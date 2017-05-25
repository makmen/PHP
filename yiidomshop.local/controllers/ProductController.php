<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;


class ProductController extends AppController
{
    public $out = [ ];
        
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $this->out['product'] = Product::findOne($id); // ленивая загрузка

        // $this->out['product'] = Product::find()->with('category')->where(['id'=>$id]);
        if ( empty($this->out['product']) ) {
            throw new \yii\web\HttpException(404, 'Такого товара не существует');
        }
        $this->out['hits'] = Product::find()->where('hit = 1')->limit(6)->all();
        $this->setMeta('Товары для дома | ' . $this->out['product']->name , 
                $this->out['product']->keywords, 
                $this->out['product']->description);

        return $this->render('view', [ 'out' => $this->out ]  );
    }
    

    
}
