<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use common\models\Tag;
use common\models\Comment;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $user_id
 * @property integer $cate_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    private $_status;
    private $_oldTags;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'tags','cate_id'], 'required'],
            [['content'], 'string'],
            [['user_id', 'cate_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'tags'], 'string', 'max' => 255],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'user_id' => '作者',
            'cate_id' => '分类',
            'status' => '状态',
            'created_at' => '发布于',
            'updated_at' => '修改于',
        ];
    }

    public function getCate()
    {
        return $this->hasOne(Cate::className(), ['id' => 'cate_id']);
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatus()
    {
        if ($this->_status === null) {
            $this->_status = new Status($this->status);
        }
        return $this->_status;
    }

    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {
        $links = [];
        foreach(Tag::string2array($this->tags) as $tag)
            $links[] = Html::a($tag, Yii::$app->getUrlManager()->createUrl(["home/index&PostSearch[tags]=$tag"]));
        return $links;
    }

    public function findRecentPosts($limit=5)
    {
        $query = Post::find()
        ->where(['status'=>Post::STATUS_ACTIVE])
            ->orderBy('created_at DESC')
            ->limit($limit)
            ->all();
        return $query;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id',])
            ->where('status = '.Comment::STATUS_ACTIVE)
            ->orderBy('id');
    }

    /**
     * @return number of comments
     */
    public function getCommentCount()
    {
        return Comment::find()->where(['post_id' => $this->id,'status' => Comment::STATUS_ACTIVE])->count();
    }

    /**
     * @return string the URL that shows the detail of the post
     */
    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            ['home/detail','id'=>$this->id,'title'=>$this->title]
        );
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                $this->user_id = Yii::$app->user->id;
                $this->created_at = $this->updated_at = time();
            }
            else
                $this->updated_at = time();
            return true;
        }
        else
            return false;
    }

    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags=$this->tags;
    }

    /**
     * This is invoked after the record is saved.
     */
    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        Tag::updateFrequency($this->_oldTags, $this->tags);
    }

    /**
     * This is invoked after the record is deleted.
     */
    public function afterDelete()
    {
        parent::afterDelete();
        Comment::deleteAll('post_id = :post_id', [':post_id' => $this->id]);
        Tag::updateFrequency($this->tags,'');
    }

}
