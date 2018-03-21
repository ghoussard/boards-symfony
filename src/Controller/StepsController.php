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
	 * @Route("/steps/new", name="steps_new")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function add() {
		return $this->_add(Step::class);
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


	/**
	 * @Route("steps/confirmDelete/{id}", name="steps_confirm_delete")
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function confirmDelete($id) {
		return $this->_deleteConfirm($id);
	}


	/**
	 * @Route("steps/delete/{id}", name="steps_delete")
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function delete(Request $request, $id) {
		return $this->_delete($id, $request);
	}
}
