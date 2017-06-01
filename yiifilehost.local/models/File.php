<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


class File extends ActiveRecord
{
    public function behaviors(){
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at']
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName() {
        return 'files';
    }
    
    public function getUser() {
        return $this->hasOne(User::className(), [ 'id' => 'account_id' ]);
    }
    
    public function setData($file) {
        $this->account_id = Yii::$app->user->identity['id'];
        $this->title = $file['file']->name;
        $this->size = $file['file']->size;
        $this->status = 'new';
    }
    
}
