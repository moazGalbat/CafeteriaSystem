<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'cafteria'
) or die(mysqli_error($mysqli));

?>
