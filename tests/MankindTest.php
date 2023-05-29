<?php 
require_once __DIR__ . '/../www/example1.loc/src/mankind.php';
use PHPUnit\Framework\TestCase;
use App\Mankind;

class MankindTest extends TestCase
{
    public function testLoadPeopleFromFile()
    {
        $mankind = Mankind::getInstance();
        $mankind->loadPeopleFromFile('people.csv');

        $this->assertGreaterThan(50, count($mankind), 'Failed to load people from file.');
    } 

    public function testGetPercentageOfMen()
{
    $mankind = Mankind::getInstance();
    $mankind->loadPeopleFromFile('people.csv');  
    $expectedPercentageOfMen = 50;
    $actualPercentageOfMen = $mankind->getPercentageOfMen();

    $this->assertEquals($expectedPercentageOfMen, $actualPercentageOfMen, 'Percentage of men is incorrect.');
}
}