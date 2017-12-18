<?php

/**
 * This is the model class for table "employees".
 *
 * The followings are the available columns in table 'employees':
 * @property string $id
 * @property string $fam
 * @property string $nam
 * @property string $prez
 * @property string $title
 * @property string $titlesh
 * @property string $pemail
 * @property string $fullname
 */
class All extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employees the static model class
	 */
        public $fam="";
        public $nam="";
        public $prez="";
        public $title="";
        public $rank="";
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function behaviors() {
            return array(
                'ml' => array(
                    'class' => 'application.models.behaviors.MultilingualBehavior',
                    'langClassName' => 'Employeeslang',
                    'langTableName' => 'employeeslang',
                    'langForeignKey' => 'emp_id',
                    'langField' => 'lang_id',
                    'localizedAttributes' => array('fam', 'nam', 'prez' ,'title'), //attributes of the model to be translated
                    'localizedPrefix' => 'l_',
                    'languages' => Yii::app()->params['translatedLanguages'], // array of your translated languages. Example : array('fr' => 'Français', 'en' => 'English')
                    //'defaultLanguage' => 'bg', //your main language. Example : 'fr'
                    'createScenario' => 'insert',
                    'localizedRelation' => 'i18nEmployees',
                    'multilangRelation' => 'multilangEmployees',
                    'forceOverwrite' => false,
                    'forceDelete' => true, 
                    'dynamicLangClass' => true, //Set to true if you don't want to create a 'PostLang.php' in your models folder
                ),
            );
        }
    
        public function defaultScope()
        {
            return $this->ml->localizedCriteria();
        }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fam_bg, nam_bg, prez_bg, rank, title_bg, fam_en, nam_en, prez_en, title_en, pemail', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fam, nam, prez, title, pemail', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fam_bg' => 'Фамилия',
			'nam_bg' => 'Име',
			'prez_bg' => 'Презиме',
			'title_bg' => 'Титла',
                        'rank' => 'Класификация',
                    	'fam_en' => 'Last name',
			'nam_en' => 'Name',
			'prez_en' => 'Surname',
			'title_en' => 'Title',
			'pemail' => 'Pemail',
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

		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('fam',$this->fam,true);
		$criteria->compare('nam',$this->nam,true);
		$criteria->compare('prez',$this->prez,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pemail',$this->pemail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function show($employ_id=null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
               
                $lang = Yii::app()->language;
		$criteria=new CDbCriteria;
                 if(empty($employ_id)) $employ_id=0;
                 
                $criteria->compare('t.id',$employ_id);
		$criteria->compare('fam',$this->fam,true);
		$criteria->compare('nam',$this->nam,true);
		$criteria->compare('prez',$this->prez,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pemail',$this->pemail,true);
                $criteria->join = "left join employeeslang dlo on dlo.emp_id=t.id and dlo.lang_id='$lang'";
                $criteria->order = "dlo.l_nam asc";
                

  		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function kum($kum)
	{
        Yii::app()->session['kum'] = 'da';
        }
}