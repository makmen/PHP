<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ProductRepository;
use App\Product;

class ProductController extends AppController
{
    protected $productRepository;
    
    public function __construct(ProductRepository $productRepository ) {
        parent::__construct();
        $this->dirResource = 'product';
        $this->productRepository = $productRepository;
    }
    
    public function index()
    {

    }

    public function show(Product $product)
    {
        $product->img = $this->productRepository->defineImages( json_decode($product->img) );
        $this->out['content'] = view($this->dirResource . '.content')->
            with([
                'product' => $product,
                'near' => $this->productRepository->getProductsNear( $product->id )
            ])->render();
        
        return $this->renderOutput();
    }
    

}
