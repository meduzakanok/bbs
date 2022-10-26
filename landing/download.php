<?php
	    include_once 'db.php';

	    if (isset($_GET['id'])) 
	    {
			 $id = $_GET['id'];
			 $query = "SELECT * FROM candidate_file WHERE file_id = '$id'";
			 $result = mysqli_query($con,$query) or die('Error, query failed');
			 //list($fileid, $filename, $filetype, $size,$data) = mysqli_fetch_array($result);
			$row = mysqli_fetch_array($result);
			$data = $row["data"];
			$size = $row["size"];
			$filetype = $row["filetype"];
			$filename = $row["filename"];
			
			header("Content-length: strlen($data)");
			header("Content-type: $filetype");
			header("Content-Disposition: attachment; filename=$filename"); 
			 
			//header("Content-length: strlen($data)");
			//header("Content-type: $filetype");
              //header("Content-disposition: download; filename=$filename"); //disposition of download forces a download
               //echo $data;
			
			 ob_clean();
			 flush();
			 //$data = stripslashes($row["data"]);
			 echo $data;
			 mysqli_close($con);
			 exit;
	    }
 ?>
