<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kecamatan".
 *
 * @property int $id
 * @property string $nama_kecamatan
 * @property string $lat
 * @property string $lng
 * @property string $keterangan
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kecamatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kecamatan', 'lat', 'lng', 'keterangan'], 'required'],
            [['keterangan'], 'string'],
            [['nama_kecamatan', 'lat', 'lng'], 'string', 'max' => 191],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_kecamatan' => 'Nama Kecamatan',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'keterangan' => 'Keterangan',
        ];
    }
}
