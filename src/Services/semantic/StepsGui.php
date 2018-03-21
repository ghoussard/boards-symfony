<?php
/**
 * Created by PhpStorm.
 * User: houss
 * Date: 21/03/2018
 * Time: 15:30
 */

namespace App\Services\semantic;


use App\Entity\Step;

class StepsGui extends SemanticGui {

	public function dataTable($steps, $type){
		$dt=$this->_semantic->dataTable("dt-".$type, Step::class, $steps);
		$dt->setIdentifierFunction("getId");
		$dt->setFields(["title"]);
		$dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
			$bt->addClass("circular");
		}, function ($bt) {
			$bt->addClass("circular");
		});
		$dt->onPreCompile(function () use (&$dt) {
			$dt->getHtmlComponent()->colRight(1);
		});
		$dt->setUrls(["edit"=>"steps/edit", "delete"=>"steps/confirmDelete"]);
		$dt->setTargetSelector("#frm");
		return $dt;
	}

}