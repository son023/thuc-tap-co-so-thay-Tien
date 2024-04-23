<?php
    session_start();
    ob_start();
    require_once("../dal/ModelDAO.php");
    $modelUser=new ModelUser();
    $username=$password="";
    
    if((isset($_POST['dangnhap']))){
        $username=test_input($_POST['username']);
        $password=test_input($_POST['password']);
        $role=$modelUser->getRole($username,$password);
        echo $role;
        if($role==1){
                header('Location: home.php');
        }
        else if($role==2){
            header('Location: admin.php');
        }
        else{
            header('Location: index.php');
        }
        
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }





?>
<?php
require "../inc/header.php";
?>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="signin-form">
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input name="password" id="password-field" type="password" class="form-control" placeholder="Password"
                                    required>

                            </div>
                            <div class="form-group">
                                <button name="dangnhap" type="submit" class="form-control btn kanit-medium">Đăng Nhập</button>
                            </div>
                            <div class="form-group ">
                                <div class="inner-pass">
                                    <a href="/TTCS/view/forgot.php" style="color: #fff;text-decoration: none">Quên mật khẩu</a>
                                </div>
                            </div>
                        </form>

                        <?php
require "../inc/footer.php";
?>