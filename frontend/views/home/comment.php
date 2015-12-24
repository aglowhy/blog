<?php
/**
 * Created by PhpStorm.
 * User: 慕虚云
 * Date: 2015/12/16 0016
 * Time: 9:31
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php foreach($comments as $comment): ?>
    <div class="comment">
        <div class="row">
            <div class="col-md-12">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="img/none.png" alt="64x64" style="width: 64px; height: 64px;" src="" data-holder-rendered="true">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?= Html::encode($comment->author) ; ?>:</h4>
                        <p class="glyphicon glyphicon-time" aria-hidden="true"></p> <em><?= date('Y-m-d H:i:s',$comment->created_at); ?></em>
                        <p class="reply-content"><?php echo nl2br($comment->content); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- comment -->
<?php endforeach; ?>
