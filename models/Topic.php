<?php

namespace app\models;

use Yii;
use app\models\Feedback;

/**
 * This is the model class for table "topic".
 *
 * @property integer $id
 * @property string $name
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getFeedback()
    {
        return $this->hasMany(Feedback::className(), ['topic_id' => 'id']);
    }

}
