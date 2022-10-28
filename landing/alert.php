<?PHP
$id = $_GET['id'];
$l='';
if (isset($_POST['l']))
	$l = $_POST['l'];
if (($l == '') && isset($_GET['l']))
	$l = $_GET['l'];

if ($id == 1){
	$str_header = '<i class="fa fa-warning fa-2x red-color"></i> Warning';
	$str_alert = '<div class="orange-color" style="text-align: center">File too Big, please select a file less than 2mb.</div>';
}elseif ($id == 2){
	$str_header = '<i class="fa fa-warning fa-2x red-color"></i> Warning';
	$str_alert = '<div class="orange-color" style="text-align: center">File type not support!, please select a new file.</div>';
}elseif ($id == 3){
	$str_header = '<i class="fa fa-warning fa-2x red-color"></i> Warning';
	$str_alert = '<div class="orange-color" style="text-align: center">Duplicate record !!</div>';
}elseif ($id == 4){
	$str_header = '<i class="fa fa-check fa-2x green-color"></i> Result';
	$str_alert = '<div class="green-color" style="text-align: center">บันทึกข้อมูลเรียบร้อยแล้ว !!</div>';
}elseif ($id == 5){
	$str_header = '<i class="fa fa-check fa-2x green-color"></i> Result';
	$str_alert = '<div class="red-color" style="text-align: center">ลบข้อมูลเรียบร้อยแล้ว !!</div>';
}elseif ($id == 6){
	$str_header = '<i class="fa fa-check fa-2x green-color"></i> Result';
	$str_alert = '<div class="green-color" style="text-align: center">แก้ไขข้อมูลเรียบร้อยแล้ว !!</div>';
}else{
	$str_header = '<i class="fa fa-warning fa-2x red-color"></i> Warning';
	$str_alert = '<div class="orange-color" style="text-align: center">Something went wrong !, please try again later.</div>';
}
?>
<style>
	.red-color {
        color:#FF0000;
    }
	.orange-color {
        color:#FF6600;
    }
	.green-color {
        color:#009900;
    }
</style>
<form id="frmAlert" method="post" action="">
<div class="modal-header">
	<div class="icon-box">
		<?php echo $str_header?>
	</div>						
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
		<?php echo $str_alert?> 
</div>
<!-- Modal footer -->
<div class="modal-footer">
	<?php if ($id == 4){?>
		<button type="button" class="btn btn-primary"  id="btn_new" name="btn_new"><i class="fa fa-pencil-square-o"></i> Key New</button>
	<?php }elseif ($id == 6){?>
		<button type="button" class="btn btn-primary"  id="btn_new" name="btn_new"><i class="fa fa-pencil-square-o"></i> Key New</button>
		<button type="button" class="btn btn-primary"  id="btn_search" name="btn_search"><i class="fa fa-search"></i> Back Search</button>	
	<?php }?>
		<button type="button" class="btn btn-secondary"  id="btn_close" name="btn_close" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>
<script type="text/javascript">
$("#btn_new").click(function(){
	location.replace('form.php?l=<?php echo $l?>');
});
$("#btn_search").click(function(){
	location.replace('search.php?l=<?php echo $l?>');
});
</script>
</form>