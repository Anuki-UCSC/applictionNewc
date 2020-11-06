<?php include('../config/database.php');?>
<?php include('../models/reg_userIshan.php');?>


 <?php session_start(); 
//print_r($_SESSION);?>

 <?php if (!isset($_SESSION['first_name'])) {
    header('Location: ../index.php');
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Boarding Owner Page</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" type="text/css" href="../resource/css/main.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../resource/css/nav1.css"> -->
	<link rel="stylesheet" type="text/css" href="../resource/css/nav.css">





    
   <link rel="stylesheet" href="../resource/css/requestlistIshan.css"> 
    
    <link rel="stylesheet" href="../resource/css/footer.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



</head>
<body>
<div class="container" id="container">
        <div class="header">
            <div class="logo">
                <h1><b style="color: rgb(13, 13, 189)">B</b>odima<small style="font-size: 14px; color:rgb(13, 13, 189);">   Solution for many problem</small></h1>
            </div>
            <div class="sign">
                <?php if(!isset($_SESSION['email'])){echo '<a href="../controller/logingController.php?click1">Sign In <i class="fa fa-sign-in"></i></a>';}?>
                <?php if(isset($_SESSION['email'])){ 
                    ?>
                    <div class="notification"><i class="fa fa-bell"></i></div>
                    <div class="profile"><a href="profile.php"> <i  class="fa fa-user-circle"></a></i></div>
                <?php
                    echo '<div class="user">Hi '.$_SESSION['first_name'].'</div>'; 
                    echo '<a href="../controller/logoutController.php">Sign out <i class="fa fa-sign-out"></i></a>';}
                ?> 
                
            </div>
        </div>
        <div class="nav">
            <ul class="nav_bar">
                <li class=" nav_item "><a href="../index.php"><i class=" fa fa-home"></i>Home</a></li>
                <li class="nav_item "><a href="boardings.php"><i class="fa fa-bed"></i> Boardings</a></li>
                <?php if(isset($_SESSION['email']))
                { 
                    
                    if($_SESSION['level']=='boardings_owner')
                    {
                        echo '<li class="nav_item "><a href="ConBODealIshan.php"><i class="fa fa-clone"></i> Confirm Deal</a></li>';
                    }
                    // if($_SESSION['level']=="boarder"  || $_SESSION['level']=="boardings_owner" )
                     echo '<li class="nav_item "><a href="foodposts.php"><img style="height:17px; height:17px; " src="../resource/img/hamburger-solid.svg"></i> Order Foods</a></li>';
                }
                    ?>
                <li class="nav_item "><a href="# "><i class="fa fa-address-card"></i> About us</a></li>
                <li class="nav_item "><a href="# "><i class="fa fa-address-book"></i> Contact Us</a></li>
                <?php if(!isset($_SESSION['email'])){ echo '<li style="background-color:#3f3941" class="nav_item "><a  href="# "><i class="fa fa-user-plus"></i>  Register</a></li>'; }?>
            </ul>
        </div>


<div class="container">
    <div class="new-order">
        <h5 >Tempory Request List</h5>
    </div>

<main role="main">

      <section >
        <div >
            <?php
                
               //$BO_email=$_SESSION['email'];
               $BOid=$_SESSION['BOid'];
               $data=reg_userIshan::SelectBOtemRequest($BOid,$connection);


			 if ($data) {
			 	$i=0;

			 	while ($user=mysqli_fetch_assoc($data)) {
			 		$i++;
			 		?>
			 		<div class="item-wrap">
                       <h3>Request  :<?php echo $i?></h3>
                      
                    <div class="cart-item">
                    <img src="<?php echo $user['image']; ?>" style="width:140px;height:150px;">
                    <form action="../controller/TemReqBOIshan.php" method="post">

                          <div class="product-details">
                            
                            <h5>Student Eamil :<span><?php echo $user['student_email']; ?></span></h5>

                            
                          
                        </div>
                       

                         <h4>Request :<span><?php echo $user['message']; ?></span></h4>
                      

                        <h4>Request Date :<span><?php echo $user['date']; ?></span></h4>


                            

                            <div class="btn1">
                                 <input type="hidden" name='B_post_id' value="<?php echo $user['B_post_id']; ?>">
                                <input type="hidden" name='student_email' value="<?php echo $user['student_email']; ?>">
                               <input type="hidden" name='city' value="<?php echo $user['city']; ?>">
                                <!--<input type="hidden" name='email' value="<?php //echo $email; ?>">
                                <input type="hidden" name='first_name' value="<?php //echo $first_name; ?>">
                                <input type="hidden" name='last_name' value="<?php//echo $last_name; ?>"> -->
                                <button class="btn5" name="accept" type="submit">Accept</button>
                                <button class="btn2" name="remove" type="submit">cancel</button>
                            </div>
                        
                    </div>
                </div>
            </form>
                <?php
                    }
                }else{
                    echo "No Pending Requests.";
                }
                //echo $user['date'];
            ?>

			 	
			 		<!-- 
			 		 <p >Student Email:<?php   ?></p> 

			 		 <p >Boarding post id:<?php //echo $user['B_post_id'] ?></p>
                      <p ><?php //echo $user['message'] ?></p>
                      <p>

                        <a  href="accept.php?B_post_id=<?php //echo $user['B_post_id']?> & student_email=<?php //echo $user['student_email']?>">Accept</a>
                        <a  href="reject.php?B_post_id=<?php //echo $user['B_post_id']?> & student_email=<?php //echo $user['student_email']?>">Reject</a>
                      </p>
                    <small><i><?php //echo $user['date'] ?></i></small>
                    <hr>
 -->
                  
           






            
           
          
        </div>
          
      </section>

    </main>

</div>
</body>
</html>
<?php include 'footer.php'?>
<?php $connection->close(); ?>









                
                          