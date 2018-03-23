<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use App\Services\semantic\TasksGui;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
