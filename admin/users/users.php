<!--//! ============================================================== -->
<!--//! PHP  -->
<!--//! ============================================================== -->
<?php
include("../header.php"); 

if (isset($_POST['submit_btn'])) {
    $id = $_POST['id'];
    $user_state = $_POST['submit_btn'] == '1' ? "0" : "1";
    $data = array('active' => $user_state, 'id' => $id);
    $curl = curl_init('http://localhost/uni_comm/api/users/set_active.php');
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $flag = json_decode(curl_exec($curl), true);
}

$curl = curl_init('http://localhost/uni_comm/api/users/read.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$users = json_decode(curl_exec($curl), true);

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
            <h2 class="pageheader-title">View Users</h2>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Birth Date</th>
                    <th>Phone</th>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <?php 
                            if ($user['id'] == $_SESSION['user']['id']) { continue; }
                            $btn_text = $user['active'] == 1 ? 'Deactivate' : 'Activate';
                            $btn_class = $user['active'] == 1 ? 'danger' : 'primary';
                        ?>
                        <tr>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['gender'] ?></td>
                            <td><?php echo $user['department'] ?></td>
                            <td><?php echo $user['birth_date'] ?></td>
                            <td><?php echo $user['phone'] ?></td>
                            <td>
                                <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
                                <button class="btn btn-<?php echo $btn_class ?>" type="submit" name="submit_btn" value="<?php echo $user['active'] ?>"><?php echo $btn_text ?></button>
                                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include("../footer.php"); ?>