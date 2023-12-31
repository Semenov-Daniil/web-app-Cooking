<?php

namespace app\models;

use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;
use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property int $calories
 * @property string $category
 * @property int $price
 * @property string $measurements
 *
 * @property Composition[] $compositions
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'calories', 'category', 'price', 'measurements'], 'required'],
            [['calories', 'price'], 'integer'],
            [['title', 'category', 'measurements'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'calories' => 'Калорийность',
            'category' => 'Категория продукта',
            'price' => 'Цена за 1',
            'measurements' => 'Единица измерения',
        ];
    }

    /**
     * Gets query for [[Compositions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompositions()
    {
        return $this->hasMany(Composition::class, ['products_id' => 'id']);
    }
}
