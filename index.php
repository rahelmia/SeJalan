<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Login | SeJalan</title>
    <link rel="stylesheet" href="Style/login&register_style.css">
</head>
<body>
    <div class="glassbg">
        <form action="" method="POST">
             <div class="container">
                <div class="card">
                                <h1 class="title">Login</h1>

                                <div class="boxcolumn">
                                    <div class="icon">
                                        <i class="fa-solid fa-envelope fa-xl"></i>
                                    </div>
                                    <div class="form">
                                        <input type="text" name="email" class="input" placeholder="Email" required aria-describedby="emailHelp"/>
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

                               <div class="wrapper-btnforget">
                                    <a href="" class="forgetpw">Forget Password ?</a>
                               </div>

                                <button type="submit" class="btn btn-primary" id="loginbtn" name="loginbtn">Login</button>

                                <div class="tocenter">
                                    <p class="gotoregistertxt">Dont Have An Accoount ?</p>
                                    <a href="register.php" class="gotoregisterbtn">Register</a>
                                </div>
                                
            
                </div>
            </div>
                
          
        </form>
    </div>
        
    

    <script src="https://kit.fontawesome.com/d309f9e57e.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
        if(isset($_POST['loginbtn'])){
            session_start();
            include 'connection.php';
            $email = $_POST['email'];
            $password = $_POST['password'];

            $val = mysqli_query($conn, "SELECT * FROM user_tb WHERE email = '".$email."' AND password = '".$password."'");
            if(mysqli_num_rows($val) > 0){
                $d = mysqli_fetch_object($val);
                $_SESSION['islogin'] = true;
                $_SESSION['u_global'] = $d;
                $_SESSION['id'] = $d->id;
                if($d->akses == "admin"){
                    echo "<script>window.location='homescreen-admin.php'</script>";
                }  
                elseif($d->akses == "user"){
                    echo "<script>window.location='homescreen.php'</script>";
                }
                else{
                    
                    echo "<script>alert('Kamu tidak memiliki akses')</script>";
                }
            }
            else{
                echo "<script>alert('Email atau password salah')</script>";
            }
        
        }
        ?>