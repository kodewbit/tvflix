<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\ChannelFilter;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends ApiController
{
    /**
     * Paginate Categories model.
     *
     * @param Request $request
     * @param ChannelFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, ChannelFilter $filter)
    {
        $resource = Category::filter($filter)->simplePaginate();

        return CategoryResource::collection($resource);
    }

    /**
     * Show specific category details.
     *
     * @param Request $request
     * @param $id
     * @return CategoryResource
     */
    public function show(Request $request, $id)
    {
        $resource = Category::findOrFail($id);

        return CategoryResource::make($resource);
    }
}
