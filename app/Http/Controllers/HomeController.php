<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return view('home');
        // $user = $request->user();
        // //admin
        // if($user->type == 0){
        //     return redirect('admin/category');
        // }
        // //customer
        // if($user->type == 1){
            return redirect('shop/');
        // }
        // //sales
        // if($user->type == 2){
        //     return redirect('employee/salesRecord');
        // }
    }
}
