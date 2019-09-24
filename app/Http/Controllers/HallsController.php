<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Timetable;
use Illuminate\Http\Request;

class HallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::all();
        return view('admin.hall.index', ['halls' => $halls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'rows' => 'required|integer',
            'seats' => 'required|integer',
            'vip_rows' => 'integer',
            'vip_seats' => 'integer',
        ]);
        Hall::create($request->all());
        return redirect()->route('halls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hall = Hall::where('id', $id)->first();
        return view('admin.hall.edit', ['hall' => $hall]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Hall $hall
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Hall $hall)
    {
        $this->validate($request, [
            'name' => 'required',
            'rows' => 'required|integer',
            'seats' => 'required|integer',
            'vip_rows' => 'integer',
            'vip_seats' => 'integer',
        ]);
        $hall->update($request->all());
        return redirect()->route('halls.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hall $hall
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Hall $hall)
    {
        Timetable::where('hall_id', $hall->id)->delete();
        $hall->delete();
        return redirect()->route('halls.index');
    }
}
