<?php
require_once('../ConnectDB/connectDB.php');
ob_start();
session_start();
require_once('../Library/library.php');

// Gọi hàm connectDB() để tạo kết nối
$con = connectDB();

// Khởi tạo các biến
$search = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';
$item_per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // Số lượng sản phẩm mỗi trang
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Trang hiện tại
$offset = ($page - 1) * $item_per_page; // Tính offset cho SQL

$orderCondition = "";
if (isset($_GET['field']) && isset($_GET['sort'])) {
    $field = $_GET['field'];
    $sort = $_GET['sort'];
    if ($field == "price" && ($sort == "ASC" || $sort == "DESC")) {
        $orderCondition = " ORDER BY `price` $sort";
    }
}

if ($search) {
    $products = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . mysqli_real_escape_string($con, $search) . "%'" . $orderCondition . " LIMIT " . $item_per_page . " OFFSET " . $offset);
    $totalRecords = mysqli_query($con, "SELECT COUNT(*) as total FROM `product` WHERE `name` LIKE '%" . mysqli_real_escape_string($con, $search) . "%'");
} else {
    $products = mysqli_query($con, "SELECT * FROM `product`" . $orderCondition . " LIMIT " . $item_per_page . " OFFSET " . $offset);
    $totalRecords = mysqli_query($con, "SELECT COUNT(*) as total FROM `product`");
}

// Đảm bảo rằng các truy vấn SQL đã thực thi thành công
if (!$products || !$totalRecords) {
    die("Truy vấn thất bại: " . mysqli_error($con));
}

