<!--//! ============================================================== -->
<!--//! PHP  -->
<!--//! ============================================================== -->
<?php
include("../header.php"); 

if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_btn'];
    $curl = curl_init('http://localhost/uni_comm/api/announcements/delete.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($id));
    $flag = json_decode(curl_exec($curl), true);
    echo $flag ? "<script>alert('Success')</script>" : "<script>alert('Error')</script>";
}

$curl = curl_init('http://localhost/uni_comm/api/announcements/read.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$announcements = json_decode(curl_exec($curl), true);
?>
<!--//! ============================================================== -->
<!--//! PHP  -->
<!--//! ============================================================== -->

<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">View Announcements</h2>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader  -->
<!-- ============================================================== -->
    <div class="col-12">
        <div class="card">
            <table class="table table-dark">
                <thead>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Body</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($announcements as $elem) : ?>
                        <tr>
                            <td><?php echo $elem['timestamp'] ?></td>
                            <td><?php echo $elem['name'] ?></td>
                            <td><?php echo $elem['body'] ?></td>
                            <td>
                                <form style="display: inline" action="edit-announcement.php" method="post">
                                    <button class="btn btn-primary" type="submit" name="id" value="<?php echo $elem['id'] ?>">Edit</button>
                                </form>
                                <form style="display: inline" action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
                                    <button class="btn btn-danger ml-2" type="submit" name="delete_btn" value="<?php echo $elem['id'] ?>">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include("../footer.php"); ?>