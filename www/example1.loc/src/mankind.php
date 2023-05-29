<?php

namespace App;
use ArrayIterator;
use DateTime;

class Mankind implements \IteratorAggregate
{
    const BATCH_SIZE = 100;
    const MAX_FILE_SIZE = 100 * 1024 * 1024; // 100 МБ
    private static $instance = null;
    private $people = [];

    private function __construct() {
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Mankind();
        }
        return self::$instance;
    }

    public function loadPeopleFromFile($filename)
{
    $fileSize = filesize($filename);

    if ($fileSize <= self::MAX_FILE_SIZE) {
        // Якщо розмір файлу менше або дорівнює максимальному розміру, зчитати його повністю
        $this->loadAllPeople($filename);
    } else {
        // Якщо розмір файлу більший за максимальний, читати по порціях
        $this->loadPeopleInBatches($filename);
    }
}

private function loadAllPeople($filename)
{
    $file = fopen($filename, 'r');
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $data = explode(';', trim($line));
            $person = new Person(
                (int)$data[0],
                $data[1],
                $data[2],
                $data[3],
                DateTime::createFromFormat('d.m.Y', $data[4])
            );
            $this->people[$person->getId()] = $person;
        }
        fclose($file);
    }
}

private function loadPeopleInBatches($filename)
{
    $file = fopen($filename, 'r');
    if ($file) {
        $batch = [];
        while (($line = fgets($file)) !== false) {
            $data = explode(';', trim($line));
            $person = new Person(
                (int)$data[0],
                $data[1],
                $data[2],
                $data[3],
                DateTime::createFromFormat('d.m.Y', $data[4])
            );
            $batch[] = $person;

            if (count($batch) === self::BATCH_SIZE) {
                $this->processBatch($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            $this->processBatch($batch);
        }

        fclose($file);
    }
}

    public function getPersonById($id) {
        if (isset($this->people[$id])) {
            return $this->people[$id];
        }
        return null;
    }

    public function getPercentageOfMen() {
        $totalPeople = count($this->people);
        if ($totalPeople === 0) {
            return 0;
        }

        $menCount = 0;
        foreach ($this->people as $person) {
            if ($person->getSex() === 'M') {
                $menCount++;
            }
        }

        return ($menCount / $totalPeople) * 100;
    }

    public function getIterator() {
        return new ArrayIterator($this->people);
    }
}