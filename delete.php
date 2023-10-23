<?php

//Hanya Admin yang bisa mendelete data

include 'connect.php';
$id = $_GET['id'];
$querry  = mysqli_query($koneksi, "DELETE FROM pegawai WHERE id=$id");
header('location:index.php');
