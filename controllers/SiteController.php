<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Products;
class SiteController extends Controller
{
    public function actionIndex()
    {
        $products=Products::find()->all();
        return $this->render('index',['products'=>$products]);

    }
    public function actionProducts()
    {
        $products=Products::find()->all();
        if(Yii::$app->request->post('test')){
        return \yii\helpers\Json::encode($products);
        }else{
            $test = "Ajax failed";
            return \yii\helpers\Json::encode($test);
         }  
    }
}
