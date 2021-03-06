<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $type
 * @property string $value
 * @property string $gravity
 * @property string $comment
 * @property string $datetime
 * @property integer $history
 * @property integer $home_id
 *
 * The followings are the available model relations:
 * @property Home $home
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Event the static model class
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
		return 'event';
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
			array('history, home_id', 'numerical', 'integerOnly'=>true),
			array('type, value, gravity', 'length', 'max'=>45),
			array('comment, datetime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, value, gravity, comment, datetime, history, home_id', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'value' => 'Valeur',
			'gravity' => 'Gravité',
			'comment' => 'Commentaire',
			'datetime' => 'Heure de l\'évenement',
			'history' => 'Historique',
			'home_id' => 'Id de la maison',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('gravity',$this->gravity,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('history',$this->history);
		$criteria->compare('home_id',$this->home_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}