<?php

namespace Modules\Influencer\Transformers\Dashboard;

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
            "description" => $this->description ,
            "start_at"   => $this->start_at,
            "invitations_count"=> $this->invitations_count,
            "invitations_accept_count"=> $this->invitations_accept_count,
            "invitations_refused_count"=> $this->invitations_refused_count,
            "created_at"=> $this->created_at->format("d-m-Y H:i a") ,
            "deleted_at" => $this->deleted_at

        ];
    }
}
