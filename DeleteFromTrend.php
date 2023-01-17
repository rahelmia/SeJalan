<?php

    include 'connection.php';
    if(isset ($_GET['id'])){
        $insert = mysqli_query($conn, "UPDATE content SET 
        IsTrending = 'false'
         WHERE id = '".$_GET['id']."'");
        if($insert){
            echo "<script>alert('Berhasil Menghapus Dari Trending')</script>";
            echo "<script>window.location='homescreen-admin.php'</script>"; 
        }
        else{
            echo "<script>alert('Gagal Menghapus Data')</script>";
        }
    }
?>