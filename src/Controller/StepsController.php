<?php

namespace App\Controller;

use App\Repository\StepRepository;
use App\Services\semantic\StepsGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StepsController extends CrudController
{

	public function __construct(StepRepository $repository, StepsGui $gui) {
		$this->repository = $repository;
		$this->gui = $gui;
		$this->type = 'steps';
		$this->icon = 'step forward';
		$this->subHeader = 'Steps list';
	}


	/**
     * @Route("/steps", name="steps")
     */
    public function index()
    {
        return $this->_index();
    }
}
