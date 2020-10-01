<?php
	include('db/db_connect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>
<title>Claybrook Zoo </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
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
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="species.php">Animals</a></li>
          <li><a href="sponsor.php">Sponsors</a></li>
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
      <img src="images/familyzoo.jpg" width="900" height="300" alt="" class="ctop" />
      <div class="mainbar">
        <div class="article">
          <h2>Zoo Map</h2>
          <img src="images/zoomap.bmp" width="95%" height="100%" >
        </div>
      </div>
      <div class="sidebar">
        <div class="gadget">
          <h2 class="star"><span>Events</span></h2>
          <ul class="ex_menu">
            <?php
              $events = $pdo->prepare('SELECT * FROM tb_events');
              $events->execute();
              foreach ($events as $event) { ?> 
                <li> <?php echo $event['event_description'] ?> </li>
                 <?php }
            ?>  
          </ul>
        </div>
        <div class="gadget">
          <h2 class="star">Animals Type</h2>
          <ul class="sb_menu">
            <li>Mammals</li>
            <li>Birds</li>
            <li>Reptiles and Amphibians</li>
            <li>Fish</li>
          </ul>
        </div>
        <div class="gadget">
          <h2 class="star"><span>Animal Sponsors</span></h2>
          <ul class="ex_menu">
            <?php
              $sponsor = $pdo->prepare('SELECT * FROM tb_sponsor_details');
              $sponsor->execute();
              foreach ($sponsor as $sponsor) { ?> 
                <li> <?php echo $sponsor['sponsor_name'] ?> </li>
                 <?php }
            ?>  
          </ul>
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
        <img src="images/lion.jpg" alt="" /> 
        <img src="images/panda.jpg" alt="" /> 
        <img src="images/monkey.jpg" alt="" /> 
        <img src="images/crocodile.jpg" alt="" /> 
        <img src="images/bird.jpg" alt="" /> 
        <img src="images/fish.jpg" alt="" /> 
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Copyright ClayBrook Zoo 2020</p>
      <ul class="fmenu">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="species.php">Animals</a></li>
        <li><a href="sponsor">Sponsors</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
  <script type="text/javascript" src="js/cufon-yui.js"></script>
  <script type="text/javascript" src="js/arial.js"></script>
  <script type="text/javascript" src="js/cuf_run.js"></script>
</body>
</html>
