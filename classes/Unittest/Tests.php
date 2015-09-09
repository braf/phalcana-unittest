<?php 

namespace Phalcana\Unittest;


class TestS
{

	/**
	 * Configure the environment for the testing suite
	 **/
	public static function configureEnvironment()
	{
		\Phalcana::$mode = \Phalcana::TESTING;

		restore_exception_handler();
		restore_error_handler();

		$loader = \Phalcana::$di->get('loader');

		$loader->registerNamespaces(array('Phalcana\Tests' => APPPATH.'tests/'), true);
	}

	/**
	 * Function required by PHPUnit to serve the test suite
	 * 
	 * @return	Phalcana\Unittest\TestSuite
	 **/
	public static function suite()
	{
		static $suite = NULL;

		if ($suite instanceof PHPUnit_Framework_TestSuite)
		{
			return $suite;
		}

		self::configureEnvironment();

		$suite = new TestSuite;
		
		// Load the whitelist and blacklist for code coverage
		$config = \Phalcana::$di->get('config')->load('unittest');		
		
		//if ($config->use_whitelist)
		//{
		//	Unittest_Tests::whitelist(NULL, $suite);
		//}
		
		//if (count($config['blacklist']))
		//{
		//	Unittest_Tests::blacklist($config->blacklist, $suite);
		//}

		// Add tests
		$files = \Phalcana::$di->get('fs')->listFiles('tests');
		self::addTests($suite, $files);

		return $suite;
	}

	/**
	 * Adds tests to the test suite
	 * 
	 * @param 	Phalcana\Unittest\TestSuite
	 * @param 	array List of files to add to the test suite
	 * @return	void
	 **/
	public static function addTests(TestSuite $suite, array $files)
	{
		foreach ($files as $path => $file)
		{
			if (is_array($file))
			{
				if ($path != 'tests'.DIRECTORY_SEPARATOR.'test_data')
				{					
					self::addTests($suite, $file);
				}
			}
			else
			{
				// Make sure we only include php files
				if (is_file($file) AND substr($file, -strlen('.php')) === '.php')
				{
					// The default PHPUnit TestCase extension
					if ( ! strpos($file, 'TestCase'.'.php'))
					{
						$suite->addTestFile($file);
					}
					else
					{
						require_once($file);
					}

					$suite->addFileToBlacklist($file);
				}
			}
		}
	}
}
