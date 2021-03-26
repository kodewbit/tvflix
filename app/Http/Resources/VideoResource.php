<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'published' => $this->published,
            'channel' => ChannelResource::make($this->whenLoaded('channel')),
            'thumbnails' => ThumbnailResource::collection($this->thumbnails)
        ];
    }
}
