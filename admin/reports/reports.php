<!--//! ============================================================== -->
<!--//! PHP  -->
<!--//! ============================================================== -->
<?php
include("../header.php"); 


if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_btn'];
    $curl = curl_init('http://localhost/uni_comm/api/reports/delete.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($id));
    $flag = json_decode(curl_exec($curl), true);
    echo $flag ? "<script>alert('Success')</script>" : "<script>alert('Error')</script>";
}

$curl = curl_init('http://localhost/uni_comm/api/reports/read.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$reports = json_decode(curl_exec($curl), true);

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
            <h2 class="pageheader-title">View reports</h2>
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
                    <th>Complaint</th>
                    <th>View Post</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report) : ?>
                        <tr>
                            <td><?php echo $report['timestamp'] ?></td>
                            <td><?php echo $report['body'] ?></td>
                            <td>
                                <a target="_blank" href="../../client/single-post.php?post_id=<?php echo $report['post_id'] ?>">View</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include("../footer.php"); ?>