<?php
$curl = curl_init('http://localhost/uni_comm/api/announcements/read.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = json_decode(curl_exec($curl), true);


?>
<!-- right announcment start -->
<div class=" d-none d-xl-block col-xl-3 right-wrapper">
            <div class="row">
                                <!-- Modal -->
                                <div class="modal fade" id="newAnnouncment" tabindex="-1" role="dialog"
                                aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="newPostLongTitle">New Announcement</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="post-text" class="col-form-label">Write your
                                                        Announcement:</label>
                                                    <textarea name="body" rows="10" class="form-control" id="post-text"
                                                        required="required"></textarea>
                                                </div>
                                            <input type="hidden" name="author_id" value="<?php echo $_SESSION['user']['id'] ?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light post-btn"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" name="save_announcement" value="1" class="btn btn-light post-btn">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="row " >
                            <div class="col-md-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <h6 class="card-title mb-0">Announcements</h6>
                                            <?php if($_SESSION['user']['type'] == ADMIN) : ?>
                                                <a href="#" data-toggle="modal" data-target="#newAnnouncment"> <i class="fa-solid fa-pen-to-square fa-bg" ></i></a>
                                            <?php endif ?>
                                        </div>
                                        <hr>
                                        <div class=" overflow-auto" style="height:500px;">
                                        <?php foreach($data as $elem) : ?>
                                            <!-- start of announcment -->
                                            <div class="mt-3  announc">
                                                <label
                                                    class="tx-11 font-weight-bold mb-0 text-uppercase"><?php echo $elem['name'] ?></label>
                                                <p class="text-muted "> <small> <?php echo $elem['timestamp'] ?> </small></p>
                                                <div class=" ">
                                                    <span><?php echo $elem['body'] ?></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php endforeach ?>
                                            <!-- end of announcment -->
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- right announcment end -->
                    </div>