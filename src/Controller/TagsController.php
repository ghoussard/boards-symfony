<?php

namespace App\Controller;

use App\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Repository\TagRepository;
use App\Services\semantic\TagsGui;
use Symfony\Component\HttpFoundation\Request;

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

	/**
	 * @Route("/tags/refresh", name="tags_refresh")
	 */
	public function refresh() {
		return $this->_refresh();
	}

	/**
	 * @Route("/tags/edit/{id}", name="tags_edit")
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function edit($id) {
		return $this->_edit($id);
	}

	/**
	 * @Route("/tags/new", name="tags_new")
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function add() {
		return $this->_add(Tag::class);
	}

	/**
	 * @Route("tags/update", name="tags_update")
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function update(Request $request) {
		return $this->_update($request, Tag::class);
	}

	/**
	 * @Route("tags/confirmDelete/{id}", name="tags_confirm_delete")
	 * @param $id
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function deleteConfirm($id) {
		return $this->_deleteConfirm($id);
	}

	/**
	 * @Route("tags/delete/{id}", name="tags_delete")
	 * @param $id
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function delete($id, Request $request) {
		return $this->_delete($id, $request);
	}
}
