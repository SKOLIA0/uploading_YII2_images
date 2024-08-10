<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ParameterSearch extends Parameter
{
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['title', 'icon', 'icon_gray'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Parameter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['type' => $this->type]);

        return $dataProvider;
    }
}
