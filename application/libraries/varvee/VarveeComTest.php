<?php
/**
 * Created by PhpStorm.
 * User: OWNER
 * Date: 05/10/14
 * Time: 8:42 PM
 */

require "VarveeCom.php";
require APPPATH.'/libraries/phpQuery/phpQuery/phpQuery.php';

class VarveeComTest extends PHPUnit_Framework_TestCase
{

	public function testTableBodyDataExists()
	{

		$Config = new VarveeComLeaderboardConfig();
		$html = file_get_contents( $Config->url() );
		$doc = phpQuery::newDocument( $html );
		$tableBody = $doc->find('div.table-body');
		$this->assertTrue( $tableBody->html() != "" );

	}

}
 