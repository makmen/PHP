<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use Session;
use App\Order;

class OrderController extends AppController
{
    protected $orderRepository;
        
    public function __construct(OrderRepository $orderRepository  ) {
        parent::__construct();
        $this->dirResource = 'order';
        $this->orderRepository = $orderRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->out['content'] = view($this->dirResource . '.content')->
            with([

            ])->render();
        
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (session('card.items') == null) {
            return redirect('/order');
        }
        $order = new Order();
        $this->validate($request, $order->rules());
        $result = $this->orderRepository->add($request);
        if (is_array($result) && !empty($result['error_message'])) {
            return back()->withInput()->with($result);
        }
        Session::forget('card');

        return redirect('/order')->with('status', 'Заказ принят. Мы с вами свяжемся в ближайшее время.');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
