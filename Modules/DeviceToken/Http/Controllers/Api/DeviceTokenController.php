<?php

namespace Modules\DeviceToken\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\DeviceToken\Http\Requests\Api\DeviceTokenRequest;
use Modules\DeviceToken\Repositories\Api\DeviceTokenRepository;

class DeviceTokenController extends ApiController
{
    public function __construct(DeviceTokenRepository $token)
    {
        $this->token = $token;
    }

    public function create(DeviceTokenRequest $request)
    {
        $token =  $this->token->create($request);

        return $this->response([]);
    }
}
