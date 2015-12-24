<?php
/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/14 0014
 * Time: 17:29
 */

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class RecentComments extends Widget
{
    public $commentDataProvider;

    public function init()
    {
        parent::init();
    }

    public function run()
    {



        $commentString='';

        foreach($this->commentDataProvider as $comment)
        {
            $commentString.=
                '<span style="color:#333;">'.Html::encode($comment->author).'</span>'.
                ' 在<span style="color:blue; font-style:italic;">《 <a href="'.$comment->post->url.'">'.Html::encode($comment->post->title).'</a>》</span> 中评论'.
                '<p class="comment-list">'.nl2br($comment->content).'</p>';
        }
        return $commentString;
    }
}

