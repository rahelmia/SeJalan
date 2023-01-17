<?php
    include 'connection.php';
    session_start();
    if($_SESSION['islogin'] != true){
        echo "<script>window.location='index.php'</script>";  
    }
    $user = $_SESSION['u_global'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Favorite | SeJalan</title>
    <link rel="stylesheet" type="text/css" href="Style/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/explorescreen-style.css">
  </head>
  <body>
    <!-- Navbar -->
    <div class="container-head">
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
                    $_SESSION['islogin'] = false;
                    echo "<script>window.location='index.php'</script>";  
                  }
                ?>
              </ul>
          </li>
          </ul>
    </header>

        <div class="wrapper-content-2">
                <form action="search-fav.php">
                        <div class="box">
                            <div class="search-box">
                            <input type="text" placeholder="Cari tempat wisata, kuliner, event" name="search">
                            <button class="icon"><i class="fa-solid fa-search fa-xl"></i></button>
                            </div>
                        </div>
                </form>
                
        </div>
        <div class="container-head">
                    <?php $index = 1;
                            $fav = mysqli_query($conn, "SELECT * FROM favorite_content WHERE id_user = '$user->id'");
                            while ($row = mysqli_fetch_array($fav)){ 
                                ?>
                            
                    <div class="container-content-box">
                        <img src="<?php echo $row['image']; ?>" class="img-content-2">
                        <div class="wrapper-content2">
                            <div class="box-category">
                            <p><?php echo $row['kategori']; ?></p>
                            </div>
                            <h1 class="title-content"><?php echo $row['judul']; ?></h1>
                            <div></div>
                            <p class="subtitle"><?php echo $row['short_desc']; ?></p>
                            <button class="btn-content" onclick="window.location.href = 'detail-content.php?id=<?php echo $row['id_content'] ?>'">Baca Selengkapnya</button>
                        </div>
                    </div>
                    <?php }  ?>
                </div>
       
        
    </div>

   
 
    


    <footer>
       <h1 class="d-flex align-items-center me-md-auto" id="title-footer">SeJalan</h1>
       <div class="content-footer">
        <img src="Assets/ph_copyright-bold.png" class="copyright-img">
        <h5 class="footer-copyright">Copyright 2022 dinas pariwisata kota semarang</h5>
      </div>
      <img src="Assets/pngwing.com (2).png" class="disbupar-img">
      <img src="Assets/Seal logo 1.png" class="seal-img">
    </footer>


    <!--js link--->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d309f9e57e.js" crossorigin="anonymous"></script>
    </body>
  </html>
