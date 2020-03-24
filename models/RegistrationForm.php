<?php


namespace app\models;


use app\components\CityValidator;
use Yii;
use yii\base\Model;
class RegistrationForm extends Model {
    public $username;
    public $password;
    public $email;
    public $country;
    public $city;
    public $phone;
    public function rules() {
        return [
            ['city', CityValidator::className()]
        ];
    }
}