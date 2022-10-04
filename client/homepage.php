<?php 
    include "header.php";
    if (isset($_POST['new_post'])) {
        $data = $_POST;
        $data['image'] = isset($_FILES['image']) ? $_FILES['image']['name'] : "";
        $curl = curl_init('http://localhost/uni_comm/api/posts/create.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $flag = json_decode(curl_exec($curl));
        echo $flag ? "<script>alert('Success')</script>" : "<script>alert('Error')</script>";
        $flag ? move_uploaded_file($_FILES['image']['tmp_name'], "uploaded_images/" . $_FILES['image']['name']) : NULL;
    }


    $curl = curl_init('http://localhost/uni_comm/api/posts/read.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $posts = json_decode(curl_exec($curl), true);
?>

<style>
    .fill {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden
    }
    .fill img {
        flex-shrink: 0;
        min-width: 100%;
        min-height: 100%
    }
</style>

                    <!-- middle start ( first post) -->
                    <div class="col-md-8 col-xl-6 middle-wrapper ">

                        <div class="row">


                            <div class="col-md-12 grid-margin">
                                <!-- <div class="card ">
                                    <div class="card-header"> -->
                                <div class="main-page">
                                    <button type="button" class="btn btn-light post-btn" data-toggle="modal" data-target="#creatPost">
                                        New post
                                    </button>
                                </div>
                                <!-- start of -new post window- -->
                                <!-- Modal -->
                                <div class="modal fade" id="creatPost" tabindex="-1" role="dialog"
                                    aria-labelledby="newPostTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title " id="newPostLongTitle">New Post</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="author_id" value="<?php echo $_SESSION['user']['id'] ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="post-text" class="col-form-label">Write your post: </label>
                                                        <textarea name="body" style="height: 175px" class="form-control" id="post-text" required="required"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <!-- new -->
                                                        <label for="uploadPostPic" class="form-label">Upload picture</label>
                                                        <input name="image" class="form-control form-control-sm uploadPostPic" id="uploadPostPic" type="file">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light post-btn" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="new_post" value="1" class="btn btn-light post-btn new-post-save">Save changes</button>
                                                </div>
                                            </form>
                                        <!-- new -->
                                        </div>
                                    </div>
                                </div>
                                <!-- end of -new post window- -->
                            </div>
                            <!-- start of first post-->
                            <div class="overflow-auto" style="height:500px">
                                <!-- new -->
                                <div class="col-md-12 grid-margin " id="dep-posts">
                                <!-- new -->
                                    <?php $i = 1; if(!empty($posts)) : foreach($posts as $post) : ?>
                                    <?php
                                      $time = date("h:i a . d-m-Y", strtotime($post['timestamp']))
                                    ?>
                                    <div class="card mb-5">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <a href="profile.php?id=<?php echo $post['uid'] ?> ">
                                                        <img class="post-pic rounded-circle" src="<?php echo "uploaded_images/{$post['profile_pic']}" ?>" alt="">
                                                    </a>    
                                                    <div class="ml-1  pl-3">
                                                        <p class="mb-0 mt-3 text-left"><?php echo $post['name'] ?></p>
                                                        <p class="tx-11 text-muted small "><?php echo $time ?></p>
                                                    </div>
                                                </div>

                                                <!-- start of dropdown menu of post  -->
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis fa-lg"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <a class="dropdown-item d-flex align-items-center" href="single-post.php?post_id=<?php echo $post['id'] ?>">
                                                            <i class="fa-solid fa-arrow-turn-up pr-2"></i>
                                                            <span class="">Go to post</span>
                                                        </a>

                                                        <?php if($post['uid'] == $_SESSION['user']['id']) : ?>
                                                        <a class="dropdown-item d-flex align-items-center" href="edit-post.php?post_id=<?php echo $post['id']?>">
                                                            <i class="fa-regular fa-edit pr-2"></i>
                                                            <span>
                                                              Edit post
                                                            </span>
                                                        </a>
                                                    <?php endif ?>

                                                        <button class="dropdown-item d-flex align-items-center" type="button" data-toggle="modal" data-target="#report<?php echo $i ?>">
                                                            <i class="fa-solid fa-shield-halved pr-2"></i>
                                                            <span class="">Report</span>
                                                        </button>

                                                    </div>
                                                    <!-- end of dropdown menu of post  -->

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="report<?php echo $i ?>" tabindex="-1" aria-labelledby="reportLabel<?php echo $i ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reportLabel<?php echo $i ?>">Report</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-danger">Please be aware that all reports are anonymous. Your identity is not sent.</p>
                                                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                                                    <div class="form-group">
                                                        <textarea name="body" style="height: 175px"  class="form-control" required="required" placeholder="Please Explain.."></textarea>
                                                        <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="send_report" value="1" class="btn btn-primary">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                        </div>
                                        

                                        <div class="card-body post">
                                            <p class="tx-14"><?php echo $post['body'] ?></p>
                                            <?php if(isset($post['image']) && $post['image']) : ?>
                                                <div class="fill">
                                                    <img src="<?php echo "uploaded_images/" . $post['image'] ?>" alt="">
                                                </div>
                                            <?php endif ?>
                                        </div>

                                        <hr>
                                        <?php
                                            $curl = curl_init('http://localhost/uni_comm/api/likes/read.php?post_id=' . $post['id']);
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                            $likes = json_decode(curl_exec($curl), true);
                                            $num_likes = count($likes);
                                        ?>
                                        <div class="card-footer pt-2">
                                            <div class="d-flex post-actions ">
                                                <a href="javascript:;"
                                                    class="d-flex align-items-center mr-4 post-action">
                                                    <p class="d-none d-md-block ml-2 ">
                                                        <?php
                                                            $needle = array(
                                                                'post_id' => $post['id'],
                                                                'user_id' => $_SESSION['user']['id'],
                                                                'name' => $_SESSION['user']['name'],
                                                                'profile_pic' => $_SESSION['user']['profile_pic']
                                                            );
                                                            $flag = in_array($needle, $likes);
                                                        ?>
                                                        <i class="<?php echo $flag  ? 'fa-solid' : 'fa-regular' ?> fa-heart mb-3"></i>
                                                        <span class="likeCount">
                                                            <span id="num_likes"><?php echo $num_likes ?></span> Likes
                                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                                                            <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                                                        </span>
                                                    </p>
                                                </a>
                                                <a href="single-post.php?post_id=<?php echo $post['id'] ?>"
                                                    class="d-flex align-items-center mr-4 post-action">

                                                    <p class="d-none d-md-block ml-2">
                                                        <i class="fa-solid fa-comment mb-3"></i>
                                                         Comment
                                                    </p>
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                    <?php $i++; ?>
                                    <?php endforeach ?>
                                    <?php else : ?>
                                        <h4 class="text-center">No new posts.</h4>
                                    <?php endif ?>
                                    <!--  end of first post-->

                                    <!-- start of second post-->
                                    <div class="card  mt-4">
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- middle end  -->
                    
                </div>
                <?php include "announcements.php" ?>  

            <?php include "footer.php" ?>  
