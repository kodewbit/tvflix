<?php

namespace App\Console\Commands;

use App\Models\Channel;
use Illuminate\Console\Command;
use Kodewbit\YouTube\Contracts\YouTube;

class UpdateChannelVideosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update channel videos';

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
        // Obtain all the channels found in the database to make a request to the
        // YouTube API requesting only the videos that
        $channels = Channel::all();

        foreach ($channels as $channel) {
            // Get the live videos of a given channel using its identifier.
            // YouTube API consumes 100 quotas in each request through the
            // "search" method.
            $videos = $youtube->getChannelLiveVideos($channel->identifier);

            foreach ($videos as $video) {
                $videoReference = $channel->videos()->updateOrCreate([
                    'name' => $video->snippet->title,
                    'channel_id' => $channel->id
                ], [
                    'name' => $video->snippet->title,
                    'description' => $video->snippet->description,
                    'url' => $video->id->videoId,
                    'identifier' => $video->id->videoId,
                    'published' => $video->snippet->publishTime
                ]);

                foreach ($video->snippet->thumbnails as $size => $attributes) {
                    $videoReference->thumbnails()->updateOrCreate([
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
