<?php
    session_start();
    ob_start();
    require_once("../dal/ModelDAO.php");
    $modelUser=new ModelUser();
    $username=$password=$nameErr="";
    
    if((isset($_POST['dangnhap']))){
        $username=test_input($_POST['username']);
        // if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
        //     $nameErr = "Only letters and white space allowed";
        // }
        $password=test_input($_POST['password']);
        $role=$modelUser->getRole($username,$password);
        if($role==1){
            $_SESSION['login']['username']=$username;
            $_SESSION['login']['role']=$role;
            header('Location: home.php');
        }
        else if($role==2){
            $_SESSION['login']['username']=$username;
            $_SESSION['login']['role']=$role;
            header('Location: admin.php');
        }
        else{
            $nameErr = "Đăng nhập không thành công. Vui lòng kiểm tra tên đăng nhập và mật khẩu.";
        }
        
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tín Chỉ</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="img js-fullheight" style="background-image: url(../public/image/ok1.jpg);">

    <section class="section-one">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-5">
                    <div class="inner-head">
                        <h1 class="inner-title kanit-bold">HỌC VIỆN CÔNG NGHỆ BƯU CHÍNH VIỄN THÔNG</h1>
                        <h2 class="inner-desc kanit-medium">CỔNG THÔNG TIN ĐĂNG KÝ TIN CHỈ</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center kanit-medium">Đăng Nhập</h3>
                        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="signin-form">
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" placeholder="Username" required>
                                
                            </div>
                            <div class="form-group">
                                <input name="password" id="password-field" type="password" class="form-control" placeholder="Password"
                                    required>

                            </div>
                            <div class="form-group">
                               <span class="error" style="text-center"><?php echo $nameErr;?></span>
                                <button name="dangnhap" type="submit" class="form-control btn kanit-medium">Đăng Nhập</button>
                            </div>
                            <div class="form-group ">
                                <div class="inner-pass">
                                    <a href="/TTCS/view/forgot.php" style="color:#ffffff;text-decoration:none">Quên mật khẩu</a>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>