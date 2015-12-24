<?php

namespace common\models;

use Yii;
use common\models\Status;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $parent_id
 * @property string $content
 * @property string $author
 * @property string $email
 * @property integer $thumbsup
 * @property integer $thumbsdown
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'content', 'author', 'email'], 'required'],
            [['post_id', 'parent_id', 'thumbsup', 'thumbsdown', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['author', 'email'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => '对应文章',
            'parent_id' => '对应评论',
            'content' => '内容',
            'author' => '作者',
            'email' => '邮箱',
            'thumbsup' => '赞的次数',
            'thumbsdown' => '踩的次数',
            'status' => '状态',
            'created_at' => '评论日期',
            'updated_at' => '修改日期',
        ];
    }

    public function getPost(){
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    public function getParent(){
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    public function getStatus()
    {
        if ($this->_status === null) {
            $this->_status = new Status($this->status);
        }
        return $this->_status;
    }

    public function isReply()
    {
        return $this->parent_id > 0;
    }

    public function getCommentType()
    {
        return $this->isReply() ? '回复' : '评论';
    }

    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function findRecentComments($limit=10)
    {
        $query = Comment::find()
            ->where(['status' => Comment::STATUS_ACTIVE])
            ->orderBy('created_at DESC')
            ->limit($limit)
            ->all();
        return $query;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                $this->created_at = $this->updated_at = time();
            }
            else
                $this->updated_at = time();
            return true;
        }
        else
            return false;
    }
}
