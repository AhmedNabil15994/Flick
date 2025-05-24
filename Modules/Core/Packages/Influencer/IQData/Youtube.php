<?php

namespace Modules\Core\Packages\Influencer\IQData;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Packages\Influencer\Enum\Platform;
use Modules\Core\Packages\Influencer\Concerns\IQDataTrait;
use Modules\Influencer\Entities\Youtube as Model;
use Modules\Core\Packages\Influencer\Contracts\YoutubeStatisticInterface;

class Youtube implements YoutubeStatisticInterface
{
    use IQDataTrait;

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function fetchDataApi($forceUpdate=false)
    {
        if (
            $forceUpdate == false &&
            $this->model->latest_calling_at &&
            $this->model->api_info && isset($this->model->api_info["report_id"]) &&
            isset($this->model->api_info["created"])
            && now()->diffInDays(Carbon::parse($this->model->api_info["created"])) < 55

        ) {
            $this->response = $this->iQDataApi->getReportById($this->model->api_info["report_id"]);
        } else {
            $this->response = $this->iQDataApi->createNewReport([
                "url" => $this->model->url ,
                "platform"=>Platform::YOUTUBE
            ]);
        }
        $this->checkingCallingApi();
        return $this;
    }

    private function getPathForFile()
    {
        return 'iqData/'.$this->model->influencer_id."/youtube" . "/".$this->model->id . ".json";
    }

    private function getDataForModelFromResponse()
    {
        return [
            "api_info"         => $this->response["report_info"],
            "latest_calling_at" =>$this->getLatestCallingApiDate(),
            "is_verified"       => $this->getFromResponse("user_profile.is_verified") ,
            "is_hidden"         => $this->getFromResponse("user_profile.is_hidden") ,
            "user_name"         => $this->getFromResponse("user_profile.custom_name") ,
            "account_id"        => $this->getFromResponse("user_profile.user_id") ,
            "followers"       => $this->getFromResponse("user_profile.followers", 0) ,
            "posts_count"       => $this->getFromResponse("user_profile.posts_count", 0) ,
            "engagements"       => $this->getFromResponse("user_profile.engagements", 0) ,
            "engagement_rate"       => $this->getFromResponse("user_profile.engagement_rate", 0) ,
            "avg_likes"         => $this->getFromResponse("user_profile.avg_likes", 0) ,
            "avg_dislikes"       => $this->getFromResponse("user_profile.avg_dislikes", 0) ,
            "avg_comments"       => $this->getFromResponse("user_profile.avg_comments", 0) ,
            "avg_views"       => $this->getFromResponse("user_profile.avg_views", 0) ,
            "total_views"       => $this->getFromResponse("user_profile.total_views", 0) ,
            "audience_genders"       => $this->getFromResponse("audience_followers.data.audience_genders") ,
            "audience_ages"       => $this->getFromResponse("audience_followers.data.audience_ages") ,
            "stat_history"        => $this->getFromResponse("user_profile.stat_history"),
            "audience_genders_per_age"       => $this->getFromResponse("audience_followers.data.audience_genders_per_age") ,
            "audience_genders_per_age_commenter"          => $this->getFromResponse("audience_commenters.data.audience_genders_per_age"),
            "audience_genders_commenter"       => $this->getFromResponse("audience_commenters.data.audience_genders") ,

        ];
    }
}
