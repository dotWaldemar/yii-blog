<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Category;
use yii\helpers\ArrayHelper;
use app\models\ImageUpload;
use app\models\Tag;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
        public function actionSetTags($id)
        {
            $article = $this->findModel($id);
            $selectedTags = $article->getSelectedTags(); //
            $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
            if(Yii::$app->request->isPost)
            {
                $article->saveTags($tags);
                return $this->redirect(['view', 'id'=>$article->id]);
            }
            
            return $this->render('tags', [
                'selectedTags'=>$selectedTags,
                'tags'=>$tags
            ]);
        }
    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $uploadImage = new ImageUpload();
        $selectedCategory = $model->category->id;
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // File upload
            $file = UploadedFile::getInstance($model, 'image');
            $model->saveImage($uploadImage->uploadFile($file, $model->image));

            // Categories
            $postDatas = Yii::$app->request->post('Article');
            $category = $postDatas['category'];
            $model->saveCategory($category);

            // Tags
            $tags = Yii::$app->request->post('tags');
            
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('create', [
            'model' => $model,
            'selectedCategory'=> $selectedCategory,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
        
}
