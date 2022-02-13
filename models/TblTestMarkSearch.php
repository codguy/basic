<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblTestMark;

/**
 * TblTestMarkSearch represents the model behind the search form of `app\models\TblTestMark`.
 */
class TblTestMarkSearch extends TblTestMark
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student', 'subject', 'sub_code', 'created_by_id'], 'integer'],
            [['mark', 'total', 'created_on'], 'safe'],
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
        $query = TblTestMark::find();

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
            'student' => $this->student,
            'subject' => $this->subject,
            'sub_code' => $this->sub_code,
            'created_on' => $this->created_on,
            'created_by_id' => $this->created_by_id,
        ]);

        $query->andFilterWhere(['like', 'mark', $this->mark])
            ->andFilterWhere(['like', 'total', $this->total]);

        return $dataProvider;
    }
}
