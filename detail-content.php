<?php
    include 'connection.php';
    session_start();
    if($_SESSION['islogin'] != true){
        echo "<script>window.location='index.php'</script>";  
    }
    $user = $_SESSION['u_global'];

    $sql = mysqli_query($conn, "SELECT * FROM content WHERE id = '".$_GET['id']."'");
    $data = mysqli_fetch_object($sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $data->judul?> | SeJalan</title>
    <link rel="stylesheet" type="text/css" href="Style/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/detailcontent-Style.css">
  </head>
  <body>
    <!-- Navbar -->
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

    <div class="detail-wrapper">
        <h1 class="title-content"><?php echo $data->judul ?></h1> 
        <p class="date-txt"><?php echo date('d F Y', strtotime($data->tanggal_upload)); ?></p>
        <div class="wrapper-img">
          <img src="<?php echo $data->image ?>" class="img-banner">
          <div class="wrapper-right">
            <video width="420" height="260" controls class="video-player">
              <source src="<?php echo $data->video ?>" type="video/mp4">
            </video>
            <a href="#myModal" data-toggle="modal">
              <div class="wrapper-image">
                <div class="wrapper-image-column">
                  <?php
                      $indeximg = 0;
                      $imagelengthsql = mysqli_query($conn, "SELECT * FROM image_detail WHERE id_post = '$data->id'");
                      $imageee = mysqli_query($conn, "SELECT * FROM image_detail WHERE id_post = '$data->id' LIMIT 4");
                      $imagelength = mysqli_num_rows( $imagelengthsql );
                  ?>
                  <div class="childern-img">
                    <?php 
                         if($imagelength == 1){
                          while ($imagedata = mysqli_fetch_array($imageee)){
                            $indeximg++;
                      ?>

                            <img id="img-c1-<?php echo $indeximg ?>" class="img-child" width="420" height="260" src="<?php echo($imagedata['image_url']) ?>">

                    <?php 
                          }}
                         else if($imagelength == 2){
                          while ($imagedata = mysqli_fetch_array($imageee)){
                            $indeximg++;
                      ?>
                          <img id="img-c2-<?php echo $indeximg ?>" class="img-child" width="210" src="<?php echo($imagedata['image_url']) ?>">

                      <?php 
                          }}
                        else if($imagelength == 3){
                          while ($imagedata = mysqli_fetch_array($imageee)){
                            $indeximg++;
                      ?>
                        <img id="img-c3-<?php echo $indeximg ?>" class="img-child" width="210" height="130" src="<?php echo($imagedata['image_url']) ?>">
                      <?php 
                          }}
                          else if($imagelength >3){
                          while ($imagedata = mysqli_fetch_array($imageee)){
                            $indeximg++;
                      ?>
                      <img id="img<?php echo $indeximg ?>" class="img-child" width="210" height="130" src="<?php echo($imagedata['image_url']) ?>">
                      <?php }} ?>
                  </div>
                  <?php if($imagelength > 4){ ?>
                  <div class="boxxx">
                    <div class="BOXcoba"></div>
                    <div class="BOXcoba"></div>
                    <div class="BOXcoba"></div>
                    <div class="BOXcoba2">
                      <h4 class="txt-img">+<?php echo $imagelength-4 ?></h4>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </a>

          </div>
        </div>
        <h3><?php echo $data->subtitle ?></h3>
        <p class="desc"><?php echo $data->desc_p1 ?></p>
        <p class="desc"><?php echo $data->desc_p2 ?></p>
        <p class="desc"><?php echo $data->desc_p3 ?></p>
        <p class="desc"><?php echo $data->desc_p4 ?></p>
        <p class="desc"><?php echo $data->desc_p5 ?></p>
        <p class="desc"><?php echo $data->desc_p6 ?></p>
        <p class="desc"><?php echo $data->desc_p7 ?></p>
        <p class="desc"><?php echo $data->desc_p8 ?></p>
        <p class="desc"><?php echo $data->desc_p9 ?></p>
        <p class="desc"><?php echo $data->desc_p10 ?></p>
        <div class="wrapper-action">
          <a class="btn-share" href="#modalshare"data-toggle="modal" >Share <i class="fa-solid fa-share"></i></a>
          <?php 
            $favdata1 = mysqli_query($conn, "SELECT * FROM favorite_content WHERE id_content = '$data->id' AND id_user = '$user->id'");
            $userisempty = mysqli_num_rows( $favdata1 );  
            if($userisempty > 0)
          ?>
          <form action="" method="POST"><button name="btnfav" class="btn-fav"><?php echo $userisempty == 0 ? "Favorite " : "Hapus Dari Fav " ?><i class="fa-solid fa-star"></i></button></form>
          <?php 
            if(isset($_POST['btnfav'])){
              
              if($userisempty == 0){
                  $insert = mysqli_query($conn, "INSERT INTO favorite_content (id_content, id_user, user_name, user_image, image, kategori, judul, short_desc) VALUES (
                    '".$data->id."', '".$user->id."', '".$user->username."', '".$user->image."', '".$data->image."', '".$data->kategori."', '".$data->judul."', '".$data->short_desc."'
                  )");
                  if($insert){
                      $favdata2 = mysqli_query($conn, "SELECT * FROM favorite_content WHERE id_content = '$data->id'");
                      $fav_length = mysqli_num_rows( $favdata2 );  
                      $insert_count = mysqli_query($conn, "UPDATE content SET 
                      favorite_count = '".$fav_length."'
                      WHERE id = '".$data->id."'");
                      echo "<script>window.location='detail-content.php?id=".$data->id."'</script>";
                    }
              }
              
              else{
                $delete = mysqli_query($conn, "DELETE FROM favorite_content WHERE id_content = '$data->id' AND id_user = '$user->id'");
                echo "<script>window.location='detail-content.php?id=".$data->id."'</script>"; 
              }
            }
            $indeximggg =0;
            $datafav = mysqli_query($conn, "SELECT * FROM favorite_content WHERE id_content = '$data->id' LIMIT 4");
            $datafavlength = mysqli_query($conn, "SELECT * FROM favorite_content WHERE id_content = '$data->id'");
            $fav_length_data = mysqli_num_rows( $datafavlength ); 
        ?>
        <div class="img-box-fav">
          
          <a href="#modal2" data-toggle="modal" class="a-fav">
            <?php 
              while ($datanya = mysqli_fetch_array($datafav)){  
                $indeximggg++;
            ?>
              <img src="<?php echo $datanya['user_image'] != "" ? $datanya['user_image']:"https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" ?>" width="50px" height="50px" class="imgg-<?php echo $indeximggg?>">
            <?php } ?>
            <?php if($fav_length_data >4){ ?>
              <div class="boxlengthfav">
                <!-- <p></p> -->
              </div>
            <?php } ?>
          </a>
        </div>
          

      </div>
    </div>


    <!-- Modal Image -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content bg-transparent ">
            <div class="modal-header flex-column">
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">

                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
                  <?php 
                      $index = 0;
                      $imgcount = mysqli_query($conn, "SELECT * FROM image_detail WHERE id_post = '$data->id'");
                      while ($imggtest = mysqli_fetch_array($imgcount)){
                        $index++;
                  ?>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index ?>" ></button>
                  <?php } ?>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="<?php echo $data->image ?>" class="img-banner" alt="...">
                  </div>

                  <?php 
                     $imagesql = mysqli_query($conn, "SELECT * FROM image_detail WHERE id_post = '$data->id'");
                      while ($imagelist = mysqli_fetch_array($imagesql)){
                  ?>
                  <div class="carousel-item">
                    <img src="<?php echo($imagelist['image_url']) ?>" class="img-banner" alt="...">
                  </div>  
                  
                  <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
        </div>
    </div>
</div>

<div id="modal2" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                
                <h4 class="modal-title w-100">User Favorite</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            <?php $index = 1;
                       $fav= mysqli_query($conn, "SELECT * FROM favorite_content WHERE id_content = '$data->id'");
                       while ($favorites = mysqli_fetch_array($fav)){ ?>
                <div class="row-fav">
                  <img src="<?php echo $favorites['user_image'] != ""?$favorites['user_image'] : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"?>" class="img_user_fav">
                  <p class="username-fav"><?php echo $favorites['user_name'] ?></p>
                </div>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>
<div id="modalshare" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                
                <h4 class="modal-title w-100">Share</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <a href="https://twitter.com/share?url=http://localhost/New%20folder/detail-content.php?id=37&text='<?php echo $data->judul ?>'" class="share-btn twitter">Twitter</a>
              <a href="https://www.facebook.com/" class="share-btn facebook">Facebook</a>
              <a href="mailto:?subject=<'<?php echo $data->judul ?>'>&body=<'<?php echo $data->short_desc ?>'>" class="share-btn email">Email</a>
            </div>
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

  
