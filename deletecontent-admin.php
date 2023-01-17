<?php

    include 'connection.php';
    if(isset ($_GET['id'])){
        $delete = mysqli_query($conn, "DELETE FROM content WHERE id = '".$_GET['id']."'");
        if($delete){
            echo "<script>alert('Berhasil Menghapus Data')</script>";
            echo "<script>window.location='homescreen-admin.php'</script>"; 
        }
        else{
            echo "<script>alert('Gagal Menghapus Data')</script>";
        }
    }
?>