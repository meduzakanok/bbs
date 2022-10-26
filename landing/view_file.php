<!-- 
		Author: Sampath Kumar Medarametla
		Email: skmeadarametla@gmail.com
		All rights reserved to Sampath Kumar Medarametla
		Free to use with copyright
		Date: 7/9/2015
-->
<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Uploaded files</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
<label>Uploaded files</label>
</div>
<div id="body">
<a href="logon-home.php"><img src="img/home.png" width="60px" height="60px" alt="home.png" align="left"/></a>
<a href="index.php"><img src="img/back.png" width="60px" height="60px" alt="home.png" align="left"/></a>

	<table width="80%" border="1">
    <tr>
    <th colspan="4"><tt style="font-family:Trebuchet MS;color:black; font-size:20px;"><a href="index.php">Click here to upload new files</a></tt></th>
    </tr>
    <tr bgcolor="#005CE6" style="font-family:Trebuchet MS;color: white; font-size:20px;">

    <td>File name</td>
    <td>File Type</td>
    <td>File size<sub style="font-size:10px">(In KB)</sub></td>
    <td>Download Link</td>
    </tr>
    <?php
	$sql="SELECT * FROM candidate_file";
	$result_set=mysqli_query($con,$sql);
	if (mysqli_num_rows($result_set) == 0) {
            echo "Database is empty <br>";
        } 


        else {
            while (list($file_ID,$candidate_ID, $filename,$filetype,$size,$data) = mysqli_fetch_array($result_set)) {
                ?>
                <tr bgcolor="#D6E5FB" style="word-wrap: break-word; font-family:Trebuchet MS;color: #FF6600; font-size:15px;">
                <td><?php echo $filename; ?>111</td>
                <td>
                <?php 
                
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if($ext=="doc"||$ext=="docx")
				{
					echo '<img src="img\word.png" alt="word.png" width="40px" height="40px"/>';
				
					
				}

				else if($ext=="pdf"||$ext=="PDF")
				{
					echo '<img src="img\pdf.png" alt="word.png" width="40px" height="40px"/>';
				}

				else if($ext=="xls"||$ext=="xlsx"||$ext=="XLSX"||$ext=="XLS")
				{
					echo '<img src="img\excel.png" alt="word.png" width="40px" height="40px"/>';

				}
				


			else if($ext=="jpeg"||$ext=="jpg"||$ext=="png"||$ext=="JPEG"||$ext=="JPG"||$ext=="PNG"||$ext=='gif'||$ext=='GIF')
			{
		       		echo '<img src="img/photo.png" alt="word.png" width="40px" height="40px"/>';
	       	}
            
            else{
            	echo '<img src="img\misc.png" alt="word.png" width="40px" height="40px"/>';

            }    

                ?></td>
                <td><?php echo $size; ?></td>
                <td><a href="download.php?id=<?php echo urlencode($file_ID); ?>"
                   ><?php urlencode($filename);?>Download</a></td>
                </tr>
                <?php
            }
        }

	/*while($row=mysqli_fetch_array($result_set))
	{
		?>
        <tr>
        <td><?php echo $row['filename'] ?></td>
        <td><?php echo $row['filetype'] ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><a href="uploads/<?php echo $row['id'] ?>" target="_blank">view file</a></td>
        </tr>
        <?php
	}*/
	?>
    </table>
    
</div>
</body>
</html>
