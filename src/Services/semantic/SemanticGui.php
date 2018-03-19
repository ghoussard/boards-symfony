<?php
namespace App\Services\semantic;

use Ajax\php\symfony\JquerySemantic;

class SemanticGui extends JquerySemantic{
	protected function initialize(){
		$this->setAjaxLoader("<div class=\"ui active centered inline text loader\">Loading</div>");
	}
	
	public function dataTable($objects,$type){
		
	}
	public function dataForm($object,$type){
		
	}

	public function message($content,$type="info",$icon=null){
		$msg= $this->_semantic->htmlMessage("msg",$content,$type);
		if(isset($icon))
			$msg->setIcon($icon);
		return $msg;
	}
	
	public function messageConfirmation($message,$type="info"){
		return $this->renderView("Components/confirmation.html.twig",compact("message","type"));
	}
	
	public function simpleElement($content){
		return $this->renderView("Components/simple.html.twig",["element"=>$content]);
	}
	
	public function realizeOperation($callback,$object,$successMessage,$errorMessage,$refreshUrl,$refreshElement,$refreshAttributes=["jqueryDone"=>"replaceWith","hasLoader"=>false,"attr"=>""]){
		if($callback($object)){
			$msg=$this->message($successMessage,"success","info circle");
			$this->get($refreshUrl,$refreshElement,$refreshAttributes);
		}else{
			$msg=$this->message($errorMessage,"warning","warning circle");
		}
		return $this->simpleElement($msg);
	}
	
	public function getHeader($title,$subHeader,$icon){
		$semantic=$this->_semantic;
		$header=$semantic->htmlHeader("header", 3);
		$header->asTitle($title, $subHeader);
		$header->addIcon($icon);
		return $header;
	}
}