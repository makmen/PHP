<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\File;
use app\models\UploadForm;
use yii\data\Pagination;
use yii\web\UploadedFile;
use app\lib\files;

class FileController extends AppController
{
    public $out = [ ];
    private $pageSize = 6;
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [ 'index', 'load', 'download' ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->setMeta('Файл хостинг', 'файлы, заливка, сервер', 'Новые возможности, новые цены');
        $user = User::getUser();
        $query = File::find()->where([
            'account_id' => $user->id, 
            'status' => 'new'
        ]);
        $this->out['pages'] = new Pagination( [
            'totalCount' => $query->count(),
            'pageSize' => $this->pageSize, 
            'forcePageParam' => false, 
            'pageSizeParam' => false 
        ]);
        $this->out['files'] = $query->offset( $this->out['pages']->offset )->
                limit( $this->out['pages']->limit )->all();

        return $this->render('index', [ 'out' => $this->out ]  );
    }
    
    public function actionLoad()
    {
        $this->setMeta('Загрузка файла', 'файлы, заливка, сервер', 'Новые возможности, новые цены');
        $this->out['upload'] = new UploadForm();
        if (Yii::$app->request->isPost) {
            $this->out['upload']->file = UploadedFile::getInstance( $this->out['upload'], 'file' );
            
            $user = User::getUser();
            $file = new File();
            $file->setData($this->out['upload']);
            $user->totalsize += $file->size;
            
            $errs = [];
            if ($user->totalsize > Yii::$app->params['limitSize']) {
                $errs['error'] = 'Суммарный объем файлов превышает 10 Мб';
            } 
            if ( count($errs) == 0 ) {
                if ( !is_dir( Yii::$app->params['tmp'] . $user->id ) ) {
                    mkdir( Yii::$app->params['tmp'] . $user->id );
                }
                if ( !is_dir( Yii::$app->params['files'] . $user->id ) ) {
                    mkdir( Yii::$app->params['files'] . $user->id );
                }
                if ($this->out['upload']->upload( Yii::$app->params['tmp'] . $user->id . '/' )) {
                    $file->titlenew = $this->out['upload']->file->name;
                    $res = copy( 
                        Yii::$app->params['tmp'] . $user->id . '/' . $file->titlenew,
                        Yii::$app->params['files'] . $user->id . '/' . $file->titlenew
                    );
                    if ( $res && $file->save() && $user->save()) {
                        files::clearDir( Yii::$app->params['tmp'] . $user->id );
                    } else {
                        $errs['error'] = 'Ошибка загрузки файла';
                    }
                }
            }
            if ( count($errs) == 0 ) {
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');
            } else {
                Yii::$app->session->setFlash('error', $errs['error']);
            }
        }

        return $this->render('load', [ 'out' => $this->out ]  );
    }
    
    public function actionDelFile(){
        if(!Yii::$app->request->isAjax){
            return $this->goHome();
        }
        $res = 0;
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $id = (int)Yii::$app->request->get('id');
        $file = File::findOne( ['id' => $id, 'status' => 'new'] );
        $user = User::getUser();
        if ( $file != null && $user->id == $file->account_id) {
            $file->status = 'deleted';
            $user->totalsize -= $file->size;
            unlink(Yii::$app->params['files'] . $user->id . '/' . $file->titlenew);
            $res = $file->save() && $user->save();
        }
        
        return $res;
    }
    
    public function actionDownload() {
        $id = Yii::$app->request->get('id');
        $file = File::findOne( ['id' => $id, 'status' => 'new'] );
        $user = User::getUser();
        if ( $file != null && $user->id == $file->account_id) {
            files::downloadFile(
                Yii::$app->params['files'] . $user->id,
                $file->titlenew 
            );
        } else {
            return $this->goHome();
        }
    }
    
    
   
}
