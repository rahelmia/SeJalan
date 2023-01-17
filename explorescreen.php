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
    <title>Explore | SeJalan</title>
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
            <li class="nav-item"><a href="explorescreen.php" class="nav-link-custom-a">Explore</a></li>
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

        <div class="container-content">
            <div class="elipsbox-2">
                <img src="Assets/Ellipse 1 (1).png" class="elips1">
            </div>
            <div class="elipsbox-1">
                <img src="Assets/Ellipse 2 (1).png" class="elips2">
            </div>
            <div class="wrapper-content">
                <div class="left-box">
                    <div class="box-head">
                        <div class="box-dec"></div>
                        <h1 class="title-head">TEMUKAN IDE DESTINASI BARU</h1>
                        <p class="subtitle-head">Tersedia lebih dari ratusan Ide tempat wisata,kuliner,event yang menarik di semarang</p>
                    </div>
                    <form action="search-page.php">
                        <div class="box">
                            <div class="search-box">
                            <input type="text" placeholder="Cari tempat wisata, kuliner, event" name="search">
                            <button class="icon"><i class="fa-solid fa-search fa-xl"></i></button>
                        </div>
                        </div>
                    </form>
                </div>
                <div class="right-box">
                    <div class="imgleft">
                        <img src="Assets/Events.png" class="imgleft1">
                        <img src="Assets/Rectangle 93 (1).png" class="imgleft2">
                    </div>
                    <div class="imgright">
                        <img src="Assets/Rectangle 92.png" class="imgright1">
                        <img src="Assets/Rectangle 94.png" class="imgright2">              
                    </div>
                </div>
            </div>
        </div>
        <div class="wrappertabbar">
            <div class="tabbar">
                <a href="explorescreen.php" class="btnt-a">Wisata</a>
                <a href="kulinerScreen.php" class="btnt">Kuliner</a>
                <a href="EventScreen.php" class="btnt">Event</a>
            </div>  
        </div>
        <div class="wrapper-body">
            <div class="content">
                <?php $index = 1;
                        $popular = mysqli_query($conn, "SELECT * FROM content WHERE kategori = 'wisata'");
                        while ($row = mysqli_fetch_array($popular)){ ?>
                  <a href="detail-content.php?id=<?php echo $row['id'] ?>" class="btnc">
                    <div class="card-content">
                    <img src="<?php echo($row['image']) ?>" class="img-content">
                    <div class="wrapper-child">
                        <h1 class="title-card"><?php echo($row['judul']) ?></h1>
                        <p class="lokasi-txt"><?php echo($row['lokasi']) ?></p>
                    </div>
                    </div>
                </a>
                <?php }  ?>
            </div>
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
