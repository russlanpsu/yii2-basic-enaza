<?php

namespace app\models;

use app\models\Topic;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property integer $topic_id
 * @property string $msg
 * @property string $file_name
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;
    public $mimeType;

    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['topic_id'], 'integer'],
            [['msg'], 'string', 'max' => 1000],
            [['file_name'], 'string', 'max' => 255],
//          [['file'], 'file'],
//          [['file'], 'file', 'extensions' => 'png, jpg'],   // с расширением не работает почему-то
            [
                ['file'], 'file', 'skipOnEmpty' => true,
                'mimeTypes' => 'image/png text/plain application/pdf image/gif image/jpeg'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic' => 'Topic',
            'msg' => 'Msg',
            'file' => 'Прикрепить файл',
//            'file_name' => 'File Name',
        ];
    }

    public function getTopic()
    {
        return $this->hasOne(Topic::className(), ['id' => 'topic_id']);
    }

    public function getFileMimeType(){
        $result = '';
        if (!empty($this->file_name) && file_exists($this->file_name)){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $result = finfo_file($finfo, $this->file_name);
            finfo_close($finfo);
        }

        return $result;
    }

    function getHumanFileSize($bytes, $decimals = 2) {
        $sz = 'BKMGTP';
        $factor = (int)floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    public function getFileSize(){
        if (!empty($this->file_name) && file_exists($this->file_name)){
            $fileSize = filesize($this->file_name);
            return $this->getHumanFileSize($fileSize);
        };
        return '';

    }

}
