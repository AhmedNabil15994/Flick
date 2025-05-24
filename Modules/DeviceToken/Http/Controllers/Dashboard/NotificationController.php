<?php

namespace Modules\DeviceToken\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\DeviceToken\Traits\FCMTrait;
use Modules\DeviceToken\Jobs\GeneralNotification;
use Modules\DeviceToken\Repositories\Dashboard\DeviceTokenRepository;

class NotificationController extends Controller
{
    use FCMTrait;

    public function __construct(DeviceTokenRepository $token)
    {
        $this->token = $token;
    }

    public function index()
    {
        return view('devicetoken::dashboard.notifications.index');
    }

    public function send(Request $request)
    {
        dispatch(new \Modules\DeviceToken\Jobs\GeneralNotification($request->all()));

        return Response()->json([true , __('apps::dashboard.messages.send')]);
    }
}
