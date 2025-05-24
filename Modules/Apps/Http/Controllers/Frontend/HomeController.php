<?php

namespace Modules\Apps\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Modules\Area\Entities\Country;
use Illuminate\Routing\Controller;
use Modules\Influencer\Http\Controllers\Frontend\InfluencerController;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $countries = Country::active()->pluck('title','id')->toArray();
        $socials = ["instagram","youtube","tiktok","twitch"];
        $influencersHtml = (new InfluencerController)->getInfluencersView($request);
        
        return view(
            'apps::frontend.index',
            compact('countries','socials','influencersHtml')
        );
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route("frontend.home.index");
    }
}
