<?php
include 'db_utf8.php';
include 'function.php';	
$l = '';
$str_l = '';
isset( $_POST['l'] ) ? $str_l = $_POST['l'] : $str_l = $_GET['l'];

if ($str_l == '')
	header('Location: ../');
else{
	$str_l = getLogin($str_l , 0);
	$l = $str_l;
	$str_l = getLogin($str_l , 1);
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>BBS Recruit management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="../images/BBS_logo.ico">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/css.css">
	<link rel="stylesheet" href="css/jquery.multiselect.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/datepicker.css">
	<link rel="stylesheet" href="css/tab.css">
	<style type="text/css">
		ul,li { margin:0; padding:0; list-style:none;}
	</style>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.multiselect.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1 style="background-color: #fff;"><a href="index.html" class="logo"><img src="../images/BBS_logo.jpg" width="80" height="46"></a></h1>
				<ul class="list-unstyled components mb-5">
					<li><a href="index.php?l=<?php echo $l?>"><span class="fa fa-home"></span> Home</a></li>
					<li><a href="form.php?l=<?php echo $l?>"><span class="fa fa-sticky-note"></span> FORM</a></li>
					<li class="active"><a href="search.php?l=<?php echo $l?>"><span class="fa fa-search"></span> SEARCH</a></li>
					<li><a href="admin.php?l=<?php echo $l?>"><span class="fa fa-cog"></span> ADMIN</a></li>
					<li><a href="user.php?l=<?php echo $l?>"><span class="fa fa-user"></span> USER</a></li>
					<li><a href="report.php?l=<?php echo $l?>"><span class="fa fa-folder-open"></span> REPORT</a></li>
					<li><a href="../"><span class="fa fa-sign-out"></span> LOGOUT</a></li>
				</ul>
				<footer><div class="footer"><p>Copyright &copy;2022 <a href="http://bbssolution.com/" target="_blank">BBS Solution Co., Ltd.</a> All rights reserved.</p></div></footer>
			</nav>
			<!-- Page Content  -->
			<div id="content" class="p-4 p-md-5">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="btn btn-primary"><i class="fa fa-bars"></i><span class="sr-only">Toggle Menu</span></button>
					<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="nav navbar-nav ml-auto">
								<li class="nav-item active"><a class="nav-link" href="search.html">Recruit List</a></li>
							</ul>
					</div>
				</div>
				</nav>
				<?php	
					//------------------------------------------------------------------------------------------------start search
						$txtName = "";
						$ddPosition = "";
						$txtCallDate_start = "";
						$txtCallDate_end = "";
						$txtInterviewDate_start = "";
						$txtInterviewDate_end = "";
						$ddInterestedPosition = "";
						$ddClientCompany = "";
						$chkCalldate = '';
						$chkIntdate = '';
						$arrpos['BA'] = '';
						$arrpos['Programmer'] = '';
						$arrpos['Admin'] = '';
						$arrpos['PM'] = '';
						$arrpos['SA'] = '';
						$arrpos['SAP'] = '';
						$arrpos['Tester'] = '';
						$arrpos['Other'] = '';
						//echo 'btn_search - '.$_POST['btn_search'].'<br/>';
						//echo 'REQUEST_METHOD - '.$_SERVER['REQUEST_METHOD'].'<br/>';
						//if (isset($_POST['btn_search'])){
						if ($_SERVER['REQUEST_METHOD'] == 'POST'){
							isset( $_POST['txtName'] ) ? $txtName = $_POST['txtName'] : $txtName = "";
							isset( $_POST['ddPosition'] ) ? $ddPosition = $_POST['ddPosition'] : $ddPosition = "";
							isset( $_POST['chkCalldate'] ) ? $chkCalldate = $_POST['chkCalldate'] : $chkCalldate = "";
							isset( $_POST['chkIntdate'] ) ? $chkIntdate = $_POST['chkIntdate'] : $chkIntdate = "";
							$txtCallDate_start = $_POST['txtCallDate_start'];
							$txtCallDate_end = $_POST['txtCallDate_end'];
							$txtInterviewDate_start = $_POST['txtInterviewDate_start'];
							$txtInterviewDate_end = $_POST['txtInterviewDate_end'];
							isset( $_POST['ddInterestedPosition'] ) ? $ddInterestedPosition = $_POST['ddInterestedPosition'] : $ddInterestedPosition = "";
							isset( $_POST['ddClientCompany'] ) ? $ddClientCompany = $_POST['ddClientCompany'] : $ddClientCompany = "";
							$n = 0;
							$candidate_rec = '';
							$candidate_record = '';
							$candidate_pos = '';
							$candidate_call = '';
							$candidate_int = '';
							//echo 'ddInterestedPosition - '.$ddInterestedPosition."<br/><br/>";
							//echo 'ddClientCompany - '.$ddClientCompany."<br/><br/>";
							if (isset($txtName) && ($txtName!='')){
								$sql_searchN = "SELECT candidate_ID FROM candidate ";
								$sql_searchN .= " where 1 ";
								$sql_searchN .= " and (flag_delete ='N') ";
								$sql_searchN .= " and ((name_en LIKE '%".trim($txtName)."%') or (sname_en LIKE '%".trim($txtName)."%') ";
								$sql_searchN .= " or (name_th LIKE '%".trim($txtName)."%') or (sname_th LIKE '%".trim($txtName)."%'))";
								$sql_searchN .= " group by candidate_ID";
								//echo 'sql candidate - '.$sql."<br/>";
								$stmt_searchN = $con->query($sql_searchN);
								//$rows = mysqli_num_rows($query);
								$candidate_rec = '(';
								while ($result_searchN = $stmt_searchN->fetch()) 
									$candidate_rec .= "'".$result_searchN['candidate_ID']."',";
								
								if ($candidate_rec  != '('){
									$candidate_rec = substr($candidate_rec,0, -1).")";
									$candidate_record = $candidate_rec;
								}else
									$candidate_rec = '';
								
								//echo 'candidate_rec - '.$candidate_rec."<br/><br/>";
							}
							if (isset($ddPosition) && ($ddPosition!='')){
								$sql_position = "SELECT candidate_ID FROM candidate_position ";
								$sql_position .= " where 1 ";
								$sql_position .= " and position in (";
								foreach( $ddPosition as $key => $pos ){
									$sql_position .= "'".$pos."',";
									$arrpos[$pos] = 'selected';
								}
								$sql_position = substr($sql,0, -1).")";
								if ($candidate_rec != '')
									$sql_position .= " and (candidate_ID in ".$candidate_rec.")";
								$sql_position .= " group by candidate_ID";
								//echo 'sql candidate_position - '.$sql."<br/>";
								$stmt_position = $con->query($sql_position);
								//$rows = mysqli_num_rows($query);
								$candidate_pos = '(';
								while ($result_position = $stmt_position->fetch()) {
									$candidate_pos .= "'".$result_position['candidate_ID']."',";
								} //end while
								if ($candidate_pos  != '('){
									$candidate_pos = substr($candidate_pos,0, -1).")";
									$candidate_record = $candidate_pos;
								}else	
									$candidate_pos ='';
								//echo 'candidate_pos - '.$candidate_pos."<br/><br/>";
							}
							if (($chkCalldate =='checked') || ($ddInterestedPosition!='')){
								$sql_callrecord = "SELECT candidate_ID FROM candidate_callrecord WHERE 1 ";
								if ($chkCalldate =='checked')
									$sql_callrecord .= " and (call_date BETWEEN '".$txtCallDate_start." 00:00:00' AND '".$txtCallDate_end." 23:59:59')";
								if ($ddInterestedPosition != '')
									$sql_callrecord .= " and (interested_position = '".$ddInterestedPosition."')";
								if ($candidate_rec != '')
									$sql_callrecord .= " and (candidate_ID in ".$candidate_rec.")";
								if ($candidate_pos != '')
									$sql_callrecord .= " and (candidate_ID in ".$candidate_pos.")";
								$sql_callrecord .= " group by candidate_ID";
								//echo 'sql candidate_callrecord - '.$sql_callrecord."<br/>";
								$stmt_callrecord = $con->query($sql_callrecord);
								//$rows = mysqli_num_rows($query);
								$candidate_call = '(';
								while ($result_callrecord = $stmt_callrecord->fetch()) {
									$candidate_call .= "'".$result_callrecord['candidate_ID']."',";
								} //end while
								if ($candidate_call  != '('){
									$candidate_call = substr($candidate_call,0, -1).")";
									$candidate_record = $candidate_call;
								}else 
									$candidate_call = '';
								//echo 'candidate_call - '.$candidate_call."<br/><br/>";
							}
							if (($chkIntdate =='checked') || ($ddClientCompany != '')){
								$sql_interviewrecord = "SELECT candidate_ID FROM candidate_interviewrecord WHERE 1 ";
								if ($chkIntdate =='checked')
									$sql_interviewrecord .= " and (interview_date BETWEEN '".$txtInterviewDate_start." 00:00:00' AND '".$txtInterviewDate_end." 23:59:59')";
								if ($ddClientCompany != '')
									$sql_interviewrecord .= " and (client_ID = ".$ddClientCompany.")";
								if ($candidate_rec != '')
									$sql_interviewrecord .= " and (candidate_ID in ".$candidate_rec.")";
								if ($candidate_pos != '')
									$sql_interviewrecord .= " and (candidate_ID in ".$candidate_pos.")";
								if ($candidate_call != '')
									$sql_interviewrecord .= " and (candidate_ID in ".$candidate_call.")";
								$sql_interviewrecord .= " group by candidate_ID";
								//echo 'sql candidate_callrecord - '.$sql."<br/>";
								$stmt_interviewrecord = $con->query($sql_interviewrecord);
								//$rows = mysqli_num_rows($query);
								$candidate_int = '(';
								while ($result_interviewrecord = $stmt_interviewrecord->fetch()) {
									$candidate_int .= "'".$result_interviewrecord['candidate_ID']."',";
								} //end while
								if ($candidate_int  != '('){
									$candidate_int = substr($candidate_int,0, -1).")";
									$candidate_record = $candidate_int;
								}else 
									$candidate_int = '';
								//echo 'candidate_int - '.$candidate_int."<br/><br/>";
							}
						}
						//------------------------------------------------------------------------------------------------end search
				?>
				<form id="frmRecruit" name="frmRecruit" method="POST" action="search.php"><input type="hidden" id="l" name="l" value="<?php echo $l?>"><input type="hidden" id="id" name="id" value="">
					<div class="part_form">
						<table border="0" style="width:100%;" id="tabSearch" class="tabForm_part">
						<tr> 	
							<td style="width:15%">Name/ชื่อ</td>
							<td style="width:25%"><div class="col-sm-5"><input class="form-control" type="text" name="txtName" id="txtName" style="width: 100%;cursor:pointer" value="<?php echo $txtName?>"></div></td>
							<td style="width:15%">Position</td>
							<td style="width:25%"><div class="col-sm-5">
								<select name="ddPosition[]" id="ddPosition" class="ddStyle" style="width: 100%" multiple>
									<option value="BA" <?php echo $arrpos['BA']?>>BA</option>
									<option value="Programmer" <?php echo $arrpos['Programmer']?>>Programmer</option>
									<option value="Admin" <?php echo $arrpos['Admin']?>>Project Admin</option>
									<option value="PM" <?php echo $arrpos['PM']?>>Project Manager</option>
									<option value="SA" <?php echo $arrpos['SA']?>>SA</option>
									<option value="SAP" <?php echo $arrpos['SAP']?>>SAP</option>
									<option value="Tester" <?php echo $arrpos['Tester']?>>Tester</option>
									<option value="Other" <?php echo $arrpos['Other']?>>Other</option>
								</select>
							</div></td>
							<td rowspan="3" style="text-align:center">
								<button type="submit" class="btn btn-lg btn-primary"  id="btn_search" name="btn_search" value="search"><i class="fa fa-search"></i> Search</button>
							</td>
						</tr>
						<tr> 	
							<td>Interested Position</td>
							<td><select id="ddInterestedPosition" name="ddInterestedPosition" class="ddStyle ddSearch" style="width: 100%"></select></td>
							<td>Customer Company</td>
							<td><select id="ddClientCompany" name="ddClientCompany" class="ddStyle ddSearch" style="width: 100%"></select></td>
						</tr>
						<tr> 	
							<td><label class="lblcontainer"><input type="checkbox" class="checkbox label_inline lblcontainer" id="chkCalldate" name="chkCalldate" value="checked" <?php echo $chkCalldate?>>&nbsp;&nbsp;Call Date</label></td>
							<td><input class="datepicker form-control" id="txtCallDate_start" name="txtCallDate_start" size="16" type="text" style="width: 100%;cursor:pointer" value="<?php echo $txtCallDate_start?>"></td>
							<td>to</td>
							<td><input class="datepicker form-control" id="txtCallDate_end" name="txtCallDate_end" size="16" type="text" style="width: 100%;cursor:pointer" value="<?php echo $txtCallDate_end?>"></td>
						</tr>
						<tr> 	
							<td><label class="lblcontainer"><input type="checkbox" class="checkbox label_inline lblcontainer" id="chkIntdate" name="chkIntdate" value="checked" <?php echo $chkIntdate?>>&nbsp;&nbsp;Interview Date</label></td>
							<td><input class="datepicker form-control" id="txtInterviewDate_start" name="txtInterviewDate_start" size="16" type="text" style="width: 100%;cursor:pointer"></td>
							<td>to</td>
							<td><input class="datepicker form-control" id="txtInterviewDate_end" name="txtInterviewDate_end" size="16" type="text" style="width: 100%;cursor:pointer"></td>
						</tr>
						</table>
					</div><br/>
				</form>
				<?php
					if (($_SERVER['REQUEST_METHOD'] == 'POST') && ($candidate_record != '')){
					//if (isset($_POST['btn_search']) && ($candidate_record != '')){
				?>
				<input type="text" id="txtKeySearch" onkeyup="myFunction()" placeholder="Search.." style="width:100%;">
				<table  style="width:100%;" id="tabRecord">
				<tr class="header">
					<th style="width:5%;">ID</th>
					<th style="width:15%;">Name Surname</th>
					<th style="width:15%;">ชื่อ นามสกุล</th>
					<th style="width:30%;">Position / Skill</th>
					<th style="width:10%;">Telephone</th>
					<th style="width:10%;">E-mail</th>
					<th style="width:5%;">LineID</th>
					<th>Actions</th>
				</tr>
				<?php
					$sql_candidateShow = "SELECT * FROM candidate ";
					$sql_candidateShow .= " where 1 ";
					$sql_candidateShow .= " and (flag_delete ='N') ";
					$sql_candidateShow .= " and (candidate_ID in ".$candidate_record.")";
					
					//echo 'candidate_record - '.$candidate_record."<br>";
					//echo 'SQL - '.$sql."<br>";
					$stmt_candidateShow = $con->query($sql_candidateShow);
					//$rows = mysqli_num_rows($query);
					while ($result_candidateShow = $stmt_candidateShow->fetch()) {
				?>
				<tr>
					<td style="vertical-align: top;"><?php echo $result_candidateShow['candidate_ID']?></td>
					<td style="vertical-align: top;"><?php echo $result_candidateShow['title_en'].$result_candidateShow['name_en'].' '.$result_candidateShow['sname_en']?></td>
					<td style="vertical-align: top;"><?php echo $result_candidateShow['title_th'].$result_candidateShow['name_th'].' '.$result_candidateShow['sname_th']?></td>
					<td style="vertical-align: top;">
						<?php
							$sql_pos = "SELECT * FROM candidate_position ";
							$sql_pos .= " where 1 ";
							$sql_pos .= " and (candidate_ID ='".$result_candidateShow['candidate_ID']."') ";
							$stmt_pos = $con->query($sql_pos);
							echo '<ul class="list">';
							//$first_col = '<li>';
							//$sec_col = '<li>';
							while ($result_pos = $stmt_pos->fetch()) {
								
								//$first_col .= '<span class="name">'.$result_pos['position'].'</span>';
								echo "<li style='width: 30%;'>".$result_pos['position']."</li>";
								//echo '<table style="width:100%;" border=1 id="tabRecord_inside"><tr>';
								//echo "<td style='width:150px;vertical-align: top;text-align: left;'>".$result_pos['position']."</td>";
								
								$sql_posskill = "SELECT * FROM candidate_positionskill ";
								$sql_posskill .= " where 1 ";
								$sql_posskill .= " and (candidate_ID ='".$result_candidateShow['candidate_ID']."') ";
								$sql_posskill .= " and (position ='".$result_pos['position']."') ";
								$stmt_posskill = $con->query($sql_posskill);
								//echo '<td style="vertical-align: top;">';
								//$sec_col .= '<span class="name">';
								echo "<li>";
								while ($result_posskill = $stmt_posskill->fetch()) {
									echo "- ".$result_posskill['skill']."<br/>";
									//$sec_col .= '-'.$result_posskill['skill'].'<br/>';
								}
								echo "</li>";
								//$sec_col .='</span> ';
								//echo "</td>";
								//echo "</tr></table>";
							}
							//$first_col .= '</li>';
							//$sec_col .= '</li>';
							//echo $first_col.$sec_col ;
							echo '</ul>';
						?>
					</td>
					<td style="vertical-align: top;">
						<?php
							$sql_cMail = "SELECT * FROM candidate_contact ";
							$sql_cMail .= " where contact_type='Email' ";
							$sql_cMail .= " and (candidate_ID ='".$result_candidateShow['candidate_ID']."') ";
							$stmt_cMail = $con->query($sql_cMail);
							while ($result_cMail = $stmt_cMail->fetch()) {
								echo "- ".$result_cMail['contact_info']."<br/>";
							}
						?>
					</td>
					<td style="vertical-align: top;">
						<?php
							$sql_cTel = "SELECT * FROM candidate_contact ";
							$sql_cTel .= " where contact_type='Telephone' ";
							$sql_cTel .= " and (candidate_ID ='".$result_candidateShow['candidate_ID']."') ";
							$stmt_cTel = $con->query($sql_cTel);
							while ($result_cTel = $stmt_cTel->fetch()) {
								echo "- ".$result_cTel['contact_info']."<br/>";
							}
						?>
					</td>
					<td style="vertical-align: top;">
						<?php
							$sql_cLine = "SELECT * FROM candidate_contact ";
							$sql_cLine .= " where contact_type='LineID' ";
							$sql_cLine .= " and (candidate_ID ='".$result_candidateShow['candidate_ID']."') ";
							$stmt_cLine = $con->query($sql_cLine);
							while ($result_cLine = $stmt_cLine->fetch()) {
								echo $result_cLine['contact_info']."<br/>";
							}
						?>
					</td>
					<td style="vertical-align: top;">
						<button type="button" class="btn btn-lg btn-success" title="Edit Recruit" id="btn_edt" onclick="setID('<?php echo $result_candidateShow['candidate_ID']?>');edtSubmit()"><i class="fa fa-edit"></i></button>
						<button type="button" class="btn btn-lg btn-danger" title="Delete Recruit" data-toggle="modal" data-target="#modalDelRecruit" onclick="setID('<?php echo $result_candidateShow['candidate_ID']?>')"><i class="fa fa-trash-o"></i></button>
					</td>
				</tr>
				<?php } ?>
				</table>
				<?php }?>
			</div>
		</div>
		<!-- Start Modal Confirm Delete -->
		<form id="frmDelRecruit" method="post" action="">
			<div id="modalDelRecruit" class="modal">
				<div class="modal-dialog modal-confirm">
					<div class="modal-content">
						<div class="modal-header flex-column">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<div class="icon-box">
								<font color="#dc3545"><i class="fa fa-close fa-2x"></i> <font size="5px"><b> Delete</b></font></font>
							</div>
						</div>
						<div class="modal-body">
							<p>Do you really want to delete this record? <br/><font color="#dc3545">This process cannot be undo.</font></p>
						</div>
						<div class="modal-footer justify-content-center">
							<button type="button" id="btn_del" class="btn btn-lg btn-danger" data-dismiss="modal">Delete</button>
							<button type="button" id="btn_delc" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- End Modal Confirm Delete -->
		<!-- Start Modal Alert -->
		<div class="modal" id="modalAlert">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content" id="modalContentAlert"></div>
			</div>
		</div>
		<!-- End Modal Alert -->
	<script type="text/javascript"> 
		//$( "#btn_edt" ).click(function() {
			//var dataURL = '';
			//var id = $('#id').val();
			//event.preventDefault(); 
			//alert(id);
			//$("#frmRecruit").submit();
			//$.post("form_edt.php",{id:id},function(data){
				//alert(data);
				//if (data == '1'){
					//dataURL = 'alert.php?id=5&l=<?php echo $l?>';
					//$('#modalContentAlert').load(dataURL,function(){$('#modalAlert').modal('show')});
					//location.replace('search.php?l=<?php echo $l?>');
				//}	
			//});
			//$('#frmRecruit').attr('action', "form_edt.php").submit();
		//});
		$( "#btn_del" ).click(function() {
			var dataURL = '';
			var id = $('#id').val();
			event.preventDefault(); 
			//alert(id);
			$.post("delete.php",{f:"candidate_ID",id:id ,frm:"candidate"},function(data){
				//alert(data);
				if (data == '1'){
					//dataURL = 'alert.php?id=5&l=<?php echo $l?>';
					//$('#modalContentAlert').load(dataURL,function(){$('#modalAlert').modal('show')});
					$("#frmRecruit").submit();
				}	
			});
		});
		
		$(".datepicker").datepicker({format: "yyyy-mm-dd"});
		<?php if ($txtCallDate_start != ''){?>
			var txtCallDate_start_tmp = new Date('<?php echo $txtCallDate_start?>');
		<?php }else{?>
			var txtCallDate_start_tmp = new Date();
		<?php }?>
		
		<?php if ($txtCallDate_end != ''){?>
			var txtCallDate_end_tmp = new Date('<?php echo $txtCallDate_end?>');
		<?php }else{?>
			var txtCallDate_end_tmp = new Date();
		<?php }?>
		
		<?php if ($txtInterviewDate_start != ''){?>
			var txtInterviewDate_start_tmp = new Date('<?php echo $txtInterviewDate_start?>');
		<?php }else{?>
			var txtInterviewDate_start_tmp = new Date();
		<?php }?>
		
		<?php if ($txtInterviewDate_end != ''){?>
			var txtInterviewDate_end_tmp = new Date('<?php echo $txtInterviewDate_end?>');
		<?php }else{?>
			var txtInterviewDate_end_tmp = new Date();
		<?php }?>
		
		var txtCallDate_start_tmp_now = new Date(txtCallDate_start_tmp.getFullYear(), txtCallDate_start_tmp.getMonth(), txtCallDate_start_tmp.getDate(), 0, 0, 0, 0);
		var txtCallDate_end_tmp_now = new Date(txtCallDate_end_tmp.getFullYear(), txtCallDate_end_tmp.getMonth(), txtCallDate_end_tmp.getDate(), 0, 0, 0, 0);
		var txtInterviewDate_start_tmp_now = new Date(txtInterviewDate_start_tmp.getFullYear(), txtInterviewDate_start_tmp.getMonth(), txtInterviewDate_start_tmp.getDate(), 0, 0, 0, 0);
		var txtInterviewDate_end_tmp_now = new Date(txtInterviewDate_end_tmp.getFullYear(), txtInterviewDate_end_tmp.getMonth(), txtInterviewDate_end_tmp.getDate(), 0, 0, 0, 0);
		
		var txtCallDate_start = $('#txtCallDate_start').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
			document.getElementById('chkCalldate').checked = true;
			txtCallDate_start.hide();
		}).data('datepicker');
		txtCallDate_start.setValue(txtCallDate_start_tmp_now);
		
		var txtCallDate_end = $('#txtCallDate_end').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
			document.getElementById('chkCalldate').checked = true;
			txtCallDate_end.hide();
		}).data('datepicker');
		txtCallDate_end.setValue(txtCallDate_end_tmp_now);
		
		var txtInterviewDate_start = $('#txtInterviewDate_start').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
			document.getElementById('chkIntdate').checked = true;
			txtInterviewDate_start.hide();
		}).data('datepicker');
		txtInterviewDate_start.setValue(txtInterviewDate_start_tmp_now);
		
		var txtInterviewDate_end = $('#txtInterviewDate_end').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
			document.getElementById('chkIntdate').checked = true;
			txtInterviewDate_end.hide();
		}).data('datepicker');
		txtInterviewDate_end.setValue(txtInterviewDate_end_tmp_now);
		
		$('#ddPosition').multiselect({
			columns: 1,
			placeholder: '--Select Position--',
			search: true
		});
		
		$(function(){
			$.post("load-dropdown.php",{position_id:'<?php echo $ddInterestedPosition?>',action:"load-position",act:'1'},function(data){
				$("#ddInterestedPosition").html(data);
			});
			$.post("load-dropdown.php",{position_id:'<?php echo $ddClientCompany?>',action:"load-client",act:'2'},function(data){
				$("#ddClientCompany").html(data);
			});
		}); //end function load drop down
	</script>
	<script>
	function edtSubmit(){
		$('#frmRecruit').attr('action', "form_edt.php").submit();
	}
	function setID(d){
		$( "#id" ).val(d);
	}
	function myFunction() {
		  // Declare variables
		  var input, filter, table, tr, td0, td1, td2, i, txtValue0, txtValue1, txtValue2;
		  input = document.getElementById("txtKeySearch");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("tabRecord");
		  tr = table.getElementsByTagName("tr");
		//alert(tr.length);
		  // Loop through all table rows, and hide those who don't match the search query
		  for (i = 0; i < tr.length; i++) {
				td0 = tr[i].getElementsByTagName("td")[0];
				td1 = tr[i].getElementsByTagName("td")[1];
				td2 = tr[i].getElementsByTagName("td")[2];
				td3 = tr[i].getElementsByTagName("td")[3];
				td4 = tr[i].getElementsByTagName("td")[4];
				td5 = tr[i].getElementsByTagName("td")[5];
				td6 = tr[i].getElementsByTagName("td")[6];
				
				
				if (td0 || td1 || td2 || td3 || td4 || td5 || td6) {
						txtValue0 = td0.textContent || td0.innerText;
						txtValue1 = td1.textContent || td1.innerText;
						txtValue2 = td2.textContent || td2.innerText;
						txtValue3 = td3.textContent || td3.innerText;
						txtValue4 = td4.textContent || td4.innerText;
						txtValue5 = td5.textContent || td5.innerText;
						txtValue6 = td6.textContent || td6.innerText;
						if ((txtValue0.toUpperCase().indexOf(filter) > -1) 
						||(txtValue1.toUpperCase().indexOf(filter) > -1) 
						||(txtValue2.toUpperCase().indexOf(filter) > -1) 
						||(txtValue3.toUpperCase().indexOf(filter) > -1) 
						||(txtValue4.toUpperCase().indexOf(filter) > -1) 
						||(txtValue5.toUpperCase().indexOf(filter) > -1) 
						||(txtValue6.toUpperCase().indexOf(filter) > -1) )
						{
							tr[i].style.display = "vertical-align: top;";
						} 
						else {
							tr[i].style.display = "none";
						}
				}
		  }
	}
	</script>

     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>
  </body>
</html>