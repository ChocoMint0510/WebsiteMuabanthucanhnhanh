<?php
require_once('../ConnectDB/connectDB.php');
ob_start();
session_start();
require_once('../Library/library.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="icon" href="../images/logoPopo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous" />
    <!-- link fontawesome -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet" />
    <!-- font google -->
    <link rel="stylesheet" href="./Home/owl.carousel.min.css" />
    <link rel="stylesheet" href="./Home/owl.theme.default.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" rel="stylesheet">
    <!-- carousel -->
    <style>
      :root {
        --bg-color: #ffbf80;
        --textName-color : #157332;
        --textPrice-color: #fb492c;
        --boder-color: #cabbbb;
      }
    </style>
    <title>Tài Khoản</title>
    <link rel="stylesheet" href="./styleAllUserManager.css" />
</head>

<body>
    <div class="containerr">
      <header>
        <div class="subsystem">
          <div class="social_network">
          <a href="https://www.facebook.com/narizmusicrl/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/narizmusic/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/narizmusicrl/" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.tiktok.com/@narizmusicrl" target="_blank"><i class="fab fa-tiktok"></i></a>
          </div>
          <?php disAdmin(1)?>
          <div class="account">
          <span class="notification"><i class="fas fa-bell" onclick="showNotification()"></i>
                <sub><?php
                    if (isset($_SESSION['user'])) {
                      showCountNotification($_SESSION['user']['idUser']);
                    } else {
                      echo 0;
                    } 
                  ?></sub>
            <div class="show_Notification">
              <ul>
              <?php if (isset($_SESSION['user'])) {
                  showNotification($_SESSION['user']['idUser']);
                } else {
                  echo "<h4>Không có thông báo nào !</h4>";
                } ?>
              </ul>
            </div>
            </span>
            <?php
              if(isset($_SESSION['user'])) {
                disLogin(3);
              } else {
                echo '
                <a class="hover__bg" href="../Login/creatLogin.php" style = "display: inline;" href="">Đăng Ký</a>
                <a class="hover__bg" href="../Login/index.php" style = "display: inline;" href="">Đăng Nhập</a>
              ';
              }
            ?> 
          </div>
        </div>
        <div class="header_top">
          <div class="logo">
            <?php logo(0);?>
          </div>
          <div class="box-header_content">
          <div class="slogan">
            <h1>Yêu Là Phải Nói - Cũng Như Đói Là Phải Ăn</h1>
          </div>
          <!-- end slogan -->
          <div class="section_policy">
            <div class="policy_item">
              <div class="policy_item_icon">
                <img src="../images/policy_images_1.png" alt="">
              </div>
              <div class="policy_item_content">
                <h4>Bảo đảm chất lượng</h4>
                <p>Sản phẩm bảo đảm chất lượng.</p>
              </div>
            </div>
            <!-- end policy item -->
            <div class="policy_item">
              <div class="policy_item_icon">
                <img src="../images/policy_images_2.png" alt="">
              </div>
              <div class="policy_item_content">
                <h4>Miễn phí giao hàng</h4>
                <p>Cho đơn hàng từ 200,000 đ.</p>
              </div>
            </div>
            <!-- end policy item -->
            <div class="policy_item">
              <div class="policy_item_icon">
                <img src="../images/policy_images_3.png" alt="">
              </div>
              <div class="policy_item_content">
                <h4>Hỗ trợ 24/7</h4>
                <p>Hotline: 0123 456 789</p>
              </div>
            </div>
            <!-- end policy item -->
          </div>
          <!-- end  section_policy-->
          </div>
          
        </div>
        <!-- end header_top -->
        <div class="header_bottom">
          <nav class="nav_top">
            <button class="bnt-bars">
              <i class="fas fa-bars"></i>
            </button>
            <ul>
              <li><a href="../index.php">Trang Chủ</a></li>
              <li><a href="../Product/index.php">Thực Đơn</a></li>
              <li><a href="">Giảm Giá</a></li>
              <li><a href="">Tuyển Dụng</a></li>
              <li><a href="">Thông Tin</a></li>
              <button class="bnt-close">
                <i class="fas fa-times"></i>
              </button>
            </ul>
            <!-- end logo -->
          </nav>
          <!-- end nav_top -->
          <div class="search">
              <form action="../Product/index.php" method="post">
                <input type="text" oninput="errorLog()" placeholder="Tìm Kiếm Sản Phẩm" name="txtSearch" required/>
                <button name="bntSearch" onclick="return checkForm()"><i class="fas fa-search"></i></button>
              </form>
              <div class="error_log">
                <span>Không được để trống !</span>
              </div>
          </div>
          <!-- end search-->
          <div class="cart">
            <?php 
              if (isset($_SESSION['user'])) {
                cart(0);
              } else {
                echo'
                <div class="cart_icon">
                  <i class="fas fa-shopping-cart"></i>
                  <sub>0</sub>
                </div>';
              }
            ?>
            <div class="showCart">
              <h4>Sản Phẩm Đã thêm</h4>
              <ul class="list_cart">
              <form action="" method="post">
                  <?php
                    if(isset($_SESSION['user'])) {
                      showCartMini($_SESSION['user']['idUser'],2);
                      if (isset($_POST['deleteCart'])) {
                        $conn = connectDB();
                        $idCartDetail = $_POST['deleteCart'];
                        $sql1 = "DELETE FROM cart WHERE cart.idCartDetail =".$idCartDetail.""; // xóa giỏi hàng có mã hàng chi tiết đấy
                        $conn -> query($sql1);
          
                        $sql2= "DELETE FROM cartdetail WHERE cartdetail.id_cartDetail =".$idCartDetail.""; // xóa giỏ hàng chi tiết
                        $conn -> query($sql2);
                        header("Refresh:0");
                      }
                    }
                    else {
                      echo '<li class="cartEmpty">Giỏ Hàng Trống !</li>';
                    }
                  ?>
                </form>
              </ul>
              <a class="linkCart" href="../Cart/giohang.php">Xem giỏ hàng</a>
            </div>
            <!-- end showCart -->
          </div>
          <!-- end cart -->
          
        </div>
        <!-- end header_bottom -->
      </header>
        <!-- end header -->
      <main>
        <div class="title_name">
          <h1><i class="fas fa-user-cog"></i>Tài Khoản</h1>
        </div>
        <div class="manager__user">
          <div class="content_main">
            <div class="setting_logo">
                <div class="title_setting">
                    <h2>Ảnh Đại Diện</h2>
                </div>
                <!-- end title_setting -->
                <div class="edit_logo">
                    <form action="" method="post" method="post" enctype="multipart/form-data">
                        <!-- <img src="../images/avata/avatar d" alt=""> -->
                        <?php disAvata();?>
                        <input type="file" name="Upfile" id="Upfile" required>
                        <?php nameimg($_SESSION['user']['idUser']);?>
                        <button class="bnt_submit" id="bnt_UpdateLogo" name="bntEditLogo" onclick="return showInpfile()" value="edit">Thay đổi</button>
                    </form>
                    <?php
                        if (isset($_POST['bntEditLogo']) == 'update') {
                            $nameImg = upFile('Upfile','../images/avata/');
                            updateAvatar($nameImg, $_SESSION['user']['idUser']);
                        }
                    ?>
                </div>
            </div>
            <!-- end setting item -->
            <div class="setting_adress">
                <div class="title_setting">
                    <h2>Thông tin cá nhân</h2>
                </div>
                <!-- end title_setting -->
                <div class="edit_adress">
                    <form action="" method="post" method="post">
                        <div class="form_group">
                            <?php personalInformation($_SESSION['user']['idUser']);?>
                        </div>
                        <button class="bnt_submit" name="bntEditAdress" id="bnt_UpdateAdress" onclick="return showInpAdress()" value="edit">Thay đổi</button>
                    </form>
                    <?php 
                        if (isset($_POST['bntEditAdress']) == 'update') {
                          updatePersonalInformation($_POST['txtFullName'], $_POST['txtEmail'], $_POST['txtPhone'], $_POST['txtadress'], $_SESSION['user']['idUser']);
                        }
                    ?>
                </div>
            </div>
            <!-- end setting item -->
            <div class="setting_contact">
                <div class="title_setting">
                    <h2>Bảo Mật</h2>
                </div>
                <!-- end title_setting -->
                <div class="edit_contact">
                    <form action="" method="post" method="post">
                        <div class="input__password">
                          <div class="form_group">
                            <label for="">Mật Khẩu Cũ</label>
                            <input type="password" name="passOld" required>
                          </div>
                          <div class="form_group">
                            <label for="">Mật Khẩu Mới</label>
                            <input type="password" name="passNew" id="passNew" required>
                          </div>
                          <div class="form_group">
                            <label for="">Nhập Lại Mật Khẩu Mới</label>
                            <input type="password" id="erpass" required >
                          </div>
                        </div>
                        <div class="submit_group">
                          <button name="bntEditPass" onclick="return checkPass()">Thay Đổi</button>
                        </div>
                    </form>
                    <p class="errorPass"><?php
                      if (isset($_POST['bntEditPass'])) {
                        editPassWord($_SESSION['user']['idUser'],$_SESSION['user']['passWord'],$_POST['passOld'],$_POST['passNew']);
                      }
                    ?></p>
                </div>
                <button class="bnt_submit showInpPass" onclick="showInpContact()">Đổi Mật Khẩu</button>
                
              </div>
              <!-- end setting item -->
          </div>
        </div>
      </main>
      <!-- end main -->
      <footer>
        <div class="section_information">
          <div class="section_information_address">
            <div class="logo-footer">
              <?php logo(0);?>
            </div>
            <div class="information_address">
              <h2>Cửa Hàng NFF</h2>
              
            </div>
          </div>
          <!-- end section_information_address -->
          <div class="contact_information">
            <h2>Chính sách và quy định chung</h2>
            <div class="contact_information_content">
              <p class="contact_information_content_sub">
              Các chính sách và quy định chung này liên quan đến việc Khách hàng sử dụng website của NarizFastFood
              </p>
              <img src="../images/hostline.png" alt="">
            </div>
          </div>
          <!-- end contact_information -->
          <div class="list_product_footer">
            <h2>Danh mục thông tin</h2>
            <ul>
              <li><a href="">Đồ Uống</a></li>
              <li><a href="">Sữa Chua</a></li>
              <li><a href="">Đồ Ăn Vặt</a></li>
              <li><a href="">Tuyển Dụng</a></li>
              <li><a href="">Điều Khoản Và Trách Nhiệm</a></li>
            </ul>
          </div>
        </div>
        <div class="copy_right">
          <p>Copyright 2024 © NarizFastFood. Bản Quyền Thuộc NarizFastFood</p>
        </div>
      </footer>
    </div>
    <script>
      // check emty search 
    const valSearch = document.querySelector('.search input');

    function checkForm() {
        if (valSearch.value.trim() == "") {
            document.querySelector('.error_log').style.display = "block";
            return false;
        } else {
            return true;
        }
    }

    function errorLog() {
        if (valSearch.value.trim() != "") {
            document.querySelector('.error_log').style.display = "none";
        }
    }
    </script>
    
    <script src="./styleJs.js"></script>


</body>
</html>