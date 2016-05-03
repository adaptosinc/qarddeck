<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Theme;

/**
 * SearchTheme represents the model behind the search form about `app\models\Theme`.
 */
class SearchTheme extends Theme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_id', 'theme_type'], 'integer'],
            [['theme_name', 'theme_properties'], 'safe'],
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
        $query = Theme::find();

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
            'theme_id' => $this->theme_id,
            'theme_type' => $this->theme_type,
        ]);

        $query->andFilterWhere(['like', 'theme_name', $this->theme_name])
            ->andFilterWhere(['like', 'theme_properties', $this->theme_properties]);

        return $dataProvider;
    }
}
