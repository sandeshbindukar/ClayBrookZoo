<?php
	include('db/db_connect.php');
  if($_SESSION['sessUserType'] != "user"){
  header('Location:login.php'); 
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
          <li><a href="index.php">Home</a></li>
          <li><a href="species.php">Animals</a></li>
          <li class="active"><a href="sponsor.php">Sponsors</a></li>
          <li><a href="contact.php">Contact Us</a></li>
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
  </div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <?php
          
           if (isset($_POST['submit'])) {
             $stmt = $pdo->prepare('INSERT INTO tb_sponsor_details(species_code, species_name, animal_given_name, species_classification, sponsor_name, sponsor_email, sponsor_mobile_number, sponsor_address, sponsorship_band, date_of_sponsor)
              VALUES(:species_code, :species_name, :animal_given_name, :species_classification, :sponsor_name, :sponsor_email, :sponsor_mobile_number, :sponsor_address, :sponsorship_band, :date_of_sponsor)');
             $criteria = [
                  'species_code' => $_POST['species_code'],
                  'species_name' => $_POST['species_name'],
                  'animal_given_name' => $_POST['animal_given_name'],
                  'species_classification' => $_POST['species_classification'],
                  'sponsor_name' => $_POST['sponsor_name'],
                  'sponsor_email' => $_POST['sponsor_email'],
                  'sponsor_mobile_number' => $_POST['sponsor_mobile_number'],
                  'sponsor_address' => $_POST['sponsor_address'],
                  'sponsorship_band' => $_POST['sponsorship_band'],
                  'date_of_sponsor' => $_POST['date_of_sponsor']
                ];
                $stmt->execute($criteria);
                header('Location:sponsor.php');
           }
           ?>
          <h2>Become a Sponsor</h2>
          <form action="beSponsor.php" method="POST" style="margin: 2%;">
           <?php 
          $species = $pdo->query('SELECT * FROM tb_animal_details WHERE species_id = ' . $_GET['species_id'])->fetch();
           if (file_exists('images/' . $species['species_id'] . '.jpg')) {
                  echo '<a href="images/' . $species['species_id'] . '.jpg"><img src="images/' . $species['species_id'] . '.jpg" width=200 /></a>';
                } ?> <br>
            <label>Species Code: </label>
            <input type="text" name="species_code" value="<?php echo $species['species_id']; ?>" /> <br><br>
            <label>Species Name: </label>
            <input type="text" name="species_name" value="<?php echo $species['species_name']; ?>" /> <br><br>
            <label>Animal Given Name: </label>
            <input type="text" name="animal_given_name" value="<?php echo $species['animal_given_name']; ?>" /> <br><br>
            <label>Species Classification: </label>
            <input type="text" name="species_classification" value="<?php echo $species['species_classification']; ?>" /> <br><br>
            <label>Sponsor Name: </label>
            <input type="text" name="sponsor_name" value="<?php echo $user['name'] ,' ', $user['surname']; ?>" /> <br><br>
            <label>Sponsor Email:</label>
            <input type="text" name="sponsor_email" value="<?php echo $user['email'] ?>"><br><br>
            <label>Sponsor Phone:</label>
            <input type="text" name="sponsor_mobile_number" value="<?php echo $user['mobile_number'] ?>"><br><br>
            <label>Sponsor Address: </label>
            <textarea name="sponsor_address"><?php echo $user['address'] ?></textarea><br><br>
            <label>Sponsorship Band(A-E): </label>
            <select name="sponsorship_band">
              <option value="A">A (2500)</option>
              <option value="B">B (2000)</option>
              <option value="C">C (1500)</option>
              <option value="D">D (1000)</option>
              <option value="E">E (500)</option>
            </select><br><br>
            <label>Date of Sponsor: </label>
            <input type="text" name="date_of_sponsor" value="<?php echo date("m/d/Y") ?>" /><br><br>
            <input type="submit" name="submit" value="Submit" />  
          </form>
          <!-- 
          <h2>Animals</h2>
          <?php
            $speciesQuery = $pdo->prepare('SELECT * FROM tb_animal_details LIMIT 10');
            $speciesQuery->execute();
            
            if (isset($_POST['submit'])) { //when form is submitted i.e. submit button is pressed
              $key = '%'.$_POST['key'].'%';
              $result = $pdo->prepare("SELECT * FROM tb_animal_details WHERE  animal_given_name LIKE :key OR species_name LIKE :key OR species_classification LIKE :key");
              $criteria = [
                'key' => $key
              ];
              $result->execute($criteria);
              foreach ($result as $species) {
              if (file_exists('images/' . $species['species_id'] . '.jpg')) {
                  echo '<a href="images/' . $species['species_id'] . '.jpg"><img src="images/' . $species['species_id'] . '.jpg" width=200 /></a>';
                }
                  echo '<div class="details">';
                  echo '<h3>Species Name: ' . $species['species_name'] . '</h3>';
                  echo '<h3>Animal Given Name: ' . $species['animal_given_name'] . '</h3>';
                  echo '<h4>Date Of Birth: ' . $species['date_of_birth'] . '</h4>';
                  echo '<h4>Gender: ' . $species['gender'] . '</h4>';
                  echo '<h4>Average life span(in Yrs.): ' . $species['average_lifespan_in_yrs'] . ' </h4>';
                  echo '<h4>Species Classification: ' . $species['species_classification'] . ' </h4>';
                  echo '<h4>Date Joined In Zoo: ' . $species['date_joined_in_zoo'] . ' </h4>';
                  echo '<h4>Animal Dimension: ' . $species['animal_dimension'] . ' </h4>';
                  echo '<h4>Natural Habitat Description: ' . $species['natural_habitat_description'] . ' </h4>';
                  echo '<h4>'?><a href="sponsor.php?species_id=<?php echo $species['species_id'];?>" style="text-decoration: none; color: green;"'>Become a Sponsor for <?php echo $species['animal_given_name'];?> ? <?php '</a></h4>';
                  echo '</div>';
              }
            }
            else{
              foreach ($speciesQuery as $species) {
              if (file_exists('images/' . $species['species_id'] . '.jpg')) {
                echo '<a href="images/' . $species['species_id'] . '.jpg"><img src="images/' . $species['species_id'] . '.jpg" width=200 /></a>';
              }
              echo '<div class="details">';
              echo '<h3>Species Name: ' . $species['species_name'] . '</h3>';
              echo '<h3>Animal Given Name: ' . $species['animal_given_name'] . '</h3>';
              echo '<h4>Date Of Birth: ' . $species['date_of_birth'] . '</h4>';
              echo '<h4>Gender: ' . $species['gender'] . '</h4>';
              echo '<h4>Average life span(in Yrs.): ' . $species['average_lifespan_in_yrs'] . ' </h4>';
              echo '<h4>Species Classification: ' . $species['species_classification'] . ' </h4>';
              echo '<h4>Date Joined In Zoo: ' . $species['date_joined_in_zoo'] . ' </h4>';
              echo '<h4>Animal Dimension: ' . $species['animal_dimension'] . ' </h4>';
              echo '<h4>Natural Habitat Description: ' . $species['natural_habitat_description'] . ' </h4>';
              echo '<h4>'?><a href="sponsor.php?species_id=<?php echo $species['species_id'];?>" style="text-decoration: none; color: green;"'>Become a Sponsor for <?php echo $species['animal_given_name'];?> ? <?php '</a></h4>';
              echo '</div>';
             } 
           }
          ?> -->
        </div>
      </div>
      
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2>About Zoo</h2>
        <img src="images/zoologo.jpg" width="80" height="100" alt="" />
          <p>Claybrook Zoo is a small family-oriented zoo in the Northwest of England. Established in 1965, the zoo has a long history of providing educational support resources for members of the public to enhance their visiting experience. </p>
        </div>
      </div>
      <div class="col c3">
        <h2>Image Galley</h2>
        <img src="images/lion.jpg" width="66" height="66" alt="" /> <img src="images/panda.jpg" width="90" height="66" alt="" /> <img src="images/monkey.jpg" width="77" height="66" alt="" /> <img src="images/crocodile.jpg" width="66" height="66" alt="" /> <img src="images/bird.jpg" width="90" height="66" alt="" /> <img src="images/fish.jpg" width="77" height="66" alt="" /> </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Copyright ClayBrook Zoo 2020</p>
      <ul class="fmenu">
        <li><a href="index.php">Home</a></li>
        <li><a href="species.php">Animals</a></li>
        <li class="active"><a href="sponsor.php">Sponsors</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
</body>
</html>
