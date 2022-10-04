<?php 

if (isset($_POST['submit'])) {
    $data = $_POST;
    $data['file'] = isset($_FILES['file']) ? $_FILES['file']['name'] : "";
    $curl = curl_init('http://localhost/uni_comm/api/courses/create.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $flag = json_decode(curl_exec($curl));
    echo $flag ? "<script>alert('Success')</script>" : "<script>alert('Error')</script>";
    $flag ? move_uploaded_file($_FILES['file']['tmp_name'], "uploaded_courses/" . $_FILES['file']['name']) : NULL;
}

include "header.php"; 
?>

 <!-- middle start ( first post) -->
 <div class="col-md-8 col-xl-6 middle-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">

                                          <!-- start of first post-->
                                          <div class="card ">
                                            <div class="card-header">
                                                <div class="main-page">
        
                                                    <h1> Courses</h1>
                                                </div>
        
                                                <div class="d-flex align-items-center justify-content-between">
        
                                                    <div class="d-flex align-items-center pl-4">
                                                        <div class="dropdown dropdown-fc ">
                                                            <button class="btn btn-outline-secondary dropdown-toggle "
                                                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                Faculty
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="faculty">
                                                                <a class="dropdown-item" href="#" name="CIT" >CIT</a>
                                                                <a class="dropdown-item" href="#" name="Nursing" >Nursing</a>
                                                                <a class="dropdown-item" href="#" name="Language" >Language Center</a>
                                                            </div>
        
                                                        </div>
        
                                                        <div class="dropdown ">
                                                            <button class="btn btn-outline-secondary dropdown-toggle dep-main"
                                                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                Department
                                                            </button>
        
                                                            <div class="dropdown-menu Department" aria-labelledby="dropdownMenuButton" id="Department">
                                                                <a class="dropdown-item" href="#">-No faculty selected-</a>
                                                            </div>
                                                            
                                                            
        
                                                 
        
                                                        </div>
                                                        <?php if($_SESSION['user']['type'] == ADMIN || $_SESSION['user']['type'] == TEACHER) : ?>
                                                            <div class="row">
                                                                <button class="col-sm-4 btn btn-secondary" style="margin-left:80px" data-toggle="modal" data-target="#uploadNewFile">
                                                                Upload <i class="fa-solid fa-plus"></i></button>
                                                                <a href="view-upload.php" class="col-sm-4 btn btn-secondary" style="margin-left:10px"> View uploads </a>
                                                            </div>
                                                        <?php endif ?>
    
        
                                                    </div>
        
        
                                                </div>
                                            </div>
        
                                            <div class="card-body  overflow-auto" style="height:380px">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Course name</th>
                                                            <th scope="col">File name</th>
                                                            <th scope="col ">Download</th>
                                                            <th scope="col">Uploaded by</th>
                                                        </tr>
                                                    </thead>
        
                                                    <tbody id="courseTable">
                                                       
        
                                                    </tbody>
                                                </table>
        
        
                                            </div>
                                        </div>
                                        <!--  end of first post-->

                                    <!-- start of -upload file window- -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="uploadNewFile" tabindex="-1" role="dialog"
                                        aria-labelledby="newPostTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title " id="newPostLongTitle">File Upload
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="courses.php" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <select class="mb-3 form-select" name="faculty" id="facultyUpload">
                                                            <option selected disabled> -Select Faculty- </option>
                                                            <option value="CIT" >       CIT             </option>
                                                            <option value="Nursing">    Nursing         </option>
                                                            <option value="Language">   Language Center </option>
                                                        </select>
                                                        <select class="mb-3 form-select" name="department" id="departmentUpload">
                                                            <option selected disabled> -Select Department- </option>
                                                        </select>
    
                                                        <div class="mb-3 form-group">
                                                            <label>Course Name</label>
                                                            <input class="form-control courseName" type="text" name="course_name">
                                                        </div>
                                                        <div class="mb-3 form-group">
                                                            <label>Subject Name</label>
                                                            <input class="form-control fileName" type="text" name="subject_name">
                                                        </div>
                                                    <div class="mb-3">
                                                        <label for="uploadFile" class="form-label">Upload file</label>
                                                        <input name="file" class="form-control form-control-sm uploadPostPic" id="uploadFile" type="file">
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="author_id" value="<?php echo $_SESSION['user']['id'] ?>">
                                                        <button type="button" class="btn btn-light post-btn" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="submit" value="1" class="btn btn-light post-btn new-file-save">Save changes</button>
                                                    </div>          
                                                </form> 

                                            </div>
                                        </div>
                                    </div>

                                    <!-- end of -upload file window- -->


                            </div>

                        </div>
                    </div>
                    <!-- middle end  -->
                    <?php include "announcements.php" ?>
                    <?php include "footer.php" ?>