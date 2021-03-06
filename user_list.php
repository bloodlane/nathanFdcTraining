<?php 
	include('api.php');
	$number_of_users = count_users();
	echo "Number of users = ".$number_of_users;
	echo "<br>";
	//$limit = trim($_GET['entries']);
	$limit = isset($_GET['entries'])?$_GET['entries']:10;
	echo "Limit: ".$limit."<br>";
	$num_of_pages = ceil($number_of_users / $limit);
	echo "Number of pages=".$num_of_pages."<br>";

	$page = isset($_GET['page'])?$_GET['page']:1;
	echo "Page value :".$page."<br>";
	

	$start=$limit*($page-1);
	echo "Starting value: ".$start."<br>";

	$newLimit= $limit;
	echo "New Limit value: ".$newLimit."<br>";
	$users = get_users($limit, $start);



 ?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="../nathan/jquery/jquery.min.js"></script>
	    <script src="../nathan/js/bootstrap.min.js"></script>
	    <link rel="stylesheet" href="../nathan/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

		<script>
			$(document).ready(function(){
				$('#entries').change(function(){ 
					$('#pagination_form').submit();
				});
			});
		</script>

 		<div class="container">
  		  	<a href="index.php">Registration form</a>	|
  		  	<a href="search.php">Search a user</a>		
 		  	<h2>User list</h2>

 		  	
			<div class="col-lg-1">
					<form id="pagination_form">
					<select class="form-control" name="entries" id ="entries">
						<option value="" selected disabled><?php echo "Limit:".$limit; ?></option>
						<option <?php echo (isset($_GET['entries']) && $_GET['entries'] == '10') ? 'selected' : '' ?>>10</option>
						<option <?php echo (isset($_GET['entries']) && $_GET['entries'] == '20') ? 'selected' : '' ?>>20</option>
					</select>
				</form>				
			</div>

			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>Id</th>
						<th >Firstname</th>
						<th >Middlename</th>
						<th >Lastname</th>
						<th >Gender</th>
						<th style="min-width:100px; text-align: center">Birthdate</th>
						<th style="min-width:150px; text-align: center">Created date</th>
						<th style="min-width:150px; text-align: center">Modified date</th>
						<th style="min-width:150px; text-align: center">Created IP</th>
						<th style="min-width:150px; text-align: center">Modified IP</th>
						<th colspan="2" style="text-align: center">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$count = 1;
					foreach ($users as $u) { ?>
					<tr>
						<td style="text-align: center"><?php echo $count++ ?></td>
						<td style="text-align: center"><?php echo $u['firstname'] ?></td>
						<td style="text-align: center"><?php echo $u['middlename'] ?></td>
						<td style="text-align: center"><?php echo $u['lastname'] ?></td>
						<td style="text-align: center"><?php echo $u['gender'] ?></td>
						<td style="text-align: center"><?php echo $u['birthdate'] ?></td>
						<td style="text-align: center"><?php echo $u['created_date'] ?></td>
						<td style="text-align: center"><?php echo $u['modified_date'] ?></td>
						<td style="text-align: center"><?php echo $u['created_ip'] ?></td>
						<td style="text-align: center"><?php echo $u['modified_ip'] ?></td>
						<td>
							<a class="btn btn-info" href="update_user.php?id=<?php echo $u['user_id']?>">
					          <span class="glyphicon glyphicon-pencil"></span> Update
					        </a>
						</td>
						<td>
							<a class="btn btn-danger" href="delete.php?id=<?php echo $u['user_id']?>" onclick="confirm('Are you sure?'); ">
							<span class="glyphicon glyphicon-trash"></span> Delete
							</a>
						</td>

					</tr>

				<?php } ?>
				</tbody>
			</table> 
					<ul class="pagination">
					  <li class="previous"><a href="user_list.php?page=<?php if($page==1){echo $page=1;}else{echo $page-1;} ?>">Prev</a></li>
			<?php 
					for($i = 1; $i<=$num_of_pages; $i++){		?>
					  <li class="<?php if($i==$page){echo 'active';} ?>"><a href="user_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php   }											?>
					  <li class="next"><a href="user_list.php?page=<?php if($page==$num_of_pages){echo $page=$num_of_pages;}else{echo $page+1;} ?>">Next</a></li>
					</ul>
		</div >
	</body>
</html>

<?php 

  ?>