<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "board".
 *
 * @property int $id 板块ID
 * @property string $name 板块名
 * @property string $description 板块说明
 * @property string $created_at
 * @property string $updated_at
 */
class Board extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'board';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 250],
            // default 默认在没有数据的时候才会进行赋值
            [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '板名',
            'description' => '板块描述',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
