<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FilmsController;

use DateTime;
use Illuminate\Http\Request;
use App\Hall;
use App\Film;
use App\Timetable;

class PagesController extends Controller
{
    public function index()
    {
        $films = Film::orderBy('name')
            ->take(4)
            ->get();
        $arResult['films'] = [];

        foreach ($films as $key => $film) {
            $arResult['films'][$key]['film'] = $film;

            $arResult['films'][$key]['times'] = [];

            $times = $film->timetables;

            foreach ($times as $time) {
                $arResult['films'][$key]['times'][] = date('H:i', DateTime::createFromFormat('Y-m-d H:i:s', $time->start)->format('U'));
            }
        }

        return view('layout.main', $arResult);
    }

//    public function halls()
//    {
//        return view('admin.hall.index', ['halls' => Hall::all()]);
//    }
}
