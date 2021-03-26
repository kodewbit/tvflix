<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\ChannelFilter;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChannelController extends ApiController
{
    /**
     * Paginate Channels model.
     *
     * @param Request $request
     * @param ChannelFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, ChannelFilter $filter)
    {
        $resource = Channel::filter($filter);

        return ChannelResource::collection($resource->simplePaginate());
    }

    /**
     * Show specific country details.
     *
     * @param Request $request
     * @param $id
     * @return ChannelResource
     */
    public function show(Request $request, $id)
    {
        $resource = Channel::findOrFail($id);

        return ChannelResource::make($resource);
    }
}
