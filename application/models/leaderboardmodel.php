<?php

/**
 *
 */

require APPPATH."/entities/Player.php";
require APPPATH."/entities/LeaderboardData.php";

class LeaderboardModel extends CI_Model
{


	public function getLeaderboard()
	{

		require APPPATH.'libraries/varvee/VarveeCom.php';

		$leaderboardData = VarveeCom::getLeaderboardData();

		$data = [];
		foreach( $leaderboardData as $key=>$leaderboardEntry )
		{
			if( $leaderboardEntry['Rank'] > 5 ) break;

			$Player = new Player();
			$Player->id = $leaderboardEntry['PlayerID'];
			$Player->name = $leaderboardEntry['PlayerName'];

			$LeaderboardData = new LeaderboardData();
			$LeaderboardData->Player = $Player;
			$LeaderboardData->gp = $leaderboardEntry['GP'];
			$LeaderboardData->pts = $leaderboardEntry['PTS'];
			$LeaderboardData->ppg = $leaderboardEntry['PPG'];

			$data[ $key ] = $LeaderboardData;

		}

		return $data;

	}


}