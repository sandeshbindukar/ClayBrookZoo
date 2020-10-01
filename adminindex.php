<?php
	include('db/db_connect.php');
  if($_SESSION['sessUserType'] != "admin"){
  header('Location:login.php'); //if the user is not admin go to index page
  }
  else{
  //select details from product table if the user is admin
  $select_species = $pdo->prepare("SELECT species_id, species_name, animal_given_name, date_of_birth, gender, average_lifespan_in_yrs, species_classification, dietary_requirements, natural_habitat_description, global_population_distribution, date_joined_in_zoo, animal_dimension FROM tb_animal_details");
  $select_species->execute();

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
          <li class="active"><a href="adminindex.php">Home</a></li>
          <li><a href="addspecies.php">Add Species</a></li>
          <li><a href="manageSponsor.php">Sponsors</a></li>
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
          <li><a href = "logout.php">Logout</a><li> <!-- gets logged out when pressed -->
		  	<?php } else { ?>
		  <li><a href="login.php">Login</a></li>	<!-- link to login page -->
			<?php } ?>
          
        </ul>
      </div>
      <div class="clr"></div>
    </div>
    <div class="content" style="border-top: 1px solid #CCC">
      	<div class="mainbar" style="width: 100%">
          <div class="article">
      	     <!-- Table to display the species with details and admin can add, delete, species in this page -->
          		<h2>SPECIES TABLE</h2>
          		<a href="addspecies.php" style="text-decoration: none; "><h3>Add Species</h3></a> <!-- link to addProduct page -->
          		<table border="2" cellspacing="2">
          		<td style="border:0; text-align:center; "> <?php echo @$showResult; ?></td> 
          		<tr>
          			<th>SPECIES ID</th>
          			<th>SPECIES NAME</th>
          			<th>ANIMAL GIVEN NAME</th>
                <th>SPECIES IMAGE</th>
          			<th>DATE OF BIRTH</th>
          			<th>GENDER</th>
          			<th>AVERAGE LIFE SPAN</th>
                <th>SPECIES CLASSIFICATION</th>
                <th>DIETARY REQUIREMENTS</th>
                <th>NATURAL HABITAT DESCRIPTION</th>
                <th>GLOBAL POPULATION DISTRIBUTION</th>
                <th>DATE JOINED IN ZOO</th>
                <th>ANIMAL DIMENSION</th>
          		</tr>


                  <?php
                  foreach ($select_species as $row) {?> 
                    <tr style="text-align: center;">
                      <td> <?php echo $row['species_id']; ?></td> 
                      <td> <?php echo $row['species_name']; ?></td> 
                      <td> <?php echo $row['animal_given_name']; ?></td> 
                      <td><?php
                        echo  "<img src='images/".$row['species_id'].".jpg' width=200 >"  ; 
                       ?></td> <!-- displays animal image -->
                      <td> <?php echo $row['date_of_birth']; ?> </td> 
                      <td> <?php echo $row['gender']; ?> </td>
                      <td> <?php echo $row['average_lifespan_in_yrs']; ?> </td> 
                      <td> <?php echo $row['species_classification']; ?> </td>
                      <td> <?php echo $row['dietary_requirements']; ?> </td> 
                      <td> <?php echo $row['natural_habitat_description']; ?> </td>
                      <td> <?php echo $row['global_population_distribution']; ?> </td>
                      <td> <?php echo $row['date_joined_in_zoo']; ?> </td>
                      <td> <?php echo $row['animal_dimension']; ?> </td>   
                      <td >
                        <a href="editspecies.php?species_id=<?php echo $row['species_id'];?>" style="text-decoration: none; color: green;">Edit
                        </a> <!-- go to the edit animal page when the Edit button is pressed -->
                      </td>
                      <td >
                        <a href="deletespecies.php?species_id=<?php echo $row['species_id'];?>" style="text-decoration: none; color: red;">Delete
                        </a><!-- The animal is deleted from animals table when the Delete button is clicked -->
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
        <li class="active"><a href="adminindex.php">Home</a></li>
        <li><a href="addspecies.php">Animals</a></li>
        <li><a href="manageSponsor.php">Sponsors</a></li>
        <li><a href="adminevents.php">Events</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</body>
</html>