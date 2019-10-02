<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FilmsController;

use App\Order;
use DateTime;
use Illuminate\Http\Request;
use App\Hall;
use App\Film;
use App\Timetable;
use Illuminate\Support\Facades\Auth;

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
            $arResult['headFilm'] = Film::take(1)->get()[0];

            $times = $film->timetables;

            foreach ($times as $time) {
                $arResult['films'][$key]['times'][] = date('H:i', DateTime::createFromFormat('Y-m-d H:i:s', $time->start)->format('U'));
            }
        }

        return view('layout.main', $arResult);
    }

    public function order($id)
    {
        $order = Order::find($id);
        if ($order->user_id === Auth::user()->id) {
            $arResult['order'] = $order;
            return view('layout.order.index', $arResult);
        } else {
            return redirect()->route('home');
        }
    }
}
