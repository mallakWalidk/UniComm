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
                                        <a class="nav-link" href="#" style="color:black"><i
                                                class="fa-solid fa-comments fa-xl"></i></a>

                                    </li>
                                </ul>


                                <form class="form-inline my-2 my-lg-0">
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
                                        <img src="uploaded_images/girl.jpg" alt="" width="100" height="100"
                                            class="rounded-circle  border border-dark">
                                        <h6 class="profile-pic">admin</h6>
                                        <p><small>admin</small></p>


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
                                            <a href="profile.php?id=1"  class="nav-link">
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
                    <!-- middle start ( first post) -->
                    <div class="col-md-8 col-xl-6 middle-wrapper">
                        <div class="row overflow-auto" style="height:570px">
                            <div class="col-md-12 grid-margin">
                                <!-- start of first post-->
                                                                                                        <div class="card ">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <a href="profile.php?id=1">
                                                        <img class="post-pic rounded-circle" src="uploaded_images/girl.jpg" alt="">
                                                    </a>
                                                    <div class="ml-1 small pl-3">
                                                        <p class="mb-0 mt-3 ">admin</p>
                                                        <p class="tx-11 text-muted small ">04:45pm 10-May-2022</p>
                                                    </div>
                                                </div>

                                                <!-- start of dropdown menu of post  -->
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis fa-lg"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">

                                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                                            <i class="fa-solid fa-arrow-turn-up pr-2"></i>
                                                            <span class="">Go to post</span></a>

                                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                                            <i class="fa-regular fa-copy pr-2"></i>
                                                            <span class="">Copy link</span></a>

                                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                                            <i class="fa-solid fa-shield-halved pr-2"></i>
                                                            <span class="">Report</span></a>

                                                    </div>
                                                    <!-- end of dropdown menu of post  -->

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body post">
                                            <p class="tx-14">this is a test post!</p>
                                        </div>

                                        <hr>

                                        <div class="card-footer pt-2">
                                            <div class="d-flex post-actions ">
                                                <a href="javascript:;" class="d-flex align-items-center mr-4 post-action">
                                                    <p class="d-none d-md-block ml-2"> <i
                                                            class="fa-regular fa-heart mb-3"></i>
                                                            <span class="likeCount">Like</span>  

                                                    </p>
                                                </a>
                                                <a href="javascript:;" class="d-flex align-items-center mr-4 post-action">

                                                    <p class="d-none d-md-block ml-2"> <i
                                                            class="fa-solid fa-comment mb-3"></i> Comment</p>
                                                </a>
                                                
                                            </div>
                                        </div>
                                </div>
                                                                <!--  end of first post-->                                
                            </div>

                        </div>
                    </div>
                    <!-- middle end  -->

                <!-- right announcment start -->
<div class=" d-none d-xl-block col-xl-3 right-wrapper">
                        <div class="row ">
                            <div class="col-md-12 grid-margin">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <h6 class="card-title mb-0">Announcements</h6>

                                        </div>
                                        <hr>
                                        <div class=" overflow-auto" style="min-height:500px">
                                                                                    <!-- start of announcment -->
                                            <div class="mt-3  announc">
                                                <label
                                                    class="tx-11 font-weight-bold mb-0 text-uppercase">admin</label>
                                                <p class="text-muted "> <small> 2022-05-09 14:52:37 </small></p>
                                                <div class=" ">
                                                    <span>This is a test Announcement22222!</span>
                                                </div>
                                            </div>
                                            <hr>
                                                                                        <!-- start of announcment -->
                                            <div class="mt-3  announc">
                                                <label
                                                    class="tx-11 font-weight-bold mb-0 text-uppercase">admin</label>
                                                <p class="text-muted "> <small> 2022-05-09 03:31:23 </small></p>
                                                <div class=" ">
                                                    <span>This is a test Announcement!</span>
                                                </div>
                                            </div>
                                            <hr>
                                                                                        <!-- end of announcment -->
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- right announcment end -->
                    </div>                   
                </div>
            </div>

         <script src="main.js"></script>
<script>
    $('.skill-set').mouseover(function (e) {
        e.currentTarget.querySelector('.delete-btn').style.display = 'inline-block';
    });
    $('.skill-set').mouseout(function (e) {
        e.currentTarget.querySelector('.delete-btn').style.display = 'none';
    });
    
</script>
</body>

</html>