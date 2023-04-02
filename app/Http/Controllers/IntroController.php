<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntroCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class IntroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IntroCreateRequest $request)
    {
        $user = User::create($request->validated());
        session(['user_id' => $user->id]);

        return redirect()->route('questions.show', ['questionIndex' => 1]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('intro');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
