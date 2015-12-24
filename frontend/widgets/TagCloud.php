<?php
/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/14 0014
 * Time: 9:23
 */

namespace frontend\widgets;

use yii\base\Widget;

class TagCloud extends Widget
{
    public $tags;

    public function init(){
        parent::init();
    }

    public function run(){
        $tagString='';
        //$colors = [1=>'default', 2=>'primary', 3=>'success', 4=>'info', 5=>'warning', 6=>'danger'];

        foreach($this->tags as $tag=>$weight) {
            //$color = $colors[mt_rand(1, 6)];
            $color = array("6"=>"danger","5"=>"info","4"=>"warning","3"=>"primary","2"=>"success");
            echo '<a href="'.\Yii::$app->homeUrl.'?r=home/index&PostSearch[tags]='.$tag.'">'.
                ' <h'.$weight.' style="display: inline-block;font-size:17px;"><span class="label label-'.$color[$weight].'">'.$tag.'</span></h'.$weight.'></a>';
        }

    }
}