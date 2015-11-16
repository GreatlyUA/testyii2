<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\News;

/**
 * NewsSearch represents the model behind the search form about `app\module\admin\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    
  
    public function rules()
    {
        return [
            [['id', 'status', 'position', 'type', 'arhive', 'in_home'], 'integer'],
            [['name', 'news_text', 'news_anounce'], 'safe'],
            [['date', 'event_date'], 'date', 'format' => 'Y-m-d'],
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
        $query = News::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'status' => $this->status,
            'position' => $this->position,
            'type' => $this->type,
            'arhive' => $this->arhive,
            'in_home' => $this->in_home,
            'event_date' => $this->event_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
    		->andFilterWhere(['=', 'date', $this->date]);
    		
        return $dataProvider;
    }
}
