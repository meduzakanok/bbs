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
					<li class="active"><a href="admin.php?l=<?php echo $l?>"><span class="fa fa-cog"></span> ADMIN</a></li>
					<li><a href="user.php?l=<?php echo $l?>"><span class="fa fa-user"></span> USER</a></li>
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
								<li class="nav-item"><a class="nav-link" href="admin.php?l=<?php echo $l?>">[ Company ]</a></li>
								<li class="nav-item"><a class="nav-link" href="jobs.php?l=<?php echo $l?>">[ Position ]</a></li>
								<li class="nav-item active"><a class="nav-link" href="admin_language.php?l=<?php echo $l?>"><font color="#0891f8">[ Programming Language ]</font></a></li>
								<li class="nav-item"><a class="nav-link" href="admin_module.php?l=<?php echo $l?>">[ SAP Modules ]</a></li>
							</ul>
					</div>
				</div>
				</nav>
				<table id="tabAdd" style="width:100%;" border="0">
				<tr>
					<td style="width:90%;"><input type="text" id="txtKeySearch" onkeyup="myFunction()" placeholder="Search.." style="width:100%;"></td>
					<td style="text-align:center"><button type="button" class="btn btn-primary" title="Add Language" id="btn_add" name="btn_add" formaction="addedt_language.php?l=<?php echo $l?>&id=0"><i class="fa fa-plus-square-o"></i> Add Language</button></td>
				</tr>
				</table>
				<table style="width:100%;" border="0" id="tabRecord">
				<tr class="header">
					<th style="width:45%;">Languages Description</th>
					<th style="width:45%;">Languages Value</th>
					<th>Actions</th>
				</tr>
				<?php
					$sql_lang = "SELECT * FROM prog_lang ";
					$sql_lang .= " order by lang";
					$stmt_lang = $con->query($sql_lang);
					$rows_res = $stmt_lang->rowCount();
					if ($rows_res >0){
						while ($result_lang = $stmt_lang->fetch()) {
				?>
				<tr>
					<td><?php echo $result_lang['lang']?></td>
					<td><?php echo $result_lang['lang_val']?></td>
					<td>
						<button type="button" class="btn btn-lg btn-success" title="Edit Language" id="btn_edt" name="btn_edt" formaction="addedt_language.php?l=<?php echo $l?>&id=<?php echo $result_lang['lang_ID']?>"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-lg btn-danger" title="Delete Language" id="btn_del" name="btn_del" formaction="del.php?l=<?php echo $l?>&frm=language&id=<?php echo $result_lang['lang_ID']?>"><i class="fa fa-trash-o"></i></button>
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
	<script>
	function myFunction() {
		  // Declare variables
		  var input, filter, table, tr, td0, td1, i, txtValue0, txtValue1, txtValue2;
		  input = document.getElementById("txtKeySearch");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("tabRecord");
		  tr = table.getElementsByTagName("tr");

		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
				td0 = tr[i].getElementsByTagName("td")[0];
				td1 = tr[i].getElementsByTagName("td")[1];
				
				if (td0) {
						txtValue0 = td0.textContent || td0.innerText;
						txtValue1 = td1.textContent || td1.innerText;
						if ((txtValue0.toUpperCase().indexOf(filter) > -1) 
							||(txtValue1.toUpperCase().indexOf(filter) > -1) )
						{
							tr[i].style.display = "";
						} 
						else {
							tr[i].style.display = "none";
						}
				}
		  }
	}
	</script>
	<script type="text/javascript">
		$( document ).ready( function () {});
		$("button").on('click', function(e){
			e.preventDefault();
			var dataURL = $(this).attr('formaction');
			var btn = $(this).attr('name');
			if (btn == 'btn_del'){
				$('#modalContentDel').load(dataURL,function(){
					$('#modalDel').modal('show');
				});
			}else if ((btn == 'btn_add')||(btn == 'btn_edt')){
				$('#modalContentAddEdt').load(dataURL,function(){
					$('#modalAddEdt').modal('show');
				});
			}
		});
	</script>
     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>

  </body>
</html>