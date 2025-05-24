<?php

namespace Modules\Influencer\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            "title.*" => "required|unique_translation:tags,title|string|max:255" ,
            "description" => "nullable",
            "status"      => "sometimes"
        ];
        if (strtolower($this->getMethod()) == "put") {
            $rule["title.*"]  = "required|unique_translation:tags,title,{$this->tag},id|string|max:255" ;
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
