<?php

namespace Modules\Influencer\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class TiktokResource extends JsonResource
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
            "influencer_fk" => $this->influencer_id,
            "image"         =>  url(optional($this->influencer)->image ?? "/uploads/default.png"),
            "influencer_link" => route("dashboard.influencers.show", $this->influencer_id),
            "status"    => $this->status ,
            "user_name"    => $this->user_name ,
            "followers"     => $this->followers ?? 0,
            "engagements"   => $this->engagements ?? 0,
            "engagement_rate"   => $this->engagement_rate ?? 0,
            "posts_count"   => $this->posts_count ?? 00,
            "total_likes"   => $this->total_likes ?? 0,
            "account_id"    => $this->account_id ,
            'latest_calling_at'         => $this->latest_calling_at ? $this->latest_calling_at->format("d-m-Y H:i a") : "" ,
            "created_at"=> $this->created_at->format("d-m-Y H:i a") ,
            "influencer" => new InfluencerResource($this->whenLoaded("influencer")),
        ];
    }
}
