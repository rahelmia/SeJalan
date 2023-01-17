<?php
    include 'connection.php';
    session_start();
    $user = $_SESSION['u_global'];
    if($_SESSION['islogin'] != true){
        echo "<script>window.location='index.php'</script>";  
      }
      
    elseif($user->akses != "admin")
    {
      echo "<script>alert('Maaf Kamu Tidak Memiliki Akses Sebagai Admin!')</script>";
      echo "<script>window.location='index.php'</script>";  
      $_SESSION['islogin'] = false;
    }

    $kategori = mysqli_query($conn, "SELECT * FROM content WHERE id = '".$_GET['id']."'");
    $data = mysqli_fetch_object($kategori);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Content | Admin SeJalan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <link rel="stylesheet" href="Style/upload-content.css">
  </head>
  <body>

  <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Selamat Datang Admin</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="homescreen-admin.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Kelola Konten</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="uploadcontent-admin.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Upload</span></a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $user->image != "" ? $user->image : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"?>" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1"><?php echo $user->username ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="profile-admin.php">Edit Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><form action="" method="post"><button name="logoutbtn" class="dropdown-item">Logout</button></form></li>
                        <?php 
                         if(isset($_POST['logoutbtn'])){
                          $_SESSION['islogin'] = false;
                          echo "<script>window.location='index.php'</script>";  
                        }?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
        <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" value="<?php echo $data->judul ?>" id="exampleInputEmail1"  required >
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Banner</label>
                        <input type="file" class="form-control" name="image" id="exampleInputEmail1" value="<?php echo $data -> image ?>" >
                        <?php if($data->image != ""){ ?>
                          <p><?php echo $data -> image ?></p>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Video</label>
                        <input type="file" class="form-control" name="video" id="exampleInputEmail1" value="<?php echo $data -> video ?>"  >
                    </div>
                    <?php if($data->video != ""){ ?>
                          <p><?php echo $data -> video ?></p>
                        <?php } ?>

                    <div class="box">
                      <select class = "form-select" name="kategori">
                            <option value="<?php echo $data -> kategori ?>"> <?php echo $data -> kategori ?> </option>
                            <option value="wisata">Wisata</option>
                            <option value="kuliner">Kuliner</option>
                            <option value="event">Event</option>
                      </select>
                    </div>

                   

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="short_desc" required maxlength="177"><?php echo $data -> short_desc ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Lokasi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="lokasi" required maxlength="177"><?php echo $data -> lokasi ?></textarea>
                    </div>
                   
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" name="subtitle" id="exampleInputEmail1" maxlength="100" value="<?php echo $data -> subtitle ?>"  required >
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 1</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p1"  required><?php echo $data -> desc_p1 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 2</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p2" ><?php echo $data -> desc_p2 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 3</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p3" ><?php echo $data -> desc_p3 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 4</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p4"  ><?php echo $data -> desc_p4 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 5</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p5"  ><?php echo $data -> desc_p5 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 6</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p6" ><?php echo $data -> desc_p6 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 7</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p7" ><?php echo $data -> desc_p7 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 8</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p8"  ><?php echo $data -> desc_p8 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 9</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p9" ><?php echo $data -> desc_p9 ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Content Paragraft 10</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="desc_p10" ><?php echo $data -> desc_p10 ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="btnsubmit">Submit</button>
                </form>
        </div>
    </div>
  </div>
      <!--js link--->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script type="text/javascript" src="assets/script.js"></script>
    </body>
  </html>


  <?php 
    if(isset($_POST['btnsubmit'])){
      $judul = $_POST['judul'];
      $short_desc = $_POST['short_desc'];
      $lokasi = $_POST['lokasi'];
      $kategori = $_POST['kategori'];
      $subtitle = $_POST['subtitle'];
      $desc_p1 = $_POST['desc_p1'];
      $desc_p2 = $_POST['desc_p2'];
      $desc_p3 = $_POST['desc_p3'];
      $desc_p4 = $_POST['desc_p4'];
      $desc_p5 = $_POST['desc_p5'];
      $desc_p6 = $_POST['desc_p6'];
      $desc_p7 = $_POST['desc_p7'];
      $desc_p8 = $_POST['desc_p8'];
      $desc_p9 = $_POST['desc_p9'];
      $desc_p10 = $_POST['desc_p10'];

      $filename = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      
      $videoname = $_FILES['video']['name'];
      $tmp_video = $_FILES['video']['tmp_name'];

      $type1 = explode('.', $filename);
      $type2 = $type1[1];
      
      $type1vid = explode('.', $videoname);
      $type2vid = $type1vid[1];

      $typeok = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
      $typevid = array('mp4');

      
    
        if($kategori != ""){
              if($filename == "" && $videoname == ""){
                $insert = mysqli_query($conn, "UPDATE content SET 
                judul = '".$judul."', 
                image = '".$data->image."', 
                video = '".$data->video."', 
                short_desc = '".$short_desc."', 
                lokasi = '".$lokasi."', 
                subtitle = '".$subtitle."', 
                desc_p1 = '".$desc_p1."', 
                desc_p2 = '".$desc_p2."', 
                desc_p3 = '".$desc_p3."', 
                desc_p4 = '".$desc_p4."', 
                desc_p5 = '".$desc_p5."', 
                desc_p6 = '".$desc_p6."', 
                desc_p7 = '".$desc_p7."', 
                desc_p8 = '".$desc_p8."', 
                desc_p9 = '".$desc_p9."',
                desc_p10 = '".$desc_p10."',
                kategori = '".$kategori."'
                ");

                if($insert){
                    echo "<script>alert('Berhasil Mengubah Data')</script>";
                    echo "<script>window.location='homescreen-admin.php'</script>"; 
                }
                else{
                    echo "<script>alert('Gagal Mengubah Data')</script>";
                }
             }

             elseif($videoname == "" && $filename != ""){

                 move_uploaded_file($tmp_name, './Image/'.$filename);

                  $insert = mysqli_query($conn, "UPDATE content SET 
                  judul = '".$judul."', 
                  image = 'Image/".$filename."', 
                  video = '".$data->video."', 
                  short_desc = '".$short_desc."', 
                  lokasi = '".$lokasi."', 
                  subtitle = '".$subtitle."', 
                  desc_p1 = '".$desc_p1."', 
                  desc_p2 = '".$desc_p2."', 
                  desc_p3 = '".$desc_p3."', 
                  desc_p4 = '".$desc_p4."', 
                  desc_p5 = '".$desc_p5."', 
                  desc_p6 = '".$desc_p6."', 
                  desc_p7 = '".$desc_p7."', 
                  desc_p8 = '".$desc_p8."', 
                  desc_p9 = '".$desc_p9."',
                  desc_p10 = '".$desc_p10."',
                  kategori = '".$kategori."'
                  ");

                  if($insert){
                      echo "<script>alert('Berhasil Mengubah Data')</script>";
                      echo "<script>window.location='homescreen-admin.php'</script>"; 
                  }
                  else{
                      echo "<script>alert('Gagal Mengubah Data')</script>";
                  }
             }

             elseif($videoname != "" && $filename ==""){
              move_uploaded_file($tmp_video, './Video/'.$videoname);

                $insert = mysqli_query($conn, "UPDATE content SET 
                judul = '".$judul."', 
                image = '".$data->image."', 
                video = 'Video/".$videoname."', 
                short_desc = '".$short_desc."', 
                lokasi = '".$lokasi."', 
                subtitle = '".$subtitle."', 
                desc_p1 = '".$desc_p1."', 
                desc_p2 = '".$desc_p2."', 
                desc_p3 = '".$desc_p3."', 
                desc_p4 = '".$desc_p4."', 
                desc_p5 = '".$desc_p5."', 
                desc_p6 = '".$desc_p6."', 
                desc_p7 = '".$desc_p7."', 
                desc_p8 = '".$desc_p8."', 
                desc_p9 = '".$desc_p9."',
                desc_p10 = '".$desc_p10."',
                kategori = '".$kategori."'
                ");

                if($insert){
                    echo "<script>alert('Berhasil Mengubah Data')</script>";
                    echo "<script>window.location='homescreen-admin.php'</script>"; 
                }
                else{
                    echo "<script>alert('Gagal Mengubah Data')</script>";
                }
             }

             elseif ($videoname != "" && $filename != "")
             {
                move_uploaded_file($tmp_name, './Image/'.$filename);
                move_uploaded_file($tmp_video, './Video/'.$videoname);

                  $insert = mysqli_query($conn, "UPDATE content SET 
                  judul = '".$judul."', 
                  image = 'Image/".$filename."', 
                  video = 'Video/".$videoname."', 
                  short_desc = '".$short_desc."', 
                  lokasi = '".$lokasi."', 
                  subtitle = '".$subtitle."', 
                  desc_p1 = '".$desc_p1."', 
                  desc_p2 = '".$desc_p2."', 
                  desc_p3 = '".$desc_p3."', 
                  desc_p4 = '".$desc_p4."', 
                  desc_p5 = '".$desc_p5."', 
                  desc_p6 = '".$desc_p6."', 
                  desc_p7 = '".$desc_p7."', 
                  desc_p8 = '".$desc_p8."', 
                  desc_p9 = '".$desc_p9."',
                  desc_p10 = '".$desc_p10."',
                  kategori = '".$kategori."'
                  ");

                  if($insert){
                      echo "<script>alert('Berhasil Mengubah Data')</script>";
                      echo "<script>window.location='homescreen-admin.php'</script>"; 
                  }
                  else{
                      echo "<script>alert('Gagal Mengubah Data')</script>";
                  }
             }
             else{
              echo "<script>alert('Gagal Update!')</script>";
          }
        }
        else{
            echo "<script>alert('Mohon Memilih Kategori!')</script>";
        }
      
    }

   
?>
