<?php
session_start();
if (isset($_POST['cancel'])) {
    header("Location: homepage.php");
}
if (isset($_POST['btn'])) {
    $data = $_POST;
    $curl = curl_init('http://localhost/uni_comm/api/skills/create.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $flag = json_decode(curl_exec($curl));
    echo $flag ? "<script>alert('Added skills successfully.')</script>" : "<script>alert('Error occurred.')</script>" ;
}
if (isset($_POST['submit-image'])) {
    $data = $_SESSION['user'];
    $data['profile_pic'] = $_FILES['image']['name'];
    
    $curl = curl_init('http://localhost/uni_comm/api/users/update.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $flag = json_decode(curl_exec($curl));
    if($flag) { 
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploaded_images/' . $_FILES['image']['name']);
        "<script>alert('successfully updated image.')</script>" ;
        //* READ USER
        $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?id='.$_SESSION['user']['id']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $user = json_decode(curl_exec($curl), true);
            $_SESSION['user'] = $user;
            // echo "<script>location.reload();</script>";
        } else {
            "<script>alert('Error occurred.')</script>" ;
        }
    }
    include "header.php";
?>

                    <!-- middle start -->
                    <div class="col-md-8 col-xl-6 middle-wrapper">
                        <div class="row overflow-auto" style="height:570px">
                            <div class="col-md-12 grid-margin">

                                <!-- start of settings -->
                                <div class="card ">
                                    <div class="card-header">
                                        <!-- settings of photo -->
                                        <img class=" rounded-circle mr-4" id="profile-photo" src="<?php echo 'uploaded_images/' . $_SESSION['user']['profile_pic'] ?>" alt="">
                                            <form action="settings.php" method="post" enctype="multipart/form-data">
                                                <label type="submit" class="btn btn-outline-dark mr-1 mt-2">
                                                        <i class="fa-solid fa-camera"></i>
                                                        Upload photo 
                                                        <input name="image" type="file" accept=".png,.jpg" class="account-settings-fileinput "> 
                                                </label>
                                                    <button name="submit-image" value="1" type="submit" style="display: none" class="btn btn-outline-secondary">Save</button>
                                            </form>
                                    </div>

                                    <!--  Personal Details -->
                                    <div class="card-body post">
                                        <p class="setting-title">Personal Details </p>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input disabled class="form-control" type="text" name="name" value="<?php echo $_SESSION['user']['name'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input disabled class="form-control" name="email" type="text" value="<?php echo $_SESSION['user']['email'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <input disabled class="form-control" name="gender" type="text" value="<?php echo $_SESSION['user']['gender'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Birth date</label>
                                                    <input disabled class="form-control" name="birth_date" type="text" value="<?php echo $_SESSION['user']['birth_date'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label>Phone</label>
                                                    <input disabled class="form-control col ml-2" name="phone" type="text" value="<?php echo $_SESSION['user']['phone'] ?>">
                                                    <a class="col-sm-4" href="change-phone.php">Change number</a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <input disabled class="form-control" name="type" type="text" value="<?php echo $type ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2 mb-5">
                                            <p class="setting-title">Password</p>
                                            <a href="change-password.php">Change password</a>
                                        </div>
                                        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                                        <!-- Skills -->
                                        <p class="setting-title">Skills <i class="fa-solid fa-circle-plus fa-sm pl-3 "
                                                id="add-skill"></i> </p>
                                        <div id="skills">
                                            <div class="row">
                                                <div class="col-1">
                                                    <i class="fa-solid fa-circle-minus pt-2 remove-skill "></i>
                                                </div>

                                                <div class="col">

                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="skills[0]"
                                                            placeholder="your skill">
                                                    </div>
                                                </div>

                                                <div class="col mt-2">
                                                    <div class="form-group">
                                                        <input data-toggle="tooltip" data-placement="top" title="Tooltip on top" type="range" id="skill" name="skill_vals[0]" step="10" min="10" max="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <button type="submit" name="btn" value="1" class="btn btn-dark">Save changes</button>
                                                    <button type="submit" name="cancel" value="1" class="btn btn-outline-dark ml-3">Cancel</button>

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                                        </form>

                                    </div>
                                    <!-- end of settings -->


                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- middle end  -->

                    <?php include "announcements.php" ?>
                </div>
            </div>

           <?php include "footer.php" ?>