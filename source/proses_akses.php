<?php 

include 'koneksi.php';

if(isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $role = $_POST['role'];
    
    $query = "UPDATE user SET role='$role' WHERE id_user='$id_user'";
    $result = mysqli_query($koneksi, $query);
    
    if($result) {
        echo "<script>
        alert('User Berhasil Di Akses jadi Admin');
        window.location='../Admin/user.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}


?>