<?php 
    include "header.php";

    $curl = curl_init('http://localhost/uni_comm/api/posts/read_single.php?id=' . $_GET['post_id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $post = json_decode(curl_exec($curl), true);

    $curl = curl_init('http://localhost/uni_comm/api/likes/read.php?post_id=' . $_GET['post_id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $likes = json_decode(curl_exec($curl), true);
    $num_likes = count($likes);

    $curl = curl_init('http://localhost/uni_comm/api/comments/read.php?post_id=' . $_GET['post_id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $comments = json_decode(curl_exec($curl), true);
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

                            <!-- start of first post-->
                            <div class="overflow-auto" style="height:560px">
                                <!-- new -->
                                <div class="col-md-12 grid-margin " id="dep-posts">
                                <!-- new -->
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
                                                    <?php if($post['uid'] == $_SESSION['user']['id']) : ?>
                                                        <a class="dropdown-item d-flex align-items-center" href="edit-post.php?post_id=<?php echo $post['id']?>">
                                                            <i class="fa-regular fa-edit pr-2"></i>
                                                            <span>
                                                              Edit post
                                                            </span>
                                                        </a>
                                                    <?php endif ?>

                                                    <button class="dropdown-item d-flex align-items-center" type="button" data-toggle="modal" data-target="#report">
                                                            <i class="fa-solid fa-shield-halved pr-2"></i>
                                                            <span class="">Report</span>
                                                        </button>

                                                    </div>
                                                    <!-- end of dropdown menu of post  -->

                                                </div>
                                            </div>
                                        </div>
  <!-- Modal -->
  <div class="modal fade" id="report" tabindex="-1" aria-labelledby="reportLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reportLabel">Report</h5>
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
                                            $needle = array(
                                                'post_id' => $post['id'],
                                                'user_id' => $_SESSION['user']['id'],
                                                'name' => $_SESSION['user']['name'],
                                                'profile_pic' => $_SESSION['user']['profile_pic']
                                            );
                                            $flag = in_array($needle, $likes);
                                        ?>
                                        <?php if(count($likes) > 1) : ?>
                                            <div class="ml-3"><?php echo $likes[0]['name']  . ' and <a href="#" class="" data-toggle="modal" data-target="#likesList">' . (count($likes) - 1) ?> others liked this post </a></div>
                                        <?php else : 
                                                if(count($likes) == 1) : 
                                        ?>
                                            <div class="ml-3"><?php echo $likes[0]['name'] . ' liked this post' ?></div>
                                            <?php else : ?>
                                                <div class="ml-3">No likes</div>
                                        <?php endif ?>
                                        <?php endif ?>
                                        <!-- //!modal -->
                                        <div class="modal fade" id="likesList" tabindex="-1" role="dialog"
                                    aria-labelledby="newPostTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title "><?php echo count($likes) ?> Likes</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <tbody>
                                                            <?php foreach($likes as $like) : ?>
                                                            <tr>
                                                                <td style="position: relative; left: -170px">
                                                                    <?php echo "<img height='50' width='50' class='rounded-circle mr-4' src='uploaded_images/{$like['profile_pic']}' alt='#'>" ?>
                                                                    <?php echo $like['name'] ?>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light post-btn" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                        <!-- //!end modal -->

                                        <div class="card-footer pt-2">
                                            <div class="d-flex post-actions ">
                                                <a href="javascript:;"
                                                    class="d-flex align-items-center mr-4 post-action">
                                                    <p class="d-none d-md-block ml-2 ">
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

                                                    <p class="d-none d-md-block ml-2"> <i
                                                            class="fa-solid fa-comment mb-3"></i> Comment</p>
                                                </a>
                                            </div>
                                        </div>
                                         <!-- start of comments -->
                                    <div class="d-flex flex-row add-comment-section mt-4 mb-4 p-2 pn-0">
                                        <input type="text" name="body" class="form-control mr-3" placeholder="Write your comment here..">
                                        <input type="hidden" name="author_id" value="<?php echo $_SESSION['user']['id'] ?>">
                                        <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                                        <button id="add-comment" class="btn btn-outline-dark comment-btn" type="button">
                                            Comment
                                        </button>
                                    </div>
                                    <h5 class="title-notifi pl-2 h6 pb-2"><?php echo count($comments) ?> Comments:</h5>
                                    <hr>
                                    <div id="comments">
                                        <!-- //!start -->
                                        <?php foreach($comments as $comment) : ?>
                                            <?php if($comment['author_id'] == $_SESSION['user']['id']) : ?>
                                            <div class="dropdown" style="position: relative; right: -550px; top: 20px; display: inline">
                                                <button class="btn p-0" type="button" id="dropdownMenuButton2"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis fa-lg"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                        <button class="dropdown-item d-flex align-items-center delete-comment"> 
                                                            <i class="fa-solid fa-trash pr-2"></i>
                                                            <span>
                                                                Delete
                                                            </span>
                                                        </button>
                                                        <input type="hidden" name="comment_id" value="<?php echo $comment['id'] ?>">
                                                        <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                                                    </div>
                                            </div>
                                        <?php endif ?>
                                                <!-- end of dropdown menu of post  -->
                                            <div class="single-comment pb-4" href="#">
                                                <div class="p-1 d-flex align-items-center  ">
                                                    <div class="notifi-img mr-3">
                                                        <img height="50" wifth="50" class="rounded-circle ml-1" src="<?php echo "uploaded_images/" . $comment['profile_pic'] ?>" alt="" />
                                                    </div>
                                                    <div class="">
                                                        <h5 class="title-notifi pl-0 h6"><?php echo $comment['name'] ?></h5>

                                                        <span class="font-weight-normal comment-text">
                                                            <?php echo $comment['body']; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- //!end -->
                                        <?php endforeach ?>
                                    </div>
                                    <!-- start of comments -->


                                    </div>
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
