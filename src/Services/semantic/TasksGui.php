<?php
/**
 * Created by PhpStorm.
 * User: houss
 * Date: 23/03/2018
 * Time: 18:36
 */

namespace App\Services\semantic;


use Ajax\service\JArray;
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


	public function dataForm($task, $type, $di = null) {
		$df = $this->_semantic->dataForm("frm-".$type, $task);

		if($task->getStory()!=null){
			$task->idStory = $task->getStory()->getId();
		}

		$df->setFields(["content\n","id\n", "content", "idStory"]);
		$df->setCaptions(["Modification", "", "Content", "Story"]);
		$df->fieldAsMessage(0, ["icon" => "info circle"]);
		$df->fieldAsHidden(1);
		$df->fieldAsDropDown(3, JArray::modelArray($di, 'getId', 'getDescriptif'));
		$df->fieldAsInput( "content", [ "rules" => "empty" ] );
		$df->setValidationParams( [ "on" => "blur", "inline" => true ] );
		$df->setSubmitParams( "tasks/update", "#frm", [ "attr" => "", "hasLoader" => false ] );

		return $df;
	}

}