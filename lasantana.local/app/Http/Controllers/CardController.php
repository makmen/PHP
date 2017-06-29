<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Repositories\ProductRepository;
use App\Repositories\OrderRepository;

use App\Card;
use Validator;

class CardController extends AppController
{
    protected $productRepository;
        
    public function __construct(ProductRepository $productRepository ) {
        parent::__construct();
        $this->dirResource = 'card';
        $this->productRepository = $productRepository;
    }

    public function add() {
        $id = (int)Input::get('id');
        if ( $id <=0 ) {
            return false;
        }
        $qty = (int)Input::get('quantity');
        $product = $this->productRepository->getById($id);
        if (!$product) {
            return false;
        }
        $card = new Card();
        $card->addToCard($product, $qty);
        $out = [
            'quantity' => session('card.quantity'),
            'sum' => session('card.sum')
        ];

        return $out;
    }
    
    public function deleteItem() {
        $id = (int)Input::get('id');
        if ( $id <=0 ) {
            return false;
        }
        $card = new Card();
        $card->deleteCard($id);
        $out = [
            'quantity' => session('card.quantity') ?: 0,
            'sum' => session('card.sum') ?: 0
        ];
        
        return $out;
    }
 
}
