<?php
	include('db/db_connect.php');
  if($_SESSION['sessUserType'] != "admin"){
  header('Location:login.php'); //if the user is not admin go to index page
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
        <h1><a href="adminindex.php">Claybrook Zoo </a></h1>
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
				<!-- <li><?php echo 'Hello, '. $user['username'];  ?></li> <!-- displays Hello message to a user --> -->
          <li><a href = "logout.php">Logout</a><li> <!-- gets logged out when pressed -->
		  	<?php } else { ?>
		  <li><a href="login.php">Login</a></li>	<!-- link to login page -->
			<?php } ?>
          
        </ul>
      </div>
      <div class="clr"></div>
    </div>

     <div class="content Content">
      <div class="content_resize">
    	<div class="mainbar">
        <div class="article">
    	  
          <?php
          if (isset($_POST['submit'])) {

          $stmt = $pdo->prepare('UPDATE tb_animal_details
                      SET species_name = :species_name,
                          animal_given_name = :animal_given_name,
                          date_of_birth = :date_of_birth,
                          gender = :gender,
                          average_lifespan_in_yrs = :average_lifespan_in_yrs,
                          species_classification = :species_classification,
                          dietary_requirements = :dietary_requirements,
                          natural_habitat_description = :natural_habitat_description,
                          global_population_distribution = :global_population_distribution,
                          date_joined_in_zoo = :date_joined_in_zoo,
                          animal_dimension = :animal_dimension
                         WHERE species_id = :species_id
                  ');

          $criteria = [
                  'species_name' => $_POST['species_name'],
                  'animal_given_name' => $_POST['animal_given_name'],
                  'date_of_birth' => $_POST['date_of_birth'],
                  'gender' => $_POST['gender'],
                  'average_lifespan_in_yrs' => $_POST['average_lifespan_in_yrs'],
                  'species_classification' => $_POST['species_classification'],
                  'dietary_requirements' => $_POST['dietary_requirements'],
                  'natural_habitat_description' => $_POST['natural_habitat_description'],
                  'global_population_distribution' => $_POST['global_population_distribution'],
                  'date_joined_in_zoo' => $_POST['date_joined_in_zoo'],
                  'animal_dimension' => $_POST['animal_dimension'],
                  'species_id' => $_POST['species_id']
                ];

          $stmt->execute($criteria);

          if ($_FILES['species_image']['error'] == 0) {
            $fileName = $_POST['species_id'] . '.jpg';
            move_uploaded_file($_FILES['species_image']['tmp_name'], 'images/' . $fileName);
          }
           header('Location:adminindex.php');
           // echo 'Species saved';
        }
        else {

            if (isset($_SESSION['sessUserType'])=="admin") {
             $species = $pdo->query('SELECT * FROM tb_animal_details WHERE species_id = ' . $_GET['species_id'])->fetch();
            }

            ?>

              <h2>EDIT SPECIES</h2>

              <form action="editspecies.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="species_id" value="<?php echo $species['species_id']; ?>" />

                <label>Species Name</label>
                <input type="text" name="species_name" value="<?php echo $species['species_name']; ?>" /><br><br>

                <label>Animal Given Name</label>
                <input type="text" name="animal_given_name" value="<?php echo $species['animal_given_name']; ?>" /><br><br>

                <?php
                if (file_exists('images/' . $species['species_id'] . '.jpg')) {
                  echo '<img style="width: 200px; clear: both" src="images/' . $species['species_id'] . '.jpg" />';
                }
                ?><br>
                <label>Species Image</label>
                <input type="file" name="species_image" /><br><br>

                <label>Date Of Birth</label>
                <input type="date" name="date_of_birth" value="<?php echo $species['date_of_birth'] ?>" /> <br><br>

                <label>Gender</label><br>
                 <?php if ($species['gender'] == 'male') { 
                  echo 
                  '<input type="radio" name="gender" value="male" CHECKED /> Male <br>
                  <input type="radio" name="gender" value="female" /> Female';
                  }
                  else{
                     echo 
                  '<input type="radio" name="gender" value="male"  /> Male 
                  <input type="radio" name="gender" value="female" CHECKED /> Female';
                  } ?><br><br>
                

                <label>Average Life Span(in Yrs)</label>
                <input type="text" name="average_lifespan_in_yrs" value="<?php echo $species['average_lifespan_in_yrs'] ?>" /><br><br>

                <label>Species Classification</label>
                <select name="species_classification">
                <?php
                  $stmt = $pdo->prepare('SELECT * FROM tb_species_classification');
                  $stmt->execute();
                  foreach ($stmt as $row) {
                    if ($species['species_classification'] == $row['classification_name']) {
                    echo '<option selected="selected" value="' . $row['classification_name'] . '">' . $row['classification_name'] . '</option>';
                  }
                  else {
                    echo '<option value="' . $row['classification_name'] . '">' . $row['classification_name'] . '</option>';
                    }
                  }
                ?>
                </select><br><br>

                <label>Dietary Requirements </label>
                <textarea name="dietary_requirements"><?php echo $species['dietary_requirements']; ?></textarea><br><br>

                <label>Natural Habitat Description </label>
                <textarea name="natural_habitat_description"><?php echo $species['natural_habitat_description']; ?></textarea><br><br>

                <label>Global Population Distribution </label>
                <textarea name="global_population_distribution"><?php echo $species['global_population_distribution']; ?></textarea><br><br>

                <label>Date Joined In Zoo</label>
                <input type="date" name="date_joined_in_zoo"  value="<?php echo $species['date_joined_in_zoo'] ?>" /> <br><br>
                
               <label>Animal Dimension</label>
                <textarea name="animal_dimension"><?php echo $species['animal_dimension']; ?></textarea><br><br>

                <input type="submit" name="submit" value="Update" class="input" />

              </form>
            <?php } ?>
        </div>
      </div>
    </div>
    </div>
   
   <div class="clr"></div>
    
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
</div>
</body>
</html>