<?php
include "header.php";
if (isset($_POST['submit-btn'])) {
  
    $phone = $_POST['phone'];
    if (empty($phone)) {
        $msg = 'Please fill in empty fields.';
        $state = 'danger';
    }
    else if (strlen($phone) == 10) {
        if (ctype_digit($phone)) {
            //* success
            $data = $_SESSION['user'];
            $data['phone'] = $phone;
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
            //! error: number contains symbols or letters
            $msg = 'Phone number can only contain numbers.';
            $state = 'danger';
        }
    } else {
        //! error: length must be 10
            $msg = 'Length of phone number must be 10 digits.';
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
                                    </div>

                                    <!--  password -->
                                    <div class="card-body post">
                                        <p class="setting-title">Edit Phone</p>
                                    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" id="change-phone">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>New Phone Number</label>
                                                    <input class="form-control" type="tel" name="phone" placeholder="07x xxxxxxx">
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