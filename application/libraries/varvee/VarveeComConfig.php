<?php

/**
 * Created by PhpStorm.
 * User: OWNER
 * Date: 04/10/14
 * Time: 5:49 PM
 */

class VarveeComLeaderboardConfig
{

	const BaseUrl = "http://www.varvee.com/team/individual_leaderboard/54/27/";

	public $sort = "PointsPerGame";

	public $direction = "desc";

	public $page = "1";

	public $schoolYear = "2014";

	public $sortGP = "10";

	public $topQty = 5;

	public function url()
	{
		$url = self::BaseUrl
			. "sort:{$this->sort}/"
			. "direction:{$this->direction}/"
			. "page:{$this->page}/"
			. "school-year:{$this->schoolYear}/"
			. "sortGP:{$this->sortGP}/";

		return $url;

	}

}

class VarveeComPlayerConfig
{

	const BaseUrl = "http://www.varvee.com/team/player/27/";

	public $playerId;

	public function url()
	{
		if( !is_numeric( $this->playerId ))
		{
			throw new Exception('No playerId set.');
		}

		$url = self::BaseUrl.$this->playerId;

		return $url;

	}

}