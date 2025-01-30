<?php

if ($_SESSION['user'] ?? false) {
  header('location: /php/learn-from-english/public');
  exit();
}

view("registeration/create.view.php");
