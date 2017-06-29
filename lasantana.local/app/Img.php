<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Storage;
use Illuminate\Http\UploadedFile;

class Img extends Model
{
    private $uploaddir;
    private $file;
    private $name;
    private $allowedExtention = [ 'jpeg', 'jpg', 'png', 'bmp', 'gif'];
    private $size = 10000000;
    private $storage;
    
    function getName() {
        return $this->name;
    }
 
    public function __construct($file) {
        $this->uploaddir = storage_path('images/');
        $this->storage = Storage::disk('images');
        $this->file = $file;
    }

    public function validateData() {
        $this->name = strtolower( str_random(6) . time() . '.' . strtolower( $this->file->extension() ) );
        if (
            ( $this->file->extension() == ''  ) ||
            !in_array( strtolower($this->file->extension()), $this->allowedExtention)
        ) {
            
            return 'Файл не относится к картинкам';
        }
        if ( $this->file->getClientSize() >= $this->size  ) {
            return 'Файлы слишком большие, огроничение по объейму 10 Мб';
        }
        if ( !$this->file->move( $this->uploaddir , $this->name  ) ) {
            return 'Ошибка загрузки файлов';
        }

        return false;
    }

    public function loadFile() {
        if ( !$this->file->move( $this->uploaddir , $this->name  ) ) {
            return 'Ошибка загрузки файлов';
        }
        
        return false;
    }
    
    public function deleteFile() {
        if ( $this->storage->has( $this->file )) {
            $this->storage->delete([ $this->file ]);
        }
    }

    
    
}
