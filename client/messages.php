<?php 
    include 'header.php';
    
    $curl = curl_init('http://localhost/uni_comm/api/messages/read.php?id=' . $_SESSION['user']['id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $messages = json_decode(curl_exec($curl), true);
?>

                    <!-- middle start (messages) -->
                    <div class="col-md-8 col-xl-6 middle-wrapper">
                        <div class="row">
                            <div class=" overflow-auto" style="height:570px">


                                <div class="col-md-12 grid-margin">

                                    <div class="card ">

                                        <div class=" notifi-bottom p-3">
                                            <label class="title-notifi">Messages</label>

                                        </div>

                                        <?php if(!empty($messages)) : foreach($messages as $message) : ?>
                                            <?php 
                                                if ($message['sender_id'] != $_SESSION['user']['id']) {
                                                    $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?id=' . $message['sender_id']);
                                                } else {
                                                    $curl = curl_init('http://localhost/uni_comm/api/users/read_single.php?id=' . $message['reciever_id']);
                                                }
                                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                $user = json_decode(curl_exec($curl), true);

                                            ?>
                                        <!-- message -->
                                        <a style="text-decoration: none" class="message " href="<?php echo 'chat.php?msg_id=' . $message['msg_id'] ?>">
                                            <div class="p-3 d-flex align-items-center  ">
                                                <div class="notifi-img mr-3">
                                                    <img height="80" width="80" class="rounded-circle" src="<?php echo "uploaded_images/{$user['profile_pic']}" ?>" alt="" />
                                                </div>
                                                <div class="">
                                                    <h5 class="title-notifi pl-0 tx-5 h6"><?php echo $user['name'] ?></h5>

                                                    <span class="font-weight-normal">
                                                        <?php if ($message['sender_id'] == $_SESSION['user']['id']) {
                                                            echo '<span class="text-muted"> you: </span>';
                                                        }
                                                        ?>
                                                        <?php 
                                                            $curl = curl_init('http://localhost/uni_comm/api/messages/read_recent.php?id=' . $message['id']);
                                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                                            $recent_msg = json_decode(curl_exec($curl), true);
                                                            $time = date("h:i a . d-m-Y", strtotime($recent_msg['timestamp']));
                                                            echo $recent_msg['body'];
                                                        ?>
                                                    <!-- //TODO: fix recent -->

                                                        <div class="text-right text-muted pt-1 v"> <?php echo $time ?></div>
                                                    </span>
                                                </div>

                                            </div>
                                        </a>
                                        <?php endforeach ?>
                                        <?php else : ?>
                                            <h3 class="text-center">
                                                No new messages <br><br>
                                                <i style="font-size: 50px" class="fa-solid fa-inbox"></i>
                                            </h3>
                                        <?php endif ?>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- middle end  -->




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

            <!-- footer -->

            <script src="main.js"></script>
</body>

</html>