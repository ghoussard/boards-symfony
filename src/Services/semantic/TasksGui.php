<?php
/**
 * Created by PhpStorm.
 * User: houss
 * Date: 23/03/2018
 * Time: 18:36
 */

namespace App\Services\semantic;


use App\Entity\Task;

class TasksGui extends SemanticGui {

	public function dataTable($tasks, $type){
		$dt = $this->_semantic->dataTable("dt-".$type, Task::class, $tasks);
		$dt->setFields(['content', 'story']);
		$dt->setCaptions(['Content', 'Story']);

		$dt->setValueFunction('content', function($v,$task){
			return $task->getContent();
		});

		$dt->setValueFunction('story', function($v,$task){
			return $task->getStory();
		});

		$dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
			$bt->addClass("circular");
		}, function ($bt) {
			$bt->addClass("circular");
		});
		$dt->onPreCompile(function () use (&$dt) {
			$dt->getHtmlComponent()->colRight(2);
		});
		$dt->setUrls(["edit"=>"tasks/edit","delete"=>"tasks/confirmDelete"]);
		$dt->setTargetSelector("#frm");
		return $dt;
	}

}