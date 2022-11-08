<?PHP
$frm = $_GET['frm'];
$id = $_GET['id'];
$l = $_GET['l'];
?>
<form id="frmDel" method="post" action="">
<div class="modal-header flex-column">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<div class="icon-box">
		<font color="#dc3545"><i class="fa fa-close fa-2x"></i> <font size="5px"><b> Delete</b></font></font>
	</div>
</div>
<div class="modal-body">
	<p>Do you really want to delete this record? <br/>
	<b><?php echo $frm.' id : '.$id?></b>
	<b><label id="disName"></label></b>
	<font color="#dc3545">This process cannot be undo.</font></p>
</div>
<div class="modal-footer justify-content-center">
	<button type="button" id="btn_delRec" class="btn btn-lg btn-danger" data-dismiss="modal">Delete</button>
	<button type="button" id="btn_delcRec" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancel</button>
</div>
</form>
<script type="text/javascript">
	var redirect = '';
	var act = '';
	var rfield = '';
	var ifield = '';
	<?php if ($frm == 'user'){?>
		redirect = 'user';
		act = 'rec_user';
		rfield = 'rec_usr';
		ifield = 'rec_ID';
	<?php }?>
	<?php if ($frm == 'position'){?>
		redirect = 'jobs';
		act = 'position';
		rfield = 'position';
		ifield = 'position_ID';
	<?php }?>
	<?php if ($frm == 'company'){?>
		redirect = 'admin';
		act = 'client_company';
		rfield = 'client_company';
		ifield = 'client_ID';
	<?php }?>
	<?php if ($frm == 'language'){?>
		redirect = 'admin_language';
		act = 'prog_lang';
		rfield = 'lang';
		ifield = 'lang_ID';
	<?php }?>
	<?php if ($frm == 'module'){?>
		redirect = 'admin_module';
		act = 'sap_modules';
		rfield = 'SAP_module';
		ifield = 'SAP_ID';
	<?php }?>
	$.post("getVal.php",{act:act, id:"<?php echo $id ?>",rfield:rfield,ifield:ifield},function(data){
		//alert(data);
		$("#disName").html("<?php echo $frm ?> : "+data);
	});
	$( "#btn_delRec" ).click(function() {
		var dataURL = '';
		var id = $('#id').val();
		event.preventDefault(); 
		//alert(id);
		$.post("delete.php",{f:ifield,id:"<?php echo $id ?>" ,frm:"<?php echo $frm ?>"},function(data){
			//alert(data);
			if (data == '1'){
				location.replace(redirect+'.php?l=<?php echo $l?>');
			}	
		});
	});
	
</script>