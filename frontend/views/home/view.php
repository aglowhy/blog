<?php
use yii\helpers\Html;
?>

<div class="primary">
	<div class="article">

		<h2 class="entry-title"><a href="<?= $model->url; ?>"><?= Html::encode($model->title);?></a></h2>
		
		<?php //<?= Html::a($model->title, $model->url) ?>
			
			<div class="entry-meta">
				<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?= date('Y-m-d H:i',$model->created_at)."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?= Html::encode($model->user->username)."&nbsp;&nbsp;&nbsp;&nbsp;" ; ?></em>
				<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <em><?= Html::a(" {$model->commentCount}条评论",$model->url.'#comments'); ?></em>
			</div>
	</div>
	<div class="entry-summary">
			<p><?= mb_substr(strip_tags($model->content),0,288,'utf-8'); ?>
			<?= mb_strlen(strip_tags($model->content))>288?'......':'';?></p>
	</div>

	<div class="read-more">
		<a href="<?= $model->url; ?>" class="more-link"><span class="glyphicon glyphicon-hand-right"></span> 阅读全文</a>
	</div>

	<br>
	
</div>
	
<hr>

