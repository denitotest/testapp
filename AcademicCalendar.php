<?php

/**
 * This is the model class for table "academic_calendar".
 *
 * The followings are the available columns in table 'academic_calendar':
 * @property string $id
 * @property string $year
 * @property integer $oks
 * @property integer $form_edu
 *
 * The followings are the available model relations:
 * @property TypePrograms $oks0
 * @property FormEdu $formEdu
 * @property LearningProcess[] $learningProcesses
 */
class AcademicCalendar extends CActiveRecord
{
    public $info = '';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AcademicCalendar the static model class
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
		return 'academic_calendar';
	}

    public function behaviors() {
        return array(
            'ml' => array(
                'class' => 'application.models.behaviors.MultilingualBehavior',
                'langClassName' => 'AcademicCalendarlang',
                'langTableName' => 'academic_calendar_lang',
                'langForeignKey' => 'calendar_id',
                'langField' => 'lang_id',
                'localizedAttributes' => array('info'), //attributes of the model to be translated
                'localizedPrefix' => 'l_',
                'languages' => Yii::app()->params['translatedLanguages'], // array of your translated languages. Example : array('fr' => 'Français', 'en' => 'English')
                //'defaultLanguage' => 'bg', //your main language. Example : 'fr'
                'createScenario' => 'insert',
                'localizedRelation' => 'i18nAcademicCalendarlang',
                'multilangRelation' => 'multilangacademiccalendarlang',
                'forceOverwrite' => false,
                'forceDelete' => true,
                'dynamicLangClass' => true, //Set to true if you don't want to create a 'PostLang.php' in your models folder
            ),
        );
    }

    public function defaultScope() {
        return $this->ml->localizedCriteria();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year, oks, form_edu', 'required'),
			array('oks, form_edu', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>50),
			array('info_bg, info_en', 'length', 'max'=>5500),
            array('info_bg, info_en, year','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, year, oks, form_edu', 'safe', 'on'=>'search'),
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
			'oks0' => array(self::BELONGS_TO, 'TypePrograms', 'oks'),
			'formEdu' => array(self::BELONGS_TO, 'FormEducation', 'form_edu'),
			'learningProcesses' => array(self::HAS_MANY, 'LearningProcess', 'calendar_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'year' => 'Учебна година',
			'oks' => 'ОКС',
			'form_edu' => 'Форма',
            'info_en' => 'Допълнителна информация',
            'info_bg' => 'Допълнителна информация',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('oks',$this->oks);
		$criteria->compare('form_edu',$this->form_edu);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}