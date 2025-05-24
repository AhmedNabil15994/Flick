<?php

namespace Modules\User\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
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
           'id'            => $this->id,
           'name'          => $this->name,
           'email'         => $this->email  ?? "",
           "admin_approved"=> $this->admin_approved,
           'mobile'        => $this->mobile ?? "",
           "country_Id"     => optional($this->country)->title,
           "type"           => __("user::dashboard.workers.form.types." .$this->type),
           'image'         => url($this->image),
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y', strtotime($this->created_at)),
       ];
    }

}
