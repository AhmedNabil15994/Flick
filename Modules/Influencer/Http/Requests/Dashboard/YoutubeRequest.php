<?php

namespace Modules\Influencer\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class YoutubeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =  [
            "user_name"        => "nullable|max:255",
            "account_id"      => "nullable|string|max:255" ,
            "influencer_id"         => "required|exists:influencers,id",
            "workers"        => "nullable|array" ,
            "worker.*"      => "required|exists:users,id",
            "status"     => "sometimes",
            "url"       => "required|url",
            "posts_count"  => "nullable|numeric|min:0",
            "followers"  => "nullable|numeric|min:0",
            "avg_dislikes"  => "nullable|numeric|min:0",
            "avg_comments"  => "nullable|numeric|min:0",
            "total_views"  => "nullable|numeric|min:0",
            "avg_views"  => "nullable|numeric|min:0",
            "avg_likes"  => "nullable|numeric|min:0",
            "engagement_rate"           => "nullable|numeric|min:0",
            "engagements"           => "nullable|numeric|min:0"


        ];


        return $rule;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
