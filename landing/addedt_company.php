<?PHP
include 'db_utf8.php';
include 'function.php';
$id_string = '';
$id = $_GET['id'];
$l = $_GET["l"];
if (($id=='0')||empty($id)){
	$id_string = "Add Client Customer";
	$client_company = "";
	$client_department = "";
	$client_contact = "";
}else{
	$id_string = "Edit ClientCustomer id=".$id;
	$sql_rec_comp ="SELECT * FROM client_company where client_ID = '".$id."' ";
	$stmt_rec_comp = $con->query($sql_rec_comp);
	$rows_rec_comp = $stmt_rec_comp->rowCount();
	if ($rows_rec_comp > 0){
		while ($result_rec_comp = $stmt_rec_comp->fetch()) {
			$client_company = $result_rec_comp['client_company'];
			$client_department = $result_rec_comp['client_department'];
			$client_contact = $result_rec_comp['client_contact'];
		}
	}// end if row>0
}
?>
<script type="text/javascript">
		//Start Validate
	$(document).ready(function () {
		
		$( "#frmAddEdt" ).validate( {
			rules: {
				txtCustomerCompany: "required",
				txtCustomerDepartment: "required",
				txtCustomerContact: "required"
			},
			messages: {
				txtCustomerCompany: "required",
				txtCustomerDepartment: "required",
				txtCustomerContact: "required"
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
				if (document.getElementById("eCompany").style.display == "block"){
					$( "#eCompany" ).addClass( "help-block" );
					$( "#txtCustomerCompany" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				}
			},
			submitHandler: function(form) {
				//form.submit();
				//alert('00000000000000000000');
				var frm = '';
				var id = '';
				id = $('#id').val();
				var client_company = '';
				client_company = $('#txtCustomerCompany').val();
				var client_department  = '';
				client_department  = $('#txtCustomerDepartment').val();
				var client_contact = '';
				client_contact = $('#txtCustomerContact').val();
				//alert(client_company);
				if (client_company != ''){
					//alert('11111111111111');
					$.post("validate.php",{ID:'<?php echo $id ?>', client_company:client_company, action:"validate-company"},function(data){
						//alert(data);
						if (data == '1'){
							//alert('122322');
							$("#eCompany").html('');
							document.getElementById("eCompany").style.display = "none";
							$( "#txtCustomerCompany" ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
							if ((client_company!='')&& (client_department!='')&& (client_contact!='')){
								
								if (($( "#id" ).val() ==0)||($( "#id" ).val() =='')){
									frm = 'addcompany';
								}else{
									frm = 'updcompany';
								}
								$.post("addupd_company.php",{id:id, client_company : client_company, client_department : client_department, client_contact:client_contact, l : "<?php echo $l ?>", frm : frm},function(datai){
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
							$( "#eCompany" ).addClass( "help-block" );
							$( "#txtCustomerCompany" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
							$("#eCompany").html('Duplicate company !!!');
							document.getElementById("eCompany").style.display = "block";
						}	
					});
				}//end if position_val
				
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
		location.replace('admin.php?l=<?php echo $l?>');
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
			<td><input id="id" name="id" type="hidden" value="<?php echo $id?>">
				<table border="0" style="width: 100%" class="tabForm_part">
				<tr>
					<td style="text-align:right;">Company : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="txtCustomerCompany" name="txtCustomerCompany" style="width: 100%"  value="<?php echo $client_company?>" autocomplete="off"><div id="eCompany" class="has-error" style="display:none">Duplicate!!!</div></div></td>
				</tr>
				<tr>
					<td style="text-align:right;">Department : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="txtCustomerDepartment" name="txtCustomerDepartment" style="width: 100%"  value="<?php echo $client_department?>" autocomplete="off"></div></td>
				</tr>
				<tr>
					<td style="text-align:right;">Contact Name : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="txtCustomerContact" name="txtCustomerContact" style="width: 100%"  value="<?php echo $client_contact?>" autocomplete="off"></div></td>
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
	<button type="submit" class="btn btn-lg btn-success" id="btn_submit" name="btn_submit"><i class="fa fa-save"></i> Save</button>
	<button type="button" class="btn btn-lg btn-danger" id="btn_cancel" name="btn_cancel" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div>
</form>