<?php

namespace Modules\Influencer\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
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
            "image" =>  url(optional($this->influencer)->image ?? "/uploads/default.png"),
            "influencer_id" => optional($this->influencer)->name ,
            "mobile" => (optional($this->influencer)->phone_code) . optional($this->influencer)->mobile ,
            'video' => $this->video ? url($this->video) : '',
            "email" => optional($this->influencer)->email ,
            "approve_at"   => $this->approve_at,
            "status"=> $this->generateStatusSelector(),
            "invitation_status"=> $this->invitation_status ? __('influencer::dashboard.events.form.active') : __("influencer::dashboard.events.form.notActive"),
            'ivt_status' => $this->invitation_status,
            "created_at"=> $this->created_at->format("d-m-Y H:i a") ,
            "instagram_info"=> $this->when($this->relationLoaded('influencer') && $this->influencer->relationLoaded("instagrams"), $this->mapInstagrams()),
            "youtube_info"=> $this->when($this->relationLoaded('influencer')  && $this->influencer->relationLoaded("youtubes"), $this->mapYoutubes()),
            "tiktok_info"=> $this->when($this->relationLoaded('influencer')  && $this->influencer->relationLoaded("tiktoks"), $this->mapTiktoks()),

        ];
    }


    public function mapInstagrams()
    {
        $accounts = "";

        foreach ($this->influencer->instagrams as  $model) {
            $url = route("dashboard.instagram.show", $model->id);
            $accounts .= "<a href='".$url."' target='_blank'> <i class='fa fa-instagram'></i> <span style='display:none'>$url</span></a>";
        }

        return $accounts;
    }

    public function mapYoutubes()
    {
        $accounts = "";

        foreach ($this->influencer->youtubes as  $model) {
            $url = route("dashboard.youtube.show", $model->id);
            $accounts .= "<a href='".$url."' target='_blank'> <i class='fa fa-video-camera'></i>  <span style='display:none'>$url</span> </a>";
        }

        return $accounts;
    }

    public function mapTiktoks()
    {
        $accounts = "";

        foreach ($this->influencer->tiktoks as  $model) {
            $url = route("dashboard.tiktok.show", $model->id);
            $accounts .= "<a href='".$url."' target='_blank'> <i class='fa fa-youtube'></i> <span style='display:none'>$url</span></a>";
        }

        return $accounts;
    }

    public function generateStatusSelector()
    {
        return view('influencer::dashboard.events.components.change-status-selector',['status' => $this->status,'id' => $this->id])->render();
    }
}
