<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Style/login&register_style.css">
    <title>Login | sparepart guitar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="glassbg">
        <form action="" method="POST">
             <div class="container">
                <div class="card">
                <h1 class="title">Register</h1>
                            <div class="boxcolumn">
                                    <div class="icon">
                                        <i class="fa-solid fa-user fa-xl"></i>
                                    </div>
                                    <div class="form">
                                        <input type="text" name="username" class="input" placeholder="username" required/>
                                    </div>
                                </div>
                            <br>

                            <div class="boxcolumn">
                                <div class="icon">
                                    <i class="fa-solid fa-envelope fa-xl"></i>
                                </div>
                                <div class="form">
                                    <input type="text" name="email" class="input" placeholder="Email" aria-describedby="emailHelp" required />
                                </div>
                            </div>
                            <br>
                    
                            <div class="boxcolumn">
                                <div class="icon">
                                    <i class="fa-solid fa-lock fa-xl"></i>
                                </div>
                                <div class="form">
                                    <input type="text" name="password" class="input" placeholder="Password" required/>
                                </div>
                            </div>
                            <br>

                           
                           
                          
                                <button type="submit" class="btn btn-primary" id="loginbtn" name="registerbtn">Register</button>
                                <div class="tocenter">
                                    <p class="gotoregistertxt">Already an Accoount ?</p>
                                    <a href="index.php" class="gotoregisterbtn">Login</a>
                                </div>
                          
                </div>
            </div>
                
          
        </form>
    </div>
        
    

    <script src="https://kit.fontawesome.com/d309f9e57e.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
        if(isset($_POST['registerbtn'])){
            session_start();
            include 'connection.php';
            $username = $_POST['username'];
            $email = $_POST['email'];
            $akses = $_POST['akses'];
            $password = $_POST['password'];
            
            $val = mysqli_query($conn, "INSERT INTO user_tb (username, email, password, akses) VALUES ('$username', '$email', '$password', 'user')");
            if($val){
                echo "<script>alert('Berhasil Mendaftar, Silahkan Login')</script>";
                echo "<script>window.location='index.php'</script>"; 
            }
            else{
                echo "<script>alert('Gagal Mendaftar, Silahkan Coba Lagi')</script>";
            }
        }
?>