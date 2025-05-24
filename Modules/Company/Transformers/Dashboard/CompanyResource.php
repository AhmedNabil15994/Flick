<?php

namespace Modules\Company\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            "description" => $this->description ,
            "status"    => $this->status ,
            "mobile"    => $this->mobile ,
            "email"           => $this->email,
            'logo'         => url($this->logo),
            "email" => $this->email,
            "manager_id" => optional($this->manager)->name,
            "created_at"=> $this->created_at->format("d-m-Y H:i a") ,
            "deleted_at" => $this->deleted_at

        ];
    }
}
