<?php

namespace Modules\Influencer\Transformers\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"    => $this->id ,
            "title" => $this->title ,
            "influencers_ids" => $this->influencers->pluck('id')->toArray() ,
        ];
    }
}
