<?php 

//! include header
include('../header.php');

//! User Saves
if (isset($_POST['save_btn'])) {
    $data = $_POST;
    $curl = curl_init('http://localhost/uni_comm/api/announcements/create.php');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $flag = json_decode(curl_exec($curl));
    //* flag = true when successful.
    $msg = $flag ? 'Created Successfully.' : 'Error Ocurred.';
    $state = $flag ? 'success' : 'warning';    
}

?>



<div class="card">
    <?php  if (isset($state) && isset($msg)) : ?>
    <?php echo "<div class='alert alert-{$state}'>{$msg}</div>" ?>
    <?php endif ?>
    <h5 class="card-header">Create Announcement</h5>
    <div class="card-body">
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group">
                <label class="col-form-label">Body</label>
                <textarea style="max-height: 400px; min-height: 300px" class="form-control" name="body"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="author_id" value="<?php echo $_SESSION['user']['id'] ?>">
                <button name="save_btn" value="1" type="submit" class="btn btn-primary">Save changes</button>
                <a href="announcements.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php include('../footer.php'); ?>