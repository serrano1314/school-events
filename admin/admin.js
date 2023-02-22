$(document).ready(function(){
    displayUsersTable();
})



function displayUsersTable(){
    var displayTableData = 'true';
    $.ajax({
        url:'display_user_table.php',
        type:'post',
        data:{
            tableData:displayTableData
        },
        success:function(data,status){
            console.log(status);
            console.log('display');
            $('#display-user').html(data);
        }
    })
}

function updateUser(user_id){
    
}


function deleteUser(user_id){
    $.ajax({
        url:'delete_user.php',
        type:'post',
        data:{
            del_user_id:user_id
        },
        success:function(data,status){
            console.log(status);
            console.log('delete' + data);
            displayUsersTable();
        }
    })
}

function addUser(){
    var username_add=$('#uname').val();
    var password_add=$('#password').val();
    var email_add=$('#email').val();
    var first_name_add=$('#fname').val();
    var middle_name_add=$('#mname').val();
    var last_name_add=$('#lname').val();
    var gender_add=$('#gender').val();
    var course_add=$('#course').val();
    var year_add=$('#year').val();
    var section_add=$('#section').val();
    var usertype_add=$('#user-type').val();

    $.ajax({
        url:'add_user.php',
        type: 'post',
        data:{
            username:username_add,
            password:password_add,
            email:email_add,
            first_name:first_name_add,
            middle_name:middle_name_add,
            last_name:last_name_add,
            gender:gender_add,
            course:course_add,
            year:year_add,
            section:section_add,
            user_type:usertype_add
        },
        success:function(data,status){
            console.log(status);
            displayUsersTable();
        }
    });
}