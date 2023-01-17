<?php

    include 'connection.php';
    if(isset ($_GET['id'])){
        $isverytrend = mysqli_query($conn, "SELECT * FROM content WHERE IsTrending = 'verytrue'");
        $verytrend_length = mysqli_num_rows( $isverytrend );
        $data = mysqli_fetch_object($isverytrend);


        if($verytrend_length >= 1){
            echo "<script>alert('Maksimal konten untuk menjadi paling trending adalah 1!!!, kamu telah set $data->judul menjadi paling trending untuk sekarang ini, mohon hapus $data->judul dari paling trending terlebih dahulu untuk merubahnya')</script>";
            echo "<script>window.location='homescreen-admin.php'</script>"; 
        }
        else{
            $insert = mysqli_query($conn, "UPDATE content SET 
            IsTrending = 'verytrue'
            WHERE id = '".$_GET['id']."'");
            if($insert){
                echo "<script>alert('Berhasil Menjadikan Paling Trending')</script>";
                echo "<script>window.location='homescreen-admin.php'</script>"; 
            }
            else{
                echo "<script>alert('Gagal Menjadikan Paling Trending')</script>";
            }
        }
    }
?>