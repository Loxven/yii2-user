<?php

namespace amnah\yii2\user\models;

use Yii;
use yii\db\ActiveRecord;
use ReflectionClass;
use yii\helpers\Inflector;

/**
 * This is the model class for table "tbl_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $denomination_id
 * @property string $name_church
 * @property string $address_one
 * @property string $address_two
 * @property string $title
 * @property string $email_church
 * @property string $email_app
 * @property string $phone_church
 * @property string $phone_app
 * @property string $website
 * @property string $mission
 * @property string $facebook_link
 * @property string $latitude
 * @property string $longitude
 * @property string $coordinates
 * @property integer $available_app
 * @property string  $create_time
 * @property string  $update_time
 *
 *
 * @property User    $user
 */
class Profile extends ActiveRecord
{

    /**
     * @var int Inactive status
     */
    const STATUS_UNAVAILABLE = 0;

    /**
     * @var int Active status
     */
    const STATUS_AVAILABLE = 1;

    public $coordinates;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return static::getDb()->tablePrefix . "profile";
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['user_id'], 'required'],
//            [['user_id'], 'integer'],
//            [['create_time', 'update_time'], 'safe'],
//            [['full_name'], 'string', 'max' => 255]
            [['denomination_id', 'available_app'], 'integer'],
            [['name_church', 'address_one', 'address_two', 'email_church', 'email_app', 'website', 'mission', 'facebook_link'], 'string', 'max' => 255],
            [['email_church', 'email_app'], 'email'],
            [['title'], 'string', 'max' => 180],
            [['phone_church', 'phone_app', 'initials'], 'string', 'max' => 20],
            [['latitude', 'longitude'], 'string', 'max' => 120],
            [['email_church'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'user_id' => Yii::t('user', 'User ID'),
            'denomination_id' => Yii::t('app', 'Denomination'),
            'name_church' => Yii::t('app', 'Name Church'),
            'initials' => Yii::t('app', 'Initials'),
            'coordinates' => Yii::t('app', 'Address'),
            'address_two' => Yii::t('app', 'Complement'),
            'title' => Yii::t('app', 'Title page church'),
            'email_church' => Yii::t('app', 'Email Church'),
            'email_app' => Yii::t('app', 'Email App'),
            'phone_church' => Yii::t('app', 'Phone Church'),
            'phone_app' => Yii::t('app', 'Phone App'),
            'website' => Yii::t('app', 'Website'),
            'mission' => Yii::t('app', 'Mission'),
            'facebook_link' => Yii::t('app', 'Facebook Link'),
            'password' => Yii::t('app', 'Password'),
            'confirm_password' => Yii::t('app', 'Confirm Password'),
            'available_app' => Yii::t('app', 'Status Profile'),
            'create_time' => Yii::t('user', 'Create Time'),
            'update_time' => Yii::t('user', 'Update Time'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => function () {
                    return date("Y-m-d H:i:s");
                },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $user = Yii::$app->getModule("user")->model("User");
        return $this->hasOne($user::className(), ['id' => 'user_id']);
    }

    /**
     * Set user id
     *
     * @param int $userId
     * @return static
     */
    public function setUser($userId)
    {
        $this->user_id = $userId;
        return $this;
    }

    public static function statusAvailable()
    {
        // get data if needed
        static $dropdown;
        if ($dropdown === null) {

            // create a reflection class to get constants
            $reflClass = new ReflectionClass(get_called_class());
            $constants = $reflClass->getConstants();

            // check for status constants (e.g., STATUS_ACTIVE)
            foreach ($constants as $constantName => $constantValue) {

                // add prettified name to dropdown
                if (strpos($constantName, "STATUS_") === 0) {
                    $prettyName               = str_replace("STATUS_", "", $constantName);
                    $prettyName               = Inflector::humanize(strtolower($prettyName));
                    $dropdown[$constantValue] = $prettyName;
                }
            }
        }

        return $dropdown;
    }
}