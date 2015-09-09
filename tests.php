<?php

if ( ! class_exists('Phalcana'))
{
	die('Please include the Phalcana index.php file');
}

// PHPUnit requires a test suite class to be in this file,
// so we create a faux one that uses the kohana base
class TestSuite extends Phalcana\Unittest\Tests { }

