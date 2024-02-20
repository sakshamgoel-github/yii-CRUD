<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "players".
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property string $team
 */
class players extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'gender', 'team'], 'required'],
            [['name', 'team'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'gender' => 'Gender',
            'team' => 'Team',
        ];
    }
}
