<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="masthead">
        <div class="brand">
            <h1 class="brand-title">Whystic</h1>
            <div class="brand-description">PHP Study Notes</div>
        </div>
        <div class="nav">
            <div class="nav-menu">
                <ul>
                    <li><a href="<?= Yii::$app->homeUrl;?>">Home</a></li>
                    <li><a href="<?= Yii::$app->homeUrl.'?r=home/index&PostSearch[cate_id]=2';?>">PHP</a></li>
                    <li><a href="<?= Yii::$app->homeUrl.'?r=home/index&PostSearch[cate_id]=3';?>">MySQL</a></li>
                    <li><a href="<?= Yii::$app->homeUrl.'?r=home/index&PostSearch[cate_id]=4';?>">Linux</a></li>
                    <li><a href="<?= Yii::$app->homeUrl.'?r=home/index&PostSearch[cate_id]=5';?>">Javascript</a></li>
                </ul>
            </div>
            <form class="nav-search"></form>
        </div>
    </div>

    <div class="content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="footer-info">
        <div class="footer-copyright">
            &copy; 2015
            <a rel="home" href="http://www.whystic.com/">Whystic</a>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>

<a href="javascript:;" id="btn"></a>
<script type="text/javascript">
    //为了在编辑器之外能展示高亮代码
    SyntaxHighlighter.highlight();
    //调整左右对齐
    for(var i=0,di;di=SyntaxHighlighter.highlightContainers[i++];){
        var tds = di.getElementsByTagName('td');
        for(var j=0,li,ri;li=tds[0].childNodes[j];j++){
            ri = tds[1].firstChild.childNodes[j];
            ri.style.height = li.style.height = ri.offsetHeight + 'px';
        }
    }
</script>
</body>
</html>
<?php $this->endPage() ?>
