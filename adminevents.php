<?php
	include('db/db_connect.php');
  if($_SESSION['sessUserType'] != "admin"){
  header('Location:login.php'); //if the user is not admin go to index page
  }
   if(isset($_GET['showResult'])) $showResult = '<h4>' . $_GET['showResult'] . '</h4>';
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
          <li><a href="addspecies.php">Add Species</a></li>
          <li><a href="manageSponsor.php">Sponsors</a></li>
          <li class="active"><a href="adminevents.php">Events</a></li>
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
          <div class="article Article">  
           <?php
            if (isset($_POST['submit'])) {
              $stmt = $pdo->prepare('INSERT INTO tb_events (event_description)
                   VALUES (:event_description)');
              $criteria = [
                'event_description' => $_POST['event_description']
               ];
              $stmt->execute($criteria);
            }
              ?>
          <table border="2" cellspacing="2">
            <td style="border:0; text-align:center; "> <?php echo @$showResult; ?></td> 
             <tr>
                <th>EVENT ID</th>
                <th>EVENT DESCRIPTION</th>
            </tr>
          <?php
           $event = $pdo->prepare('SELECT * FROM tb_events');
           $event->execute();
           foreach ($event as $event) { ?>
           <tr style="text-align: center;">
            <td> <?php echo $event['event_id']; ?></td> 
            <td> <?php echo $event['event_description']; ?></td> 
            <td>
              <a href="deleteEvent.php?event_id=<?php echo $event['event_id'];?>">Delete</a>
            </td>
           </tr>
          <?php }
            ?>
         </table>
          <h2>Add Events</h2>
          <form action="adminevents.php" method="POST" enctype="multipart/form-data">
            <label>Events Description</label>
            <textarea name="event_description"></textarea><br><br>
            <input type="submit" name="submit" value="Add" class="input" />
          </form>


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
        <li><a href="addspecies">Animals</a></li>
        <li><a href="manageSponsor.php">Sponsors</a></li>
        <li class="active"><a href="adminevents.php">Events</a></li>
      </ul>
      <div class="clr"></div>
    </div>
  </div>
</div>
</body>
</html>