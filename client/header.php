<?php
//* start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//* constants
define('STUDENT', 0);
define('TEACHER', 1);
define('ADMIN', 2);



if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

$type = $_SESSION['user']['type'] == STUDENT ? 'student' : ($_SESSION['user']['type'] == TEACHER ? 'teacher' : 'admin');

date_default_timezone_set('Asia/Amman');

if (isset($_POST['save_announcement'])) {
    $data = $_POST;
    $curl = curl_init('http://localhost/uni_comm/api/announcements/create.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $flag = json_decode(curl_exec($curl));
    echo $flag ? "<script>alert('Success')</script>" : "<script>alert('Error')</script>";
}

if (isset($_POST['send_report'])) {
    $data = $_POST;
    $curl = curl_init('http://localhost/uni_comm/api/reports/create.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $flag = json_decode(curl_exec($curl));
    echo $flag ? "<script>alert('Success')</script>" : "<script>alert('Error')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>UniComm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- css links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- icons -->
    <script src="https://kit.fontawesome.com/2a6811da9b.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Source+Sans+Pro:wght@600&display=swap"
        rel="stylesheet">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- css files -->
    <link href="sidebar.css" rel="stylesheet">
    <link href="main-style.css" rel="stylesheet">
</head>

<style>
    /* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
<ul id="ui-id-1" tabindex="0" class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" style="width: 188.4px; top: 75.4125px; left: 1105.72px; display: none ;">
  
</ul>
<body>
    <div class="container">
        <div class="homepage-page tx-13">

            <!-- start of search -->
            <div class="row" >
                <div class="col-12 grid-margin">

                    <div class="homepage-header" style="width: 1270px;">

                        <nav class="navbar navbar-expand-lg ">
                            <img src="images/UniComm (3).png" class="logo">

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto pl-4">

                                    <li class="nav-item">
                                        <a class="nav-link " href="#" style="color:black"><i
                                                class="fa-solid fa-bell fa-xl"></i></a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="messages.php" style="color:black"><i
                                                class="fa-solid fa-comments fa-xl"></i></a>

                                    </li>
                                </ul>

                                
                                <form class="form-inline my-2 my-lg-0">
                                    <?php if ($_SESSION['user']['type'] == ADMIN) : ?>
                                        <a class="mr-3" href="../admin/main/index.php">Go to admin site</a>
                                    <?php endif ?>
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>

                    </div>

                </div>
                <!-- end of search -->

                <div class="row homepage-body">
                    <!-- left sidebar start -->
                    <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper"  >
                        <div class="card " style="height:570px">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-shrink-0 user-side" style="width: 280px;">
                                    <a class="text-center link-dark text-decoration-none ">
                                        <img src="<?php echo 'uploaded_images/' . $_SESSION['user']['profile_pic']?>" alt="" width="100" height="100"
                                            class="rounded-circle  border border-dark">
                                        <h6 class="profile-pic"><?php echo $_SESSION['user']['name']?></h6>
                                        <p><small><?php echo $type ?></small></p>


                                    </a>
                                    <hr>
                                    <ul class="nav nav-pills flex-column mb-auto">
                                        <li class="nav-item">
                                            <a href="homepage.php" class="nav-link" aria-current="page">
                                                <i class="fa-solid fa-house"></i>
                                                Home
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="profile.php?id=<?php echo $_SESSION['user']['id'] ?>"  class="nav-link">
                                                <i class="fa-solid fa-user"></i>
                                                Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="courses.php" class="nav-link">
                                                <i class="fa-solid fa-book-bookmark"></i>
                                                Courses
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="department.php" class="nav-link ">
                                                <i class="fa-solid fa-building-columns"></i>
                                                Department
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="settings.php" class="nav-link ">
                                                <i class="fa-solid fa-gear"></i>
                                                Settings
                                            </a>
                                        </li>
                                        <hr>
                                        <form action="logout.php" method="post">
                                            <li>
                                                <button type="submit" class="nav-link">
                                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                    Log out
                                                </button>
                                            </li>
                                        </form>
                                    </ul>


                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- left sidebar end -->