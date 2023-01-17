<?php
    include 'connection.php';
    session_start();
    if($_SESSION['islogin'] != true){
        echo "<script>window.location='index.php'</script>";  
    }
    $user = $_SESSION['u_global'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | SeJalan</title>
    <link rel="stylesheet" href="Style/editprofile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/style.css">
</head>
<body>
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom" id="navbar">
        <h1 class="d-flex align-items-center me-md-auto" id="title-navbar">SeJalan</h1>

          <ul class="nav nav-pills">
            <li class="nav-item"><a href="homescreen.php" class="nav-link-custom">Home</a></li>
            <li class="nav-item"><a href="trendsscreen.php" class="nav-link-custom">Trends</a></li>
            <li class="nav-item"><a href="explorescreen.php" class="nav-link-custom">Explore</a></li>
            <li class="nav-item"><a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="nav-link-custom"><img src="<?php echo $user->image != "" ? $user->image : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"?>" class="img-profile-navbar"></a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><div class="wrapper-profile"><img src="<?php echo $user->image != "" ? $user->image : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"?>" class="img-profile-navbar"> <?php echo $user->username ?></li>
                <li><a class="dropdown-item" href="edit-profile.php">Edit Profile</a></li>
                <li><a class="dropdown-item" href="favoriteScreen.php">Your Favorite</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><form action="" method="post"><button name="logoutbtn" class="btn-logout">Logout</button></form></li>
                <?php 
                  if(isset($_POST['logoutbtn'])){
                    $_SESSION['islogin'] == false;
                    echo "<script>window.location='index.php'</script>";  
                  }
                ?>
              </ul>
          </li>
          </ul>
    </header>
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

     <!--js link--->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d309f9e57e.js" crossorigin="anonymous"></script>
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
                echo "<script>window.location='homescreen.php'</script>"; 
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
                echo "<script>window.location='homescreen.php'</script>"; 
            }
            else{
                echo "<script>alert('Gagal Merubah Profile')</script>";
            }
      }
    }

   
?>