// Xử lý kết quả truy vấn
$totalRecords = mysqli_fetch_assoc($totalRecords)['total'];
$totalPages = ceil($totalRecords / $item_per_page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="icon" href="../images/logonariz.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous" />
    <!-- link fontawesome -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet" />
    <!-- font google -->
    <link rel="stylesheet" href="./Home/owl.carousel.min.css" />
    <link rel="stylesheet" href="./Home/owl.theme.default.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Reddit+Mono:wght@200..900&display=swap" rel="stylesheet">
    <!-- carousel -->
    <style>
      :root {
        --bg-color: #ffbf80;
        --textName-color : #157332;
        --textPrice-color: #fb492c;
        --text-color: #157332;
      }
    </style>
    <title>Thực Đơn</title>
    <link rel="stylesheet" href="./style_category.css" />
    <link rel="stylesheet" href="./style_home_animate.css">
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
            <h1>MENU</h1>
          </div>
          <!-- end slogan -->
          <div class="section_policy">
            <div class="policy_item">
              <div class="policy_item_icon">
                <img src="../images/policy_images_1.png" alt="">
              </div>
              <div class="policy_item_content">
                <h4>Bảo đảm chất lượng</h4>
                <p>Sản phẩm bảo đảm chất lượng.</p>/ b
</div>
            </div>
            <!-- end policy item -->
            <div class="policy_item">
              <div class="policy_item_icon">
                <img src="../images/policy_images_2.png" alt="">
              </div>
              <div class="policy_item_content">
                <h4>Miễn phí giao hàng</h4>
                <p>Cho đơn hàng đầu tiên.</p>
              </div>
            </div>
            <!-- end policy item -->
            <div class="policy_item">
              <div class="policy_item_icon">
                <img src="../images/policy_images_3.png" alt="">
              </div>
              <div class="policy_item_content">
                <h4>Hỗ trợ 24/7</h4>
                <p>Hotline: <?php showPhoneWeb(); ?></p>
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
              <li><a href="./index.php">Thực Đơn</a></li>
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
              <form action="" method="post">
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
                      showCartMini($_SESSION['user']['idUser'], 2);
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
        <div class="content">
                <div class="filter-product">
                    <form action="" method="post">
                        <div class="category-product">
                            <div class="category-prdTop">
                                <span class="DanhMuc">DANH MỤC</span>
                                <span class="icon-dropDownDM" onclick="showCategory()">▼</span>
                            </div>
                            <div class="inp-category">
                                <ul class="list-choose">
                                    <?php
                                        if (isset($_POST['bntSreachCategory'])) {
                                            showCategory(-1);
                                        } else {
                                            if (isset($_GET['idML'])) {
                                                showCategory($_GET['idML']);
                                            } else {
                                                showCategory(0);
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <button class="bnt_sea_carte" name="bntSreachCategory"><a href="http://localhost/LAPTRINHPHP/DOAN_new/Doan12/Doan/Product/index.php" >Tìm kiếm</a></button>
                    </form>
                </div>

                
                <!-- end filter product -->
                <div class="show-product">
                    <div class="sort-product">
                        <form action="" method="get">
                        <label>Sắp xếp theo: </label>
                          <select name="field" onchange="this.form.submit()">
                              <option value="price" <?php echo (isset($_GET['field']) && $_GET['field'] == 'price') ? 'selected' : ''; ?>>Giá:</option>
                          </select>
                          <select name="sort" onchange="this.form.submit()">
<option value="ASC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : ''; ?>>Tăng dần</option>
                              <option value="DESC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : ''; ?>>Giảm dần</option>
                          </select>
                          <button type="submit" name="btnSort"><a href="http://localhost/LAPTRINHPHP/DOAN_new/Doan12/Doan/Product/index.php" style="text-decoration: none">Sắp Xếp</a></button>
                            </select>
                        </form>
                    </div>
                    <hr class="hr-btSort">
                    <div class="box-product_Hot">
                        <?php
                        while ($row = mysqli_fetch_assoc($products)) {
                            echo '
                                <div class="item-product-hot">
                                    <div class="item-product-hot-img">
                                        <img src="../images/' . $row['image'] . '" alt="" />
                                        <a href="../Product_Detail/sanpham.php?id=' . $row["id_product"] . '">Mua Ngay</a>
                                        <span class="discount">- ' . $row['discount'] . '%</span>
                                    </div>
                                    <div class="item-product-information">
                                        <p class="name-product">' . $row['nameProduct'] . '</p>
                                        <span class="priceSaled-product">' . number_format(ceil(($row['price'] - ($row['price'] * $row['discount']) / 100))) . ' đ</span>
                                        <span class="price-product">' . number_format($row['price']) . ' đ</span>
                                    </div>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- enn content -->

            
        </main>
        <footer>
        <div class="section_information">
          <div class="section_information_address">
            <div class="logo-footer">
              <?php logo(0);?>
            </div>
            <div class="information_address">
              <h2>Cửa Hàng NarizFastFood</h2>
              <ul>
                <?php 
                $conn = connectDB();
                $result = $conn->query("SELECT * FROM information");
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                    echo '
                      <li>'.$row['address1'].'</li>
                    ';
                }
?>
              </ul>
            </div>
          </div>
          <!-- end section_information_address -->
          <div class="contact_information">
            <h2>Chính sách và quy định chung</h2>
            <div class="contact_information_content">
              <p class="contact_information_content_sub">
              Các chính sách và quy định chung này liên quan đến việc Khách hàng sử dụng website của NFF
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./Home/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="./js_category.js"></script>
    <script>
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 100,
            nav: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 5,
                },
            },
        });
    </script>
    <?php 
    if (isset($_POST['bntSreachCategory'])) {
        if (isset($_POST['valCheckbox'])) {
            $conn = connectDB();
            $arrCheckbox = $_POST['valCheckbox'];
            $result = $conn -> query("SELECT * FROM category");
            if ($result -> num_rows >0) {
                while ($row = $result ->fetch_assoc()) {
                    foreach($arrCheckbox as $value){
                        if ($row['id_category']==$value) {
                            echo '<script>
                                var valCheckbox = document.querySelectorAll(".valCheckbox");
                                valCheckbox.forEach((item, index) => {
                                        if(item.value=='.$value.')
                                            item.checked="checked";
                                        });
                                </script>';
                        } 

                    } 
                }
            }
        }
    }
?>
<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "106683535040589");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./Home/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-FTMtEbfueYSOfT4twEnZzAHdWGsmZLMK5cvius5F5VVycN1p4nVn0j5V0dIYI6AX" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eylA6bBaW2nNf58QeXf1U0Bf1OJquhJOZceggPVRV+mKf05L4gSgfp" crossorigin="anonymous"></script>
    <script src="./js.js"></script>



</body>

</html>