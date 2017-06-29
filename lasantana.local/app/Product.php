<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Storage;
use Image;
use Config;

class Product extends Model
{
    private $pathImage;
    private $storage;
    private $images;
    
    private $mini = 'mini';
    private $normal = 'normal';
    private $max = 'max';
    
    function getMini() {
        return $this->mini;
    }

    function getNormal() {
        return $this->normal;
    }

    function getMax() {
        return $this->max;
    }
    
    function getImages() {
        return $this->images;
    }
        
    function setImages($images) {
        $this->images = $images;
    }

    public function __construct() {
        $this->pathImage = public_path() . '/adm/images/products/'; 
        $this->storage = Storage::disk('images');
    }

    protected $fillable = [ 'title', 'content', 'price', 'img', 'new', 'keywords', 'description', 'user_id', 'category_id'];
        
    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function orders() {
        return $this->belongsToMany('App\Order', 'orders_products')->withPivot('quantity_product', 'summa_product');
    }
    
    public function getProductDir() {
        if (!is_dir( $this->pathImage . $this->id )) {
            mkdir( $this->pathImage . $this->id );
        }
        $this->pathImage .=  $this->id; 
    }

    public function addImages() {
        foreach ($this->images as $image) {
            $obj = new \stdClass;
            $obj->mini = $this->mini . $image;
            $obj->normal = $this->normal . $image;
            $obj->max = $this->max . $image;

            $img = Image::make( $this->storage->get( $image ) );
            //$img->save($this->pathImage . '/' . $obj->max, 100);
            $img->fit(
                    Config::get('settings.products_img')['max']['width'], 
                    Config::get('settings.products_img')['max']['height']
                )->save($this->pathImage . '/' . $obj->max, 100);
            $img->fit(
                    Config::get('settings.products_img')['normal']['width'], 
                    Config::get('settings.products_img')['normal']['height']
                )->save($this->pathImage . '/' . $obj->normal, 100);
            $img->fit(
                    Config::get('settings.products_img')['mini']['width'], 
                    Config::get('settings.products_img')['mini']['height']
                )->save($this->pathImage . '/' . $obj->mini, 100);


            $this->storage->delete( $image );
        }
    }
    
    public function deleteImages() {
        $size = [$this->mini, $this->normal, $this->max ];
        foreach ($this->images as $image) {
            foreach ($size as $item) {
                if (is_file($this->pathImage . '/' . $item . $image)) {
                    unlink($this->pathImage . '/' . $item . $image);
                }
            }
        }
    }
    
    public function needAdd( $new ) {
        $return = [];
        $old = json_decode($this->img);
        foreach ($new as $image) {
            if (!in_array($image, $old)) {
                $return[] = $image;
            }
        }
        
        return $return;
    }
    
    public function needDelete( $new ) {
        $return = [];
        $old = json_decode($this->img);
        foreach ($old as $image) {
            if (!in_array($image, $new)) {
                $return[] = $image;
            }
        }
        
        return $return;
    }

    
}
