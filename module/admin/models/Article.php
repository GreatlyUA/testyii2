<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "_article".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $text
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public function behaviors()
	{
	    return [
	        'slug' => [
	            'class' => 'Zelenin\yii\behaviors\Slug',
	            'slugAttribute' => 'slug',
	            'attribute' => 'title',
	            // optional params
	            'ensureUnique' => true,
	            'replacement' => '-',
	            'lowercase' => true,
	            'immutable' => false,
	            // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general. 
	            'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
	        ]
	    ];
	}
	
    public static function tableName()
    {
        return '_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'text'], 'required'],
            [['text'], 'string'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['parent_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родитель',
            'title' => 'Заголовок',
            'slug' => 'Алиас',
            'text' => 'Текст',
        ];
    }
    
     public function getParent()
    {
        return $this->hasOne(Article::className(), ['id' => 'parent_id']);
    }
    
}
