<?php 
require_once __DIR__ . '/../www/example1.loc/src/person.php';
use PHPUnit\Framework\TestCase;
use App\Person;

class PersonTest extends TestCase
{
    public function testGetAgeInDays()
    {
        $birthDate = new DateTime('1990-01-01');
        $person = new Person(1, 'John', 'Doe', 'M', $birthDate);

        $ageInDays = $person->getAgeInDays();

        $expectedAgeInDays = floor((time() - $birthDate->getTimestamp()) / (60 * 60 * 24));
        $this->assertEquals($expectedAgeInDays, $ageInDays);
    }
}