<?php
namespace App\Libs;
class Formbuilder
{
	private $markup="";
	private $columns;
	private $columns_grid;
	public function __construct($name, $columns=1 ,$method="POST", $action="", $enctype=false){
		$this->columns=$columns;
		$this->columns_grid=12/$columns;
		$this->markup="<form method='$method' action='$action' id='f-$name'";
		$this->markup.=($enctype)?"enctype\"multipart/form-dat>":">";
		$csrf= set_csrf();
		$this->markup.="<input type='hidden' value='$csrf' name='csrf'>";
		$this->markup.="<div class='row'>";
	}
	public function addInput($type="text", $name="", $label=false, $attr=array(), $column_width=null){
		$bootstrap_columns=($column_width!==null)?$column_width:$this->columns_grid;
		$this->markup.="<div class='form-group col-sm-{$bootstrap_columns}'>";
		if($label!=false){
			$this->markup.="<label for='$name'>$label</label>";
		}
		$this->markup.="<input type='$type' name='$name' id='$name'";
			$class=isset($attr['class'])?"form-control{$attr['class']}":"form-control";
			$this->markup.="class='$class'";
			if(count($attr)>0){
				foreach($attr as $key=>$item):
					if($key=="class") continue;
					$this->markup.=" $key=\"$item\"";
				endforeach;
			}
			$this->markup.=">";//input ende
		$this->markup.="</div>";//form-group ende
		return $this;
	}
	public function addButton($name, $value, $attr = array(), $column_width = null)
	{
		$bootstrap_columns = ($column_width !== null) ? $column_width : $this->columns_grid;
		$this->markup .= "<div class=\"form-group col-sm-{$bootstrap_columns}\">";
		$this->markup .= "<button name=\"$name\" id=\"$name\"";
		$class = (isset($attr['class'])) ? "btn btn-primary {$attr['class']}" : "btn btn-primary";
		$this->markup .= " class=\"$class\"";
		if (count($attr) > 0) {

			foreach ($attr as $key => $val):
				if ($key == "class") continue;
				$this->markup .= " $key=\"$val\"";
			endforeach;
		}
		$this->markup .= ">$value</button>";
		$this->markup .= "</div>"; // form-group end
		return $this;
	}
	public function addSelect($name = "", $label = false, $options = array(), $selected = null, $attr = array(), $column_width = null){
		$bootstrap_columns = ($column_width !== null) ? $column_width : $this->columns_grid;
		$this->markup .= "<div class=\"form-group col-sm-{$bootstrap_columns}\">";
		if ($label !== false) $this->markup .= "<label for=\"$name\">$label</label>";
		$this->markup .= "<select id=\"$name\" name=\"$name\"";
		$class = (isset($attr['class'])) ? "form-control {$attr['class']}" : "form-control";
		$this->markup .= " class=\"$class\"";
		if (count($attr) > 0) {

			foreach ($attr as $key => $val):
				if ($key == "class") continue;
				$this->markup .= " $key=\"$val\"";
			endforeach;
		}
		$this->markup .= ">";
		foreach ($options as $key => $val):
			if ($selected !== null && $selected == $key) {
				$this->markup .= "<option value=\"$key\" selected>$val</option>";
			} else {
				$this->markup .= "<option value=\"$key\">$val</option>";
			}
		endforeach;
		$this->markup .= "</select>";
		$this->markup .= "</div>"; // form-group end
		return $this;
	}
	public function addTextarea($name = "", $label = false, $value = "", $attr = array(), $column_width = null)
	{
		$bootstrap_columns = ($column_width !== null) ? $column_width : $this->columns_grid;
		$this->markup .= "<div class=\"form-group col-sm-{$bootstrap_columns}\">";
		if ($label !== false) $this->markup .= "<label for=\"$name\">$label</label>";
		$this->markup .= "<textarea name=\"$name\" id=\"$name\"";
		$class = (isset($attr['class'])) ? "form-control {$attr['class']}" : "form-control";
		$this->markup .= " class=\"$class\"";
		if (count($attr) > 0) {

			foreach ($attr as $key => $val):
				if ($key == "class") continue;
				$this->markup .= " $key=\"$val\"";
			endforeach;
		}
		$this->markup .= ">$value</textarea>";
		$this->markup .= "</div>"; // form-group end
		return $this;
	}
	public function addCheckbox($values=array(), $attr=array())
	{
		$this->markup .= "<div class=\"form-group col-sm-12\">";
		foreach ($values as $key => $item) {
			$this->markup .= "<input type=\"checkbox\" name='$key' id='$key' value='$key'";
				foreach($attr as $key){
					$this->markup.=$key;
				};
				$this->markup.="> <label for='$key'>$item</label>";
		}
		$this->markup .= "</div>";
		return $this;
	}
	public function addRadioGroup($name, $values=array(), $inline=false){
		$this->markup .= "<div class=\"col-sm-12\">";
		$counter=1;
		foreach($values as $key=>$item){
			$class=($inline)?"form-check form-check-inline":"form-check";
			$this->markup.="<div class=$class>";
			$this->markup.="<input class='form-check-input' type='radio' id='$name-$counter' name='$name' value='$key'>";
			$this->markup.="<label for='$name-$counter' class='form-check-label'>$item</label>";
			$this->markup.="</diV>";
			$counter++;
		}
		$this->markup.="</div>";
		return $this;
	}
	public function output(){
		$this->markup.="</div>";
		$this->markup.="</form>";
		return $this->markup;
	}
}
