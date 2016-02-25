<?php 
App::uses('Helper','View');

class MessageHelper extends Helper{
	public function show($val){
		if($val == 1){
			return "<font color=green>Yes</font>";
		}
		if($val == 0){
			return "<font color=red>No</font>";
		}
	}
}
 ?>