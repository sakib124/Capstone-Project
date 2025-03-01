<?php
session_start();
include'dbconnection.php';
if($_SESSION['login']!="1"){
header("Location: stafflogin.php");}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Capstone Project</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  form{
	width: 500px;
	margin:0 auto;
  <style>
  .grid-container {
      display: grid;
      grid-template-columns: 20% 20% 20% 20% 20%;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <div class="w3-top" >
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
	    <!--changed admin/manage-patients.php to staff/manage-patients.php -Danny-->
        <a href="https://ontario-shores.herokuapp.com/staff/manage-patients.php" class="w3-bar-item w3-button"><b>Manage Patients</b></a>
        <!--Float to the right, hide in small screen -->
        <div class="w3-right w3-hide-small">
          <a href="#projects" class="w3-bar-item w3-button">Projects</a>
          <a href="#about" class="w3-bar-item w3-button">About</a>
          <a href="#contact" class="w3-bar-item w3-button">Contact</a>
        </div>
    </div>
  </div><br>
<br>
<br>
<br>
<br>


  <!--Page-->
  <div class="w3-content w3-padding" style="max-width:1564px">




<!--Project Section -->

 								<!--DYNAMIC PROFILES SEARCH BAR-->

<!--Dynamic Profiles -->
<div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Search for Public Media</h3>
  </div>

  <div allign="center">

	<form action="search.php">
	  	<input type="text" placeholder="Search.." name="profileid">
  		<input type="submit" value="Submit">
	</form>

  </div>


<!--Patient Profiles -->

<?php
  $connect = mysqli_connect("us-cdbr-iron-east-04.cleardb.net", "bc9da719e482f3", "deea7ef6", "heroku_dbefbfd5b04ac35");
  $profile = $_GET['uid'];
  $query = "SELECT fname FROM patient WHERE id='$profile'";
  $result = mysqli_query($connect, $query);
  $value = mysqli_fetch_assoc($result);
  $valuestr = $value['fname'];
?>

  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Albums in Patient Profile: <?php echo ucfirst($valuestr); ?></h3>
    <button onclick="location.href='albumdeletestaff.php?profileid=<?php echo $profile ?>'" class="w3-button w3-right w3-red">Delete Albums</button>
  </div>

  <div class="grid-container">
  <?php

  $sql = "SELECT DISTINCT album FROM new_media WHERE patientid='$profile' AND type='picture'";
  $result2 = mysqli_query($connect, $sql);
  $opt = "";

    while($row = mysqli_fetch_assoc($result2)) {

      $item = $row['album'];

      $query = "SELECT link FROM new_media WHERE patientid='$profile' AND album='$item' LIMIT 1";
      $img = mysqli_query($connect, $query);
      $url = mysqli_fetch_assoc($img);
      $urlstr = $url['link'];

      $opt .= "<div class='grid-item'><h5>$item</h5><a href='albumgallery.php?profileid=$profile&albumname=$item'><img id='$urlstr' src='$urlstr' style='width: 100%; height: 100%; padding: 3px;'></a></div>";
    }
  ?>

  <?php echo $opt ?>

  </div>

<br>
<br>
<br>
<br>
<br>



      <!-- End page content -->
      </div>


      <!-- Footer -->
      <footer class="w3-center w3-black w3-padding-16">
        <p>Made For <a href="https://www.ontarioshores.ca/" title="Ontario Shores Center for Mental Health Science" target="_blank" class="w3-hover-text-green">Ontario Shores Center for Mental Health Sciences</a> in collaboration with Ontario Tech University</p>
      </footer>
</body>
</html>
