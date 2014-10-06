<?php

/**
 * Created by PhpStorm.
 * User: OWNER
 * Date: 04/10/14
 * Time: 5:45 PM
 */

require "VarveeComConfig.php";
require APPPATH.'/libraries/phpQuery/phpQuery/phpQuery.php';

class VarveeCom
{



	static public function getLeaderboardData( VarveeComLeaderboardConfig $Config = null )
	{
		// ensure we have a default players config here
		if( $Config === null ) $Config = new VarveeComLeaderboardConfig();

		// build url
		$html = file_get_contents( $Config->url() );
		$doc = phpQuery::newDocument( $html );

		$empty = $doc->find('div.table-body tr.empty-set');
		if( $empty->html() != "" ) return [];

		$rows = $doc->find('div.table-body tr');



		// this could be automated instead of hardcoded here
		// todo: add test to ensure order of properties remains as posted or add logic to sequence properly
		$data = ['Rank', 'GradYear', 'Number', 'PlayerName', 'Team Name', 'GP', 'PTS', 'PPG', '2PT', '2PTA', '2PT%', '3PT', '3PTA', '3PT%', 'FT', 'FTA', 'FT%', 'OR', 'DR', 'R', 'A', 'T', 'S', 'B', 'PF'];
		$leaderboardData = [];

		foreach( $rows as $rowKey=>$tr )
		{
			if( $rowKey < 2 ) continue;

			$cells = $tr->getElementsByTagName('td');

			$leaderboardData[ $rowKey ] = [];

			$lastrank = 0;
			foreach( $cells as $cellKey=>$td )
			{
				$value = $td->textContent;

				// 00 // Rank
				if( trim( $value ) == "--" ) $value = $lastrank;
				$lastrank = $value;

				// 03 // Player
				if( $cellKey == 3 )
				{
					$links = $td->getElementsByTagName('a');
					$a = $links->item(0)->getAttribute('href');
					$leaderboardData[ $rowKey ]['PlayerID'] = array_pop( explode( "/", $a ));
				}

				// done, assign data
				$leaderboardData[ $rowKey ][ $data[ $cellKey ]] = $value;

			}
		}

		return $leaderboardData;

	}

	/**
	 * @param $id
	 */
	static public function getPlayerData( VarveeComPlayerConfig $Config )
	{
		/**
		 * todo: The way that the screen is organized suggests that there COULD be more than one sport listed for
		 * a player. After getting this to work with a single sport verify the code on a player with two sports (no
		 * obvious way to query this besides brute force)
		 */

		$playerData = [];

		// build url
		$html = file_get_contents( $Config->url() );
		$doc = phpQuery::newDocument( $html );
		$playerData['name'] = $doc->find('div.profile-name')->html();
		$playerData['teamName'] = strip_tags( $doc->find('div.school')->html() );

		$rows = $doc->find('div.table-body tr');
		$data = ['Date', 'Opponent', 'Result', 'PTS', 'PPG'];
		$gameData = [];

		foreach( $rows as $rowKey=>$tr )
		{
			//if( $rowKey < 2 ) continue;

			$cells = $tr->getElementsByTagName('td');
			if( $cells->length < 2 ) continue;

			$gameData[ $rowKey ] = [];

			foreach( $cells as $cellKey=>$td )
			{
				$value = $td->textContent;

				// done, assign data
				// todo: currently running loop when we already have all the data we need - check this later - something more efficient
				if( $value == "-" ) $value = 0;
				$gameData[ $rowKey ][ @$data[ $cellKey ]] = $value;

			}
		}

		$playerData['games'] = $gameData;

		return $playerData;


	}

}