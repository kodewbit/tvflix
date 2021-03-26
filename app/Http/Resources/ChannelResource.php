<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * @inheritdoc
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'url' => $this->url,
            'country' => CountryResource::make($this->country),
            'categories' => CategoryResource::collection($this->categories),
            'thumbnails' => ThumbnailResource::collection($this->thumbnails)
        ];
    }
}
