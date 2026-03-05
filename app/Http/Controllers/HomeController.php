<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s=Auth::user()->customerId;
        $data['data']=DB::table('bills')->where('user_id',$s)->get();
        return view('home',$data);
    
    $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
    $kwhData = [110, 135, 128, 150, 142];

    return view('home', compact('labels', 'kwhData'));
}


}
