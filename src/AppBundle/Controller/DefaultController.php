<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{

	/**
     * Lists all Product entities.
     *
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
		return $this->redirectToRoute('product_index');
    }
}
