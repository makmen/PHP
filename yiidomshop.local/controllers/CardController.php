<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use app\models\Card;
use app\models\Order;
use app\models\OrderItems;

class CardController extends AppController
{
    public $out = [ ];
    
    public function actionViewCard() {
        $this->out['session'] = Yii::$app->session;
        $this->out['session']->open();
        $this->layout = false;
        
        return $this->render('add', [ 'out' => $this->out ]  );
    }
    
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $quantity = (int)Yii::$app->request->get('quantity');
        $quantity = !$quantity ? 1 : $quantity;
        $product = Product::findOne($id);
        if ( empty($product) ) {
            return false;
        }
        $this->out['session'] = Yii::$app->session;
        $this->out['session']->open();
        $card = new Card();
        $card->addToCard($product, $quantity);
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        
        return $this->render('add', [ 'out' => $this->out ]  );
    }
    
    public function actionClear(){
        $this->out['session'] = Yii::$app->session;
        $this->out['session']->open();
        $this->out['session']->remove('card');
        $this->out['session']->remove('card.quantity');
        $this->out['session']->remove('card.sum');
        $this->layout = false;
        
        return $this->render('add', [ 'out' => $this->out ]  );
    }
    
    public function actionDelItem(){
        $id = Yii::$app->request->get('id');
        $this->out['session'] = Yii::$app->session;
        $this->out['session']->open();
        $card = new Card();
        $card->recalc($id);
        $this->layout = false;
        
        return $this->render('add', [ 'out' => $this->out ]  );
    }
    
    public function actionView() {
        $this->out['session'] = Yii::$app->session;
        $this->out['session']->open();
        $this->setMeta('Товары для дома | Корзина');
        $this->out['order'] = new Order();
        if( $this->out['order']->load(Yii::$app->request->post()) ){
            $this->out['order']->qty = $this->out['session']['card.quantity'];
            $this->out['order']->sum = $this->out['session']['card.sum'];
            if($this->out['order']->save()){
                $res = $this->saveOrderItems($this->out['session']['card'], $this->out['order']->id);
                if ($res) {
                    Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер вскоре свяжется с Вами.');
                    /*Yii::$app->mailer->compose('order', ['out' => $this->out])
                        ->setFrom(['andreymakas@inbox.ru' => 'yiishop.local'])
                        ->setTo($this->out['order']->email)
                        ->setSubject('Заказ')
                        ->send();*/
                    Yii::$app->mailer->compose('order', ['out' => $this->out])
                        ->setFrom(['andreymakas@inbox.ru' => 'yiishop.local'])
                        ->setTo(Yii::$app->params['adminEmail'])
                        ->setSubject('Заказ')
                        ->send();
                    $this->out['session']->remove('card');
                    $this->out['session']->remove('card.quantity');
                    $this->out['session']->remove('card.sum');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
                }
            }else{
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }

        return $this->render('view', [ 'out' => $this->out ]  );
    }
    
    protected function saveOrderItems($items, $order_id){
        foreach($items as $id => $item){
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['quantity'];
            $order_items->sum_item = $item['quantity'] * $item['price'];
            if( !$order_items->save() ){
                return false;
            }
        }
        return true;
    }
    
}
