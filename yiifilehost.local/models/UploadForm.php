<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\lib\files;

/**
 * ContactForm is the model behind the contact form.
 */
class UploadForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => [] , 'maxSize' => Yii::$app->params['limitSize']],
        ];
    }
 
    public function attributeLabels()
    {
        return [
            'file' => 'Ваш файл',
        ];
    }
    
    public function upload( $path )
    {
        $res = false;
        if ($this->validate()) {
            $this->file->name = time() . files::ru2Lat( $this->file->name );
            $this->file->saveAs( $path . $this->file->name );
            $res = true;
        } 
        
        return $res;
    }

}
