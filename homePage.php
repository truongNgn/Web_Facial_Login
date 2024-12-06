
<?php
session_start();

// Simulating a logged-in user (replace with actual login logic)
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'TestUser'; // Replace this with your actual username logic
}

// Retrieve the username from the session
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="styles/index1.css">
    <link rel="stylesheet" href="styles/floatingButton.css">
    <link rel="stylesheet" href="styles/headFoot.css">
    <link rel="stylesheet" href="styles/table.css">
    <link rel="stylesheet" href="styles/iconMenu.css">
    <title>Admin Dashboard</title>
    <style>
        :root {
            --theme-color: #95B5E4;
            --menu-color: #2876D4;
        }

        .h2 {
            margin-top: 10px;
            padding-top: 20px;
            text-align: center;
        }

        .dropdown-toggle {
            background-color: var(--menu-color);
        }

        .dropdown-button {
            color: whitesmoke;
            font-weight: bolder;
            font-size: 20px;
        }

        #main-head {
            background-color: var(--theme-color);
            padding: 3px;
            border-radius: 8px;
        }

        .inline-label {
            display: inline-block;
            margin-right: 20px;
        }

        #search-bar {
            align-items: center;
            margin-left: 850px;
            border-radius: 20px;
        }

        /* table */
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border-radius: 12px;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: var(--menu-color);
            /* Background color of th */
            color: white;
            /* Text color of th */
        }

        .noiDung {
            width: 100%;
        }

        .card-container {
        display: flex;
        flex-wrap: nowrap; /* Prevent wrapping; use wrap if needed */
        justify-content: space-between; /* Adjust spacing between cards */
        gap: 60px; /* Add space between cards */
    }

    .card {
        flex: 0 0 calc(25% - 20px); /* Make each card take 25% width minus the gap */
        margin: 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        background-color: #f9f9f9;
    }

    .card-img-top-container {
        width: 100%;
        height: 200px; /* Adjust this to your preferred height */
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f0f0f0;
    }

    .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the container */
    }

    .card-body {
        padding: 10px;
        text-align: center;
    }
    </style>
</head>

<body style="position: relative;">
    <header>
        <div class="header">
            <img src="img/papa.png" alt="Logo" class="logo">
            <div class="avatar-container">
                <div class="btn-group">
                    <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="user-info">
                            <span class="user-name"></span>
                            <span class="user-name" id="user-name"><?php echo $username; ?></span>
                        </div>
                        <img src="img/garnacho-mu-488.jpg" alt="Avatar" class="avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="userInfo.php">Thông tin cá nhân</a>
                        <a class="dropdown-item" href="doiMatKhau.php">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="login.html">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div>
        <br>
    </div>


    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <div class="list-group">
                        <a href="homeAdmin.php" class="list-group-item list-group-item-action active">
                            <img src="icon/home.png" class="icon" alt="">
                            Trang chủ
                        </a>

                        <a href="sanPhamAdmin.php" class="list-group-item list-group-item-action" aria-current="true">
                            <img src="icon/product.png" class="icon" alt="">
                            Sản Phẩm</a>
                        <a href="khachHangAdmin.php" class="list-group-item list-group-item-action">
                            <img src="icon/user.png" class="icon" alt="">
                            Khách Hàng</a>
                        
                      
                      
                        <a href="hoaDonAdmin.php" class="list-group-item list-group-item-action ">
                            <img src="icon/order.png" class="icon" alt="">
                            Hóa Đơn</a>
                        <a href="baoCaoAdmin.php" class="list-group-item list-group-item-action">
                            <img src="icon/newspaper.png" class="icon" alt="">
                            Báo Cáo</a>
                        <!-- <a href="#" class="list-group-item list-group-item-action">Cài Đặt</a> -->

                    </div>

                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">



                <h2><span class="badge rounded-pill bg-primary text-light">Xin chào
                        User </span></h2>
                <br>

                <h3><span class="badge rounded-pill bg-light text-dark">Sản phẩm nổi bật</span></h3>
                <div class="card-container">
    
                    <div class="card-container">
                        <div class="card">
                            <div class="card-img-top-container">
                                <img src="img/products/IPH14-128GB.jpg" class="card-img-top" alt="Product 1">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Product 1</h5>
                                <p class="card-text">Description of Product 1</p>
                            </div>
                        </div>
                    
                        <div class="card">
                            <div class="card-img-top-container">
                                <img src="img/products/REALMEGT2-256GB.jpg" class="card-img-top" alt="Product 2">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Product 2</h5>
                                <p class="card-text">Description of Product 2</p>
                            </div>
                        </div>
                    
                        <div class="card">
                            <div class="card-img-top-container">
                                <img src="img/products/HUAWEIP50PRO-256GB.jpg" class="card-img-top" alt="Product 3">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Product 3</h5>
                                <p class="card-text">Description of Product 3</p>
                            </div>
                        </div>
                    
                        <div class="card">
                            <div class="card-img-top-container">
                                <img src="img/products/SONYXPERIA1III-256GB.jpg" class="card-img-top" alt="Product 4">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Product 4</h5>
                                <p class="card-text">Description of Product 4</p>
                            </div>
                        </div>
                    </div>
    
</div>



                <br><br>


                <h3><span class="badge rounded-pill bg-light text-dark">Sự kiện gần đây</span></h3>
                <div class="noiDung">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/homePage/event1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/homePage/event2.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/homePage/event3.png" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>


            </main>
        </div>
    </div>




    <footer class="bg-dark text-white pt-4" style="position:absolute ; bottom:0  ;width: 100% ;  z-index: 2">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Chúng tôi là công ty chuyên về mảng xây dựng hệ thống bán hàng dành cho admin</p>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope"></i> minhtruongb16@gmail.com</li>
                        <li><i class="fas fa-phone"></i> 0334053171</li>
                        <li><i class="fas fa-map-marker-alt"></i> Nguyen Huu Tho, Ho Chi Minh City</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled d-flex">
                        <li><a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <p class="mb-0">&copy; 2024 PactPal. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rows = document.querySelectorAll('tr[data-href]');
            rows.forEach(row => {
                row.addEventListener('click', function () {
                    window.location.href = this.dataset.href;
                });
            });
        });

        // Fetch the username from the backend
        fetch('getUser.php')
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success && data.username) {
            document.getElementById('user-name').textContent = data.username;
        } else {
            console.error('No user is logged in:', data.message || 'Unknown error');
        }
    })
    .catch(error => console.error('Error fetching user data:', error));

    </script>
    
</body>

</html>