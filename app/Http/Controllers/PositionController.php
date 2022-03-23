<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::get();
        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePositionRequest $request)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['admin_created_id'] = auth()->user()->id;
        $validatedRequest['admin_updated_id'] = auth()->user()->id;
        Position::create($validatedRequest);
        return redirect()->route('positions.index')->with('alert-success', 'Position has been successfuly created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['admin_updated_id'] = auth()->user()->id;
        $position->update($validatedRequest);
        return redirect()->route('positions.index')->with('alert-success', 'Position has been successfuly updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Position $position)
    {

        $position->delete();
        $request->session()->put('alert-info', 'Position has been deleted');
        if ($request->ajax()) {
            return response('deleted');
        }
        return redirect()->back();
    }
}
