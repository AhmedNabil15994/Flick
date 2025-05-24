<?php

namespace Modules\User\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
           'start_at'       =>$this->start_at->format("d-m-Y H:i a"),
           'end_at'         =>$this->end_at->format("d-m-Y H:i a"),
           'transaction_id'     => $this->transaction_id  ?? "",
           "from_admin"=> $this->from_admin,
           'is_free'        => $this->is_free,
           "price"          => $this->price,
           'package_id'         =>optional($this->package)->title,
           'created_at'    => date('d-m-Y', strtotime($this->created_at)),
       ];
    }

   
}
