<?php

namespace Modules\Influencer\Transformers\Dashboard;

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
            "description" => $this->description ,
            "start_at"   => $this->start_at,
            "end_at"   => $this->start_at,
            "company_id"   => optional($this->company)->name,
            "is_active"    => $this->is_active ,
            "status"    => $this->status ,
            "created_at"=> $this->created_at->format("d-m-Y H:i a") ,
            "deleted_at" => $this->deleted_at

        ];
    }
}
