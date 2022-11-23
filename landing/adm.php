<?php
include 'db_utf8.php';
include 'function.php';	
$l = '';
$str_l = '';
$current_login = '';
isset( $_POST['l'] ) ? $str_l = $_POST['l'] : $str_l = $_GET['l'];

if ($str_l == '')
	header('Location: ../');
else{
	$str_l = getLogin($str_l , 0);
	$l = $str_l;
	$current_login = getLogin($str_l , 3);
	$str_l = getLogin($str_l , 1);
}
$login_role = getVal("rec_user",$current_login,"rec_role","rec_usr");
//$id = getVal("rec_user",$current_login,"rec_ID","rec_usr");
if ($login_role != 'Super')
	header('Location: user_self.php?l='.$l);
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>BBS Recruit management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="../images/BBS_logo.ico">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/css.css">
	<link rel="stylesheet" href="css/jquery.multiselect.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/datepicker.css">
	<link rel="stylesheet" href="css/tab.css">
	<style type="text/css">
		ul,li { margin:0; padding:0; list-style:none;}
	</style>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.multiselect.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1 style="background-color: #fff;"><a href="index.html" class="logo"><img src="../images/BBS_logo.jpg" width="80" height="46"></a></h1>
				<ul class="list-unstyled components mb-5">
					<li><a href="index.php?l=<?php echo $l?>"><span class="fa fa-home"></span> Home</a></li>
					<li><a href="form.php?l=<?php echo $l?>"><span class="fa fa-sticky-note"></span> FORM</a></li>
					<li><a href="search.php?l=<?php echo $l?>"><span class="fa fa-search"></span> SEARCH</a></li>
					<li class="active"><a href="admin.php?l=<?php echo $l?>"><span class="fa fa-cog"></span> ADMIN</a></li>
					<li><a href="user.php?l=<?php echo $l?>"><span class="fa fa-user"></span> USER</a></li>
					<li><a href="report.php?l=<?php echo $l?>"><span class="fa fa-folder-open"></span> REPORT</a></li>
					<li><a href="../"><span class="fa fa-sign-out"></span> LOGOUT</a></li>
				</ul>
				<footer><div class="footer"><p>Copyright &copy;2022 <a href="http://bbssolution.com/" target="_blank">BBS Solution Co., Ltd.</a> All rights reserved.</p></div></footer>
			</nav>
			<!-- Page Content  -->
			
			<div id="content" class="p-4 p-md-5">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="btn btn-primary"><i class="fa fa-bars"></i><span class="sr-only">Toggle Menu</span></button>
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="nav navbar-nav ml-auto">
								<ul class="nav navbar-nav ml-auto">
								<li class="nav-item"><a class="nav-link" href="admin.php?l=<?php echo $l?>">[ Company ]</font></a></li>
								<li class="nav-item"><a class="nav-link" href="jobs.php?l=<?php echo $l?>">[ Position ]</a></li>
								<li class="nav-item"><a class="nav-link" href="admin_language.php?l=<?php echo $l?>">[ Programming Language ]</a></li>
								<li class="nav-item"><a class="nav-link" href="admin_module.php?l=<?php echo $l?>">[ SAP Modules ]</a></li>
								<?php if ($current_login == 'admin'){?>
									<li class="nav-item active"><a class="nav-link" href="adm.php?l=<?php echo $l?>"><font color="#0891f8">[ Admin ]</font></a></li>
								<?php }?>
							</ul>
							</ul>
					</div>
				</div>
				</nav>
				<?php
					$txtQuery = "";
					isset( $_POST['radTab'] ) ? $radTab = $_POST['radTab'] : $radTab = "";
					isset( $_POST['radTable'] ) ? $radTable = $_POST['radTable'] : $radTable = "";
					//echo "radTab - ".$radTab.'<br>';
					//echo "radTable - ".$radTable.'<br>';
					$th = '';
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							isset( $_POST['txtQuery'] ) ? $txtQuery = $_POST['txtQuery'] : $txtQuery = "";
							if (isset($txtQuery) && ($txtQuery!='')){
								//echo "query - ".$txtQuery.'<br>';
								$col = 0;
								if ($radTab == "DESCRIBE"){
									$th = '<tr class="header"><th style="width:20%;">Name</th><th style="width:20%;">Type</th><th style="width:10%;">Null</th><th style="width:10%;">Key</th><th style="width:10%;">Default</th><th>Extra</th></tr>';
									$col = 6;
								}elseif ($radTab == "SELECT"){
									$sql_col ="DESCRIBE ".$radTable;
									$stmt_col = $con->query($sql_col);
									$th = '<tr class="header">';
									while ($result_col = $stmt_col->fetch()) {
										$th .= '<th style="width:20%;">'.$result_col[0].'</th>';
										$col++;
									}
									$th .= '</tr>';
								}else
									$th = '';
							}
							//echo 'col - '.$col;
						}
					}
				?>
				<form id="frmRecruit" name="frmRecruit" method="POST" action="adm.php"><input type="hidden" id="l" name="l" value="<?php echo $l?>">
					<div class="part_form">
						<table border="0" style="width:100%;" id="tabSearch" class="tabForm_part">
						<tr> 	
							<td style="width:10%;text-align:right">Command</td>
							<td><textarea id="txtQuery" name="txtQuery" rows="5" style="width: 100%"><?php echo $txtQuery?></textarea></td>
							<td style="width:20%" style="text-align:center">
								<button type="submit" class="btn btn-lg btn-primary"  id="btn_search" name="btn_search" value="search"><i class="fa fa-search"></i> Query</button>
							</td>
						</tr>
						<tr> 	
							<td colspan="3">
							<label class="lblcontainer" onclick="changeMethod('DESCRIBE')">
								<input type="radio" class="lblcontainer" id="rad_DESCRIBE" name="radTab" value="DESCRIBE" <?php echo ($radTab == "DESCRIBE" ? "checked" : "") ?>>&nbsp;DESCRIBE {table}
							</label><br/>
							<label class="lblcontainer" onclick="changeMethod('SELECT')">
								<input type="radio" class="lblcontainer" id="rad_SELECT" name="radTab" value="SELECT" <?php echo ($radTab == "SELECT" ? "checked" : "") ?>>&nbsp;SELECT * FROM {table} where 1 and (flag_delete ='N')
							</label><br/>
							<label class="lblcontainer" onclick="changeMethod('DELETE')">
								<input type="radio" class="lblcontainer" id="rad_DELETE" name="radTab" value="DELETE" <?php echo ($radTab == "DELETE" ? "checked" : "") ?>>&nbsp;DELETE FROM {table} where
							</label><br/>
							<label class="lblcontainer" onclick="changeMethod('TRUNCATE')">
								<input type="radio" class="lblcontainer" id="rad_TRUNCATE" name="radTab" value="TRUNCATE" <?php echo ($radTab == "TRUNCATE" ? "checked" : "") ?>>&nbsp;TRUNCATE {table} 
							</label><br/>
							</td>
						</tr>
						</table>
					</div><br/>
				
				
				<input type="text" id="txtKeySearch" onkeyup="myFunction()" placeholder="Search.." style="width:100%;">
				<table  style="width:100%;" border="1">
				<tr>
					<td style="width:20%;vertical-align: top;">
						<table  style="width:100%;" border="0">
						<tr class="header">
							<th style="width:20%;">Table</th>
						</tr>
						<?php
							$sql_tab ="SHOW TABLES";
							$stmt_tab = $con->query($sql_tab);
							$rows_tab = $stmt_tab->rowCount();
							while ($result_tab = $stmt_tab->fetch()) {
						?>
							<tr>
								<td style="vertical-align: top;">
									<label class="lblcontainer">
										<input type="radio" class="lblcontainer" name="radTable" onclick="setQuery(this.value)" value="<?php echo $result_tab[0]?>" <?php echo ($radTable == $result_tab[0] ? "checked" : "") ?>>
										&nbsp;<?php echo $result_tab[0]?>
									</label>
								</td></tr>
						<?php }?>
						</table>
					</td>
					<td style="vertical-align: top;">
						<table  style="width:100%;" id="tabRecord" border="1">
						<?php echo $th;?>
						<?php
							if ($txtQuery!=''){
								$rows_res = 0;
								try {
									$stmt = $con->query($txtQuery);
									$rows_res = $stmt->rowCount();
								}catch (Exception $e){
									echo '<font color="red">Error --> </font>'.$e;
								}
								if ($rows_res>0){
									echo 'Record : '.$rows_res;
									while ($result_res = $stmt->fetch()) {
						?>
						<tr>
							<?php 
								for ($x = 0; $x < $col; $x++) {
							?>
								<td style="vertical-align: top;"><?php echo $result_res[$x]?></td>
							<?php }?>
						</tr>
						<?php } //end while
							}?>
						</table>
						<?php } // end if txtQuery
						?>
					</td>
				</tr>
				</table>
				</form>
			</div>
			
		</div>
		
		<!-- Start Modal Alert -->
		<div class="modal" id="modalAlert">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content" id="modalContentAlert"></div>
			</div>
		</div>
		<!-- End Modal Alert -->
	<script type="text/javascript"> 
	function setQuery(v){
		if ($('#rad_DESCRIBE').is(':checked'))
			$( "#txtQuery" ).val($( "#rad_DESCRIBE" ).val()+' '+v);
		else if ($('#rad_TRUNCATE').is(':checked'))
			$( "#txtQuery" ).val($( "#rad_TRUNCATE" ).val()+' '+v);
		else if ($('#rad_SELECT').is(':checked'))
			$( "#txtQuery" ).val($( "#rad_SELECT" ).val()+' * FROM '+v);
		else if ($('#rad_DELETE').is(':checked'))
			$( "#txtQuery" ).val($( "#rad_DELETE" ).val()+' FROM '+v +' WHERE');
		else
			$( "#txtQuery" ).val(v);
	}
	function changeMethod(v){
		$( "#txtQuery" ).val(v);
	}
	function myFunction() {
		  // Declare variables
		  var input, filter, table, tr, td0, td1, td2,td3, td4, td5, i, txtValue0, txtValue1, txtValue2,txtValue3, txtValue4, txtValue5;
		  input = document.getElementById("txtKeySearch");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("tabRecord");
		  tr = table.getElementsByTagName("tr");
		//alert(tr.length);
		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
				td0 = tr[i].getElementsByTagName("td")[0];
				td1 = tr[i].getElementsByTagName("td")[1];
				td2 = tr[i].getElementsByTagName("td")[2];
				td3 = tr[i].getElementsByTagName("td")[3];
				td4 = tr[i].getElementsByTagName("td")[4];
				td5 = tr[i].getElementsByTagName("td")[5];
				
				
				if (td0 || td1 || td2 || td3 || td4 || td5 ) {
						txtValue0 = td0.textContent || td0.innerText;
						txtValue1 = td1.textContent || td1.innerText;
						txtValue2 = td2.textContent || td2.innerText;
						txtValue3 = td3.textContent || td3.innerText;
						txtValue4 = td4.textContent || td4.innerText;
						txtValue5 = td5.textContent || td5.innerText;
						if ((txtValue0.toUpperCase().indexOf(filter) > -1) 
						||(txtValue1.toUpperCase().indexOf(filter) > -1) 
						||(txtValue2.toUpperCase().indexOf(filter) > -1) 
						||(txtValue3.toUpperCase().indexOf(filter) > -1) 
						||(txtValue4.toUpperCase().indexOf(filter) > -1) 
						||(txtValue5.toUpperCase().indexOf(filter) > -1)  )
						{
							tr[i].style.display = "vertical-align: top;";
						} 
						else {
							tr[i].style.display = "none";
						}
				}
		  }
	}
	</script>

     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>
  </body>
</html>