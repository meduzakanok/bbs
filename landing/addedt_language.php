<?PHP
include 'db_utf8.php';
include 'function.php';	
$id_string = '';
$id = $_GET['id'];
$l = $_GET["l"];
if (($id=='0')||empty($id)){
	$id_string = "Add Language";
	$lang = "";
	$lang_val = "";
}else{
	$id_string = "Edit Language id=".$id;
	$sql_rec_lang ="SELECT * FROM prog_lang where lang_ID = '".$id."' ";
	$stmt_rec_lang = $con->query($sql_rec_lang);
	$rows_rec_lang = $stmt_rec_lang->rowCount();
	if ($rows_rec_lang > 0){
		while ($result_rec_lang = $stmt_rec_lang->fetch()) {
			$lang = $result_rec_lang['lang'];
			$lang_val = $result_rec_lang['lang_val'];
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
				txtLanguage: "required",
				txtLanguage_val: "required"
			},
			messages: {
				txtLanguage: "required",
				txtLanguage_val: "required"
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
				if (document.getElementById("eLang").style.display == "block"){
					$( "#eLang" ).addClass( "help-block" );
					$( "#txtLanguage_val" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				}
			},
			submitHandler: function(form) {
				//form.submit();
				//alert('00000000000000000000');
				var frm = '';
				var id = '';
				id = $('#id').val();
				var lang = '';
				lang = $('#txtLanguage').val();
				var lang_val  = '';
				lang_val  = $('#txtLanguage_val').val();
				//alert(client_company);
				if (lang_val != ''){
					//alert('11111111111111');
					$.post("validate.php",{ID:'<?php echo $id ?>', lang_val:lang_val, action:"validate-lang"},function(data){
						//alert(data);
						if (data == '1'){
							//alert('122322');
							$("#eLang").html('');
							document.getElementById("eLang").style.display = "none";
							$( "#txtLanguage_val" ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
							if ((lang!='')&& (lang_val!='')){
								
								if (($( "#id" ).val() ==0)||($( "#id" ).val() =='')){
									frm = 'addlang';
								}else{
									frm = 'updlang';
								}
								$.post("addupd_lang.php",{id:id, lang : lang, lang_val : lang_val,  l : "<?php echo $l ?>", frm : frm},function(datai){
									//alert(datai);
									if (datai == '1'){
										alertF('Result','<font color="green">??????????????????????????????????????????????????????????????????????????? !!</font>');
									}
									else{
										alertF('Warning','<font color="red">Something went wrong!, please try again later/or call to admin.</font>');
									}
								});
							}
						}else {
							$( "#eLang" ).addClass( "help-block" );
							$( "#txtLanguage_val" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
							$("#eLang").html('Duplicate language !!!');
							document.getElementById("eLang").style.display = "block";
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
		location.replace('admin_language.php?l=<?php echo $l?>');
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
					<td style="text-align:right;">Language Description : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="txtLanguage" name="txtLanguage" style="width: 100%" value="<?php echo $lang?>" autocomplete="off"></div></td>
				</tr>
				<tr>
					<td style="text-align:right;">Language Value : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="txtLanguage_val" name="txtLanguage_val" style="width: 100%" value="<?php echo $lang_val?>" autocomplete="off"><div id="eLang" class="has-error" style="display:none">Duplicate!!!</div></div></td>
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