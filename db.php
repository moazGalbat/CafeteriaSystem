<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  'root',
  'cafteria'
) or die(mysqli_error($mysqli));

?>
