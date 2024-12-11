<?php

namespace App\Http\Controllers;

use App\Models\Predictions;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $prediction = Predictions::where('user_id', Auth::user()->id)->latest()->first();

        return view('pages.index', [
            'title' => 'Home - DiaCheck',
            'active' => 'home',
            'prediction' => $prediction
        ]);
    }
}
