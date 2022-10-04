<?php
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $curl = curl_init('http://localhost/uni_comm/api/skills/delete.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($id));
    $ret = json_decode(curl_exec($curl), true);
    echo $ret ? "<script>alert('SUCCESS')</script>" : "<script>alert('ERROR')</script>";
}
if (!isset($_GET['id'])) {
    header("Location: 404.php");
} else if ($_GET['id'] == $_SESSION['user']['id']) {
    $user = $_SESSION['user'];
} else {
    //* Read User
    $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?id=' . $_GET['id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $user = json_decode(curl_exec($curl), true);
}

if (isset($_POST['send'])) {
    $data = $_POST;
    $curl = curl_init('http://localhost/uni_comm/api/messages/create.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $ret = json_decode(curl_exec($curl), true);
    echo $ret ? "<script>alert('SUCCESS')</script>" : "<script>alert('ERROR')</script>";
}


$curl = curl_init('http://localhost/uni_comm/api/messages/read_msg_id?sender_id=' . $_SESSION['user']['id'] . '&reciever_id=' . $user['id']);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$msg_id = json_decode(curl_exec($curl), true);
if (!is_array($msg_id)) {
    $msg_id="none";
} else {
    $msg_id = $msg_id['msg_id'];
}




$curl = curl_init('http://localhost/uni_comm/api/skills/read_single.php?user_id=' . $user['id']);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$skills = json_decode(curl_exec($curl), true);
include "header.php";


?>

<style>
    .delete-btn:hover {
        background-color: #b51b2a;
    }
</style>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user']['id'] ?>">
            <input type="hidden" name="reciever_id" value="<?php echo $user['id'] ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="post-text" class="col-form-label">Write your message: </label>
                    <textarea name="body" style="height: 175px" class="form-control" id="post-text" required="required"></textarea>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="send" value="1" class="btn btn-primary">Send</button>
            <input type="hidden" name="msg_id" value="<?php echo $msg_id ?>">

        </div>
    </form>
    </div>
  </div>
</div>

                    <!-- middle start -->
                    <div class="col-md-8 col-xl-6 middle-wrapper ">

                        <div class="row">

                            <!-- start of profile top -->
                            <div class="col-md-12 grid-margin">
                                <div class="card ">
                                    <div class="card-header">
                                        <img class="post-pic rounded-circle" src="<?php echo 'uploaded_images/' . $user['profile_pic']?>" alt="">
                                        <p class="mb-0 mt-1 "><?php echo $user['name'] ?></p>
                                        <p class="text-muted small pt-0"> <?php echo $type ?> </p>

                                        <?php if($_SESSION['user']['id'] != $user['id']) : ?>
                                            <button type="button" class="btn btn-light profile-button mr-4" data-toggle="modal" data-target="#exampleModal">Send Messege</button>
                                        <?php endif ?>

                                        <?php if($_SESSION['user']['id'] == $user['id']) : ?>
                                            <a href="settings.php">
                                                    <button type="button" class="btn btn-light profile-button">Edit Profile</button>
                                            </a>
                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>
                            <!-- end of profile top -->

                            <!-- Start of about in profile -->
                            <div class="col-lg-6 grid-margin " >

                                <div class="card h-100 " >
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <h4 style="margin-left:80px">About me</h4>


                                        </div>
                                    </div>

                                    <div class="card-body post p-2 ">
                                       
                                        <div class="row mb-2 ">
                                            <div class="col-md-4 text-muted  pr-0">Birthday:</div>
                                            <div class="col-md-6 birthday-Departmen "><?php echo $user['birth_date'] ?></div>
                                        </div>

                                        <?php if($user['type'] == STUDENT || $user['type'] == TEACHER) : ?>
                                            <div class="row mb-2 ">
                                                <div class="col-md-4 text-muted  pr-0">Department:</div>
                                                <div class="col-md-6 profile-profile "><?php echo $user['department'] ?></div>
                                            </div>
                                        <?php endif ?>

                                        <?php if($user['type'] == STUDENT) : ?>
                                            <div class="row mb-2 ">

                                                <div class="col-md-4 text-muted  pr-0">year Level:</div>
                                                <div class="col-md-6 academic-profile "><?php echo $user['level'] ?></div>
                                            </div>
                                        <?php endif ?>


                                    </div>




                                </div>

                            </div>
                            <!-- End of about in profile -->

                            <!-- Start of skills -->
                            <div class="col-lg-6 grid-margin ">

                                <div class="card ">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">

                                            <h4 style="margin-left:80px">Skills</h4>


                                        </div>
                                    </div>

                                    <div class="card-body post pb-3">
                                        <?php if(!empty($skills)) : foreach($skills as $skill) : ?>
                                            <div class="mb-1 skill-set"><?php echo $skill['name'] ?> <small class="text-muted row"><?php echo '<span class="col">' . $skill['value'] . '%</span>' ?> <?php if($_SESSION['user']['id'] == $user['id']) : ?><form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post" style="display: inline" class="col-1"><button name="id" value="<?php echo $skill['id'] ?>" type="submit" style="border: none; display: none" class="badge badge-danger delete-btn">X</button></form><?php endif ?> </small></div>
                                            <div class="progress mb-3" style="height: 4px;">
                                                <div class="progress-bar bg-secondary" style="width: <?php echo $skill['value'] ?>%;"></div>
                                            </div>
                                        <?php endforeach ?>
                                            <?php else : ?>
                                                <h6 class="text-center">No skills</h6>
                                        <?php endif ?>
                                    </div>




                                </div>

                            </div>
                            <!-- End of skills -->


                        </div>
                    </div>
                    <!-- middle end  -->

                    <?php include "announcements.php" ?>
                </div>
            </div>

<?php include "footer.php" ?>