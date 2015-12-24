<?php
/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/14 0014
 * Time: 22:22
 */

namespace frontend\widgets;

use Yii;
use common\models\Cate;
use yii\base\Widget;
use yii\helpers\Html;

class CateList extends Widget
{
    public $cateDataProvider;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $cateList='';

        foreach($this->cateDataProvider as $cate){
            $cateList.= '<p style="color:blue; font-style:italic;"> <a href="'.\Yii::$app->homeUrl.'?r=home/index&PostSearch[cate_id]='.$cate->id.'">'.Html::encode($cate->title).'</a></p>';
        }
        return $cateList;
    }
}