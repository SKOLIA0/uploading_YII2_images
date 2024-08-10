<?php

namespace app\controllers;

use Yii;
use app\models\Parameter;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use app\components\Transliterator;

class ParametersController extends Controller
{
    /**
     * Список параметров с поиском
     */
    public function actionIndex()
    {
        $searchModel = new \app\models\ParameterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Просмотр параметра
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Редактирование параметра
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $icon = UploadedFile::getInstance($model, 'iconFile');
            $iconGray = UploadedFile::getInstance($model, 'iconGrayFile');

            if ($icon) {
                $model->icon = $this->saveUploadedFile($icon);
                $model->icon_original_name = $icon->name;
            }
            if ($iconGray) {
                $model->icon_gray = $this->saveUploadedFile($iconGray);
                $model->icon_gray_original_name = $iconGray->name;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Удаление изображения
     */
    public function actionDeleteImage($id, $type)
    {
        $model = $this->findModel($id);

        if ($type == 'icon') {
            $model->icon = null;
            $model->icon_original_name = null;
        } elseif ($type == 'icon_gray') {
            $model->icon_gray = null;
            $model->icon_gray_original_name = null;
        }

        $model->save();

        return $this->redirect(['update', 'id' => $model->id]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Поиск модели по ID
     */
    protected function findModel($id)
    {
        if (($model = Parameter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Сохранение загруженного файла
     */
    protected function saveUploadedFile(UploadedFile $file)
    {
        $fileName = Transliterator::transliterate($file->baseName) . '.' . $file->extension;
        $filePath = Yii::getAlias('@webroot/uploads/') . $fileName;

        // Проверка на существование файла с таким же именем и добавление суффикса
        $counter = 1;
        $originalFileName = $fileName;
        while (file_exists($filePath)) {
            $fileName = Transliterator::transliterate($file->baseName) . '_' . $counter . '.' . $file->extension;
            $filePath = Yii::getAlias('@webroot/uploads/') . $fileName;
            $counter++;
        }

        // Сохранение файла
        if ($file->saveAs($filePath)) {
            return $fileName;
        }

        return null;
    }

    public function actionCreate()
    {
        $model = new Parameter();

        if ($model->load(Yii::$app->request->post())) {
            // Применение транслитерации к полю title
            $model->title = Transliterator::transliterate($model->title);

            $icon = UploadedFile::getInstance($model, 'iconFile');
            $iconGray = UploadedFile::getInstance($model, 'iconGrayFile');

            if ($icon) {
                $model->icon = $this->saveUploadedFile($icon);
                $model->icon_original_name = $icon->name;
            }
            if ($iconGray) {
                $model->icon_gray = $this->saveUploadedFile($iconGray);
                $model->icon_gray_original_name = $iconGray->name;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionApiList()
    {
        $parameters = Parameter::find()->where(['type' => 2])->all();
        $result = [];

        foreach ($parameters as $parameter) {
            $result[] = [
                'id' => $parameter->id,
                'title' => $parameter->title,
                'icon' => $parameter->icon ? [
                    'name' => $parameter->icon_original_name,
                    'url' => $parameter->getIconUrl(),
                    'type' => 'icon',
                ] : null,
                'icon_gray' => $parameter->icon_gray ? [
                    'name' => $parameter->icon_gray_original_name,
                    'url' => $parameter->getIconGrayUrl(),
                    'type' => 'icon_gray',
                ] : null,
            ];
        }

        return $this->asJson($result);
    }
}
