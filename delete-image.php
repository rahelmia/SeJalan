<?php

    include 'connection.php';
    if(isset ($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_query($conn, "SELECT * FROM image_detail WHERE id = '$id'");
        $object = mysqli_fetch_object($data);
        $id_post = $object->id_post;
        $delete = mysqli_query($conn, "DELETE FROM image_detail WHERE id = '$id'");
        if($delete){
            echo "<script>alert('Berhasil Menghapus Image')</script>";
            echo "<script>window.location='kelolaimage.php?id=$id_post'</script>"; 
        }
        else{
            echo "<script>alert('Gagal Menghapus Image')</script>";
        }
    }
?>