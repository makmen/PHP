<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Session;

class Card extends Model
{

    public function __construct() {

    }
    
    public function addToCard ($product, $quantity) {
        $quantity = ($quantity > 0) ? $quantity : 1;
        $images = json_decode($product->img);
        if (Session::has('card.items.'.$product->id)) {
            $value = Session::get('card.items.'.$product->id . '.quantity');
            Session::put('card.items.'.$product->id . '.quantity', ($value + $quantity) );
        } else {
            Session::put('card.items.'.$product->id, [
                'quantity' => $quantity,
                'title' => $product->title,
                'price' => $product->price,
                'img' => $images[0]
            ]);
        }
        if (Session::has('card.quantity')) {
            Session::put('card.quantity', (Session::get('card.quantity') + $quantity) );
        } else {
            Session::put('card.quantity', $quantity );
        }
        if (Session::has('card.sum')) {
            Session::put('card.sum', (Session::get('card.sum') + $quantity * $product->price) );
        } else {
            Session::put('card.sum', $quantity * $product->price );
        }
    }
    
    public function deleteCard($id) {
        if (Session::has('card.items.'.$id)) {
            $qtyMinus = Session::get('card.items.'.$id . '.quantity');
            $sumMinus = Session::get('card.items.'.$id . '.quantity') * Session::get('card.items.'.$id . '.price');
            $totalQuantity = Session::get('card.quantity');
            $totalSum = Session::get('card.sum');

            Session::put('card.quantity', ($totalQuantity - $qtyMinus) );
            Session::put('card.sum', ($totalSum - $sumMinus) );
            Session::forget('card.items.'.$id);
            if (Session::get('card.quantity') == 0 && Session::get('card.sum') == 0) {
                Session::forget('card');
            }
        }
    }
    



    

}
