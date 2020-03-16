<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Slider;
use yii\helpers\ArrayHelper;

/**
 * SliderSearch represents the model behind the search form of `backend\models\Slider`.
 */
class SliderSearch extends Slider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'caption', 'image', 'created_by','is_active'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Slider::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $query->joinWith('createdBy');
        $this->is_active = strtolower($this->is_active);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like','is_active',array_search($this->is_active,$this->active)])
            ->andFilterWhere(['like','user.username',$this->created_by]);

        return $dataProvider;
    }
}
