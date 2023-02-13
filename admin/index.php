
<?php 
            session_start();

            if(isset($_SESSION['id']) && isset($_SESSION['username'])){
                $subok = $_SESSION['first_name'];
            }else{
                header("location: index.php");
                exit();
            }
        ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Events Management System</title>

    
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../CSS/admin.css">
    <link
      href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css"
      rel="stylesheet"
    >
    
    <script src="https://kit.fontawesome.com/4667e2671f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    

    

    
</head>
<body>
    <div id="adminpage">
        <nav >
            <ul class="sidenav">
                <li class="logo"><a id="logo" href=""><img src="..\img files\logo.png" alt=""><span class="nav-item">Event Management</span></a></li>
                <li class="nav"><a href=""><i class="fa fa-solid fa-users-viewfinder"></i><span class="nav-item">Overview</span></a></li>
                <li class="nav"><a href=""><i class="fa fa-solid fa-user"></i><span class="nav-item">Users/Participants</span></a></li>
                <li class="nav"><a href=""><i class="fa fa-brands fa-elementor"></i><span class="nav-item">Event Request</span></a></li>
                <li class="nav"><a href=""><i class="fa fa-solid fa-list-check"></i><span class="nav-item">Organizers</span></a></li>
                <li class="nav"><a href=""><i class="fa fa-solid fa-database"></i><span class="nav-item">Reports</span></a></li>
                <li class="nav"><a href=""><i class="fa fa-solid fa-gear"></i><span class="nav-item">Settings</span></a></li>
                <li class="nav logout"><a href="logout.php"><i class="fa fa-solid fa-arrow-right-from-bracket"></i><span class="nav-item">Logout</span></a></li>
            </ul>
        </nav>

        <div class="adminContent gridContainer">
            <h2 class="header">Welcome, <?php echo ucfirst($subok)?></h3>

            <div class="eventGraph">
                    <canvas id="myChart"></canvas>
            </div>

            <!-- <input class="searchbar" type="text" name="event" id="" placeholder="search"> -->
            <div  id='calendar'></div>
            <div  class="eventTable" id="wrapper"></div>
            
        </div>
    </div>
    
    
    
</body>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
<script src="../admin.js"></script>


</html>