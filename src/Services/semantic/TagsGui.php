<?php

namespace App\Services\semantic;

use Ajax\semantic\html\elements\HtmlLabel;
use App\Entity\Tag;
use Ajax\semantic\html\base\constants\Color;

class TagsGui extends SemanticGui{
	public function dataTable($tags,$type){
		$dt=$this->_semantic->dataTable("dt-".$type, "App\Entity\Tag", $tags);
		$dt->setFields(["tag"]);
		$dt->setCaptions(["Tag"]);
		$dt->setValueFunction("tag", function($v,$tag){
			$lbl=new HtmlLabel("",$tag->getTitle());
			$lbl->setColor($tag->getColor());
			return $lbl;
		});
		$dt->addEditButton(true,["ajaxTransition"=>"random"]);
		$dt->setUrls(["edit"=>"tags/edit"]);
		$dt->setTargetSelector("#frm");
		return $dt;
	}

	public function dataForm($tag, $type, $di = null) {
		$colors = Color::getConstants();
		$df = $this->_semantic->dataForm("frm-".$type, $tag);
		$df->setFields(["title\n","id\n", "title", "color"]);
		$df->setCaptions(["Modification", "", "Title", "Color"]);
		$df->fieldAsMessage(0, ["icon" => "info circle"]);
		$df->fieldAsHidden(1);
		$df->fieldAsDropDown(3, \array_combine($colors, $colors));
		$df->fieldAsInput( "title", [ "rules" => "empty" ] );
		$df->setValidationParams( [ "on" => "blur", "inline" => true ] );
		$df->setSubmitParams( "tags/update", "#frm", [ "attr" => "", "hasLoader" => false ] );

		return $df;
	}
}

