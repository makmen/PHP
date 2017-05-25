<?php

namespace app\components;

use yii\base\Widget;
use app\models\Product;
use Yii;

class RecommendItems extends Widget {
    
    public $data;
    public $menuHtml;
    private $limit = 8;
    private $cnt = 3;
    
    public function init() {
        parent::init();
    }

    public function run() {
        // get cache
        $items = Yii::$app->cache->get('recommend');
        if($items)  {
        	return $items;
        }
        $data = Product::find()->asArray()->
                where('recommend = \'1\'')->limit($this->limit)->all();

        for ($i = 0, $j = 0, $count = count($data); $i < $count; $i++) {
            if ( count($this->data[$j]) < $this->cnt ) {
                $this->data[$j][] = $data[$i];
            } else {
                $this->data[++$j][] = $data[$i];
            }
        }
        $this->menuHtml = $this->getHtml();
        Yii::$app->cache->set('recommend', $this->menuHtml, 120);
        
        return $this->menuHtml;
    }
    
    protected function getHtml(){
        ob_start();
        include __DIR__ . '/views/recommenditems.php';
        return ob_get_clean();
    }
    


}