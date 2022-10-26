<?PHP
$frm = $_GET['frm'];
$id = $_GET['id'];
?>
<form id="frmDel" method="post" action="">
<div class="modal-header flex-column">
	<div class="icon-box">
		<i class="fa fa-close fa-4x"></i>Are you sure?
	</div>							
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<p>Do you really want to delete <b><?php echo $frm.' id='.$id?></b> ? </p>
</div>
<div class="modal-footer justify-content-center">
	<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Delete</button>
	<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancel</button>
</div>
</form>