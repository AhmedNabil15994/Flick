<?php

namespace Modules\Influencer\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $rule =  [
            "title"   => "required",
            "title.*"   => "required|string|max:255" ,
            "description" => "nullable",
            "status"      => "sometimes" ,
            "campaign_id"    => "required|exists:campaigns,id",
            "start_at"      => "sometimes|date",
            "end_at"      => "sometimes|date|after:start_at",
            "companions_count" => "nullable|integer|min:0",
            "location"   => "nullable|string|url",
            "influencers"  => "sometimes|array|exists:influencers,id" ,
            "helper_links"  => "nullable|array",
        ];

        if ($this->helper_links) {
            foreach ($this->helper_links as $key => $link) {
                $rule["helper_links.$key.key"]= $key === 0 && !isset($link["link"]) ? "nullable" : "required";
                $rule["helper_links.$key.link"]=  $key === 0 && !isset($link["key"]) ? "nullable" : "required"."|url";
            }
        }

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
