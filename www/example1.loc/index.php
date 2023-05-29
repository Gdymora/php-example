<?php
require_once './src/person.php';
require_once './src/mankind.php';

use App\Mankind;

// Usage example
$mankind = Mankind::getInstance();
$mankind->loadPeopleFromFile('people.csv');

foreach ($mankind as $person) {
    echo '<div>';
    echo '<strong>ID:</strong> ' . $person->getId() . ' ';
    echo '<strong>Name:</strong> ' . $person->getName() . ' ';
    echo '<strong>Age in days:</strong> ' . $person->getAgeInDays() . ' ';
    echo '<strong>Age:</strong> ' . $person->getBirthDate() . ' ';   
    echo '</div>';
}

$percentageOfMen = $mankind->getPercentageOfMen();
echo 'Percentage of Men: ' . $percentageOfMen . '%' . PHP_EOL;