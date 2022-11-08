<?PHP
include 'db_utf8.php';
include 'function.php';	
$id_string = '';
$id = $_GET['id'];
$l = $_GET["l"];
if (($id=='0')||empty($id)){
	$id_string = "Add Position";
	$position = "";
	$position_val = "";
}else{
	$id_string = "Edit Position id=".$id;
	$sql_rec_job ="SELECT * FROM position where position_ID = '".$id."' ";
	$stmt_rec_job = $con->query($sql_rec_job);
	$rows_rec_job = $stmt_rec_job->rowCount();
	if ($rows_rec_job > 0){
		while ($result_rec_job = $stmt_rec_job->fetch()) {
			$position = $result_rec_job['position'];
			$position_val = $result_rec_job['position_val'];
		}
	}// end if row>0
}
?>
<script type="text/javascript">
		
	$(document).ready(function () {
		//Start Validate
		//alert('00000000000000000000');
		$( "#frmAddEdt" ).validate( {
			rules: {
				position: "required",
				position_val: "required"
			},
			messages: {
				position: "required",
				position_val: "required"
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
				if (document.getElementById("ePosition").style.display == "block"){
					$( "#ePosition" ).addClass( "help-block" );
					$( "#position_val" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				}
			},
			submitHandler: function(form) {
				//form.submit();
				//alert('00000000000000000000');
				var frm = '';
				var id = '';
				id = $('#id').val();
				var position = '';
				position = $('#position').val();
				var position_val = '';
				position_val = $('#position_val').val();
				if (position_val != ''){
					//alert('11111111111111');
					$.post("validate.php",{ID:'<?php echo $id ?>', position_val:position_val, action:"validate-position"},function(data){
						//alert(data);
						if (data == '1'){
							//alert('122322');
							$("#ePosition").html('');
							document.getElementById("ePosition").style.display = "none";
							$( "#position_val" ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
							if ((position!='')&& (position_val!='')){
								
								if (($( "#id" ).val() ==0)||($( "#id" ).val() =='')){
									frm = 'addposition';
								}else{
									frm = 'updposition';
								}
								$.post("addupd_job.php",{id:id, position : position, position_val : position_val, l : "<?php echo $l ?>", frm : frm},function(datai){
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
							$( "#ePosition" ).addClass( "help-block" );
							$( "#position_val" ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
							$("#ePosition").html('Duplicate position !!!');
							document.getElementById("ePosition").style.display = "block";
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
		location.replace('jobs.php?l=<?php echo $l?>');
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
					<td style="text-align:right;">Position Description : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="position" name="position" style="width: 100%" value="<?php echo $position?>" autocomplete="off"></div></td>
				</tr>
				<tr>
					<td style="text-align:right;">Position Value : </td>
					<td><div class="col-sm-5"><input class="form-control" type="text" id="position_val" name="position_val" style="width: 100%" value="<?php echo $position_val?>" autocomplete="off"><div id="ePosition" class="has-error" style="display:none">Duplicate!!!</div></div></td>
				</tr>
				<tr>
					<td style="width: 25%"></td>
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
	<button type="submit" class="btn btn-lg btn-success"  id="btn_jobSubmit" name="btn_jobSubmit"><i class="fa fa-save"></i> Save</button>
	<button type="button" class="btn btn-lg btn-danger"  id="btn_jobCancel" name="btn_jobCancel" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
</div>
</form>
