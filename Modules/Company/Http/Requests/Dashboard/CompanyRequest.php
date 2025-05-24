<?php

namespace Modules\Company\Http\Requests\Dashboard;

use Modules\Influencer\Enum\GenderType;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule =  [
            "name"        => "required",
            "name.*"      => "required|string|max:255" ,
            "description"         => "nullable",
            "email"     => "nullable|email" ,
            "mobile"    => "nullable" ,
            "workers"   => "sometimes", 
            "workers.*" => "nullable|exists:users,id", 
            "logo"      => "nullable|image"  ,
            "manager_id" => "nullable|exists:users,id",
            "tags" => "sometimes|array",
            "tags.*"=> "sometimes|exists:tags,id"
        ];
        if (strtolower($this->getMethod()) == "put") {
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
