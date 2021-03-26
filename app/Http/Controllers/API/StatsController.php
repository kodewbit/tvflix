<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\StatsResource;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Country;
use App\Models\Thumbnail;
use App\Models\Video;
use Illuminate\Http\Request;

class StatsController extends ApiController
{
    /**
     * Show server stats.
     *
     * @param Request $request
     * @return StatsResource
     */
    public function index(Request $request)
    {
        $resource = [
            'total' => [
                'videos' => Video::count(),
                'countries' => Country::count(),
                'categories' => Category::count(),
                'channels' => Channel::count(),
                'thumbnails' => Thumbnail::count()
            ],
            'version' => parent::VERSION
        ];

        $resource = json_decode(json_encode($resource));

        return StatsResource::make($resource);
    }
}
