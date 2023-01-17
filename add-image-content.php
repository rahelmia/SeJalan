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
    $user = $_SESSION['u_global'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kelola Image | Admin-Sejalan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/homeScreen-admin.css">
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
                        <label for="exampleInputEmail1" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="image" id="exampleInputEmail1"  required>
                        <button type="submit" class="btn btn-primary mt-2" name="btnsubmit">Submit</button>
                </div>
            </form>
                        
        </div>
    </div>
</div>
<?php 
    if(isset($_POST['btnsubmit'])){

      $filename = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      $id = $_GET['id'];

      $type1 = explode('.', $filename);
      $type2 = $type1[1];

        
            move_uploaded_file($tmp_name, './DetailImages/'.$filename);

            $insert = mysqli_query($conn, "INSERT INTO image_detail (id_post, image_url) VALUES (
                '".$id."', 'DetailImages/".$filename."'
            )");

            if($insert){
                echo "<script>alert('Berhasil Mengupload Image')</script>";
                echo "<script>window.location='kelolaimage.php?id=$id'</script>"; 
            }
            else{
                echo "<script>alert('Gagal Mengupload Image')</script>";
            }
    }
      

   
?>                 
      
      <!--js link--->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script type="text/javascript" src="assets/script.js"></script>
      <script src="https://kit.fontawesome.com/d309f9e57e.js" crossorigin="anonymous"></script>
</body>
</html>