<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;
use App\Category;
use App\Product;
use App\lib\UploadHandler;
use Illuminate\Http\UploadedFile;
use App\Img;

use Storage;
use Config;

class ProductController extends AdminController
{

    public function __construct( 
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    ) {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->dirResource = 'product';
    }
    
    public function index()
    {
        $this->title = 'Товары';
        $products = $this->productRepository->getProducts( 
            Config::get('settings.pagginate_products_admin')
        );
        $this->out['content'] = view( 'admin.' . $this->dirResource.'.content')->
                with('products', $products )->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->out['content'] = view( 'admin.' . $this->dirResource.'.update' )->
            with([
                'categories' => $this->categoryRepository->buildTreeCategories(),
                'newProducts' => [ 'Нет', 'Да' ]
            ])->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $result = $this->productRepository->add($request);
        if (is_array($result) && !empty($result['error_message'])) {
            return back()->with($result);
        }

        return redirect('/admin/products')->with($result);
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
    public function edit(Product $product)
    {
        $this->title = 'Реадактирование товара - ' . $product->title;
        
        if (is_string($product->img) && 
                 is_array(json_decode($product->img)) &&
                 (json_last_error() == JSON_ERROR_NONE) ) {
            $product->img = json_decode($product->img);
        }
        $this->out['content'] = view('admin.' . $this->dirResource.'.update')->
            with([
                'product' => $product, 
                'categories' => $this->categoryRepository->buildTreeCategories(),
                'newProducts' => ['Нет', 'Да']
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
    public function update(ProductRequest $request, Product $product)
    {
        $result = $this->productRepository->update($request, $product);
        if (is_array($result) && !empty($result['error_message'])) {
            return back()->with($result);
        }

        return redirect('/admin/products')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->user_id != \Auth::user()->id) {
            abort(403);
        }
        $result = $this->productRepository->delete($product);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        
        return redirect('/admin/products')->with($result);
    }
    
    public function loader(Request $request) {
        $error = false;
        $files = [];
        if ($request->isMethod('post')) {
            foreach ($request->file() as $file) {
                $img = new Img($file);

                if ( $error = $img->validateData() ) {
                    break;
                }
                
                $files[] = $img->getName();
            }
        }
        
        $data = $error ? [ 'error' => $error ] : [ 'files' => $files ];

        echo json_encode( $data );
    }

    public function delfile (Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            if ( isset($data['file']) ) {
                $img = new Img( $data['file'] );
                $img->deleteFile();
            }
        }
    }

}
