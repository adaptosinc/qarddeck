<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Qard;

/**
 * SearchQard represents the model behind the search form about `app\models\Qard`.
 */
class SearchQard extends Qard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qard_id', 'user_id', 'qard_theme', 'qard_privacy', 'status'], 'integer'],
            [['title', 'url', 'description', 'bg_image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Qard::find();

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
            'qard_id' => $this->qard_id,
            'user_id' => $this->user_id,
            'qard_theme' => $this->qard_theme,
            'qard_privacy' => $this->qard_privacy,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'bg_image', $this->bg_image]);

        return $dataProvider;
    }
}
