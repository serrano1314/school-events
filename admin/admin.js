$(document).ready(function(){
    
    displayUsersTable();
    displayEventTable();
    $('#addUserButton').unbind().click(addUser);
    $('#updateUserButton').unbind().click(updateUser);
    $('#addEventButton').unbind().click(addEvent);
    
})

function displayUsersTable(){
    
    var displayTableData = 'true';
    $.ajax({
        url:'display_user_table.php',
        method:'post',
        data:{
            tableData:displayTableData
        },
        success:function(data,status){
            console.log(status);
            console.log('display');
            $('#display-user').html(data);
            $('#displayuser_table').DataTable();

        }
    })

    getUserRecord();
}

function displayEventTable(){
    var displayTableEventData = 'true';
    $.ajax({
        url:'display_event_table.php',
        method:'post',
        data:{
            tableEventData:displayTableEventData
        },
        success:function(data,status){
            console.log('display event table');
            $('#display-event').html(data);
            $('#displayevent_table').DataTable();

        }
    })
    getEventRecord();
}

function getUserRecord(){
    
    $(document).on('click','#getUserDataButton', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var update_user_id = $(this).attr('data-id');

        $.ajax({
            url:'get_user_record.php',
            method:'post', 
            data:{
                user_id:update_user_id
            },
            success:function(data,status){
                data = JSON.parse(data)
                console.log(data);
                // console.log(status);
                $('#updateUserModal').modal('show');
                
                $('#update_user_id').val(data[0]);
                $('#update_uname').val(data[1]);
                $('#update_password').val(data[2]);
                $('#update_email').val(data[3]);
                $('#update_fname').val(data[4]);
                $('#update_mname').val(data[5]);
                $('#update_lname').val(data[6]);
                $('#update_gender').val(data[7]);
                $('#update_course').val(data[8]);
                $('#update_year').val(data[9]);
                $('#update_section').val(data[10]);
                $('#update_user-type').val(data[11]);

            }
        });
    });    
}

function getEventRecord(){
    
    $(document).on('click','#getEventDataButton', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var update_evet_id = $(this).attr('data-id');
        
        $.ajax({
            url:'get_event_record.php',
            method:'post', 
            data:{
                event_id:update_evet_id
            },
            success:function(data,status){
                data = JSON.parse(data)
                console.log(data);
                console.log(status);
                $('#updateEventRowModal').modal('show');

                $('#update_event_id').val(data[0]);
                $('#update_event_title').val(data[2]);
                $('#update_event_description').val(data[3]);

                $('#update_start_datetime').val(data[4]);
                $('#update_end_datetime').val(data[5]);
                $('#update_event_location').val(data[6]);
                $('#update_event_type').val(data[7]);

            }
        });
    });    
}

function updateUser(){
    var update_user_id = $('#update_user_id').val();
    var update_user_username = $('#update_uname').val(); 
    var update_user_password = $('#update_password').val();
    var update_user_email = $('#update_email').val();
    var update_user_fname = $('#update_fname').val();
    var update_user_mname = $('#update_mname').val();
    var update_user_lname = $('#update_lname').val();
    var update_user_gender = $('#update_gender').val();
    var update_user_course = $('#update_course').val();
    var update_user_year = $('#update_year').val();
    var update_user_section = $('#update_section').val();
    var update_user_usertype = $('#update_user-type').val();

    // console.log(update_user_id)

    $.ajax({
        url:'update_user.php',
        method:'post',
        data:{
            user_id: update_user_id,
            username: update_user_username,
            password: update_user_password,
            email: update_user_email,

            first_name: update_user_fname,
            middle_name: update_user_mname,
            last_name: update_user_lname,
            gender: update_user_gender,

            course: update_user_course,
            year: update_user_year,
            section: update_user_section,

            user_type: update_user_usertype
        },
        success:function(data,status){
            console.log("EDITED ");
            console.log(status);
            alert('USER UPDATED');
            displayUsersTable();
        }
    });

}

function deleteUser(user_id){
    $.ajax({
        url:'delete_user.php',
        method:'post',
        data:{
            del_user_id:user_id
        },
        success:function(data,status){
            console.log(status);
            console.log('delete' + data);
            alert('Deletion '+status);
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
        method: 'post',
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
            alert(status);
            // $("#addUserModal").modal('hide');
            $('form').trigger('reset');
            // console.log(parseInt(data)+1);
            $('#uname').val('default' + (parseInt(data)+1).toString());
            displayUsersTable();
        }
    });
}

function addEvent(){
    var eventStart_add=$('#eventStartDate').val();
    var eventEnd_add=$('#eventEndDate').val();
    var eventTitle_add=$('#eventTitle').val();
    var eventDescription_add=$('#eventDescription').val();
    var eventLocation_add=$('#eventLocation').val();
    var eventType_add=$('#eventType').val();
    var user_id_event_add = $('#user_id_event').val();

    $.ajax({
        url:'add_event.php',
        method: 'post',
        data:{
            eventStart: eventStart_add,
            eventEnd: eventEnd_add,
            eventTitle: eventTitle_add,
            eventDescription: eventDescription_add,
            eventLocation: eventLocation_add,
            eventType: eventType_add,
            user_id_event: user_id_event_add
        },
        success:function(data,status){
            console.log(data);
            console.log('Add event success');
            alert(status);
            // $("#addEventModal").modal('hide');
            $('form').trigger('reset');
            displayEventTable();
        }
    });
}
