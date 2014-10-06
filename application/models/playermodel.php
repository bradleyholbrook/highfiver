<?php

/**
 * Created by PhpStorm.
 * User: Bradley Holbrook
 * Date: 04/10/14
 * Time: 5:19 PM
 */

require APPPATH."/entities/Player.php";
require APPPATH."/entities/PlayerGame.php";
require APPPATH."/libraries/varvee/VarveeCom.php";

class PlayerModel extends CI_Model
{

	public function getPlayer( $id )
	{

		$VarveeComPlayerConfig = new VarveeComPlayerConfig();
		$VarveeComPlayerConfig->playerId = $id;
		$playerData = VarveeCom::getPlayerData( $VarveeComPlayerConfig );

		$Player = new Player();
		$Player->id = $id;
		$Player->name = $playerData['name'];
		$Player->teamName = $playerData['teamName'];



		foreach( $playerData['games'] as $game )
		{
			$Game = new PlayerGame();
			$Game->date = $game['Date'];
			$Game->opponent = $game['Opponent'];
			$Game->pts = $game['PTS'];
			$Game->result = substr( $game['Result'], 0, 1 );

			$score = explode("-", substr( $game['Result'], 1 ));
			arsort( $score, SORT_NUMERIC );

			$Game->teamPts = ( $Game->result == "L" ) ? $score[1] : $score[0];

			$Player->Games[] = $Game;
		}

		return $Player;

	}

}