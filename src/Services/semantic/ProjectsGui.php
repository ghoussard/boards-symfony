<?php

namespace App\Services\semantic;


use Ajax\semantic\html\elements\HtmlLabel;
use Ajax\semantic\html\elements\HtmlInput;
use Ajax\service\JArray;

class ProjectsGui extends SemanticGui{

	public function buttons(){
		$bts=$this->_semantic->htmlButtonGroups("bts",["Projects","Tags","dataTable projects"]);
		$bts->setPropertyValues("data-url", ["projects","tags","projectsSem"]);
		$bts->addIcons(["folder","tags","folder"]);
		$bts->getOnClick("td3","#response",["attr"=>"data-url"]);
	}

	public function dataTable($projects,$type){
		$dt=$this->_semantic->dataTable("dt-".$type, "App\Entity\Project", $projects);
		$dt->setIdentifierFunction("getId");
		$dt->setFields(["name","startDate","dueDate","owner","stories"]);
		$dt->setCaptions(["Name","Start date","Due date","Owner","Stories"]);
		$dt->setValueFunction("startDate", function($d){return $d->format("d/m/Y");});
		$dt->setValueFunction("dueDate", function($d){return $d->format("d/m/Y");});
		$dt->setValueFunction("owner", function($owner){
			if(isset($owner)){
				return new HtmlLabel("",$owner,"user");
			}
		});
		$dt->setValueFunction("stories", function($stories){
			$list=$this->_semantic->htmlList("");
			foreach ($stories as $story){
				$list->addItem($story->__toString());
			}
			$list->setOrdered();
			return $list;
		});
		$dt->addEditDeleteButtons(false, [ "ajaxTransition" => "random","hasLoader"=>false ], function ($bt) {
			$bt->addClass("circular");
		}, function ($bt) {
			$bt->addClass("circular");
		});
		$dt->onPreCompile(function () use (&$dt) {
			$dt->getHtmlComponent()->colRight(5);
		});
		$dt->setUrls(["edit"=>"projects/edit","delete"=>"projects/confirmDelete"]);
		$dt->setTargetSelector("#frm");
		return $dt;
	}
	
	public function dataForm($project,$type,$di=null){
		$df=$this->_semantic->dataForm("frm-".$type,$project);
		if($project->getOwner()!=null){
			$project->idOwner=$project->getOwner()->getId();
		}
		$df->setFields(["name\n","id\n","name\n","description\n","startDate","dueDate\n","idOwner"]);
		$df->setCaptions(["Modification","","Name","Description","Start date","Due date","Owner"]);
		$df->fieldAsMessage(0,["icon"=>"info circle"]);
		$df->fieldAsHidden(1);
		$df->fieldAsInput(2,["rules"=>"empty"]);
		$df->fieldAsTextarea(3);
		$df->setValueFunction(4,function($d){if($d==null)$d=new \DateTime(); return new HtmlInput("startDate","date",$d->format("Y-m-d"));});
		$df->setValueFunction(5,function($d){if($d==null)$d=new \DateTime(); return new HtmlInput("dueDate","date",$d->format("Y-m-d"));});
		$df->fieldAsDropDown(6,JArray::modelArray($di,"getId","getIdentity"));
		$df->setValidationParams(["on"=>"blur","inline"=>true]);
		$df->setSubmitParams("projects/update","#frm",["attr"=>"","hasLoader"=>false]);
		return $df;
	}
}

