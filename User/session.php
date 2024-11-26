<?php
@include '../source/koneksi.php';
session_start();

if(!isset($_SESSION['user_id'])){
   echo "<script>
   alert('Koneksi anda terputus harap login ulang');
   window.location.href = '../login/login_form.php';
   </script>";
   exit();
}
?>
