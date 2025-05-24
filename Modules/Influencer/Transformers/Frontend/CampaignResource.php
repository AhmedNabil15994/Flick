<?php

namespace Modules\Influencer\Transformers\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
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
            "events" => EventResource::collection($this->events)->jsonSerialize() ,
        ];
    }
}
