<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Time\Time;
use Illuminate\Http\Request;
use App\Timetable;
use App\Hall;
use App\Film;

class TimetablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::all();
        $filmIdName = [];
        foreach ($films as $film) {
            $filmIdName[$film->id] = $film->name;
        }

        $halls = Hall::all();
        $hallIdName = [];
        foreach ($halls as $hall) {
            $hallIdName[$hall->id] = $hall->name;
        }

        $timetables = Timetable::all();
        return view('admin.timetable.index', [
            'timetables' => $timetables,
            'films' => $films,
            'halls' => $halls,
            'hallIdName' => $hallIdName,
            'filmIdName' => $filmIdName,
        ]);
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
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start' => 'required',
            'stop' => 'required',
            'film_id' => 'required|integer',
            'hall_id' => 'required|integer',
        ]);
        Timetable::create($request->all());
        return redirect()->route('timetables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timetable = Timetable::find($id);

        $time = FilmsController::convertDateToTime($timetable->start);
        $date = FilmsController::convertDateToDate($timetable->start);


        $film = $timetable->film;
        $hall = $timetable->hall;

        $arResult['film'] = $film;
        $arResult['hall'] = $hall;
        $arResult['date'] = $date;
        $arResult['time'] = $time;
        $arResult['timetable'] = $timetable;
        return view('layout.timetable.show', $arResult);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $timetable)
    {
        $arResult['timetable'] = $timetable;
        $arResult['films'] = Film::all();
        $arResult['halls'] = Hall::all();
        return view('admin.timetable.edit', $arResult);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Timetable $timetable)
    {
        $this->validate($request, [
            'start' => 'required',
            'stop' => 'required',
            'hall_id' => 'required',
            'film_id' => 'required',
        ]);
        $timetable->update($request->all());
        return redirect()->route('timetables.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Timetable $timetable
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return redirect()->route('timetables.index');
    }
}
