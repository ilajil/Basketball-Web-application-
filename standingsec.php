<?php
  session_start();
    require_once "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Standings</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css.css">
<style>
* {
  box-sizing: border-box;
}
 .navbar{
    margin-bottom: 0;
    border-radius: 0;
    background-color: #030303;
    color: #FFF
    padding: 1% 0;
    font-size: 1.2em;
    border:0;
}
#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#MyNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="#" class="navbar-nav navbar navbar-right"><img src="img/w3newbie.png"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="home.php">Home</a> </li> -->
            <li> <a href="homesec.php">News</a></li>
            <li><a href="examplesec.php">Schedule</a> </li>
            <li> <a href="standingsec.php">Standings</a></li>
            <li> <a href="playersec.php">Players</a></li>
                    <li> <a href="teamsec.php">Teams</a></li>
                    <li style="float:right;"><a href="profile2.php?userId=<?=$_SESSION["authlog"]["userId"]?>"><img style="width:30px; height:25px; background-color:white;" src="images/people/<?php echo $_SESSION["authlog"]["Image"];?>"><?php echo ' ';?><?php echo strtoupper($_SESSION["authlog"]["Full_Name"]);?></a></li>

          </ul>
        </div>
      </div>
   </nav>


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <img style="background-color:white; width:100%; height:50%; align:center;" src="images/people/<?php echo $_SESSION["authlog"]["Image"];?>">
  <label style="color:white"><?php echo $_SESSION["authlog"]["Full_Name"];?></label><br />
  <label style="color:white"><?php echo $_SESSION["authlog"]["User_Name"];?></label><br />
  <label style="color:white"><?php echo $_SESSION["authlog"]["email"];?></label><br />
  <label style="color:white"><?php echo $_SESSION["authlog"]["phone_Number"];?></label><br />
  <label style="color:white"><?php echo $_SESSION["authlog"]["Address"];?></label><br />
  <a href="index2.php">Index</a>
  <a href="logout.php">Logout</a>
  <a href="#"></a>
</div>
<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</div>


<h2>LEAGUE STANDINGS</h2>


<table id="myTable">
  <tr class="header">
    <!-- <th style="width:20%;">Standing Id</th> -->
    <th style="width:20%;">Team Name</th>
    <th style="width:20%;">Wins</th>
    <th style="width:20%;">Loss</th>
    <th style="width:20%;">Played</th>
    <th style="width:20%;">Points</th>
    </tr>
  <?php 
$select_qry="SELECT teamName, win, loss, played, points FROM `standings` INNER JOIN `teams` ON `standings`.`teamId`=`teams`.`teamId` ORDER BY `points` DESC";
$results=$conn->query($select_qry);



if ($results->num_rows>0){
  while ($row=$results->fetch_assoc()) {
 ?>
  <tr>
  <!-- <td align="center" scope="row"><?php echo $row["standingId"]; ?></td> -->
  <td align="center" scope="row"><?php echo $row["teamName"]; ?></td>
  <td align="center" scope="row"><?php echo $row["win"]; ?></td>
  <td align="center" scope="row"><?php echo $row["loss"]; ?></td>
  <td align="center" scope="row"><?php echo $row["played"]; ?></td>
  <td align="center" scope="row"><?php echo $row["points"]; ?></td>
 </tr>
 <?php
 }
}else {
  echo "0 results";
 }
    ?>
  
</table>


</body>
</html>
<style type="text/css">
    .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }

  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s
  }

  .sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
  }

  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }

  #main {
    transition: margin-left .5s;
    padding: 16px;
  }

  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
</style>
<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
  }
</script>


