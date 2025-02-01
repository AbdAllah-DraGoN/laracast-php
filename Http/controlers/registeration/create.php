<?php

if ($_SESSION['user'] ?? false) {
  redirect("/");
}

view("registeration/create.view.php");
