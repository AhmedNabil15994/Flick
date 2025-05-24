<?php

namespace Modules\Package\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            "title.*" => "required|unique_translation:packages,title|string|max:255" ,
            "description" => "nullable", 
            "price"       => "numeric|min:0" ,
            "duration"    => "integer|min:1" ,
            "is_free"     => "sometimes",
            "status"      => "sometimes"
        ];
        if (strtolower($this->getMethod()) == "put") {
            $rule["title.*"]  = "required|unique_translation:packages,title,{$this->package},id|string|max:255" ;
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
