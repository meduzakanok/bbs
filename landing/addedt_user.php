<?PHP
include 'db_utf8.php';
include 'function.php';	
$id_string = '';
$id = $_GET['id'];
$l = $_GET["l"];
if (($id=='0')||empty($id)){
	$id_string = "Add User";
	$rec_usr = "";
	$rec_pass = "";
	$rec_title = "";
	$rec_name = "";
	$rec_sname = "";
	$rec_nickname = "";
	$rec_tel = "";
	$rec_lineID = "";
	$rec_role  = "Recruiter";
	$rec_status = "Active";
}else{
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
<script type="text/javascript">
	var chars = "123456789abcdefghjkmnpqrstuvwxyz!@#$%&ABCDEFGHJKLMNPQRSTUVWXYZ";
	var passwordLength = 7;
	var password = "";
	for (var i = 0; i <= passwordLength; i++) {
		var randomNumber = Math.floor(Math.random() * chars.length);
		password += chars.substring(randomNumber, randomNumber +1);
	}
	<?php 
		if (($id=='0')||empty($id)){
	?>
		$('#txtPassword').val(password);
	<?php } ?>
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
		location.replace('user.php?l=<?php echo $l?>');
	}
</script>
<form id="frmAddEdt" method="post" action="">
<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title"><?php echo $id_string?></h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<!-- Modal body -->
<div class="modal-body">
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
</div>
<!-- Modal footer -->
<div class="modal-footer">
	<button type="submit" class="btn btn-lg btn-success"  id="btn_UserSubmit" name="btn_UserSubmit"><i class="fa fa-save"></i> Save</button>
	<button type="button" class="btn btn-lg btn-danger"  id="btn_UserCancel" name="btn_UserCancel" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div>

<!-- Start Modal Alert -->
<div class="modal" id="modalAlert">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content" id="modalContentAlert"></div>
	</div>
</div>
<!-- End Modal Alert -->
</form>
