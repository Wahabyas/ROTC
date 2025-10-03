<?php
require_once "../model/class_model.php";
if (isset($_POST)) {
    $conn = new class_model();
    $Academic_id = trim($_POST['Academic_id']);
    $acadsyear = $conn->delete_Academic($Academic_id);

    if ($acadsyear === true) {
        echo '<div class="alert alert-success">Delete Academic Year Successfully!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
    } elseif ($acadsyear === "foreign_key_error") {
        echo '<div class="alert alert-warning">This Academic Year cannot be deleted because it is being used by students.</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
    } else {
        echo '<div class="alert alert-danger">Delete Academic Year Failed!</div><script> setTimeout(function() {  window.history.go(-0); }, 1000); </script>';
    }
}
?>
