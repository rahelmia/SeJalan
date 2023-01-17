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
        <a href="add-image-content.php?id=<?php echo $_GET['id']?>" class="btn btn-secondary">Tambahkan Image</a>
          <div class="wrapper">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Image</th>
                <th scope="col">Kelola Image</th>
              </tr>
            </thead>
            <tbody>
            <?php $index = 1;
                          $image = mysqli_query($conn, "SELECT * FROM image_detail WHERE id_post = '".$_GET['id']."'");
                          while ($row = mysqli_fetch_array($image)){ ?>
                <tr>
                  <td><?php echo($row['id']) ?></td>
                  <td><img src="<?php echo ($row['image_url']) ?>" width="200px " srcset=""></td>
                  <td><a href="delete-image.php?id=<?php echo $row['id']?>" class="btn btn-danger">DELETE</a></td>
                </tr>
            <?php }  ?>
            </tbody>
          </table>
        </div>
        </div>
    </div>
</div>

      
      <!--js link--->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script type="text/javascript" src="assets/script.js"></script>
      <script src="https://kit.fontawesome.com/d309f9e57e.js" crossorigin="anonymous"></script>
</body>
</html>