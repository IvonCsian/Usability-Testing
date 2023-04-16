<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Result;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $name = User::where('id', session('user_id'))->pluck('name')->first();
        $times = Result::where('user_id', session('user_id'))->pluck('time')->toArray();
        $total_time = (string) array_sum($times);
        if($name != null && $total_time != null)
        {
            session()->forget('user_id');
        }
        return view ('result', ['total_time' => $total_time, 'name' => $name]);
    }
}
