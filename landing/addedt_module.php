<?PHP
include 'db_utf8.php';
include 'function.php';	
$id_string = '';
$id = $_GET['id'];
$l = $_GET["l"];
if (($id=='0')||empty($id)){
	$id_string = "Add Module";
	$SAP_module  = "";
	$SAP_moduleVal  = "";
}else{
	$id_string = "Edit Module id=".$id;
	$sql_rec_module ="SELECT * FROM sap_modules where SAP_ID = '".$id."' ";
	$stmt_rec_module = $con->query($sql_rec_module);
	$rows_rec_module = $stmt_rec_module->rowCount();
	if ($rows_rec_module > 0){
		while ($result_rec_module = $stmt_rec_module->fetch()) {
			$SAP_module  = $result_rec_module['SAP_module'];
			$SAP_moduleVal = $result_rec_module['SAP_moduleVal'];
		}
	}// end if row>0
}
?>
<script type="text/javascript">
		//Start Validate
	$(document).ready(function () {
		//alert('00000000000000000000');
		$( "#frmAddEdt" ).validate( {
			rules: {
				txtModule: "required",
				txtModule_val: "required"
			},
			messages: {
				txtModule: "required",
				txtModule_val: "required"
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
				if (document.getElementById("eModule").style.display == "block"){
					$( "#eModule" ).addClass( "help-block" );
					$( "#txtModule_val" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				}
			},
			submitHandler: function(form) {
				//form.submit();
				//alert('00000000000000000000');
				var frm = '';
				var id = '';
				id = $('#id').val();
				var SAP_module = '';
				SAP_module = $('#txtModule').val();
				var SAP_moduleVal  = '';
				SAP_moduleVal  = $('#txtModule_val').val();
				//alert(client_company);
				if (SAP_moduleVal != ''){
					//alert('11111111111111');
					$.post("validate.php",{ID:'<?php echo $id ?>', SAP_moduleVal:SAP_moduleVal, action:"validate-module"},function(data){
						//alert(data);
						if (data == '1'){
							//alert('122322');
							$("#eModule").html('');
							document.getElementById("eModule").style.display = "none";
							$( "#txtModule_val" ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
							if ((SAP_module!='')&& (SAP_moduleVal!='')){
								
								if (($( "#id" ).val() ==0)||($( "#id" ).val() =='')){
									frm = 'addmodule';
								}else{
									frm = 'updmodule';
								}
								$.post("addupd_module.php",{id:id, SAP_module : SAP_module, SAP_moduleVal : SAP_moduleVal,  l : "<?php echo $l ?>", frm : frm},function(datai){
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
							$( "#eModule" ).addClass( "help-block" );
							$( "#txtModule_val" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
							$("#eModule").html('Duplicate module !!!');
							document.getElementById("eModule").style.display = "block";
						}	
					});
				}//end if lang_val
				
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
		location.replace('admin_module.php?l=<?php echo $l?>');
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
		<table border="0" style="width: 100%;border-color:#DDDDDD" id="tabAddCompany">
		<tr>
			<td><input id="id" name="id" type="hidden" value="<?php echo $id?>">
				<table border="0" style="width: 100%" class="tabForm_part">
				<tr>
					<td style="text-align:right;">Module Description : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="txtModule" name="txtModule" style="width: 100%" value="<?php echo $SAP_module?>" autocomplete="off"></div></td>
				</tr>
				<tr>
					<td style="text-align:right;">Module Value : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="txtModule_val" name="txtModule_val" style="width: 100%" value="<?php echo $SAP_moduleVal?>" autocomplete="off" maxlength="10"><div id="eModule" class="has-error" style="display:none">Duplicate!!!</div></div></td>
				</tr>
				<tr>
					<td style="width: 30%"></td>
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
	<button type="submit" class="btn btn-lg btn-success"  id="btn_submit" name="btn_submit"><i class="fa fa-save"></i> Save</button>
	<button type="button" class="btn btn-lg btn-danger"  id="btn_cancel" name="btn_cancel" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div>
</form>