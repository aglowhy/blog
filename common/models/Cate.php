<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cate".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $created_at
 * @property integer $updated_at
 */
class Cate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '名称',
            'alias' => '别名',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    public static function getCates()
    {
        $models = Cate::find()->all();
        return $models;
    }

    public function getAllPosts()
    {
        return $this->hasMany(Post::className(), ['cate_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['cate_id' => 'id', 'status' => [Post::STATUS_ACTIVE]])->orderBy(['created_at' => SORT_DESC]);
    }

    public static function getAllCate()
    {
        $items = [];

        if (empty($items)) {
            $item_array = self::find()->select('id,title')->asArray()->all();
            if (empty($item_array))
                return [];
            foreach ($item_array as $item) {
                $items[$item['id']] = $item['title'];
            }
        }
        return $items;
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            ['home/cate','cate_id'=>$this->id,'title'=>$this->alias]
        );
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                $this->created_at = $this->updated_at = time();
            } else {
                $this->updated_at = time();
            }
            return true;
        } else {
            return false;
        }
    }
}
