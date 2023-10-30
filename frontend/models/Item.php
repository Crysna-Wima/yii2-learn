<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property float $price
 *
 * @property ItemCategory $category
 */
class Item extends \yii\db\ActiveRecord
{
    const EVENT_VIEW_INDEX = 'view_index';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'price'], 'required'],
            [['category_id'], 'default', 'value' => null],
            [['category_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ItemCategory::class, ['id' => 'category_id']);
    }

    public function recordStatistic()
    {
        // Pemanggilan event sebelum aksi "index"
        $this->trigger(self::EVENT_VIEW_INDEX);

        $data['access_time'] = date('Y-m-d H:i:s');
        $data['user_ip'] = Yii::$app->request->userIP ?? '0';
        $data['user_host'] = Yii::$app->request->userHost ?? '0';
        $data['path_info'] = Yii::$app->request->pathInfo ?? '0';
        $data['query_string'] = Yii::$app->request->queryString ?? '0';

        $query = Yii::$app->db->createCommand()->insert('statistic', $data)->execute();
        Yii::info('Berhasil menyimpan data statistik', 'application');
    }
}
