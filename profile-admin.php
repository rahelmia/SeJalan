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
    <title>Edit Profile | Admin-SeJalan</title>
    <link rel="stylesheet" href="Style/editprofile.css">
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
            <div class="wrapper-column">
                <div class="wrapper bg-white">
                    <h4 class="pb-4 border-bottom">Account settings</h4>
                    <div class="d-flex align-items-start py-3 border-bottom">
                        <img src="<?php echo $user->image != "" ? $user->image : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"?>"
                            class="img" alt="">
                        <div class="pl-sm-4 pl-2" id="img-section">
                            <b>Profile Photo</b>
                            <input type="file" class="form-control" name="image" id="exampleInputEmail1">
                        </div>
                    </div>
                    <div class="py-2">
                        <div class="row py-2">
                            <div class="col-md-6">
                                <label for="firstname">Username</label>
                                <input type="text" class="bg-light form-control" placeholder="Username Anda" name="username" required value="<?php echo $user->username ?>">
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="bg-light form-control" placeholder="Email Anda" name="email" value="<?php echo $user->email ?>" required>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-6">
                                <label for="email">Password</label>
                                <input type="text" class="bg-light form-control" placeholder="Password Anda" value="<?php echo $user->password ?>" name="password" required>
                            </div>
                        </div>
                        <div class="py-3 pb-4 border-bottom">
                            <button class="btn btn-primary mr-3" name="btnsave">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
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
    if(isset($_POST['btnsave'])){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $filename = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];

      $type1 = explode('.', $filename);

      $typeok = array('jpg', 'jpeg', 'png', 'gif');

      if($filename != ""){
        if(!in_array($type1[1], $typeok)){
            echo "<script>alert('Format Image Tidak Sesuai')</script>";
          }
          else{
            move_uploaded_file($tmp_name, './Users/Image/'.$filename);
    
            $insert = mysqli_query($conn, "UPDATE user_tb SET 
            username = '".$username."',
            email = '".$email."',
            password = '".$password."',
            image = 'Users/Image/".$filename."'
             WHERE id = '".$user->id."'");
    
            if($insert){
                echo "<script>alert('Berhasil Merubah Profile')</script>";
                $val = mysqli_query($conn, "SELECT * FROM user_tb WHERE email = '".$email."' AND password = '".$password."'");
                $d = mysqli_fetch_object($val);
                $_SESSION['u_global'] = $d;
                echo "<script>window.location='homescreen-admin.php'</script>"; 
            }
            else{
                echo "<script>alert('Gagal Merubah Profile')</script>";
            }
          }
      }
      else{
        $updatenoimg = mysqli_query($conn, "UPDATE user_tb SET 
            username = '".$username."',
            email = '".$email."',
            password = '".$password."',
            image = '$user->image'
            WHERE id = '$user->id'");
    
            if($updatenoimg){
                echo "<script>alert('Berhasil Merubah Profile')</script>";
                $val = mysqli_query($conn, "SELECT * FROM user_tb WHERE email = '".$email."' AND password = '".$password."'");
                $d = mysqli_fetch_object($val);
                $_SESSION['u_global'] = $d;
                echo "<script>window.location='homescreen-admin.php'</script>"; 
            }
            else{
                echo "<script>alert('Gagal Merubah Profile')</script>";
            }
      }
    }

   
?>