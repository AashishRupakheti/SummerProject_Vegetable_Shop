<?php
	include('connection.php');
	session_start();
	if(isset($_SESSION['userid'])){
		$id=$_SESSION['userid'];
	}
	
?>
<?php
	//control navigation bar	
	if(isset($_SESSION['userid'])){

		
	}
	else{
		$signupBtn= "";
		$loginBtn=" ";
		$cartBtn="";
		$notifiBtn="";
	}
	
	if(isset($_POST[""])){
		session_unset();
		header('location:index.php');
	}
	
	
?>



<!DOCTYPE html>
<html>
<head>
	<title>user</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="Resources/bootstrap-3.4.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="Resources/css/mystyle.css">
	<link rel="stylesheet" href="Resources/css/login.css">
	<script src="Resources/jquery/jquery.min.js"></script>
	<script src="Resources/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
  

  
  
</head>
<body >


	<!-- Navigation bar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button> 
				<a class="navbar-brand" href="admin.php">Rupakheti General - Admin</a>
			</div>
			<!--<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li><?php      echo $signupBtn;                  ?></li>
					<li><?php      echo $loginBtn;                  ?></li>
					<li><?php      echo $notifiBtn;                  ?></li>
					
				</ul>
			</div>
		</div>-->
	</nav>
	<div style="height:50px"></div>


	<!-- Header -->
	<div class="jumbotron text-center" style="background-image: url('images/slide5.jpg');background-size: cover;margin-bottom: 0px;">
		<h1><font color="white">Rupakheti General Suppliers</font></h1>
		<p><font color="white"><b>Stay Home Save Time</b> !!</font></p>
	</div>		


	<div>
		<ul class="nav-justified" style="background-color:green;">
			<li></li>
			<li class="active"><a href="admin.php" style="color:white" >Home</a></li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white">Orders <span class="caret"></span></a>
				<ul class="dropdown-menu" >
					<li><a href="admin_orders.php?type=new">New</a></li>
					<li><a href="admin_orders.php?type=shiped">Shiped</a></li>
					<li><a href="admin_orders.php?type=history">History</a></li>
				</ul>
			</li>
			<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" style="color:white">Items <span class="caret"></span></a>
				<ul class="dropdown-menu" >
					<li><a href="item.php?type=view">View / Remove</a></li>
					<li><a href="item.php?type=add">Add New</a></li>
				</ul>
			</li>
			<li><a href="admin_user.php" style="color:white">Users</a></li>
			<!--<li><a href="about.php" style="color:white">About us</a></li>-->
		</ul>
	</div>
	<hr>
		
	



 
 
	<!-- Content -->

	<div class="container">
		<div class="row container-fluid ">
		<h2 class='text-center'>Items</h2><br>
		
		<?php

			$status=$_GET['type'];
			
			//view items
			if($status=='view'){
				
				echo "<form method='post'>
				<select id='item' name='category' style='display: inline-block;border: 1px solid #ccc;box-sizing: border-box;border-radius:20px;width:52%;height:30px'>
					<option value='Vegetables'>vegetables</option>
					<option value='Fruits'>Fruits</option>
					
				</select><br><br>
				
				<button type='submit' name='category_view' class='logbutton'>View Items</button>
				</form>";
				
				if(isset($_POST['category_view'])){
					$category=$_POST['category'];
					echo "<h3>Item List</h3>";
					echo "<div class='col-md'>";
					echo "<div style='border-radius: 25px'>";
					echo "<table style='table-layout:fixed;width:100%'>";
					echo "<tr>";
					echo "<th>ID</th><th>Name</th><th>Brand</th><th>Price</th><th>Quantity</th>";
					echo "</tr>";

					$query4="SELECT * from product where product_category='$category'";
					$result4=mysqli_query($sql_connection,$query4);
					while($row=mysqli_fetch_assoc($result4)){
						echo "<tr>";
						echo "<td>";
						echo $row['product_id'];
						echo "</td>";
						echo "<td>";
						echo $row['product_name'];
						echo "</td>";
						echo "<td>";
						echo $row['product_brand'];
						echo "</td>";
						echo "<td>";
						echo "Rs. ".$row['product_price']." .00";
						echo "</td>";
						echo "<td>";
						echo $row['product_size']." Kg";
						echo "</td>";
						

						$productid=$row['product_id'];

						echo "<td><a href='item.php?remove=$productid&type=view' class='viewbtn'>Remove</a></td>";
						echo "</tr>";
						echo "<tr><td colspan='6'><hr></td></tr>";	
					}
					
					echo "</table>";
					echo "</div>";
					echo "</div>";
	
				}
			
			
				//delete item
				 if(isset($_GET['remove'])){
					$product_id=$_GET['remove'];
					$query6="delete from product where product_id='$product_id'";
					$result6=mysqli_query($sql_connection,$query6);
					
					if($result6){
						echo '<script type="text/javascript">alert("Item Removed!");window.location.href = "item.php?type=view";</script>';
					}else {
						'<script type="text/javascript">alert("Item Removing failed!");window.location.href = "item.php?type=view";</script>';
					}
				}
			}

			//add items
			if($status=='add'){
				echo "<form method='post' enctype='multipart/form-data'>
				Name<br><input type='text' name='name' required><br>
				Brand<br><input type='text' name='brand' required><br>
				Category<br>
				<select name='category' id='category' style='display: inline-block;border: 1px solid #ccc;box-sizing: border-box;border-radius:20px;width:52%;height:30px'>
					<option value='Vegetables'>Vegetables</option>
					<option value='Fruits'>Fruits</option>
					
				</select><br><br>
				Price (Rs)<br><input type='text' name='price' required><br>
				Quantity (Kg)<br><input type='text' name='size' required><br>
				
				Description<br><textarea name='description' rows='5' style='display: inline-block;border: 1px solid #ccc;box-sizing: border-box;border-radius:20px;width:52%;' required></textarea>
				<br>
				
				<input type='file' name='image'><br>
				<button type='submit' name='item_add' class='logbutton'>Submit</button>
				<button type='reset' name='reset' class='logbutton'>Reset</button>
				
				
				
				</form>";

				
				if(isset($_POST['item_add'])){
					$name=$_POST['name'];
					$brand=$_POST['brand'];
					$category=$_POST['category'];
					$price=$_POST['price'];
					$size=$_POST['size'];
					
					$description=$_POST['description'];
					
					//image upload
					$target="product_images/".basename($_FILES['image']['name']);
			
					$image=$_FILES['image']['name'];
		
					$query5="insert into product (product_name,product_brand,product_category,product_price,product_size,product_description,product_image) values ('$name','$brand','$category','$price','$size','$abv','$description','$image')";
					$result5=mysqli_query($sql_connection,$query5);
					
					move_uploaded_file($_FILES['image']['tmp_name'],$target);
					
					if($result5){
						echo '<script type="text/javascript">alert("Item adding succesfully!");window.location.href = "item.php?type=add";</script>';
					}else{
						echo '<script type="text/javascript">alert("error!");window.location.href = "item.php?type=add";</script>';
					}
				
				}
				
				
			}

		?>	
	
		</div>	
	</div>


	<!-- Footer -->
	<footer class="page-footer font-small pt-4" style="background-color:green;color:white;">
		<div style="height:20px;"></div>
		<div class="container-fluid text-center ">
			<div class="row">
					<h3 class="text-uppercase">Rupakheti General Suppliers</h3>
					<p>Natural items the effect of freshness!!!</p>
			</div>
		</div>
		<div class="footer-copyright text-center py-3" style="background-color:white;color:red">
			<h3>© 2065 Rupakheti General Suppliers. All Rights Reserved | Design by Aashish!</h3> 
		</div>

	</footer>
	<!-- Footer -->



</body>
</html>

<?php
	
	
	mysqli_close($sql_connection);
	
?>

