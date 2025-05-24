<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Dashboard\LoginRequest;

use Modules\Client\Entities\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Authentication\Http\Requests\Dashboard\SigninRequest;
use Modules\Authentication\Http\Requests\Dashboard\SignupRequest;
use Modules\Plan\Entities\Plan;

use Session;

class SignController extends Controller
{
    use Authentication;
    /**
     * Display a listing of the resource.
     */
    public function showsignup()
    {
        return view('authentication::frontend.auth.signup');
    }

    /**
     * signup method
     */
    public function signup(SignupRequest $request)
    {

        $validated = $request->validated();
        try {
            $client = Client::create($validated);
        } catch (\Exception $e) {
            return redirect()->back()->with(['type' => 'error', 'message' => $e]);
        }

        //event(new Registered($client));
        Auth::guard('client')->login($client);
        return redirect()->route('home');
    }

    public function showsignin()
    {
        return view('authentication::frontend.auth.signin');
    }
    /**
     * signin method
     */
    public function signin(SigninRequest $request)
    {
        try {
        // LOGIN BY : Mobile & Password
        if(is_numeric($request->email)):
            $auth = Auth::guard('frontend')->attempt([
                'mobile'     => $request->email,
                'password'   => $request->password
            ],  $request->has('remember')
        );

        // LOGIN BY : Email & Password
        elseif(filter_var($request->email, FILTER_VALIDATE_EMAIL)):
            $auth = Auth::guard('frontend')->attempt([
                'email'     => $request->email,
                'password'  => $request->password],
                $request->has('remember')
            );

        endif;

        } catch (\Exception $e) {
//            return redirect()->back()->withErrors($e)->withInput($request->except('password'));
            return redirect()->back()->with(['type'=>'error','message'=>"Something Wrong".$e])->withInput($request->only('email', 'remember'));

        }
        $intended_url = Session::has('url.intended') ? Session::get('url.intended', url('/')) : route('frontend.home.index');
        Session::forget('url.intended');
        return redirect()->to($intended_url);
    }


    /**
     * Logout method
     */
    public function signout(Request $request)
    {
        auth()->guard('frontend')->logout();
        return redirect()->route('frontend.home.index');
    }
}
