<?php

namespace App\Controller;

use App\Entity\Step;
use App\Repository\StepRepository;
use App\Services\semantic\StepsGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

	/**
	 * @Route("/steps/refresh", name="steps_refresh")
	 */
	public function refresh(){
		return $this->_refresh();
	}

	/**
	 * @Route("/steps/edit/{id}", name="steps_edit")
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit($id){
		return $this->_edit($id);
	}

	/**
	 * @Route("/steps/update", name="steps_update")
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(Request $request){
		return $this->_update($request, Step::class);
	}
}
