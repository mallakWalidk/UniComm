<?php 
include "header.php"; 
$curl = curl_init('http://localhost/uni_comm/api/messages/read_chat.php?msg_id=' . $_GET['msg_id']);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$messages = json_decode(curl_exec($curl), true);
$other_user = $messages[0]['reciever_id'] == $_SESSION['user']['id'] ? $messages[0]['sender_id'] : $messages[0]['reciever_id'];
?>

                    <!-- middle start (messages) -->
                    <div class="col-md-8 col-xl-6 middle-wrapper ">
                        <div class="row">


                            <div class="col-md-12 grid-margin">

                                <div class="card ">

                                   
                                    <div class=" overflow-auto" style="height:440px">

                                        <div class="position-relative">
                                            <div class="chat-messages p-4">
                                                <?php foreach($messages as $message) : ?>
                                                <?php 
                                                    if ($message['sender_id'] != $_SESSION['user']['id']) {
                                                        $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?id=' . $message['sender_id']);
                                                        $flag = 'left';
                                                    } else {
                                                        $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?id=' . $message['reciever_id']);
                                                        $flag = 'right';
                                                    }
                                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                    $user = json_decode(curl_exec($curl), true);
                                                    $time = date("h:i a . d-m-Y", strtotime($message['timestamp']));
                                                ?>
                                                    <!-- message -->
                                                    <div class="chat-message-<?php echo $flag?> pb-4">
                                                        <div>
                                                            <img src="<?php echo $flag == 'left' ? 'uploaded_images/' . $user['profile_pic'] : 'uploaded_images/' . $_SESSION['user']['profile_pic'] ?>" class="rounded-circle mr-1"
                                                                alt="#" width="40" height="40">
                                                            <div class="text-muted small text-nowrap mt-2"><?php echo $time ?></div>
                                                        </div>
                                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                            <?php echo $message['body'] ?>
                                                        </div>
                                                    </div>

                                                <?php endforeach ?>

                                
                                            </div>
                                            <!-- message box -->
                                            <div class="flex-grow-0 py-3 px-4 border-top">
                                                <div class="input-group">
                                                    <input name="body" type="text" class="form-control" placeholder="Type your message">
                                                    <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user']['id'] ?>" class="form-control">
                                                    <input type="hidden" name="reciever_id" value="<?php echo $other_user ?>" class="form-control">
                                                    <input type="hidden" name="msg_id" value="<?php echo $_GET['msg_id'] ?>" class="form-control">
                                                    
                                                    <button id="add-msg" class="btn btn-dark">Send</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                        </div>
                    </div>
                    <!-- middle end  -->
                </div>
            </div>
<!-- right group start -->
<div class="d-none d-xl-block col-xl-3 right-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <h6 class="title-notifi pl-1">Groups </h6>
                                            <a href="# "><i class="fa-solid fa-users-line fa-lg group-icon"
                                                    data-toggle="modal" data-target="#newGroupRequest"></i>
                                            </a>
                                        </div>
                                        <hr>
                                        <div class=" overflow-auto" style="height:500px">

                                            <!-- group -->
                                            <a class=" " href="#">
                                                <div class="p-3 d-flex align-items-center group  ">
                                                    <div class="">
                                                        <h5 class="title-notifi pl-0 tx-5 h6">Sunday Event</h5>

                                                    </div>
                                                    <div class="text-right text-muted pt-0 pl-5">4d</div>

                                                </div>
                                            </a>

                                            <!-- group -->
                                            <a class=" " href="#">
                                                <div class="p-3 d-flex align-items-center group  ">
                                                    <div class="">
                                                        <h5 class="title-notifi pl-0 tx-5 h6">Sunday Event</h5>

                                                    </div>
                                                    <div class="text-right text-muted pt-0 pl-5">4d</div>

                                                </div>
                                            </a>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- right groups end -->
                    </div>
                </div>
            </div>

            <!-- start of -creat group window- -->
            <!-- Modal -->
            <div class="modal fade" id="newGroupRequest" tabindex="-1" role="dialog" aria-labelledby="newPostTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title "  style="padding-left:150px">Create new group
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="groupName" class="col-sm-4 col-form-label">Group name</label>
                                <div class="col-sm-5">
                                    <input type="input" class="form-control" id="groupName">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="groupName" class="col-sm-4 col-form-label">Group Members</label>
                                <div class="col-sm-5">
                                    <button type="button" class="btn btn-outline-dark " data-toggle="modal"
                                    data-target="#chooseMembers ">Choose members</button>
                                </div>

                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light post-btn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-light post-btn">Send request</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end of -create group window- -->


            <!-- start of -choose window- -->
            <!-- Modal -->
            <div class="modal fade" id="chooseMembers" tabindex="-1" role="dialog" aria-labelledby="newPostTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title " style="padding-left:130px">Choose your group Members</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="firstName">
                                <label class="form-check-label" for="firstName">
                                  <h6>Mera Ahmad</h6>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="secondName" >
                                <label class="form-check-label" for="secondName">
                                    <h6>Mohammad Ahmad</h6>
                                </label>
                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light post-btn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-light post-btn">Done</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end of - choose members window- -->
            
<script>
    var element = document.querySelector(".overflow-auto");
    element.scrollTop = element.scrollHeight;
</script>
<?php include "footer.php" ?>