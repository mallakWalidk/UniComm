<?php 
if (isset($_POST['delete'])) {
    $data = $_POST['id'];
    $curl = curl_init('http://localhost/uni_comm/api/posts/delete.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $flag = json_decode(curl_exec($curl));
    if($flag) {
        header("Location: homepage.php");
    } else {
        echo "<script>alert('Error')</script>";
    }
}
if (isset($_POST['cancel'])) {
    header('Location: homepage.php');
    exit;
}
if (isset($_POST['update'])) {
    $data = $_POST;
    $data['image'] = isset($_FILES['image']) ? $_FILES['image']['name'] : "";
    $curl = curl_init('http://localhost/uni_comm/api/posts/update.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $flag = json_decode(curl_exec($curl));
    echo $flag ? "<script>alert('Success')</script>" : "<script>alert('Error')</script>";
    $flag ? move_uploaded_file($_FILES['image']['tmp_name'], "uploaded_images/" . $_FILES['image']['name']) : NULL;
    }
    
    if (!isset($_GET['post_id']) || !$_GET['post_id']) {
        header('Location: homepage.php');
        exit;
    }
    
    $curl = curl_init('http://localhost/uni_comm/api/posts/read_single.php?id=' . $_GET['post_id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $post = json_decode(curl_exec($curl), true);

    include "header.php";
?>

                    <!-- middle start ( first post) -->
                    <div class="col-md-8 col-xl-6 middle-wrapper ">

                        <div class="row">

                        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="author_id" value="<?php echo $post['uid'] ?>">
                                                <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="post-text" class="col-form-label">Write your post: </label>
                                                        <textarea name="body" style="height: 175px" class="form-control" id="post-text" required="required"><?php echo $post['body'] ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="uploadPostPic" class="form-label">Upload picture</label>
                                                        <input name="image" class="form-control form-control-sm uploadPostPic" id="uploadPostPic" type="file">
                                                    </div>
                                                    <?php if(isset($post['image']) && $post['image']) : ?>
                                                        <div class="mb-3">
                                                            <h4 class="form-label">Preview</h4>
                                                            <img height="170px" width="170px" src="uploaded_images/<?php echo $post['image'] ?>" alt="#">
                                                        </div>
                                                    <?php else : ?>
                                                        <h4>No image uploaded.</h4>
                                                    <?php endif ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="cancel" value="1" class="btn btn-light post-btn" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" name="update" value="1" class="btn btn-light post-btn new-post-save">Save changes</button>
                                                    <button type="submit" name="delete" value="1" class="btn btn-danger text-dark post-btn new-post-save">Delete post</button>
                                                </div>
                                            </form>
                            
                            
                        </div>
                    </div>
                    
                    <?php include "announcements.php" ?>  
                    </div>
                    <!-- middle end  -->
                    
                </div>

            <?php include "footer.php" ?>  
