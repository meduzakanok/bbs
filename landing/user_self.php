<?php
include 'db_utf8.php';
include 'function.php';	
$l = '';
$str_l = '';
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
$id = getVal("rec_user",$current_login,"rec_ID","rec_usr");
//echo 'id'.$id;
if ($id > 0) {
	$id_string = "Edit User id=".$id;
	$sql_rec_user ="SELECT * FROM rec_user where rec_ID = '".$id."' ";
	$stmt_rec_user = $con->query($sql_rec_user);
	$rows_rec_user = $stmt_rec_user->rowCount();
	if ($rows_rec_user > 0){
		while ($result_rec_user = $stmt_rec_user->fetch()) {
			$rec_usr = $result_rec_user['rec_usr'];
			$rec_pass = $result_rec_user['rec_pass'];
			$rec_title = $result_rec_user['rec_title'];
			$rec_name = $result_rec_user['rec_name'];
			$rec_sname = $result_rec_user['rec_sname'];
			$rec_nickname = $result_rec_user['rec_nickname'];
			$rec_tel = $result_rec_user['rec_tel'];
			$rec_lineID = $result_rec_user['rec_lineID'];
			$rec_role  = $result_rec_user['rec_role'];
			$rec_status = $result_rec_user['rec_status'];
		}
	}// end if row>0
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
					<li><a href="admin.php?l=<?php echo $l?>"><span class="fa fa-cog"></span> ADMIN</a></li>
					<li class="active"><a href="user.php?l=<?php echo $l?>"><span class="fa fa-user"></span> USER</a></li>
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
								<?php if ($login_role == 'Super'){?>
									<li class="nav-item"><a class="nav-link" href="user.php?l=<?php echo $l?>">[ User List ]</a></li>
									<li class="nav-item active"><a class="nav-link" href="user_self.php?l=<?php echo $l?>"><font color="#0891f8">[ User Profile ]</font></a></li>
								<?php }else{?>
									<li class="nav-item active"><a class="nav-link" href="user_self.php?l=<?php echo $l?>"><font color="#0891f8">[ User Profile ]</font></a></li>
								<?php }?>
							</ul>
					</div>
				</div>
				</nav>
				<form id="frmAddEdt" method="post" action=""><input type="hidden" id="l" name="l" value="<?php echo $l?>"><input type="hidden" id="id" name="id" value="<?php echo $id?>">
					<div class="part_form">
						<table border="0" style="width: 100%;border-color:#DDDDDD">
						<tr>
							<td>
								<table border="0" style="width: 100%" class="tabForm_part">
								<tr>
									<td style="text-align:right;"><input id="id" name="id" type="hidden" value="<?php echo $id?>"></td>
									<td><div class="col-sm-5">
											<select name="ddTitle" id="ddTitle" class="ddStyle" style="width: 100%">
												<option value="">--Select--</option>
												<option value="นาย" <?php echo ($rec_title == "นาย" ? "selected" : "") ?>>นาย</option>
												<option value="นาง" <?php echo ($rec_title == "นาง" ? "selected" : "") ?>>นาง</option>
												<option value="นางสาว" <?php echo ($rec_title == "นางสาว" ? "selected" : "") ?>>นางสาว</option>
											 </select>
										</div>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Name : </td>
									<td><div class="col-sm-5"><input class="form-control" type="text" id="txtName" name="txtName" style="width: 100%" value="<?php echo $rec_name?>" autocomplete="off"></div></td>
								</tr>
								<tr>
									<td style="text-align:right;">Surname : </td>
									<td><div class="col-sm-5"><input class="form-control" type="text" id="txtSurname" name="txtSurname" style="width: 100%" value="<?php echo $rec_sname?>" autocomplete="off"></div></td>
								</tr>
								<tr>
									<td style="text-align:right;">Nickname : </td>
									<td><div class="col-sm-5"><input class="form-control" type="text" id="txtNickname" name="txtNickname" style="width: 100%" value="<?php echo $rec_nickname?>" autocomplete="off"></div></td>
								</tr>
								<tr>
									<td style="text-align:right;">Telephone : </td>
									<td><input class="form-control" type="text" id="txtTelephone" name="txtTelephone" style="width: 100%" value="<?php echo $rec_tel?>" autocomplete="off"></td>
								</tr>
								<tr>
									<td style="text-align:right;">LineID : </td>
									<td><input class="form-control col-sm-5" type="text" id="txtLineID" name="txtLineID" style="width: 100%" value="<?php echo $rec_lineID?>" autocomplete="off"></td>
								</tr>
								<tr>
									<td style="text-align:right;">E-mail (User) : </td>
									<td><div class="col-sm-5"><input class="form-control" type="text" id="txtEmail" name="txtEmail" style="width: 100%" value="<?php echo $rec_usr?>" autocomplete="off"><div id="eEmail" class="has-error" style="display:none">Duplicate!!!</div></div></td>
								</tr>
								<tr>
									<td style="text-align:right;">Password : </td>
									<td>
									<div class="col-sm-5"><input class="form-control" type="text" id="txtPassword" name="txtPassword" style="width: 100%" value="<?php echo $rec_pass?>" autocomplete="off"></div>
									<!--<button type="button" class="btn btn-warning" title="Gen Password" id="genPass"><i class="fa fa-rotate-left"></i> Generate Password</button>-->
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Role : </td>
									<td>
										<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radRole_recruit" name="radRole" value="Recruiter" <?php echo ($rec_role == "Recruiter" ? "checked" : "") ?>> Recruiter&nbsp;</label>
										<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radRole_sale" name="radRole" value="Sale" <?php echo ($rec_role == "Sale" ? "checked" : "") ?>> Sale&nbsp;</label>
										<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radRole_super" name="radRole" value="Super" <?php echo ($rec_role == "Super" ? "checked" : "") ?>> Super&nbsp;</label>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Status : </td>
									<td>
										<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radStatus_active" name="radStatus" value="Active" <?php echo ($rec_status == "Active" ? "checked" : "") ?>> Active&nbsp;</label>
										<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radStatus_inactive" name="radStatus" value="Inactive" <?php echo ($rec_status == "Inactive" ? "checked" : "") ?>> Inactive&nbsp;</label>
									</td>
								</tr>
								<tr>
									<td style="width: 20%"></td>
									<td></td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</div>
					<div class="modal-footer justify-content-center">
						<button type="submit" class="btn btn-lg btn-success"  id="btn_UserSubmit" name="btn_UserSubmit"><i class="fa fa-save"></i> Save</button>
						<button type="button" class="btn btn-lg btn-danger"  id="btn_UserCancel" name="btn_UserCancel" data-dismiss="modal" onclick='redirect()'><i class="fa fa-times"></i> Cancel</button>
					</div>
				</form>
			</div>
		</div>
     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>
	 <script type="text/javascript">
		//Start Validate
	$(document).ready(function () {
		
		$( "#frmAddEdt" ).validate( {
			rules: {
				ddTitle: "required",
				txtName: "required",
				txtSurname: "required",
				txtNickname: "required",
				txtEmail: "required",
				txtPassword: "required"
			},
			messages: {
				ddTitle: "required",
				txtName: "required",
				txtSurname: "required",
				txtNickname: "required",
				txtEmail: "required",
				txtPassword: "required"
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				// Add the `help-block` class to the error element
				error.addClass( "help-block" );
				
				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertBefore( element.parent( "label" ) );
				}
				else {
					error.insertAfter( element );
				}
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				if (document.getElementById("eEmail").style.display == "block"){
					$( "#eEmail" ).addClass( "help-block" );
					$( "#txtEmail" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				}
			},
			submitHandler: function(form) {
				//form.submit();
				//alert('OKKKK");
				var frm = '';
				var role = '';
				if ($('#radRole_recruit').is(':checked'))
					role = $('#radRole_recruit').val()
				else if ($('#radRole_sale').is(':checked'))
					role = $('#radRole_sale').val()
				else if ($('#radRole_super').is(':checked'))
					role = $('#radRole_super').val();
				
				var rStatus = '';
				if ($('#radStatus_active').is(':checked'))
					rStatus = $('#radStatus_active').val()
				else if ($('#radStatus_inactive').is(':checked'))
					rStatus = $('#radStatus_inactive').val();
				var id = '';
				id = $('#id').val();
				var ddTitle = '';
				ddTitle = $('#ddTitle').val();
				var txtName = '';
				txtName = $('#txtName').val();
				var txtSurname = '';
				txtSurname = $('#txtSurname').val();
				var txtNickname = '';
				txtNickname = $('#txtNickname').val();
				var txtTelephone = '';
				txtTelephone = $('#txtTelephone').val();
				var txtLineID = '';
				txtLineID = $('#txtLineID').val();
				var txtEmail = '';
				txtEmail = $('#txtEmail').val();
				var txtPassword = '';
				txtPassword = $('#txtPassword').val();
				//alert(txtEmail);
				if (txtEmail != ''){
					var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
					if(txtEmail.match(mailformat))
					{
						$.post("validate.php",{ID:'<?php echo $id ?>', rec_usr:txtEmail, action:"validate-user"},function(data){
							//alert(data);
							if (data == '1'){
								//alert('122322');
								$("#eEmail").html('');
								document.getElementById("eEmail").style.display = "none";
								$( "#txtEmail" ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
								if ((ddTitle!='')&& (txtName!='')&&(txtSurname!='')&&(txtNickname!='')&&(txtPassword!='')){
									
									if (($( "#id" ).val() ==0)||($( "#id" ).val() =='')){
										frm = 'adduser';
									}else{
										frm = 'upduser';
									}
									$.post("addupd_user.php",{id:id, ddTitle : ddTitle, txtName : txtName,txtSurname : txtSurname,txtNickname : txtNickname,txtTelephone:txtTelephone,txtLineID : txtLineID,txtEmail : txtEmail,txtPassword : txtPassword,radRole : role,radStatus : rStatus,l : "<?php echo $l ?>", frm : frm},function(datai){
										//alert(datai);
										if (datai == '1'){
											alertF('Result','<font color="green">บันทึกข้อมูลเรียบร้อยแล้ว !!</font>');
										}
										else{
											alertF('Warning','<font color="red">Something went wrong!, please try again later/or call to admin.</font>');
										}
									});
								}
							}else {
								$( "#eEmail" ).addClass( "help-block" );
								$( "#txtEmail" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
								$("#eEmail").html('Duplicate email !!!');
								document.getElementById("eEmail").style.display = "block";
							}	
						});
					}
					else
					{
						$( "#eEmail" ).addClass( "help-block" );
						$( "#txtEmail" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
						$("#eEmail").html('Wrong email !!!');
						document.getElementById("eEmail").style.display = "block";
					}
				}//end if email
			},
			invalidHandler: function() {
				//alert("form is invalid");
			}
		});
		//End Validate*/
	});	
	function alertF(title, content) {
		var alertContent = "<div class='modal__overlay verdana' id='alertB'><div class='modal__window'><div class='modal__titlebar'><span class='modal__title'>"+title+"</span><button class='modal__close' onclick='redirect()'>X</button></div><div class='modal__content'>"+content+"</div></div></div>";
		var dialogBox = document.createElement("div");
		dialogBox.innerHTML = alertContent;
		document.body.appendChild(dialogBox); // actually append it
	}
	function redirect(){
		location.replace('user_self.php?l=<?php echo $l?>');
	}
</script>
  </body>
</html>