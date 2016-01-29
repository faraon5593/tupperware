<?php

namespace AllegroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AllegroBundle\IntegrationManager\IntegrationManager;
use Symfony\Component\HttpFoundation\Response;

class AllegroController extends Controller
{
 	public function testAction()
 	{
 		$integrationManager = new IntegrationManager();
	    $content = $integrationManager->test();

	    $response = new Response($content);

	    return $response;
 	}
}