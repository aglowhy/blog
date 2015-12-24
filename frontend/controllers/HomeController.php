<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use backend\models\PostSearch;
use common\models\Comment;
use common\models\Tag;
use common\models\Cate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class HomeController extends \yii\web\Controller
{
    public $added=0;

    public function actionIndex()
    {
        $tags = Tag::findTagWeights();

        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $postModel = new Post();
        $postDataProvider = $postModel->findRecentPosts();

        $cateModel = new Cate();
        $cateDataProvider = $cateModel->getCates();
        /*print_r($cateDataProvider);exit();*/

        $commentModel = new Comment();
        $commentDataProvider = $commentModel->findRecentComments();

        return $this->render('index', [
            'tags' => $tags,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'postDataProvider' => $postDataProvider,
            'cateDataProvider' => $cateDataProvider,
            'commentDataProvider' => $commentDataProvider,
        ]);
    }

    public function actionDetail($id)
    {
        $postModel = new Comment();

        if($postModel->load(Yii::$app->request->post())){
            $postModel->status=Comment::STATUS_INACTIVE;
            $postModel->post_id=$id;
            if($postModel->save()){
                $this->added=1;
            }
        }

        $tags=Tag::findTagWeights();

        $cateModel = new Cate();
        $cateDataProvider = $cateModel->getCates();

        $postData = new Post();
        $postDataProvider = $postData->findRecentPosts();

        $commentModel = new Comment();
        $commentDataProvider = $commentModel->findRecentComments();

        return $this->render('detail',[
            'tags' => $tags,
            'added' => $this->added,
            'postModel' => $postModel,
            'model' => $this->findModel($id),
            'postDataProvider' => $postDataProvider,
            'cateDataProvider' => $cateDataProvider,
            'commentDataProvider' => $commentDataProvider,
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('您所请求的页面不存在');
        }
    }

}
