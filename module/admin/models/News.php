<?php

namespace app\module\admin\models;

use Yii;


class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $file;
    public $del_img;
    
    public static function tableName()
    {
        return '_news';
    }

    /**
     * @inheritdoc
     */
    
     public function behaviors()
	{
	    return [
	        'slug' => [
	            'class' => 'Zelenin\yii\behaviors\Slug',
	            'slugAttribute' => 'slug',
	            'attribute' => 'name',
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
    
    public function rules()
    {
        return [
            [['name', 'date', 'news_text', 'news_anounce'], 'required'],
            [['date', 'event_date'], 'safe'],
            [['status', 'position', 'type', 'arhive', 'in_home'], 'integer'],
            [['news_text', 'news_anounce', 'slug'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif'],
            [['del_img'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'date' => 'Дата добавления',
            'status' => 'Status',
            'position' => 'Position',
            'news_text' => 'Полный текст',
            'news_anounce' => 'Краткий текст',
            'type' => 'Тип новости',
            'arhive' => 'Заархивирован',
            'in_home' => 'На главную',
            'event_date' => 'Event Date',
            'file' => 'Картинка для списка',
            'del_img' => 'Удалить картинку',
            'enabled0' => 'Нажмите для активации',
            'enabled1' => 'Нажмите для де активации',
            'slug' => 'Алиас',
            
        ];
    }
}
