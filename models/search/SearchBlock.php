<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Block;

/**
 * SearchBlock represents the model behind the search form about `app\models\Block`.
 */
class SearchBlock extends Block
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_id', 'qard_id', 'theme_id', 'status', 'is_title', 'block_priority'], 'integer'],
            [['text', 'extra_text', 'link_url', 'link_image', 'link_document', 'link_title', 'link_description', 'block_name', 'placeholder_text', 'help_text'], 'safe'],
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
        $query = Block::find();

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
            'block_id' => $this->block_id,
            'qard_id' => $this->qard_id,
            'theme_id' => $this->theme_id,
            'status' => $this->status,
            'is_title' => $this->is_title,
            'block_priority' => $this->block_priority,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'extra_text', $this->extra_text])
            ->andFilterWhere(['like', 'link_url', $this->link_url])
            ->andFilterWhere(['like', 'link_image', $this->link_image])
            ->andFilterWhere(['like', 'link_document', $this->link_document])
            ->andFilterWhere(['like', 'link_title', $this->link_title])
            ->andFilterWhere(['like', 'link_description', $this->link_description])
            ->andFilterWhere(['like', 'block_name', $this->block_name])
            ->andFilterWhere(['like', 'placeholder_text', $this->placeholder_text])
            ->andFilterWhere(['like', 'help_text', $this->help_text]);

        return $dataProvider;
    }
}
