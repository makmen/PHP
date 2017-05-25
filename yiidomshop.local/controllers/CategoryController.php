<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public $out = [ ];
    private $pageSize = 6;

    public function actionIndex()
    {
        $this->out['products'] = Product::find()->where('hit = "1"')->limit($this->pageSize)->all();
        $this->setMeta('Товары для дома', 'дом, доски, товары', 'Белые лебеди, красный вагон');

        return $this->render('index', [ 'out' => $this->out ]  );
    }
    
    public function actionView() {
        $id = Yii::$app->request->get('id');
        $this->out['category'] = Category::findOne($id);
        if ( empty($this->out['category']) ) {
            throw new \yii\web\HttpException(404, 'Такой категории не существует');
        }

        $query = Product::find()->where('category_id = ' . $id);
        $this->out['pages'] = new Pagination( [
            'totalCount' => $query->count(),
            'pageSize' => $this->pageSize, 
            'forcePageParam' => false, 
            'pageSizeParam' => false 
            ]);
        
        $this->out['products'] = $query->offset( $this->out['pages']->offset )->
                limit( $this->out['pages']->limit )->all();

        $this->setMeta('Товары для дома | ' . $this->out['category']->name , 
                $this->out['category']->keywords, 
                $this->out['category']->description);
        
        return $this->render('view', [ 'out' => $this->out ]  );
    }

    public function actionSearch() {
        $this->out['search'] = trim( Yii::$app->request->get('search') );

        $this->setMeta('Товары для дома | Поиск');
        if ( !$this->out['search'] ) {
            return $this->render('search', [ 'out' => $this->out ]  );
        }
        
        $query = Product::find()->where( ['like', 'name', $this->out['search'] ] );
        $this->out['pages'] = new Pagination( [
            'totalCount' => $query->count(),
            'pageSize' => $this->pageSize, 
            'forcePageParam' => false, 
            'pageSizeParam' => false 
            ]);
        $this->out['products'] = $query->offset( $this->out['pages']->offset )->
                limit( $this->out['pages']->limit )->all();
        
        return $this->render('search', [ 'out' => $this->out ]  );
    }
    
}
