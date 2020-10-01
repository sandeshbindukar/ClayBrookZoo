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
          <li><a href="adminindex.php">Home</a></li>
          <li class="active"><a href="addspecies.php">Add Species</a></li>
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

    <div class="content Content">
      <div class="content_resize">
    	<div class="mainbar">
        <div class="article">
    	  
            <?php
              if (isset($_POST['submit'])) {
                $stmt = $pdo->prepare('INSERT INTO tb_animal_details (species_name, animal_given_name, date_of_birth, gender, average_lifespan_in_yrs, species_classification, dietary_requirements, natural_habitat_description, global_population_distribution, date_joined_in_zoo, animal_dimension)
                             VALUES (:species_name, :animal_given_name, :date_of_birth, :gender, :average_lifespan_in_yrs, :species_classification, :dietary_requirements, :natural_habitat_description, :global_population_distribution, :date_joined_in_zoo, :animal_dimension)');

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
                  'animal_dimension' => $_POST['animal_dimension']
                ];

                $stmt->execute($criteria);

                if ($_FILES['species_image']['error'] == 0) {
                  $fileName = $pdo->lastInsertId() . '.jpg';
                  move_uploaded_file($_FILES['species_image']['tmp_name'], 'images/' . $fileName);
                }
                header('Location:adminindex.php');
                // echo 'Species added';
              }
              else {

                ?>



        <h2>ADD SPECIES</h2>

        <form action="addspecies.php" method="POST" enctype="multipart/form-data">
          <label>Species Name</label>
          <input type="text" name="species_name" /><br><br>

          <label>Animal Given Name</label>
          <input type="text" name="animal_given_name" /><br><br>

          <label>Species Image</label>
          <input type="file" name="species_image" /><br><br>

          <label>Date Of Birth</label>
          <input type="date" name="date_of_birth" /> <br><br>

          <label>Gender</label><br>
          <input type="radio" id="male" name="gender" value="male">
          <label >Male</label><br>
          <input type="radio" id="female" name="gender" value="female">
          <label >Female</label><br><br>
          

          <label>Average Life Span(in Yrs)</label>
          <input type="text" name="average_lifespan_in_yrs" /><br><br>

          <label>Species Classification</label>
          <select name="species_classification">
          <?php
            $stmt = $pdo->prepare('SELECT * FROM tb_species_classification');
            $stmt->execute();

            foreach ($stmt as $row) {
              echo '<option value="' . $row['classification_name'] . '">' . $row['classification_name'] . '</option>';
            }

          ?>
          </select><br><br>

          <label>Dietary Requirements </label>
          <textarea name="dietary_requirements"></textarea><br><br>

          <label>Natural Habitat Description </label>
          <textarea name="natural_habitat_description"></textarea><br><br>

          <label>Global Population Distribution </label>
          <textarea name="global_population_distribution"></textarea><br><br>

          <label>Date Joined In Zoo</label>
          <input type="date" name="date_joined_in_zoo" /> <br><br>
          
         <label>Animal Dimension</label>
          <textarea name="animal_dimension"></textarea><br><br>

          <input type="submit" name="submit" value="Add" class="input" />
        </form>
        <?php
          } ?>

        </div>
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
          <li class="active"><a href="addspecies">Animals</a></li>
          <li><a href="manageSponsor.php">Sponsors</a></li>
          <li><a href="adminevents.php">Events</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>
</div>
</body>
</html>