<?php
    include("connection.php");
	
  	$cmd = $_REQUEST['cmd'];
	switch($cmd){
		case "add":
			  if(empty($_REQUEST['id']))
				{
				///Insertion
				$sql = "INSERT INTO `users` (`first_name`, `last_name`, `address`)
					 VALUES ('".$_REQUEST['first_name']."', '".$_REQUEST['last_name']."', '".$_REQUEST['address']."');";
				}
				else
				{
					$sql = "update `users` set `first_name`='".$_REQUEST['first_name']."', 
							`last_name`='".$_REQUEST['last_name']."', 
							`address`='".$_REQUEST['address']."' WHERE id='".$_REQUEST['id']."'";
				}
					 
				$result = $conn->query($sql); 
				
				break;		
	     case "edit":
			   //retrive data
				$sql = "SELECT * FROM users where id='".$_REQUEST['id']."'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					// output data of each row
					$i=-1;
					while($row = $result->fetch_assoc()) {
						$i++;
						$arr[$i]['id'] = $row["id"];
						$arr[$i]['first_name'] = $row["first_name"];
						$arr[$i]['last_name'] = $row["last_name"];
						$arr[$i]['address'] = $row["address"];
					}
				} else {
					echo "0 results";
				}
				$conn->close();
				echo json_encode($arr);
				/////////////////////////////// 
			break;
			 
		case "delete": 
			   //retrive data
				$sql = "Delete FROM users where id='".$_REQUEST['id']."'";
				$result = $conn->query($sql);
				$conn->close();
				///////////////////////////////
		    break;  
		case "load_data": 
		    //load all data
			$sql = "SELECT * FROM users ORDER BY id DESC";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				$i=-1;
				while($row = $result->fetch_assoc()) {
					$i++;
					$arr[$i]['id'] = $row["id"];
					$arr[$i]['first_name'] = $row["first_name"];
					$arr[$i]['last_name'] = $row["last_name"];
					$arr[$i]['address'] = $row["address"];
				}
			  }
			echo json_encode($arr);
			break;			  	
		default:
		    //load all data
			$all_data = load_data($conn);
			echo json_encode($all_data);
			break;			  	  		
	}
?>