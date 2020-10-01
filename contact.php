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
          <li><a href="sponsor.php">Sponsors</a></li>
          <li class="active"><a href="contact.php">Contact Us</a></li>
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
        <div class="article-species contact">
          <h2>Contact</h2>
          <p>Please call us on  12125 12542 or email <a href="mailto:enquiries@claybrookzoo.co.uk">enquiries@claybrookzoo.co.uk</a></p>
          <p>Any feedback would be appreciated.</p>
          <p> Thank you for Visiting!!</p>
        </div>
        <!-- <div class="article">
          <h2>Send us mail</h2>
          <form action="#" method="post" id="sendemail">
            <ol>
              <li>
                <label for="name">Name (required)</label>
                <input id="name" name="name" class="text" />
              </li>
              <li>
                <label for="email">Email Address (required)</label>
                <input id="email" name="email" class="text" />
              </li>
              <li>
                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="8" cols="50"></textarea>
              </li>
              <li>
                <input type="submit" value="Submit" name="Submit"/>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
        </div> -->
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
        <li><a href="sponsor">Sponsors</a></li>
        <li class="active"><a href="contact.php">Contact Us</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
</body>
</html>
