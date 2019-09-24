<?php

namespace App\Http\Controllers;

use App\Film;
use App\Hall;
use App\Order;
use App\Timetable;
use Facade\FlareClient\Time\Time;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $newOrders = json_decode($request->data);
        foreach ($newOrders as $item) {
            Order::create([
                'row' => $item->row,
                'seat' => $item->seat,
                'timetable_id' => $item->timetable_id,
                'user_id' => $item->user_id,
            ]);
        }
        $arResult = $this->make($request->timetable_id);
        return $arResult;
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function make($id)
    {
        $timetable = Timetable::find($id);

        $film = $timetable->film;
        $hall = $timetable->hall;
        $orders = $timetable->orders;

        $jsonResult = [];

        $jsonResult['timetable']['id'] = $timetable->id;
        $jsonResult['timetable']['start'] = $timetable->start;
        $jsonResult['timetable']['stop'] = $timetable->stop;

        $jsonResult['film']['id'] = $film->id;
        $jsonResult['film']['name'] = $film->name;

        $jsonResult['hall']['id'] = $hall->id;
        $jsonResult['hall']['name'] = $hall->name;
        $jsonResult['hall']['rows'] = $hall->rows;
        $jsonResult['hall']['seats'] = $hall->seats;

        $jsonResult['orders'] = [];

        if ($orders) {
            foreach ($orders as $order) {
                $jsonResult['orders'][$order->id]['row'] = $order->row;
                $jsonResult['orders'][$order->id]['seat'] = $order->seat;
            }
        }

        return json_encode($jsonResult);
    }
}
