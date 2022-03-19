<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(public_path('storage/'));
        $avatar = Image::make('https://klike.net/uploads/posts/2019-03/1551511816_38.jpg')->fit(300);
        // sdd($avatar);
        return $avatar->response('jpg');
        // return view('home', compact('avatar'));
    }
}
