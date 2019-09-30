<?php

namespace App\Http\Controllers;

use App\Film;
use App\Hall;
use App\Order;
use App\Timetable;
use App\User;
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
        $arResult['orders'] = Order::all();
        $arResult['timetables'] = Timetable::all();
        $arResult['users'] = User::all();

        return view('admin.order.index', $arResult);
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
        if (!$request->handle) {
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

        $this->validate($request, [
            'user_id' => 'required|integer',
            'timetable_id' => 'required|integer',
            'row' => 'required|integer',
            'seat' => 'required|integer',
        ]);
        Order::create($request->all());
        return redirect()->route('orders.index');
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
     * @param Order $order
     * @return void
     */
    public function edit(Order $order)
    {
        $arResult['order'] = $order;
        $arResult['timetables'] = Timetable::all();
        $arResult['users'] = User::all();
        return view('admin.order.edit', $arResult);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return void
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
            'timetable_id' => 'required|integer',
            'user_id' => 'required|integer',
            'row' => 'required|integer',
            'seat' => 'required|integer',
        ]);
        //Проверим есть ли точно такой же заказ, чтобы избежать дублирования
        $findOrder = Order::where('timetable_id', $request->timetable_id)
            ->where('row', $request->row)
            ->where('seat', $request->seat)
            ->get();
        if ($findOrder->count() <= 1 || $findOrder === null) {
            //Проверим есть ли такой ряд и такое место в указанном зале
            //dd($order->timetable->hall->rows >= intval($request->row));
            if ($order->timetable->hall->rows >= intval($request->row)
                && $order->timetable->hall->seats >= intval($request->seat)
                && intval($request->row) > 0
                && intval($request->seat) > 0) {

                $order->update($request->all());
                return redirect()->route('orders.index');

            }
        }
        return redirect()->route('orders.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
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
