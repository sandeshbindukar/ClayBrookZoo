<?php
	include('db/db_connect.php');
  if($_SESSION['sessUserType'] != "admin"){
  header('Location:login.php'); //if the user is not admin go to index page
  }
  else{
  //select details from product table if the user is admin
  $select_sponsor = $pdo->prepare("SELECT sponsor_id, species_code, species_name, animal_given_name, species_classification, sponsor_name, sponsor_email, sponsor_mobile_number, sponsor_address, sponsorship_band, date_of_sponsor FROM tb_sponsor_details");
  $select_sponsor->execute();

  //display message
  if(isset($_GET['showResult'])) $showResult = '<h4>' . $_GET['showResult'] . '</h4>';
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>
<title>Claybrook Zoo </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.php">Claybrook Zoo </a></h1>
      </div>
      <div class="menu_nav">
        <ul>
          <li><a href="adminindex.php">Home</a></li>
          <li><a href="addspecies.php">Add Species</a></li>
          <li class="active"><a href="manageSponsor.php">Sponsors</a></li>
          <li><a href="adminevents.php">Events</a></li>
          <?php 
          if (isset($_SESSION['sessUserType'])) {
  		//get user details from users table by id and type
  			$stmt = $pdo-> prepare("SELECT * FROM tb_user_details WHERE user_id = :user_id AND user_type = :user_type");
  			$criteria = [
  			'user_id' => $_SESSION['sessUserId'],
  			'user_type' => $_SESSION['sessUserType']
  			];
  			$stmt->execute($criteria);
  			$user = $stmt->fetch(); ?>
  			<!-- <li><?php echo 'Hello, '. $user['username'];  ?></li> <!-- displays Hello message to a user --> -->
          <li><a href = "logout.php">Logout</a><li> <!-- gets logged out when pressed -->
  	  	<?php } else { ?>
  	  <li><a href="login.php">Login</a></li>	<!-- link to login page -->
  		<?php } ?>
          
        </ul>
      </div>
      <div class="clr"></div>
    </div>

    <div class="content Content" style="border: 1px solid #ccc">
    	<div class="mainbar" style="width: 100%">
        <div class="article">
    	     <!-- Table to display the species with details and admin can add, delete, species in this page -->
        		<h2 >SPONSOR TABLE</h2><br>
        		<table border="2" cellspacing="2">
        		<td style="border:0; text-align:center; "> <?php echo @$showResult; ?></td> 
        		<tr>
              <th>SPONSOR ID</th>
        			<th>SPECIES CODE</th>
        			<th>SPECIES NAME</th>
        			<th>ANIMAL GIVEN NAME</th>
              <th>SPECIES CLASSIFICATION</th>
              <th>SPONSOR NAME</th>
              <th>SPONSOR EMAIL</th>
              <th>SPONSOR MOBILE NUMBER</th>
              <th>SPONSOR ADDRESS</th>
              <th>SPONSORSHIP BAND</th>
              <th>DATE OF SPONSORSHIP</th>
        		</tr>


                <?php
                foreach ($select_sponsor as $row) {?> 
                  <tr style="text-align: center;">
                    <td> <?php echo $row['sponsor_id']; ?></td> 
                    <td> <?php echo $row['species_code']; ?></td> 
                    <td> <?php echo $row['species_name']; ?></td> 
                    <td> <?php echo $row['animal_given_name']; ?></td> 
                    <td> <?php echo $row['species_classification']; ?> </td>
                    <td> <?php echo $row['sponsor_name']; ?> </td> 
                    <td> <?php echo $row['sponsor_email']; ?> </td>
                    <td> <?php echo $row['sponsor_mobile_number']; ?> </td>
                    <td> <?php echo $row['sponsor_address']; ?> </td>
                    <td> <?php echo $row['sponsorship_band']; ?> </td>  
                    <td> <?php echo $row['date_of_sponsor']; ?> </td> 
                    <td>
                      <a href="deleteSponsor.php?sponsor_id=<?php echo $row['sponsor_id'];?>">Delete
                      </a>
                    </td>
                  </tr>
                <?php
                }
                ?>


        		</table>
        </div>
      </div>
    </div>
     
    <div class="clr"></div> 	
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Copyright ClayBrook Zoo 2020</p>
      <ul class="fmenu">
        <li><a href="adminindex.php">Home</a></li>
        <li><a href="addspecies.php">Animals</a></li>
        <li class="active"><a href="manageSponsor.php">Sponsors</a></li>
        <li><a href="adminevents.php">Events</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>

</body>
</html>