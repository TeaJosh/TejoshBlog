<?php
function label($id, $name, $value) {
  return "<label id='" . $id . "#" . $name . "'>" . $value . "</label>";
}

function checkbox($id, $name, $label, $checked) {
  return "<input type='checkbox' id='" . $id . "#" . $name . "' name='" . $name . "' " . $checked . " />" . $label;
}

?>
