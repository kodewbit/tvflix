<?php

namespace App\Console\Commands;

use App\Models\Channel;
use Illuminate\Console\Command;
use Kodewbit\YouTube\Contracts\YouTube;

class UpdateChannelInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update channels information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param YouTube $youtube
     * @return void
     */
    public function handle(YouTube $youtube)
    {
        // Because the YouTube API only responds with a maximum of 50 records in
        // each request, the total of channels in the database must be divided
        // into small chunks and a request must be made for each chunk that
        // is created.
        $chunks = Channel::all()->pluck('identifier')->chunk(50);

        if ($chunks->isNotEmpty()) {
            foreach ($chunks as $chunk) {
                // Make a request to the YouTube API to obtain all the information
                // associated with each of the channels found in the current chunk.
                $channels = $youtube->getChannelDetails($chunk, ['snippet']);

                foreach ($channels as $channel) {
                    // Create a reference to the channel by searching the database and obtaining
                    // the first result.
                    $channelReference = Channel::firstWhere('identifier', $channel->id);

                    // Update channel details. Set the name and description of the channel equal
                    // to the data returned by the YouTube API.
                    $channelReference->update([
                        'name' => $channel->snippet->title,
                        'description' => $channel->snippet->description,
                    ]);

                    foreach ($channel->snippet->thumbnails as $size => $attributes) {
                        // Create or update channel thumbnails in their different sizes.
                        $channelReference->thumbnails()->updateOrCreate([
                            'url' => $attributes->url,
                            'size' => $size,
                            'width' => $attributes->width,
                            'height' => $attributes->height
                        ]);
                    }
                }
            }
        }
    }
}
