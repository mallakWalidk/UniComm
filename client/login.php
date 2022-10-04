<?php
    session_start();
    define('ADMIN', 2);

    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['type'] == ADMIN) {
            header("Location: ../admin/main/index.php");
        } else {
            header("Location: homepage.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniComm</title>
    <script src="https://kit.fontawesome.com/2a6811da9b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    body{
        background-color: #eaf4f5;
    }
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #c9d5d7;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    .logo {
        padding-left: 100px;
        padding-bottom: 10px;
    }

    .btn-lg{
        padding-left: 2.5rem; 
        padding-right: 2.5rem;
        border-color:#347272;
    }

    .btn-lg:hover{
        background-color:#4D9191;

    }
</style>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="images/pics.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <img src="images/UniComm.png" class="logo">
                    <form action="../auth.php" method="post">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input  name="email"
                                    type="email"
                                    id="form3Example3"
                                    class="form-control form-control-lg"
                                    placeholder="Enter your email address" 
                                    value="<?php if(isset($_GET['email']))echo(htmlspecialchars($_GET['email'])) ?>" 
                            />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input name="password" type="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-outline btn-lg" >Login</button> 
                            <p class="small fw-bold mt-2 pt-1 mb-0">
                                If you have trouble logging in <a href="#"class="link-danger">Click here</a>
                            </p>
                        <?php if (isset($_GET['error'])) : ?>
                            <div class="alert alert-danger mt-4" role="alert"> <?php echo htmlspecialchars($_GET['error']) ?> </div>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
         
    </section>
</body>

</html>