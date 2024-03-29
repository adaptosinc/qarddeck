<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Deck;

/**
 * SearchDeck represents the model behind the search form about `app\models\Deck`.
 */
class SearchDeck extends Deck
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deck_id', 'user_id', 'status', 'deck_privacy'], 'integer'],
            [['url', 'bg_image', 'title', 'description'], 'safe'],
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
        $query = Deck::find();

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
            'deck_id' => $this->deck_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'deck_privacy' => $this->deck_privacy,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'bg_image', $this->bg_image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
