<?php

namespace App; 

class Person
{
    private $id;
    private $name;
    private $surname;
    private $sex;
    private $birthDate;

    public function __construct($id, $name, $surname, $sex, $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->sex = $sex;
        $this->birthDate = $birthDate;
    }
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getSex() {
        return $this->sex;
    }
    public function getBirthDate() {
        return $this->birthDate->format('d.m.Y');
    }
    
    public function getAgeInDays() {
        $birthTimestamp = $this->birthDate->getTimestamp();
        $currentTimestamp = time();
        $ageInSeconds = $currentTimestamp - $birthTimestamp;
        return floor($ageInSeconds / (60 * 60 * 24));
    }
}