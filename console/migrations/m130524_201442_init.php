<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
	## 表名常量
    const TABLE_USER = '{{%user}}';//用户
    const TABLE_POST = '{{%post}}';//文章
    const TABLE_CATE = '{{%cate}}';//分类
    const TABLE_TAG = '{{%tag}}';//标签
    const TABLE_COMMENT = '{{%comment}}';//评论

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // table user
        $this->createTable(self::TABLE_USER, [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        
        $this->createIndex('username', self::TABLE_USER, ['username'],true);
        $this->createIndex('email', self::TABLE_USER, ['email'],true);

        // table post
        $this->createTable(self::TABLE_POST,[
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'tags' => Schema::TYPE_STRING . '(255) NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'cate_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ],$tableOptions);
        // Indexes
        $this->createIndex('cate_id', self::TABLE_POST, 'cate_id');
        $this->createIndex('user_id', self::TABLE_POST, 'user_id');
        $this->createIndex('title', self::TABLE_POST, 'title', true);

        // table cate
        $this->createTable(self::TABLE_CATE,[
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ],$tableOptions);

        // table tag
        $this->createTable(self::TABLE_TAG,[
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . '(128) NOT NULL',
                'frequency' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            ],$tableOptions);
        // Indexes
        $this->createIndex('frequency', self::TABLE_TAG, 'frequency');

        // table comment
        $this->createTable(self::TABLE_COMMENT,[
            'id' => Schema::TYPE_PK,
            'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'parent_id' => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'author' => Schema::TYPE_STRING . '(128) NOT NULL',
            'email' => Schema::TYPE_STRING . '(128) NOT NULL',
            'thumbsup' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'thumbsdown' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ],$tableOptions);
        // Indexes
        $this->createIndex('post_id', self::TABLE_COMMENT, 'post_id');
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::TABLE_USER);
        $this->dropTable(self::TABLE_POST);
        $this->dropTable(self::TABLE_CATE);
        $this->dropTable(self::TABLE_TAG);
        $this->dropTable(self::TABLE_COMMENT);
    }
}
