<?php

namespace Modules\Influencer\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class TwitchResource extends JsonResource
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
            "id"            => $this->id ,
            "influencer_id" => optional($this->influencer)->name,
            "influencer_link" => route("dashboard.influencers.show", $this->influencer_id),
            "status"    => $this->status ,
            "user_name"    => $this->user_name ,
            "account_id"    => $this->account_id ,
            'latest_calling_at'         => $this->latest_calling_at ? $this->latest_calling_at->format("d-m-Y H:i a") : "" ,
            "created_at"=> $this->created_at->format("d-m-Y H:i a") ,
        ];
    }
}
