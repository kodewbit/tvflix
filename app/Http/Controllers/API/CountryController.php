<?php

namespace App\Http\Controllers\API;

use App\Http\Filters\CountryFilter;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CountryController extends ApiController
{
    /**
     * Paginate Countries model.
     *
     * @param Request $request
     * @param CountryFilter $filter
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, CountryFilter $filter)
    {
        $resource = Country::filter($filter)->simplePaginate();

        return CountryResource::collection($resource);
    }

    /**
     * Show specific country details.
     *
     * @param Request $request
     * @param $id
     * @return CountryResource
     */
    public function show(Request $request, $id)
    {
        $resource = Country::findOrFail($id);

        return CountryResource::make($resource);
    }
}
