<?php 
    include 'db_connect.php';
    if(isset($_POST['tableData'])){
        $table = '
        <table class="table table-striped table-hover my-3" id="displayuser_table">
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>user type</th>
                <th>full name</th>
                <th>gender</th>
                <th>course/yr/sec</th>
                <th>email</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>';

        $sql = "SELECT * from users WHERE is_user_active = '1'";
        $active_users = mysqli_query($con, $sql);

        while($users_row_data = mysqli_fetch_assoc($active_users)){
            $user_id = $users_row_data['id'];
            $user_username = $users_row_data['username'];
            $user_usertype = $users_row_data['user_type'];
            $user_fullname = $users_row_data['first_name'].' '.$users_row_data['last_name'];
            $user_gender = $users_row_data['gender'];
            $user_course_yr_sec = $users_row_data['course'].' '.$users_row_data['year'].' '.$users_row_data['section'];
            $user_email = $users_row_data['email'];

            $table.='
            <tr>
                <td>'.$user_id.'</td>
                <td>'.$user_username.'</td>
                <td>'.$user_usertype.'</td>
                <td>'.$user_fullname.'</td>
                <td>'.$user_gender.'</td>
                <td>'.$user_course_yr_sec.'</td>
                <td>'.$user_email.'</td>
                <td>
                    <button class="btn btn-info btn-sm" id="getUserDataButton" data-id='.$user_id.'><span class="fa fa-edit"></span></button>
                    <button class="btn btn-danger btn-sm" onclick="deleteUser('.$user_id.')"><span class="fa fa-trash"></span></button>
                </td>
            </tr>
            ';
        }
        
        $table.='
        </tbody>
        <tfoot>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>user type</th>
                <th>full name</th>
                <th>gender</th>
                <th>course/yr/sec</th>
                <th>email</th>
                <th>actions</th>
            </tr>
        </tfoot>
        </table>';
        echo $table;
    }
?>