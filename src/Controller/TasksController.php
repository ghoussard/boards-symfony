<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\StoryRepository;
use App\Repository\TaskRepository;
use App\Services\semantic\TasksGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends CrudController
{

	public function __construct(TaskRepository $repository, TasksGui $gui) {
		$this->subHeader = 'Tasks list';
		$this->type = 'tasks';
		$this->gui = $gui;
		$this->repository = $repository;
		$this->icon = 'list';
	}


	/**
     * @Route("/tasks", name="tasks")
     */
    public function index()
    {
        return $this->_index();
    }


	/**
	 * @Route("/tasks/refresh", name="tasks_refresh")
	 * @return Response
	 */
    public function refresh() {
    	return $this->_refresh();
    }


	/**
	 * @Route("/tasks/edit/{id}", name="tasks_edit")
	 * @param $id
	 * @param StoryRepository $repository
	 *
	 * @return Response
	 */
    public function edit($id, StoryRepository $repository) {
    	return $this->_edit($id, $repository->getAll());
    }


	/**
	 * @Route("/tasks/update", name="tasks_update")
	 * @param Request $request
	 *
	 * @return Response
	 */
    public function update(Request $request) {
    	return $this->_update($request, Task::class);
    }
}
