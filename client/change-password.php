<?php
include "header.php";
//!pass: Admin123!
if (isset($_POST['submit-btn'])) {
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if (empty($current_pass) || empty($new_pass) ||empty($confirm_pass)) {
        $msg = 'Please fill in empty fields.';
        $state = 'danger';
    }
    else if (password_verify($current_pass, $_SESSION['user']['password'])) {
        if ($confirm_pass == $new_pass) {
            //* success
            $data = $_SESSION['user'];
            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $data['password'] = $hashed_pass;
            $curl = curl_init('http://localhost/uni_comm/api/users/update.php');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $flag = json_decode(curl_exec($curl));
            if ($flag) {
                $id = $_SESSION['user']['id'];
                //* Read User
                $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?id=' . $id);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $user = json_decode(curl_exec($curl), true);
                $_SESSION['user'] = $user;
                $msg = 'Successfully updated';
                $state = 'success';
            } else {
                $msg = 'Error occurred';
                $state = 'danger';
            }
        } else {
            //! error: new and confirm do no match
            $msg = 'New and Confirm passwords do not match.';
            $state = 'danger';
        }
    } else {
        //! error: current pass incorrect
            $msg = 'Current password is incorrect.';
            $state = 'danger';
    }
    
}
?>


                    <!-- middle start -->
                    <div class="col-md-8 col-xl-6 middle-wrapper">
                        <div class="row overflow-auto" style="height:570px">
                            <div class="col-md-12 grid-margin">

                                <!-- start of settings -->
                                <div class="card ">
                                    <div class="card-header">
                                     <?php if(isset($msg) && isset($state)) : ?>
                                        <div class="alert alert-<?php echo $state ?>"><?php echo $msg ?></div>
                                     <?php endif ?>
                                     <div id="pass-msg" style="display:none" class="alert alert-danger"></div>
                                    </div>

                                    <!--  password -->
                                    <div class="card-body post">
                                        <p class="setting-title">Password</p>
                                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" id="change-pass">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Current Password</label>
                                                    <input class="form-control" type="password" name="current_pass" placeholder="......">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input class="form-control" type="password" name="new_pass" placeholder="......">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input class="form-control" type="password" name="confirm_pass" placeholder="......">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <button type="submit" name="submit-btn" value="1" class="btn btn-dark">Save changes</button>
                                                        <a href="settings.php" class="btn btn-outline-dark ml-3">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end of password -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- middle end  -->

                    <?php include "announcements.php" ?>
                </div>
            </div>

           <?php include "footer.php" ?>