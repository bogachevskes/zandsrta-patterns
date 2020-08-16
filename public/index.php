<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Strategy\Seminar;
use App\Strategy\Lecture;
use App\Strategy\TimedCostStrategy;
use App\Strategy\FixedCostStrategy;

$seminar = new Seminar(4, new TimedCostStrategy);
$lecture = new Lecture(5, new FixedCostStrategy);

echo $seminar->printCostInfo() . "<br>";
echo $seminar->printChargeType() . "<br>";

echo $lecture->printCostInfo() . "<br>";
echo $lecture->printChargeType() . "<br>";