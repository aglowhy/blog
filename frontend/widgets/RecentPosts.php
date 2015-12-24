<?php
/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/14 0014
 * Time: 16:40
 */

namespace frontend\widgets;

use Yii;
use common\models\Post;
use yii\base\Widget;
use yii\helpers\Html;

class RecentPosts extends Widget
{
    public $postDataProvider;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $postList='';

        foreach($this->postDataProvider as $post){
            $postList.= '<p style="color:blue; font-style:italic;">《 <a href="'.$post->url.'">'.Html::encode($post->title).'</a>》</p>';
        }
        return $postList;
    }
}