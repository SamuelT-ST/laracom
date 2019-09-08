<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $settings = Setting::with('media')->get()->mapWithKeys(function ($setting){
           return [$setting['option_slug'] => $setting];
        });

        return view('front.home.index')->with([
            'settings' => $settings
        ]);
    }
}
