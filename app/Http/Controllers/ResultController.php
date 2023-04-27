<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Result;
use App\Http\Requests\ResultCreateRequest;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::with('question', 'user')->paginate(5);

        return view('admin-result', compact('results'));
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

    /**
     * Update the specified resource in storage.
     */
    public function update(ResultCreateRequest $request)
    {
        try {
            $result = Result::findOrFail($request->result_id);
            $result->update($request->validated());
            session()->flash('success', 'Result has been updated successfully!');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Failed to update the Result!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $result = Result::findOrFail($request->result_id);
            $result->delete();
            session()->flash('success', 'Result has been deleted successfully!');
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Failed to delete the Result!');
        }
        return redirect()->back();
    }
}
