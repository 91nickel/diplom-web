<?php

namespace App\Http\Controllers;

use App\Film;
use App\Timetable;
use DateTime;
use Illuminate\Http\Request;


class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arResult['films'] = Film::all();
        return view('admin.film.index', $arResult);
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
            'code' => 'required',
            'announce' => 'required',
            'length' => 'required',
        ]);
        Film::create($request->all());
        return redirect()->route('films.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $film = Film::where('code', $code)
            ->get()[0];
        $arResult['film'] = $film;

        $times = $film->timetables;
        $arResult['times'] = [];

        foreach ($times as $key => $time) {
            $arResult['times'][$key]['id'] = $time->id;
            $arResult['times'][$key]['value'] = FilmsController::convertDateToTime($time->start);
        }
        return view('layout.film.index', $arResult);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Film::where('id', $id)->first();
        return view('admin.film.edit', ['film' => $film]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Film $film)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'announce' => 'required',
            'length' => 'required',
        ]);
        $film->update($request->all());
        return redirect()->route('films.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Film $film
     * @param Timetable $timetable
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Film $film, Timetable $timetable)
    {
        Timetable::where('film_id', $film->id)->delete();
        $film->delete();
        return redirect()->route('films.index');
    }

    public static function convertDateToTime($date)
    {
        return date('H:i', DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('U'));
    }

    public static function convertDateToDate($date)
    {
        return date('d-m-Y', DateTime::createFromFormat('Y-m-d H:i:s', $date)->format('U'));
    }

}
