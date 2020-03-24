<?php


namespace app\components;

use yii\base\Object;

class Taxi extends Object {
    private $_phone;
    public function getPhone() {
        return $this->_phone;
    }
    public function setPhone($value) {
        $this->_phone = trim($value);
    }
}