<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Resto\Menu;
use App\Resto\Order;

class DashboardController extends Controller
{
    private $menu, $order;
    public function __construct(){
        $this->menu = new Menu;
        $this->order = new Order;
    }

    public function index()
    {
        $data = [
            'menu_all' => $this->menu->getAll(),
        ];
        return view('dashboard.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = $this->order->validateOrder($request->all());
        if($validate){
            return redirect()->route('dashboard.index')->with('warning','warning !');
        }
        $key1 = 0;
        $key2 = 0;
        $key3 = 0;
        $key4 = 0;
        foreach ($request->input('menu_id') as $row){
            $save[] = [
                'tgl_pesan'    => Carbon::now()->format('Y-m-d'),
                'menu_id'      => $request->input('menu_id.'.$key1++),
                'qty'          => $request->input('qty.'.$key2++),
                'harga'        => $request->input('harga-jual.'.$key3++),
                'total'        => $request->input('harga.'.$key4++),
                'no_meja'      => $request->input('no_meja')
            ];
        }
        //dd($save);
        Order::insert($save);
        return view('dashboard.success');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function ajax(Request $request){
        echo $this->menu->getPrice($request->all());
    }
}
