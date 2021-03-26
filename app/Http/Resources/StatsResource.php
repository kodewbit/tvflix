<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatsResource extends JsonResource
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
            'total' => [
                'videos' => $this->total->videos,
                'countries' => $this->total->countries,
                'categories' => $this->total->categories,
                'channels' => $this->total->channels,
            ],
            'version' => $this->version
        ];
    }
}
