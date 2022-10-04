$(function () {
    var url = window.location;
    $('.nav .nav-item').find('.active').removeClass('active');
    $('.nav .nav-item .nav-link').each(function () {
        if (url.href.includes(this.href)) {
            $(this).addClass('active');
        }
    }); 


  
let skill_counter = 1;
$( "#add-skill" ).click(
    function addSkill() {
        var _div = document.createElement('div');
        _div.innerHTML = '<div class="row"> <div class="col-1"><i class="fa-solid fa-circle-minus pt-2 remove-skill"></i></div> <div class="col"> <div class="form-group"> <input class="form-control" type="text" name="skills[' + skill_counter + ']" placeholder="your skill"> </div> </div> <div class="col mt-2"> <div class="form-group"> <input type="range" id="skill" name="skill_vals[' + skill_counter + ']" step="10" min="10" max="100" > </div> </div> </div> </div> ';
        //append _div to button
        skill_counter++;
        document.getElementById("skills").appendChild(_div);
        $( ".remove-skill" ).click(
            function addSkill() {
            $(this).closest('.row').remove();
    
             }
            
        
            )
       
    }  )

    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    $(document).ready(function() {
        $('input[type="file"]').change(function(e) {
            $(e.currentTarget).parent().next().css('display', 'inline-block');
            document.getElementById('profile-photo').src = window.URL.createObjectURL(this.files[0]);
        });
    });

    $('#reset-btn').click(function(){
        $('#profile-photo').attr("src","unknown-ph.jpg")
    })
    
    $( ".remove-skill" ).click(
        function addSkill() {
        $(this).closest('.row').remove();

         }
        );


        //* tooltip in skill range input
        $('#skill').hover(function (e) {
            e.currentTarget.setAttribute('title', e.currentTarget.value);
        })
        
        //* like btn
        
        $('.post-action').click(function () {
          //*********counter********/
            var count=parseInt($(this).find('.likeCount #num_likes').html());
            var likeObject=$(this).find( ".fa-heart" );
          if( likeObject.hasClass("fa-regular")){
            likeObject.removeClass("fa-regular");
            likeObject.addClass("fa-solid");
            count++;
            $(this).find(".likeCount #num_likes").html(count);
          }
        
          else if( likeObject.hasClass("fa-solid")){
            likeObject.removeClass("fa-solid");
            likeObject.addClass("fa-regular");
            count--;
            console.log(count);
            $(this).find(".likeCount #num_likes").html(count);
          }
          //*********heart********/
            let url = likeObject.hasClass("fa-regular") ? 'http://localhost/uni_comm/api/likes/delete.php' : 'http://localhost/uni_comm/api/likes/create.php' ;
                
            let user_id = parseInt($(this).find('.likeCount input[name=user_id]').val());
            let post_id= parseInt($(this).find('.likeCount input[name=post_id]').val());
            let data = JSON.stringify({user_id, post_id});
            console.log(data);

            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (response) {
                    console.log("updated like");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
        });

        //* comment btn
        $(document).on('click','#add-comment',function () {
            let author_id = parseInt($(this).siblings('input[name=author_id]').val());
            let post_id= parseInt($(this).siblings('input[name=post_id]').val());
            let body = $(this).siblings('input[name=body]').val();
            let data = JSON.stringify({author_id, post_id, body});
            console.log(data);
            $(this).siblings('input[name=body]').val(''); //reset comment box input value

            $.ajax({
                url: 'http://localhost/uni_comm/api/comments/create.php',
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (response) {
                    console.log("added comment");
                    console.log(response);
                    $.ajax({
                        url: 'http://localhost/uni_comm/api/comments/read.php?post_id=' + post_id,
                        dataType: 'json',
                        type: 'get',
                        success: function (comments) {
                            let temp = '';
                            let del_btn = '';
                            comments.forEach(comment => {
                                del_btn = '<div class="dropdown" style="position: relative; right: -550px; top: 20px; display: inline"><button class="btn p-0" type="button" id="dropdownMenuButton2"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis fa-lg"></i></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton2"><button class="dropdown-item d-flex align-items-center delete-comment" > <i class="fa-solid fa-trash pr-2"></i><span>Delete</span></button><input type="hidden" name="comment_id" value=' + comment["id"] + '><input type="hidden" name="post_id" value=' + post_id + '></div></div>';
                                temp += del_btn + '<div class="single-comment pb-4"><div class="p-1 d-flex align-items-center"><div class="notifi-img mr-3"><img height="50" wifth="50" class="rounded-circle ml-1" src="uploaded_images/' + comment['profile_pic'] + '" alt="" /></div><div><h5 class="title-notifi pl-0 h6">' + comment['name'] + '</h5><span class="font-weight-normal comment-text">' + comment['body'] + '</span></div></div></div>';
                            });
                            $('#comments').html(temp);
                        }
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
        });

        
        $(document).on("click",".delete-comment",function () {
            let comment_id = parseInt($(this).siblings('input[name=comment_id]').val());
            let post_id= parseInt($(this).siblings('input[name=post_id]').val());
            let data = JSON.stringify({id: comment_id});
            $.ajax({
                url: 'http://localhost/uni_comm/api/comments/delete.php',
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (response) {
                    console.log('comment deleted.');
                    console.log(response);
                    console.log(post_id);
                    $.ajax({
                        url: 'http://localhost/uni_comm/api/comments/read.php?post_id=' + post_id,
                        dataType: 'json',
                        type: 'get',
                        success: function (comments) {
                            let temp = '';
                            let del_btn = '';
                            comments.forEach(comment => {
                                del_btn = '<div class="dropdown" style="position: relative; right: -550px; top: 20px; display: inline"><button class="btn p-0" type="button" id="dropdownMenuButton2"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis fa-lg"></i></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton2"><button class="dropdown-item d-flex align-items-center delete-comment" > <i class="fa-solid fa-trash pr-2"></i><span>Delete</span></button><input type="hidden" name="comment_id" value=' + comment["id"] + '><input type="hidden" name="post_id" value=' + post_id + '></div></div>';
                                temp += del_btn + '<div class="single-comment pb-4"><div class="p-1 d-flex align-items-center"><div class="notifi-img mr-3"><img height="50" wifth="50" class="rounded-circle ml-1" src="uploaded_images/' + comment['profile_pic'] + '" alt="" /></div><div><h5 class="title-notifi pl-0 h6">' + comment['name'] + '</h5><span class="font-weight-normal comment-text">' + comment['body'] + '</span></div></div></div>';                            
                            });
                            $('#comments').html(temp);
                        }
                    });
                }
            });
        });


        //* msg btn
        $(document).on('click','#add-msg',function () {
            let sender_id = parseInt($(this).siblings('input[name=sender_id]').val());
            let reciever_id= parseInt($(this).siblings('input[name=reciever_id]').val());
            let msg_id= parseInt($(this).siblings('input[name=msg_id]').val());
            console.log(msg_id);
            let body = $(this).siblings('input[name=body]').val();
            let data = JSON.stringify({sender_id, reciever_id, body, msg_id});
            console.log(data);
            $(this).siblings('input[name=body]').val(''); //reset comment box input value

            $.ajax({ //!create msg
                url: 'http://localhost/uni_comm/api/messages/create.php',
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (response) {
                    console.log("added msg to db");
                    console.log(response);
                    $.ajax({ //! read recent msg
                        url: 'http://localhost/uni_comm/api/messages/read_chat.php?msg_id=' + msg_id,
                        dataType: 'json',
                        type: 'get',
                        success: function (messages) {
                            let msg = messages[messages.length - 1];
                            $.ajax({ //! read user profile pic
                                url: 'http://localhost/uni_comm/api/users/read_single.php?id=' + sender_id,
                                dataType: 'json',
                                type: 'get',
                                success: function (user) {
                                    console.log(user);
                                    $('.chat-messages').append('<div class="chat-message-left pb-4"><div><img src="uploaded_images/' + user.profile_pic + '" class="rounded-circle mr-1"alt="#" width="40" height="40"><div class="text-muted small text-nowrap mt-2">' + msg.timestamp + '</div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1"></div>' + msg.body + '</div></div>');        
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                                } 
                            });
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        } 
                    });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
        });

        //* search
        $('input[type=search]').keyup(function () {
            let value = $(this).val();
            let data = JSON.stringify({name: value});
            if ($(this).val() != "") {
                $('#ui-id-1').show();
            } else {
                $('#ui-id-1').hide();
            }
            $('#ui-id-1').empty();
            $.ajax({
                url: 'http://localhost/uni_comm/api/users/read_by_keyword.php',
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (users) {
                    //returns array
                    console.log('Fetched users.');
                    if (users.length == 0) {
                        $('#ui-id-1').hide();
                    }
                    users.forEach(user => {
                        $('#ui-id-1').append('<div><img height="50" width="50" src="uploaded_images/' + user.profile_pic + '"><a style="text-decoration: none" href="profile.php?id=' + user.id + '" tabindex="-1" class="ui-menu-item-wrapper">' + user.name + '</a><\div>');
                    });
                    
                }
            });
        });
   
        // new

//select faculty
let deps = {
    CIT: '<a class="dropdown-item" href="#">Computer Science</a><a class="dropdown-item" href="#">Computer Engineering</a><a class="dropdown-item" href="#">Software Engineering</a><a class="dropdown-item" href="#">Cyber Security</a><a class="dropdown-item" href="#">Network and Security Engineering</a><a class="dropdown-item" href="#">Computer Information Systems</a>',
    Language: ' <a class="dropdown-item" href="#">Language Center</a>',
    Nursing: '<a class="dropdown-item" href="#">Nursing</a> <a class="dropdown-item" href="#">Midwifery</a>',
};

let depsSelect = {
    CIT: '<option value="Computer Science">Computer Science</option><option value="Computer Engineering">Computer Engineering</option><option value="Software Engineering">Software Engineering</option><option value="Cyber Security">Cyber Security</option><option value="Network and Security Engineering">Network and Security Engineering</option><option value="Computer Information Systems">Computer Information Systems</option>',
    Language: '<option value="Language">Language Center</option>',
    Nursing: '<option value="Midwifery">Midwifery</option><option value="Nursing">Nursing</option>',
};


$('#faculty').on('click', 'a', function () {
    var fac_name = $(this).attr('name');
    $(this).closest('.dropdown').find('#dropdownMenuButton').html(fac_name);
    $('.dep-main').html("Department");
    var dep_name = deps[fac_name];
    $(".Department").html(dep_name);
});

$('#facultyUpload').change(function () {
    var fac_name = $(this).val();
    $('#departmentUpload').empty();
    let dep_list = '<option selected disabled> -Select Department- </option>' + depsSelect[fac_name];
    $("#departmentUpload").html(dep_list);
});

//select department
$('#Department').on('click', 'a', function () {
    var text = $(this).html();
    var uid = $("#uid").val();
    let DepName = text.replace(" ", "%20");
    $(this).closest('.dropdown').find('#dropdownMenuButton').html(text);
    if ($("#Department").children().length > 1 ) {
        $('#courseTable').empty();
        let url = window.location.href.includes('view-upload.php') ? 'http://localhost/uni_comm/api/courses/read_by_uid.php?uid=' + uid + '&dep_name=' + DepName : 'http://localhost/uni_comm/api/courses/read.php?dep_name=' + DepName ;
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'get',
            success: function (courses) {
                if (courses.length == 0) {
                    $('#courseTable').append('<td colspan="4"><p class="text-center">No courses available.</p></td>');
                } else if (url.includes("read_by_uid.php")) {
                    courses.forEach(course => {
                        $('#courseTable').append('<tr><td>' + course.course_name + '</td><td>' + course.subject_name + '</td><td><a href="uploaded_courses/' + course.file + '">' + course.file + '</a></td><td><form style="display: inline" action="view-upload.php" method="post"><button type="submit" name="delete" value="1" class="btn btn-danger btn-sm ml-3">Delete</button><input name="id" type="hidden" value="' + course.id + '"></form></td></tr>');
                    });  
                } else {
                courses.forEach(course => {
                    $('#courseTable').append('<tr><td>' + course.course_name + '</td><td>' + course.subject_name + '</td><td><a download href="uploaded_courses/' + course.file + '">Download</a></td><td>' + course.name + '</td></tr>');
                });     
                } 
            }
        });
    }
});



//upload
$('#facultyUpload').on('click', 'a', function () {
    var htmlText = $(this).html();
    $(this).closest('.dropdown').find('#dropdownMenuButton').html(htmlText);
    $('.dep-upload').html("Department");
    var DepName = htmlText.split(' ')[0];
    var myVar = window[DepName];
    $(".DepartmentUpload").html(myVar);
});

$('.DepartmentUpload').on('click', 'a', function () {
    var text = $(this).html();
    var course=text.replace(' ','')+"Course";

    $(this).closest('.dropdown').find('#dropdownMenuButton').html(text);
    $('.new-file-save').on('click', function(){
    var inputValue = $(".fileName").val();
    var inputValue2 = $(".courseName").val();
    
    var fileDisc = ' <th scope="row">courseName</th> <td>fileName </td> <td class="t-download"> <a id="fileLink" download> <i class="fa-solid fa-download "></i> </a> </td> <td>Dr.Mallak</td>';
   
    fileDisc = fileDisc.replace("fileName", inputValue);
  
    fileDisc = fileDisc.replace("courseName", inputValue2);
   window[course]+= fileDisc;
   $('#uploadNewFile').modal('hide');})

});


$("input[name=new_pass]").keyup(function () {
    const newPass = $(this).val();
    if (newPass.length < 8) {
        $("#pass-msg").html("Must be more than 8 characters.").css("display","");
    } else { 
        var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        const flag = format.test(newPass);
        if (!flag) {
            $("#pass-msg").html("Must contain at least one special character.").css("display","");
        } else {
            var format = /[0-9]/;
            const flag = format.test(newPass);
            if (!flag) {
                $("#pass-msg").html("Must contain at least one digit.").css("display","");
            } else {
                var format = /(?:^|[^A-Z])[A-Z](?![A-Z])/;
                const flag = format.test(newPass);
                if (!flag) {
                $("#pass-msg").html("Must contain at least one capital letter.").css("display","");
                } else {
                    $("#pass-msg").html("").css("display","none");
                }
            }   
        }
    } 
});


});