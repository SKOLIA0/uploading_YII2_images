<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Parameter extends ActiveRecord
{
    // Добавляем свойства для загрузки файлов
    public $iconFile;
    public $iconGrayFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parameters';
    }

    /**
     * Правила валидации
     */
    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['type'], 'integer'],
            [['title', 'icon', 'icon_gray', 'icon_original_name', 'icon_gray_original_name'], 'string', 'max' => 255],
            [['iconFile', 'iconGrayFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * Названия полей
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'icon' => 'Icon',
            'icon_gray' => 'Icon Gray',
            'icon_original_name' => 'Original Icon Name',
            'icon_gray_original_name' => 'Original Icon Gray Name',
            'iconFile' => 'Upload Icon',
            'iconGrayFile' => 'Upload Icon Gray',
        ];
    }

    /**
     * Возвращает путь к иконке
     */
    public function getIconUrl()
    {
        return $this->icon ? Yii::$app->request->baseUrl . '/uploads/' . $this->icon : null;
    }

    /**
     * Возвращает путь к серой иконке
     */
    public function getIconGrayUrl()
    {
        return $this->icon_gray ? Yii::$app->request->baseUrl . '/uploads/' . $this->icon_gray : null;
    }
}
