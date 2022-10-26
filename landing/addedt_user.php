<?PHP
$id_string = '';
$id = $_GET['id'];
if (($id=='0')||empty($id))
	$id_string = "Add User";
else
	$id_string = "Edit User id=".$id;
?>
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
					<td style="text-align:right;"></td>
					<td>
							<select name="ddTitleEn" id="ddTitleEn" class="ddStyle" style="width: 100%">
								<option value="">--Select--</option>
								<option value="Mr.">Mr.</option>
								<option value="Mrs.">Mrs.</option>
								<option value="Miss">Miss</option>
							 </select>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;">Name : </td>
					<td><input class="form-control col-sm-5" type="text" id="txtName" name="txtName" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">Surname: </td>
					<td><input class="form-control col-sm-5" type="text" id="txtSurname" name="txtSurname" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">Nickname: </td>
					<td><input class="form-control col-sm-5" type="text" id="txtNickname" name="txtNickname" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">Telephone : </td>
					<td><input class="form-control col-sm-5" type="text" id="txtTelephone" name="txtTelephone" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">LineID : </td>
					<td><input class="form-control col-sm-5" type="text" id="txtLineID" name="txtLineID" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">E-mail (User) : </td>
					<td><input class="form-control col-sm-5" type="text" id="txtEmail" name="txtEmail" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">Password : </td>
					<td>
					<input class="form-control col-sm-5" type="text" id="txtPassword" name="txtPassword" style="width: 100%">
					<button type="button" class="btn btn-warning" title="Gen Password" ><i class="fa fa-rotate-left"></i> Generate Password</button>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;">Role : </td>
					<td>
						<label class="lblcontainer"><input type="radio" class="lblcontainer" id="role_recruit" name="role" value="Recruiter" checked> Recruiter&nbsp;</label>
						<label class="lblcontainer"><input type="radio" class="lblcontainer" id="role_sale" name="role" value="sale"> Sale&nbsp;</label>
						<label class="lblcontainer"><input type="radio" class="lblcontainer" id="role_super" name="role" value="super"> Super&nbsp;</label>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;">Status : </td>
					<td>
						<label class="lblcontainer"><input type="radio" class="lblcontainer" id="chkstatus_active" name="chkstatus" value="Y" checked> Active&nbsp;</label>
						<label class="lblcontainer"><input type="radio" class="lblcontainer" id="chkstatus_inactive" name="chkstatus" value="N"> Inactive&nbsp;</label>
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
	<button type="button" class="btn btn-lg btn-success"  id="btn_submit" name="btn_submit" data-dismiss="modal"><i class="fa fa-save"></i> Save</button>
	<button type="button" class="btn btn-lg btn-danger"  id="btn_cancel" name="btn_cancel" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div>
</form>