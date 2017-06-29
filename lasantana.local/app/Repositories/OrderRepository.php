<?php

namespace App\Repositories;

use App\Order;
use App\Repositories\ProductRepository;


class OrderRepository extends Repository {
    protected $productRepository;
    
    public function __construct(Order $model, ProductRepository $productRepository) {
        $this->model = $model;
        $this->productRepository = $productRepository;
    }
    
    public function getOrders( $pagination ) {
        $orders = $this->getMany('*')->orderBy('status', 'ASC')->orderBy( 'id', 'ASC' )->paginate( $pagination ) ;

        return $orders;
    }

    public function add($request) {
        $result = false;
        $data = $request->except('_token');
        $products = $this->productRepository->getProductByKeys( array_keys( session('card.items') ) );  
        if ( !$products ) {
            $result['error_message'] = 'Нет товаров в корзине';
        }

        if ( !$this->model->fill($data)) {
            $result['error_message'] = 'Ошибка при работе с данными';
        }

        $this->model->quantity = session('card.quantity');
        $this->model->summa = session('card.sum');

        if (!( $this->model->save() && $this->model->saveProduct($products) )) {
            $result['error_message'] = 'Ошибка при работе с базой данных';
        }
        
        return $result;
    }
    
    public function reCalcProducts() {
        
    }
    

    public function update($request, $order) {
        $result = false;
        $data = $request->except('_token', 'quantity', 'summa');
        if (empty($data)) {
            return ['error_message' => 'Нет данных'];
        }    
        if (empty( $data['change-quantity'])) {
            return ['error_message' => 'Нет ни одного товара'];
        }
        $order->fill($data);
        
        $products = [];
        foreach ($order->products as $v ) {
            $products[$v->id] = $v;
        }
        $keyProducts = array_keys($products);
        
        
        $quantity = 0;
        $summa = 0;
        foreach ( $data['change-quantity'] as $k => $v ) {
            $quantity += $v;
            if (in_array( $k, $keyProducts )) {
                $summa += ($v * $products[$k]->price);
            }
        }

        $updateItems = false;
        if ( $summa != $order->summa || $quantity != $order->quantity  ) {
            $order->quantity = $quantity;
            $order->summa = $summa;
            $updateItems = true;

        }

        $addProducts = [];
        foreach ( $data['change-quantity'] as $k => $v ) {
            if (in_array( $k, $keyProducts )) {
                $addProducts[$products[$k]->id] = ['quantity_product' => $v, 'summa_product' => $products[$k]->price * $v ];
            }
        }

        if ($updateItems && count($addProducts) > 0) {
            if ( $order->products()->detach() && $order->products()->sync( $addProducts ) ) {
                
            } else {
                return array('error_message' => 'Ошибка работы с базой данных ММ');

            }

        }
        
        $order->status = 1;
        if ($order->update()) {

            return ['status' => 'Заказ обработан'];
        } else {
            return array('error_message' => 'Ошибка работы с базой данных Order');
        }


    }
    
    
    public function delete($order) {
        if ( $order->products()->sync([]) && $order->delete()) {
            return ['status' => 'Заказ удален'];
        } else {
            return array('error_message' => 'Ошибка работы с базой данных');
        }
        
        
    }
    
}
    