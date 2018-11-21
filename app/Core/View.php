<?php
namespace App\Core;
class View
{
	public $files_css = array();
	public $files_js = array();

	public function render($view, $data = array(), $tpl = "app"){
		require __DIR__ . "/../../views/layouts/" . $tpl . ".php";
	}
	private function loadCSS(){
		$markup = "";
		if (count($this->files_css) > 0) {
			foreach ($this->files_css as $file) {
				$markup .= "<link rel='stylesheet' href='$file'>";
			}
			return $markup;
		} else {
			return false;
		}
		/*		if (file_exists("./assets/css/{$filename}")){
					echo "<link rel=\"stylesheet\" href=\"/mvc/assets/css/{$filename}\">";
				}*/
	}
	private function loadJS(){
		$markup = "";
		if (count($this->files_css) > 0) {
			foreach ($this->files_css as $file) {
				$markup .= "<script src='$file'></script>";
			}
			return $markup;
		} else {
			return false;
		}
	}
}