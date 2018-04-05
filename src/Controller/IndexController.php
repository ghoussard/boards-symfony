<?php

namespace App\Controller;

use App\Repository\MainRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Services\semantic\SemanticGui;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SemanticGui $gui){
    	$gui->getOnClick(".elements","", "#block-body",["attr"=>"data-ajax"]);
    	$gui->getOnClick("#menu a[data-ajax]","","#block-body",["attr"=>"data-ajax"]);

    	$models = array_map(function ($model) {
    		return substr($model, 11);
	    }, MainRepository::getModelNames($this->getDoctrine()));

        return $gui->renderView("index.html.twig", ['models' => $models]);
    }
}
