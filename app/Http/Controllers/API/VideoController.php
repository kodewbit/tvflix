<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\VideoFilter;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VideoController extends ApiController
{
    /**
     * Paginate Videos model.
     *
     * @param Request $request
     * @param VideoFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, VideoFilter $filter)
    {
        $resource = Video::filter($filter);

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->with($resource->getModel()->getRelations());
        }

        return VideoResource::collection($resource->simplePaginate());
    }

    /**
     * Show specific video details.
     *
     * @param Request $request
     * @param $id
     * @return VideoResource
     */
    public function show(Request $request, $id)
    {
        $resource = Video::findOrFail($id);

        if ($this->wantsExtendedInformation($request)) {
            $resource = $resource->loadMissing($resource->getRelations());
        }

        return VideoResource::make($resource);
    }
}
