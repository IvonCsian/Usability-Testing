<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntroCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BeginController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(IntroCreateRequest $request)
    {
        $user = User::create($request->validated());
        session(['user_id' => $user->id]);

        return redirect()->route('questions.show', ['questionIndex' => 1]);
    }
}
