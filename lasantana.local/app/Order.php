<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    
    protected $fillable = [ 'name', 'email', 'phone', 'address', 'message', 'quantity', 'summa'];
    
    public function products() {
        return $this->belongsToMany('App\Product', 'orders_products')->withPivot('quantity_product', 'summa_product');
    }
    
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required||max:255',
            'address' => 'required|max:255'
        ];
    }
    
    public function saveProduct($products) {
        $insert = [];
        foreach ($products as $product) {
            $quantity_product = session('card.items.' . $product->id . '.quantity');
            $summa_product = session('card.items.' . $product->id . '.quantity') *
                    session('card.items.' . $product->id . '.price');
            $insert[$product->id] = ['quantity_product' => $quantity_product, 'summa_product' => $summa_product ];
        }

        return $this->products()->sync( $insert );
    }
}
