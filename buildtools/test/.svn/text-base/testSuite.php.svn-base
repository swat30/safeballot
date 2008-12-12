<?php

require_once(dirname(__FILE__) . '/../../include/Site.php');

require_once 'PHPUnit/Framework/TestSuite.php';

require_once 'DatabaseTest.php';
require_once 'UserTest.php';
require_once 'AddressTest.php';
require_once 'GroupTest.php';
require_once 'InstantMessageTest.php';
require_once 'ArticleTest.php';

define ('DEBUG', true);

/**
 * Static test suite.
 */
class testSuite extends PHPUnit_Framework_TestSuite {

	/**
	 * Constructs the test suite handler.
	 */
	public function __construct() {
		$this->setName ( 'testSuite' );
		
		$this->addTestSuite ( 'DatabaseTest' );
		$this->addTestSuite ( 'UserTest' );
		$this->addTestSuite ( 'AddressTest' );
		$this->addTestSuite ( 'GroupTest' );
		$this->addTestSuite ( 'InstantMessageTest' );
		$this->addTestSuite ( 'ArticleTest' );
		
		$dataDir  = dirname(__FILE__).'/../../modules/';
	
		$dir  = new DirectoryIterator($dataDir);
		foreach ($dir as $file) {
			$fileName = $file->getFilename();
			if (file_exists($dataDir . $fileName . '/tests') && file_exists($dataDir . $file . '/tests/' . $file . 'Test.php')) {
				require_once($dataDir . $file . '/tests/' . $file . 'Test.php');
				$this->addTestSuite ( $file . 'Test' );
			}
		}
	}

	/**
	 * Creates the suite.
	 */
	public static function suite() {
		return new self ( );
	}
}

