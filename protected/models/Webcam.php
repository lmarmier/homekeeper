<?php

/**
 * This is the model class for table "webcam".
 *
 * The followings are the available columns in table 'webcam':
 * @property integer $id
 * @property string $title
 * @property string $location
 * @property integer $home_id
 *
 * The followings are the available model relations:
 * @property Home $home
 */
class Webcam extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Webcam the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'webcam';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('home_id', 'required'),
			array('home_id', 'numerical', 'integerOnly'=>true),
			array('title, location', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, location, home_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'home' => array(self::BELONGS_TO, 'Home', 'home_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'location' => 'Location',
			'home_id' => 'Home',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('home_id',$this->home_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}