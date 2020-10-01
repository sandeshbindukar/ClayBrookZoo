<?php
	include('db/db_connect.php');
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
      <div class="mainbar-species">
        <div class="article-species">
          <h2>Sponsors</h2>
          <?php
            $sponsor = $pdo->prepare('SELECT * FROM tb_sponsor_details');
            $sponsor->execute();
            foreach ($sponsor as $sponsor) {
              echo '<h3>Sponsor Name: ' . $sponsor['sponsor_name'] . '</h3>';
              echo '<h3>Species Sponsored: ' . $sponsor['animal_given_name'] . '</h3>';
               if (file_exists('images/' . $sponsor['species_code'] . '.jpg')) {
                  echo '<a href="images/' . $sponsor['species_code'] . '.jpg"><img src="images/' . $sponsor['species_code'] . '.jpg" width=200 /></a>';
                }
              echo '<h3>Sponsorship Band: ' . $sponsor['sponsorship_band'] . '</h3><br>';
            } 
          ?>
          <h4><a href="species.php">Want to become a sponsor?</a></h4>
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
