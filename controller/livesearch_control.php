

<?php
$connect = mysqli_connect("localhost", "root", "", "ishanbodima");
$output = '';


// $qry[]=$_POST["qry"];
if(isset($_POST["qry"]))
{
	$search = mysqli_real_escape_string($connect,$_POST["qry"]);
	$query = "
	SELECT * FROM boarding_post 
	WHERE category LIKE '%".$search."%'
	OR girlsBoys LIKE '%".$search."%' 
	OR person_count LIKE '%".$search."%' 
	OR cost_per_person LIKE '%".$search."%' 
	OR lane LIKE '%".$search."%'
	OR city LIKE '%".$search."%'
	OR district LIKE '%".$search."%'
	OR description LIKE '%".$search."%'
	";
	// return $query;
}
else
{
	$query = "
	SELECT * FROM boarding_post ORDER BY B_post_id";

	// return $query;
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
		<div class="table-responsive">
		<table class="table table bordered">
			<tr>
				<th class="img_th" rowspan=6>
				<div class="inner_img">
				<img src="'.$row["image"].'" class="profile_image" alt="" >
				</div>
				</th>
				<th>No</th><td>'.$row["B_post_id"].'</td>
			</tr>
			<tr>
				<th>Address</th><td>'.$row["lane"].', '.$row["city"].'</td>
			</tr>
			<tr>
				<th>City</th><td>'.$row["city"].'</td>
			</tr>
			<tr>
				<th>girls/boys</th><td>'.$row["girlsBoys"].'</td>
			</tr>
			<tr>
				<th>cost per person</th><td>'.$row["cost_per_person"].'</td>
			</tr>
			<tr>
				<th>description</th><td>'.$row["description"].'</td>
			</tr>
		</table>
		</div>
		';
	}
	echo $output;
}
else
{
	echo 'Search with another keyword';
}
?>