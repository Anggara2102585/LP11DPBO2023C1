<?php

include_once("model/Template.class.php");
include_once("model/DB.class.php");
include_once("model/Pasien.class.php");
include_once("model/TabelPasien.class.php");
include_once("view/TampilPasien.php");


$tp = new TampilPasien();


if (isset($_POST['add_pasien'])) {
    $tp->add($_POST);

    header("location:index.php?add");
}
else if (isset($_POST['edit_pasien'])) {
    $tp->edit($_POST);

    header("location:index.php");
}
else if (isset($_GET['delete'])) {
    $tp->delete($_GET['delete']);

    // header("location:index.php");
}
else if (isset($_GET['add'])) {
    $tp->tampilAdd();
}
else if (isset($_GET['edit'])) {
    $tp->tampilEdit($_GET['edit']);
}
else {
    $tp->tampilTabel();
}
