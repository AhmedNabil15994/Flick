<?php

namespace Modules\Influencer\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class InfluencerResource extends JsonResource
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
            "name" => $this->name ,
            "bio" => $this->bio ,
            "status"    => $this->status ,
            "contact_number"    => $this->contact_number ,
            "address_desc"           => $this->address_desc,
            "mobile"    => $this->phone_code  . $this->mobile ,
            "age"           => $this->age,
            "website_url"    => $this->website_url ,
            'image'         => url($this->image),
            "email" => $this->email,
            "is_invite" => $this->is_invite,
            "country_id" => optional($this->country)->title,
            "state_id" => $this->when($this->relationLoaded('state'), optional($this->state)->title),
            "city_id" => $this->when($this->relationLoaded('city'), optional($this->city)->title),
            "created_at"=> $this->created_at->format("d-m-Y H:i a") ,
            "deleted_at" => $this->deleted_at,
            "tags"       =>  $this->when($this->relationLoaded('tags'), $this->mapTags()),
            "instagram_info"=> $this->when($this->relationLoaded('instagrams'), $this->mapInstagrams()),
            "youtube_info"=> $this->when($this->relationLoaded('youtubes'), $this->mapYoutubes()),
            "tiktok_info"=> $this->when($this->relationLoaded('tiktoks'), $this->mapTiktoks()),



        ];
    }

    public function mapInstagrams()
    {
        $accounts = "";
        if(!is_countable($this->instagrams)){
            return "<a href='".route("dashboard.instagram.show",  $this->instagrams->id)."' target='_blank'> <i class='fa fa-instagram'></i></a>";
        }
        foreach ($this->instagrams as  $model) {
            $accounts .= "<a href='".route("dashboard.instagram.show",  $model->id)."' target='_blank'> <i class='fa fa-instagram'></i></a>";
        }

        return $accounts;
    }

    public function mapYoutubes()
    {
        $accounts = "";
        
        foreach ($this->youtubes as  $model) {
            $accounts .= "<a href='".route("dashboard.youtube.show",  $model->id)."' target='_blank'> <i class='fa fa-video-camera'></i></a>";
        }

        return $accounts;
    }

    public function mapTiktoks()
    {
        $accounts = "";
        
        foreach ($this->tiktoks as  $model) {
            $accounts .= "<a href='".route("dashboard.youtube.show",  $model->id)."' target='_blank'> <i class='fa fa-youtube'></i></a>";
        }

        return $accounts;
    }

    public function mapTags(){
        $tags = "";

        foreach ($this->tags as  $model) {
            $tags .= " <span class='badge badge-info'>".$model->title."</span> ";
        }

        return $tags;
    }
}
