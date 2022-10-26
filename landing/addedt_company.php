<?PHP
$id_string = '';
$id = $_GET['id'];
if (($id=='0')||empty($id))
	$id_string = "Add Client Customer";
else
	$id_string = "Edit ClientCustomer id=".$id;
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
					<td style="text-align:right;">Company : </td>
					<td><input class="form-control col-sm-5r" type="text" id="txtAddCustomerCompany" name="txtAddCustomerCompany" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">Department : </td>
					<td><input class="form-control col-sm-5r" type="text" id="txtAddCustomerDepartment" name="txtAddCustomerDepartment" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">Contact Name : </td>
					<td><input class="form-control col-sm-5r" type="text" id="txtAddCustomerContact" name="txtAddCustomerContact" style="width: 100%"></td>
				</tr>
				<tr>
					<td style="text-align:right;">Remark : </td>
					<td>
						<textarea id="txtNote" name="txtNote" rows="4" style="width: 100%" maxlength="300"></textarea>
					</td>
				</tr>
				<tr>
					<td style="width: 15%"></td>
					<td ></td>
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