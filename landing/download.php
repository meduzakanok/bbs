<?php
	    include_once 'db.php';

	    if (isset($_GET['id'])) 
	    {
			$id = $_GET['id'];
			$query = "SELECT * FROM candidate_file WHERE file_id = '$id'";
			$stmt_cfile = $con->query($query);
			 //list($fileid, $filename, $filetype, $size,$data) = mysqli_fetch_array($result);
			//$row = mysqli_fetch_array($result);
			$row_cfile = $stmt_cfile->fetch();
			$data = $row_cfile["data"];
			$size = $row_cfile["size"];
			$filetype = $row_cfile["filetype"];
			$filename = $row_cfile["filename"];
			
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
			 //mysqli_close($con);
			 exit;
	    }
 ?>
