<?php

namespace app\models;

use yii\base\Model;

class Card extends Model {
        
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    public function addToCard($product, $quantity = 1) {
    	$mainImage = $product->getImage();
        if ( isset($_SESSION['card'][$product->id]) ) {
            $_SESSION['card'][$product->id]['quantity'] += $quantity;
        } else {
            $_SESSION['card'][$product->id] = [
                'quantity' => $quantity,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $mainImage->getUrl('50x50')
            ];
        }
        $_SESSION['card.quantity'] = isset( $_SESSION['card.quantity'] ) ? 
            $_SESSION['card.quantity'] + $quantity : $quantity;
        $_SESSION['card.sum'] = isset( $_SESSION['card.sum'] ) ? 
            $_SESSION['card.sum'] + $quantity * $product->price : $quantity * $product->price;
    }
    
    public function recalc($id){
        if(!isset($_SESSION['card'][$id])) return false;
        $qtyMinus = $_SESSION['card'][$id]['quantity'];
        $sumMinus = $_SESSION['card'][$id]['quantity'] * $_SESSION['card'][$id]['price'];
        $_SESSION['card.quantity'] -= $qtyMinus;
        $_SESSION['card.sum'] -= $sumMinus;
        unset($_SESSION['card'][$id]);
    }
    
}