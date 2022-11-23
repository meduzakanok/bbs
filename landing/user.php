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
	<link rel="stylesheet" href="css/tab.css">
	<style type="text/css">
		ul,li { margin:0; padding:0; list-style:none;}
	</style>
	<!--<script src="js/jquery.min.js"></script>-->
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.multiselect.js"></script>
	<script src="js/select2.min.js"></script>
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1 style="background-color: #fff;"><a href="index.html" class="logo"><img src="../images/BBS_logo.jpg" width="80" height="46"></a></h1>
				<ul class="list-unstyled components mb-5">
					<li><a href="index.php?l=<?php echo $l?>"><span class="fa fa-home"></span> Home</a></li>
					<li><a href="form.php?l=<?php echo $l?>"><span class="fa fa-sticky-note"></span> FORM</a></li>
					<li><a href="search.php?l=<?php echo $l?>"><span class="fa fa-search"></span> SEARCH</a></li>
					<li><a href="admin.php?l=<?php echo $l?>"><span class="fa fa-cog"></span> ADMIN</a></li>
					<li class="active"><a href="user.php?l=<?php echo $l?>"><span class="fa fa-user"></span> USER</a></li>
					<li><a href="report.html?l=<?php echo $l?>"><span class="fa fa-folder-open"></span> REPORT</a></li>
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
								<?php if ($login_role == 'Super'){?>
										<li class="nav-item active"><a class="nav-link" href="user.php?l=<?php echo $l?>"><font color="#0891f8">[ User List ]</font></a></li>
										<li class="nav-item"><a class="nav-link" href="user_self.php?l=<?php echo $l?>">[ User Profile ]</a></li>
								<?php }else{?>
									<li class="nav-item active"><a class="nav-link" href="user_self.php?l=<?php echo $l?>"><font color="#0891f8">[ User Profile ]</font></a></li>
								<?php }?>
							</ul>
					</div>
				</div>
				</nav>
				<table id="tabAdd" style="width:100%;" border="0">
				<tr>
					<td style="width:90%;"><input type="text" id="txtKeySearch" onkeyup="myFunction()" placeholder="Search.." style="width:100%;"></td>
					<td style="text-align:center">
						<button type="button" class="btn btn-primary" title="Add User" id="btn_add" name="btn_add" formaction="addedt_user.php?l=<?php echo $l?>&id=0"><i class="fa fa-plus-square-o"></i> Add User</button>
					</td>
				</tr>
				</table>
				<table style="width:100%;" border="0" id="tabRecord">
				<tr class="header">
					<th style="width:20%;">Name Surname</th>
					<th style="width:12%;">Nickname</th>
					<th style="width:10%;">Telephone</th>
					<th style="width:10%;">LineID</th>
					<th style="width:20%;">Login/E-mail</th>
					<th style="width:12%;">Role</th>
					<th style="width:8%;">Status</th>
					<th>Actions</th>
				</tr>
				<?php
					$sql_usr = "SELECT * FROM rec_user ";
					$sql_usr .= " where rec_usr != 'admin' order by rec_name, rec_sname";
					$stmt_usr = $con->query($sql_usr);
					$rows_res = $stmt_usr->rowCount();
					if ($rows_res >0){
						while ($result_usr = $stmt_usr->fetch()) {
				?>
				<tr>
					<td><?php echo $result_usr['rec_title'].$result_usr['rec_name']." ".$result_usr['rec_sname'] ?></td>
					<td><?php echo $result_usr['rec_nickname']?></td>
					<td><?php echo $result_usr['rec_tel']?></td>
					<td><?php echo $result_usr['rec_lineID']?></td>
					<td><?php echo $result_usr['rec_usr']?></td>
					<td><?php echo $result_usr['rec_role']?></td>
					<td><?php echo $result_usr['rec_status']?></td>
					<td>
						<button type="button" class="btn btn-lg btn-success" title="Edit User" id="btn_edt" name="btn_edt" formaction="addedt_user.php?l=<?php echo $l?>&id=<?php echo $result_usr['rec_ID']?>"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-lg btn-danger" title="Delete User" id="btn_del" name="btn_del" formaction="del.php?l=<?php echo $l?>&frm=user&id=<?php echo $result_usr['rec_ID']?>"><i class="fa fa-trash-o"></i></button>
					</td>
				</tr>
					<?php }
					}
					?>
				</table>
			</div>
		</div>
		<!-- Start Modal Add Edit -->
		<div class="modal" id="modalAddEdt">
			<div class="modal-dialog modal-lg">
			  <div class="modal-content" id="modalContentAddEdt"></div>
			</div>
		</div>
		<!-- End Modal Add Edit -->
		<!-- Start Modal Confirm Delete -->
		<div class="modal" id="modalDel">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content" id="modalContentDel"></div>
			</div>
		</div>
		<!-- End Modal Confirm Delete -->

	<script type="text/javascript">
	function myFunction() {
		  // Declare variables
		  var input, filter, table, tr, td0,td1,td2,td3,td4,td5,td6, i, txtValue0,txtValue1,txtValue2,txtValue3,txtValue4,txtValue5,txtValue6;
		  input = document.getElementById("txtKeySearch");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("tabRecord");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
				td0 = tr[i].getElementsByTagName("td")[0];
				td1 = tr[i].getElementsByTagName("td")[1];
				td2 = tr[i].getElementsByTagName("td")[2];
				td3 = tr[i].getElementsByTagName("td")[3];
				td4 = tr[i].getElementsByTagName("td")[4];
				td5 = tr[i].getElementsByTagName("td")[5];
				td6 = tr[i].getElementsByTagName("td")[6];
				
				if (td0 || td1 || td2 || td3 || td4 || td5 || td6) {
						txtValue0 = td0.textContent || td0.innerText;
						txtValue1 = td1.textContent || td1.innerText;
						txtValue2 = td2.textContent || td2.innerText;
						txtValue3 = td3.textContent || td3.innerText;
						txtValue4 = td4.textContent || td4.innerText;
						txtValue5 = td5.textContent || td5.innerText;
						txtValue6 = td6.textContent || td6.innerText;
						
						if ((txtValue0.toUpperCase().indexOf(filter) > -1) ||
						(txtValue1.toUpperCase().indexOf(filter) > -1) ||
						(txtValue2.toUpperCase().indexOf(filter) > -1) ||
						(txtValue3.toUpperCase().indexOf(filter) > -1) ||
						(txtValue5.toUpperCase().indexOf(filter) > -1) ||
						(txtValue5.toUpperCase().indexOf(filter) > -1) ||
						(txtValue6.toUpperCase().indexOf(filter) > -1))
						{
							tr[i].style.display = "";
						} 
						else {
							tr[i].style.display = "none";
						}
				}
		  } //end for
	}
	</script>
	<script type="text/javascript">
		$( document ).ready( function () {
		});
		
		$("button").on('click', function(e){
			e.preventDefault();
			var dataURL = $(this).attr('formaction');
			var btn = $(this).attr('name');
			if (btn == 'btn_del'){
				$('#modalContentDel').load(dataURL,function(){ 
					$('#modalDel').modal('show') 
				});
			}else if ((btn == 'btn_add')||(btn == 'btn_edt')){
				$('#modalContentAddEdt').load(dataURL,function(){ 
					$('#modalAddEdt').modal('show') 
				});
			}
		});
	</script>
     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>

  </body>
</html>