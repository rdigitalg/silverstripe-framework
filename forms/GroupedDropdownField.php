<?php
/**
 * Grouped dropdown, using <optgroup> tags.
 * 
 * $source parameter (from DropdownField) must be a two dimensional array.
 * The first level of the array is used for the <optgroup>, and the second
 * level are the <options> for each group.
 * 
 * Returns a <select> tag containing all the appropriate <option> tags, with
 * <optgroup> tags around the <option> tags as required.
 * 
 * @package forms
 * @subpackage fields-basic
 */
class GroupedDropdownField extends DropdownField {

	function Field() {
		// Initialisations
		$options = '';
		$classAttr = '';

		if($extraClass = trim($this->extraClass())) {
			$classAttr = "class=\"$extraClass\"";
		}
		if($this->source) {
			foreach($this->source as $value => $title) {
				if(is_array($title)) {
					$options .= "<optgroup label=\"$value\">";
					foreach($title as $value2 => $title2) {
						$selected = $value2 == $this->value ? " selected=\"selected\"" : "";
						$options .= "<option$selected value=\"$value2\">$title2</option>";
					}
					$options .= "</optgroup>";
				} else { // Fall back to the standard dropdown field
					$selected = $value == $this->value ? " selected=\"selected\"" : "";
					$options .= "<option$selected value=\"$value\">$title</option>";
				}
			}
		}

		$id = $this->id();

		return "<select $classAttr name=\"$this->name\" id=\"$id\">$options</select>";
	}
}

?>