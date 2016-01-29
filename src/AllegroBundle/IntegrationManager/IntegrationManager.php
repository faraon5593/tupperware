<?php

namespace AllegroBundle\IntegrationManager;

use AllegroBundle\Utils\Auction;

class IntegrationManager
{
	public function test()
	{
		$auction = new Auction;
		echo '<pre>';
		var_dump($auction->newAuction());
		echo '</pre>';
	}
}