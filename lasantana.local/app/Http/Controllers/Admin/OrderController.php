<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\OrderRepository;

use App\Http\Requests\OrderRequest;
use Config;
use App\Order;

class OrderController extends AdminController
{
    protected $orderRepository;

    public function __construct( OrderRepository $orderRepository ) {
        parent::__construct();
        $this->orderRepository = $orderRepository;
        $this->dirResource = 'order';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Заказы';
        $orders  = $this->orderRepository->getOrders( Config::get('settings.pagginate_orders_admin') );
       
        $this->out['content'] = view( 'admin.' . $this->dirResource.'.content')->
                with('orders', $orders )->render();
        
        return $this->renderOutput();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $this->title = 'Обработка заказа - ' . $order->name;
        if ($order->id) {
            $order->load('products');
        }
        $this->out['content'] = view('admin.' . $this->dirResource.'.update')->
            with([
                'order' => $order,
            ])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        if ($order->id) {
            $order->load('products');
        }

        $result = $this->orderRepository->update($request, $order);
        if (is_array($result) && !empty($result['error_message'])) {
            return back()->withInput()->with($result);
        }

        return redirect('/admin/orders')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->id) {
            $order->load('products');
        }
        $result = $this->orderRepository->delete($order);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin/orders')->with($result);
    }
}
