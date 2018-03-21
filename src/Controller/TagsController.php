<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Repository\TagRepository;
use App\Services\semantic\TagsGui;

class TagsController extends CrudController {

	public function __construct(TagsGui $gui, TagRepository $repository) {
		$this->gui = $gui;
		$this->repository = $repository;
		$this->type = 'tags';
		$this->subHeader = 'tags list';
		$this->icon = 'tag';
	}

	/**
	 * @Route("/tags", name="tags")
	 */
	public function index() {
		return $this->_index();
	}
}
