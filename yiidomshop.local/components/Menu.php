<?php

namespace app\components;

use yii\base\Widget;
use app\models\Category;
use Yii;

class Menu extends Widget {
    
    public $data;
    public $tree;
    public $menuHtml;
    
    public function init() {
        parent::init();
    }

    public function run() {
        // get cache
        $menu = Yii::$app->cache->get('menu');
        if($menu)  {
            return $menu;
        }
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        Yii::$app->cache->set('menu', $this->menuHtml, 120);
        
        return $this->menuHtml;
    }
    
    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;  
            } else {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        
        return $tree;
    }
    
    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab){
        ob_start();
        include __DIR__ . '/views/menu.php';
        return ob_get_clean();
    }
    
}