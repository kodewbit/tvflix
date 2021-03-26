<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Kodewbit\YouTube\Contracts\YouTube;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Channel $channelModel
     * @param YouTube $youtube
     * @return void
     */
    public function run(Channel $channelModel, YouTube $youtube)
    {
        $channels = config('default.channels');

        foreach ($channels as $channel) {
            // Get the country to which the channel belongs.
            $channelCountry = Country::withoutGlobalScopes()
                ->firstWhere('code', $channel['country'])
                ->getAttribute('id');

            // Create the channel with its attributes.
            $channelReference = $channelModel->create([
                'url' => $channel['url'],
                'identifier' => $youtube->getResourceId($channel['url']),
                'country_id' => $channelCountry
            ]);

            // Associate the categories to the channel.
            foreach ($channel['categories'] as $category) {
                $channelReference->categories()->syncWithoutDetaching($category);
            }
        }
    }
}
