<?php
include_once 'db_utf8.php';
include_once 'function.php';	
$l = '';
$id = '';
$str_l = '';
isset( $_POST['l'] ) ? $str_l = $_POST['l'] : $str_l = $_GET['l'];
isset( $_POST['id'] ) ? $id = $_POST['id'] : $id = $_GET['id'];
//echo 'id - '.$id.'<br>';

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
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="icon" type="image/x-icon" href="../images/BBS_logo.ico">

	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/css.css">
	<link rel="stylesheet" href="css/jquery.multiselect.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/datepicker.css">
	<style type="text/css">
		ul,li { margin:0; padding:0; list-style:none;}
	</style>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.multiselect.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="js/combodate.js"></script>
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<h1 style="background-color: #fff;"><a href="index.html" class="logo"><img src="../images/BBS_logo.jpg" width="80" height="46"></a></h1>
				<ul class="list-unstyled components mb-5">
					<li><a href="index.php?l=<?php echo $l?>"><span class="fa fa-home"></span> Home</a></li>
					<li><a href="form.php?l=<?php echo $l?>"><span class="fa fa-sticky-note"></span> FORM</a></li>
					<li class="active"><a href="search.php?l=<?php echo $l?>"><span class="fa fa-search"></span> SEARCH</a></li>
					<li><a href="jobs.html?l=<?php echo $l?>"><span class="fa fa-id-card-o"></span> JOBS</a></li>
					<li><a href="admin.php?l=<?php echo $l?>"><span class="fa fa-cog"></span> ADMIN</a></li>
					<li><a href="user.php?l=<?php echo $l?>"><span class="fa fa-user"></span> USER</a></li>
					<li><a href="report.html?l=<?php echo $l?>"><span class="fa fa-folder-open"></span> REPORT</a></li>
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
								<li class="nav-item"></li>
								<li class="nav-item"><a class="nav-link" href="form_edt.php?l=<?php echo $l?>&id=<?php echo $id?>"><?php echo $id?></a></li>
								<li class="nav-item active"><a class="nav-link" href="form.php?l=<?php echo $l?>">FORM - Recruit</a></li>
							</ul>
						</div>
					 </div>
				  </nav>
				<form id="frmRecruit" name="frmRecruit" method="POST" action="form_viewedt.php" enctype="multipart/form-data"><input type="hidden" id="l" name="l" value="<?php echo $l?>"><input type="hidden" id="id" name="id" value="<?php echo $id?>">
				<input type="hidden" id="candidate_ID" name="candidate_ID" value="<?php echo $id?>">
				<!--Start Part1-->
				<div class="part_form">
					<h4 class="mb-4">Part 1 :  Information</h4>
					<?php
						$sql_candidate ="SELECT * FROM candidate where candidate_ID = '".$id."' ";
						$stmt_candidate = $con->query($sql_candidate);
						$rows_candidate = $stmt_candidate->rowCount();
						//echo 'rows - '.$rows."<br/>";
						if ($rows_candidate > 0){
							while ($result_candidate = $stmt_candidate->fetch()) {
					?>
					<table border="0" style="width: 100%" class="tabForm"> 
						<tr>
							<td colspan="2" style="text-align:right;">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 65px">Name&nbsp;</td>
									<td>
										<div class="col-sm-5">
											<select name="ddTitleEn" id="ddTitleEn" class="ddStyle" style="width: 100%">
												<option value="">-Select-</option>
												<option value="Mr." <?php echo ($result_candidate['title_en'] == "Mr." ? "selected" : "") ?>>Mr.</option>
												<option value="Mrs." <?php echo ($result_candidate['title_en'] == "Mrs." ? "selected" : "") ?>>Mrs.</option>
												<option value="Miss" <?php echo ($result_candidate['title_en'] == "Miss" ? "selected" : "") ?>>Miss</option>
											 </select>
										</div>
									</td>
								</tr>
								</table>
							</td>
							<td colspan="3">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtNameEn" id="txtNameEn" value="<?php echo $result_candidate['name_en']?>"></div>
									</td>
									<td style="text-align:right;">Surname&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtSNameEn" id="txtSNameEn" value="<?php echo $result_candidate['sname_en']?>"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">ID Card&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtIDcard" id="txtIDcard" maxlength="13" value="<?php echo $result_candidate['idcard']?>"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Nickname&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtNickname" id="txtNickname" style="width: 100%" value="<?php echo $result_candidate['nickname']?>"></div>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 65px">ชื่อ&nbsp;</td>
									<td>
										<div class="col-sm-5">
											<select name="ddTitleTh" id="ddTitleTh" class="ddStyle" style="width: 100%">
												<option value="">-เลือก-</option>
												<option value="นาย" <?php echo ($result_candidate['title_th'] == "นาย" ? "selected" : "") ?>>นาย</option>
												<option value="นาง" <?php echo ($result_candidate['title_th'] == "นาง" ? "selected" : "") ?>>นาง</option>
												<option value="นางสาว" <?php echo ($result_candidate['title_th'] == "นางสาว" ? "selected" : "") ?>>นางสาว</option>
											</select>
										</div>
									</td>
								</tr>
								</table>
							</td>
							<td colspan="3">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtNameTh" id="txtNameTh" value="<?php echo $result_candidate['name_th']?>"></div>
									</td>
									<td style="text-align:right;">นามสุกล&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtSNameTh" id="txtSNameTh" value="<?php echo $result_candidate['sname_th']?>"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Passport&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtPassport" id="txtPassport" maxlength="20" value="<?php echo $result_candidate['passport']?>"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Country&nbsp;</td>
									<td>
										<div class="col-sm-5">
										<select name="ddPassportCountry" id="ddPassportCountry" class="ddStyle" style="width: 100%">
											<option value="">-Select-</option>
											<optgroup label="ประเทศนิยม">
												<?php
													$sql_country = "SELECT country,country_val FROM passport_country Where country_pop=1 order by country";
													$stmt_country = $con->query($sql_country);
													while ($result_country = $stmt_country->fetch()) {
												?>
													<option value="<?php echo $result_country['country_val']?>"><?php echo $result_country['country']?></option>
												<?php } ?>
											</optgroup>
											<optgroup label="ทั้งหมด">
												<?php
													$sql_country_all = "SELECT country,country_val FROM passport_country order by country";
													$stmt_country_all = $con->query($sql_country_all);
													while ($result_country_all = $stmt_country_all->fetch()) {
												?>
													<option value="<?php echo $result_country_all['country_val']?>" <?php echo ($result_candidate['passport_country'] == $result_country_all['country_val'] ? "selected" : "") ?>><?php echo $result_country_all['country']?></option>
												<?php } ?>
											</optgroup>
										</select>
										</div>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">Address&nbsp;</td>
							<td colspan="5">
								<div class="col-sm-5"><input class="form-control" type="text" name="txtAddress" id="txtAddress" maxlength="300" value="<?php echo $result_candidate['address']?>"></div>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">Province&nbsp;</td>
							<td colspan="3">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="width: 30%">
										<?php
											$sql_province = "SELECT provinceID,provinceThai FROM v_province";
											$stmt_province = $con->query($sql_province);
										?>
										<select name="ddProvince" id="ddProvince" class="ddStyle" style="width: 100%;cursor: pointer;">
											<option value="">-เลือกจังหวัด-</option>
										<?php while ($result_province = $stmt_province->fetch()) { ?>
											<option value="<?php echo $result_province['provinceID']?>" <?php echo ($result_candidate['province'] == $result_province['provinceThai'] ? "selected" : "") ?>><?php echo $result_province['provinceThai']?></option>
										<?php }?>
										 </select>
										 <input type="hidden" name="ddProvince_info" id="ddProvince_info" value="<?php echo $result_candidate['province'] ?>">
									</td>
									<td style="text-align:right">District&nbsp;</td>
									<td style="width: 30%">
										<?php
											$sql_amphure = "SELECT provinceID,districtID,districtThai,districtThaiShort FROM v_district WHERE provinceThai='".$result_candidate['province']."' ";
											$stmt_amphure = $con->query($sql_amphure);
										?>
										<select name="ddDistrict" id="ddDistrict" class="ddStyle" style="width: 100%;cursor: pointer;">
											<option value="">-เลือกอำเภอ-</option>
											<?php while ($result_amphure = $stmt_amphure->fetch()) { ?>
											<option value="<?php echo $result_amphure['districtID']?>" <?php echo ($result_candidate['district'] == $result_amphure['districtThai'] ? "selected" : "") ?>><?php echo $result_amphure['districtThai']?></option>
										<?php }?>
										 </select>
										 <input type="hidden" name="ddDistrict_info" id="ddDistrict_info" value="<?php echo $result_candidate['district'] ?>">
									</td>
									<td style="text-align:right">SubDistrict&nbsp;</td>
									<td style="width: 30%">
										<?php
											$sql_tambon = "SELECT provinceID,provinceThai,districtID,districtThai ,tambonID,tambonThai,tambonThaiShort,postCodeMain FROM v_sdistrict WHERE districtThai='".$result_candidate['district']."' ";
											$stmt_tambon = $con->query($sql_tambon);
										?>
										<select name="ddSubDistrict" id="ddSubDistrict" class="ddStyle" style="width: 100%;cursor: pointer;">
											<option value="">-เลือกตำบล-</option>
											<?php while ($result_tambon = $stmt_tambon->fetch()) { ?>
											<option value="<?php echo $result_tambon['provinceThai'].'|'.$result_tambon['districtThai'].'|'.$result_tambon['tambonID'].'|'.$result_tambon['tambonThai'].'|'.$result_tambon['postCodeMain']?>" <?php echo ($result_candidate['subdistrict'] == $result_tambon['tambonThai'] ? "selected" : "") ?>><?php echo $result_tambon['tambonThai']?></option>
											<?php } ?>
										 </select>
										 <input type="hidden" name="ddSubDistrict_info" id="ddSubDistrict_info" value="<?php echo $result_candidate['subdistrict'] ?>">
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 30%">ZipCode&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtZipcode" id="txtZipcode" value="<?php echo $result_candidate['zipcode']?>"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td style="text-align:right;width: 25%">LineID&nbsp;</td>
										<td>
											<?php 
												$LineID = '';
												$sql_candidate_contact_line ="SELECT * FROM candidate_contact where candidate_ID = '".$id."' and contact_type='LineID' ";
												$stmt_candidate_contact_line = $con->query($sql_candidate_contact_line);
												$rows_candidate_contact_line = $stmt_candidate_contact_line->rowCount();
												//echo 'rows - '.$rows."<br/>";
												if ($rows_candidate_contact_line > 0){
													while ($result_candidate_contact_line = $stmt_candidate_contact_line->fetch()) {
															$LineID = $result_candidate_contact_line['contact_info'] ; 
													}
												}
											?>
											<div class="col-sm-5"><input class="form-control" type="text" name="txtLineID" id="txtLineID" value="<?php echo $LineID?>"></div>
										</td>
									</tr>
									</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<fieldset>
									<legend>Blood Group</legend>
									<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td style="width: 50%">
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_O" name="radBlood" value="O" <?php echo ($result_candidate['blood'] == 'O' ? "checked" : "") ?>> O</label>
										</td>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_A" name="radBlood" value="A" <?php echo ($result_candidate['blood'] == 'A' ? "checked" : "") ?>> A</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_AB" name="radBlood" value="AB" <?php echo ($result_candidate['blood'] == 'AB' ? "checked" : "") ?>> AB</label>
										</td>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_B" name="radBlood" value="B" <?php echo ($result_candidate['blood'] == 'B' ? "checked" : "") ?>> B</label>
										</td>
									</tr>
									<tr>
										<td><label class="lblcontainer">&nbsp;</label></td>
										<td><label class="lblcontainer">&nbsp;</label></td>
									</tr>
									</table>
								</fieldset>
							</td>
							<td>
									<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
									<td style="width: 50%">
										<fieldset>
											<legend>Gender</legend>
											<table border="0" style="width: 100%" class="tabForm_inside">
											<tr>
												<td>
													<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radGender_male" name="radGender" value="Male" <?php echo ($result_candidate['gender'] == 'Male' ? "checked" : "") ?>> Male&nbsp;</label>
												</td>
											</tr>
											<tr>
												<td>
													<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radGender_female" name="radGender" value="Female" <?php echo ($result_candidate['gender'] == 'Female' ? "checked" : "") ?>> Female&nbsp;</label>
												</td>
											</tr>
											<tr>
												<td><label class="lblcontainer">&nbsp;</label></td>
											</tr>
											</table>
										</fieldset>
									</td>
									<td>
										<fieldset>
											<legend>สนใจงาน Contract</legend>
											<table border="0" style="width: 100%" class="tabForm_inside">
												<tr>
													<td>
														<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radContract_y" name="radContract" value="Y" <?php echo ($result_candidate['contract'] == 'Y' ? "checked" : "") ?>> Yes&nbsp;&nbsp;</label>
													</td>
												</tr>
												<tr>
													<td>
														<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radContract_n" name="radContract" value="N" <?php echo ($result_candidate['contract'] == 'N' ? "checked" : "") ?>> No</label>
													</td>
												</tr>
												<tr>
													<td><label class="lblcontainer">&nbsp;</label></td>
												</tr>
												</table>
										</fieldset>
									</td>
									</tr>
									</table>
							</td>
							<td>
								<fieldset>
									<legend>Exp. Status</legend>
									<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radExpStatus_normal" name="radExpStatus" value="Normal" <?php echo ($result_candidate['expstatus'] == 'Normal' ? "checked" : "") ?>> Normal&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radExpStatus_blacklist" name="radExpStatus" value="Blacklist" <?php echo ($result_candidate['expstatus'] == 'Blacklist' ? "checked" : "") ?>> Blacklist&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td><label class="lblcontainer"><input class="form-control" type="text" id="txtExpStatus" name="txtExpStatus" maxlength="100" value="<?php echo $result_candidate['expstatus_info']?>"></label></td>
									</tr>
									</table>
								</fieldset>
							</td>
							<td>
								<fieldset>
									<legend>Marital Status</legend>
									<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radMarital_single" name="radMarital" value="Single" <?php echo ($result_candidate['marital'] == 'Single' ? "checked" : "") ?>> Single&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radMarital_married" name="radMarital" value="Married" <?php echo ($result_candidate['marital'] == 'Married' ? "checked" : "") ?>> Married</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radMarital_widowed" name="radMarital" value="Widowed" <?php echo ($result_candidate['marital'] == 'Widowed' ? "checked" : "") ?>> Widowed&nbsp;</label>
										</td>
									</tr>
									</table>
								</fieldset>
							</td>
							<td>
								<fieldset>
									<legend>Nationality</legend>
									<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radNationality_thai" name="radNationality" value="Thai" <?php echo ($result_candidate['nationality'] == 'Thai' ? "checked" : "") ?>> Thai&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radNationality_Other" name="radNationality" value="Other" <?php echo ($result_candidate['nationality'] == 'Other' ? "checked" : "") ?>> Other&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td><label class="lblcontainer"><input class="form-control" type="text" name="txtNationality" id="txtNationality" maxlength="100" value="<?php echo $result_candidate['nationality_info']?>"></label></td>
									</tr>
									</table>
								</fieldset>
							</td>
							<td>
								<div class="col-sm-5">
								<fieldset>
									<legend>Ethnicity</legend>
									<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radEthnicity_thai" name="radEthnicity" value="Thai" <?php echo ($result_candidate['ethnicity'] == 'Thai' ? "checked" : "") ?>> Thai&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radEthnicity_other" name="radEthnicity" value="Other" <?php echo ($result_candidate['ethnicity'] == 'Other' ? "checked" : "") ?>> Other&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td><label class="lblcontainer"><input class="form-control" type="text" name="txtEthnicity" id="txtEthnicity" maxlength="100" value="<?php echo $result_candidate['ethnicity_info']?>"></label></td>
									</tr>
									</table>
								</fieldset>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">Date of Birth&nbsp;</td>
							<td colspan="2">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="width: 15%;height:40px">
										<!--<div class="col-sm-5"><input id="txtBDDate" name="txtBDDate"  class="input-group date" type="text" style="width: 200px"></div>-->
										<input class="datepicker form-control" id="txtBDDate" name="txtBDDate" size="16" type="text" style="width: 200px" value="<?php echo $result_candidate['birthdate']?>">
									</td>
									<td style="text-align:right;width: 10%;">Age&nbsp;</td>
									<td style="text-align:center;width: 15%;"><div class="divLast" name="txtAgeYear" id="txtAgeYear">&nbsp;</div><input type="hidden" id="txtAgeYear_val" name="txtAgeYear_val"></td>
									<td>Year</td>
									<td style="text-align:center;width: 15%;"><div class="divLast" name="txtAgeMonth" id="txtAgeMonth">&nbsp;</div><input type="hidden" id="txtAgeMonth_val" name="txtAgeMonth_val"></td>
									<td>Month</td>
									<td style="text-align:center;width: 15%;"><div class="divLast" name="txtAgeDay" id="txtAgeDay">&nbsp;</div><input type="hidden" id="txtAgeDay_val" name="txtAgeDay_val"></td>
									<td>Day</td>
								</tr>
								</table>
							</td>
							<td colspan="3">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
								<td>
									<table border="0" style="width: 100%" class="tabForm_inside tbleMail">
									<?php 
										$sql_candidate_contact_mail ="SELECT * FROM candidate_contact where candidate_ID = '".$id."' and contact_type='Email' ";
										$stmt_candidate_contact_mail = $con->query($sql_candidate_contact_mail);
										$rows_candidate_contact_mail = $stmt_candidate_contact_mail->rowCount();
										if ($rows_candidate_contact_mail == 0){
									?>
										<tr>
											<td style="text-align:right;width: 15%;height:40px">Email&nbsp;</td>
											<td>
												<div class="col-sm-5"><input class="form-control" type="text" name="txtEmail[]" value=""></div>
											</td>
											<td>
												<button type="button" class="addrow btn btn-success" title="Add more email" id="btn_addeMail" name="btn_addeMail" ><i class="fa fa-plus-square-o"></i></button>
											</td>
										</tr>
									<?php
									}else {
										$m =0;
										while ($result_candidate_contact_mail = $stmt_candidate_contact_mail->fetch()) {
									?>
										<tr>
											<td style="text-align:right;width: 15%;height:40px">Email&nbsp;</td>
											<td>
												<div class="col-sm-5"><input class="form-control" type="text" name="txtEmail[]" value="<?php echo $result_candidate_contact_mail['contact_info']?>"></div>
											</td>
											<td>
												<?php if ($m==0){?><button type="button" class="addrow btn btn-success" title="Add more email" id="btn_addeMail" name="btn_addeMail" ><i class="fa fa-plus-square-o"></i></button><?php }?>
											</td>
										</tr>
									<?php 
											$m++;
										} //end while
									}?>
									</table>
								</td>
								<td>
									<table border="0" style="width: 100%" class="tabForm_inside tblTelephone">
									<?php 
										$sql_candidate_contact_tel ="SELECT * FROM candidate_contact where candidate_ID = '".$id."' and contact_type='Telephone' ";
										$stmt_candidate_contact_tel = $con->query($sql_candidate_contact_tel);
										$rows_candidate_contact_tel = $stmt_candidate_contact_tel->rowCount();
										if ($rows_candidate_contact_tel == 0){
									?>
										<tr>
											<td style="text-align:right;width: 22%;height:40px">Telephone&nbsp;</td>
											<td>
												<div class="col-sm-5"><input class="form-control" type="text" name="txtTelephone[]" value=""></div>
											</td>
											<td>
												<button type="button" class="addrow btn btn-success" title="Add more telephone" id="btn_addTel" name="btn_addTel" ><i class="fa fa-plus-square-o"></i></button>
											</td>
										</tr>
									<?php
									}else {
										$t =0;
										while ($result_candidate_contact_tel = $stmt_candidate_contact_tel->fetch()) {
									?>
										<tr>
											<td style="text-align:right;width: 22%;height:40px">Telephone&nbsp;</td>
											<td>
												<div class="col-sm-5"><input class="form-control" type="text" name="txtTelephone[]" value="<?php echo $result_candidate_contact_tel['contact_info']?>"></div>
											</td>
											<td>
												<?php if ($t==0){?><button type="button" class="addrow btn btn-success" title="Add more telephone" id="btn_addTel" name="btn_addTel" ><i class="fa fa-plus-square-o"></i></button><?php }?>
											</td>
										</tr>
									<?php 
											$t++;
										} //end while
									}?>
									</table>
								</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="height:1px;width: 6%"></td>
							<td style="height:1px;width: 6%"></td>
							<td style="height:1px;width: 24%"></td>
							<td style="height:1px;width: 16%"></td>
							<td style="height:1px;width: 16%"></td>
							<td style="height:1px;width: 16%"></td>
							<td style="height:1px;width: 16%"></td>
						</tr>
					</table>
					<?php 
						}	//end while candidate 
					} 		//end if rows_candidate candidate
					?>
				</div>
				<!--End Part1-->
				<br/>
				<!--Start Part2-->
				<div class="part_form">
					<h4 class="mb-4">Part 2 :  Position & Skill</h4>
					<table border="0" style="width: 100%" class="tabForm_part">
					<tr>
						<td colspan="3" style="text-align:left;background: #0891f8;color: #fff;"><h6>Position</h6></td>
						<td style="background: #0891f8;color: #fff;"><h6>Skill</h6></td>
						<td colspan="3" style="background: #0891f8;color: #fff;"></td>
					</tr>
					<?php
						$sql_position_SAP ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='SAP' ";
						//echo 'sql SAP - '.$sql_position_SAP;
						$stmt_position_SAP = $con->query($sql_position_SAP);
						$rows_position_SAP = $stmt_position_SAP->rowCount();
						if ($rows_position_SAP > 0)
							while ($result_position_SAP = $stmt_position_SAP->fetch()) 
								$SAP = 'checked';
						else	
							$SAP = '';
						
						$sql_positionskill_SAP ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='SAP' ";
						//echo 'sql SAP - '.$sql_positionskill_SAP."<br/>";
						
						$stmt_positionskill_SAP = $con->query($sql_positionskill_SAP);
						$rows_positionskill_SAP = $stmt_positionskill_SAP->rowCount();
						
						$SAP_skill = array();
						if ($rows_positionskill_SAP > 0){
							$sa = 0;
							while ($result_positionskill_SAP = $stmt_positionskill_SAP->fetch()) {
								$SAP_skill[$sa] = $result_positionskill_SAP['skill'];
								$sa++;
							}
						}
					?>
					<tr> <!--SAP-->
						<td colspan="2">
							<div class="col-sm-5"><label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_SAP" name="chkPosition[]" value="SAP" <?php echo $SAP?>>&nbsp;&nbsp;SAP</label></div>
						</td>
						<td style="text-align:right;">Module :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							 <select name="ddModule[]" id="ddModule" class="ddStyle" style="width: 100%" multiple>
								<?php
									$sql_SAP = "SELECT SAP_module,SAP_moduleVal FROM sap_modules order by SAP_module";
									$stmt_SAP = $con->query($sql_SAP);
									while ($result_SAP = $stmt_SAP->fetch()) {
								?>
									<option value="<?php echo $result_SAP['SAP_moduleVal']?>" <?php echo (in_array($result_SAP['SAP_moduleVal'],$SAP_skill) ? "selected" : "") ?>><?php echo $result_SAP['SAP_module'].' ('.$result_SAP['SAP_moduleVal'].')'?></option>
									<?php } ?>
							 </select>
						</td>
					</tr>
					<?php
						$sql_position_Programmer ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='Programmer' ";
						//echo 'sql Programmer - '.$sql_position_Programmer;
						$stmt_position_Programmer  = $con->query($sql_position_Programmer);
						$rows_position_Programmer = $stmt_position_Programmer ->rowCount();
						
						if ($rows_position_Programmer > 0)
							while ($result_position_Programmer = $stmt_position_Programmer ->fetch()) 
								$Programmer = 'checked';
						else	
							$Programmer = '';
						
						$sql_positionskill_Programmer ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='Programmer' ";
						//echo 'sql Programmer - '.$sql_positionskill_Programmer."<br/>";
						$stmt_positionskill_Programmer = $con->query($sql_positionskill_Programmer);
						$rows_positionskill_Programmer = $stmt_positionskill_Programmer->rowCount();
						
						$Programmer_skill = array();
						if ($rows_positionskill_Programmer > 0){
							$pg = 0;
							while ($result_positionskill_Programmer = $stmt_positionskill_Programmer->fetch()) {
								$Programmer_skill[$pg] = $result_positionskill_Programmer['skill'];
								$pg++;
							}
						}
					?>
					<tr> <!--Programmer-->
						<td colspan="2">
							<div class="col-sm-5"><label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Programmer" name="chkPosition[]" value="Programmer" <?php echo $Programmer?>>&nbsp;&nbsp;Programmer</label></div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							<select name="ddLanguage[]" id="ddLanguage" class="ddStyle" style="width: 100%" multiple>
								<?php
									$sql_lang = "SELECT lang,lang_val FROM prog_lang order by lang";
									$stmt_lang = $con->query($sql_lang);
									while ($result_lang = $stmt_lang->fetch()) {
								?>
									<option value="<?php echo $result_lang['lang_val']?>" <?php echo (in_array($result_lang['lang_val'],$Programmer_skill) ? "selected" : "") ?>><?php echo $result_lang['lang']?></option>
								<?php } ?>
							 </select>
						</td>
					</tr>
					<?php
						$sql_position_SA ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='SA' ";
						//echo 'sql SA - '.$sql_position_SA;
						
						$stmt_position_SA = $con->query($sql_position_SA);
						$rows_position_SA = $stmt_position_SA->rowCount();
						
						if ($rows_position_SA > 0)
							while ($result_position_SA = $stmt_position_SA->fetch())
								$SA = 'checked';
						else	
							$SA = '';
						
						$sql_positionskill_SA ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='SA' and skill_type='choice' ";
						//echo 'sql SA - '.$sql_positionskill_SA."<br/>";
						$stmt_positionskill_SA = $con->query($sql_positionskill_SA);
						$rows_positionskill_SA = $stmt_positionskill_SA->rowCount();
						
						if ($rows_positionskill_SA > 0)
							while ($result_positionskill_SA = $stmt_positionskill_SA->fetch())
								$SA_skill = $result_positionskill_SA['skill'];
						else	
							$SA_skill = 'N';
						
						$sql_positionskill_SA_txt ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='SA' and skill_type='text' ";
						//echo 'sql SA - '.$sql_positionskill_SA."<br/>";
						$stmt_positionskill_SA_txt = $con->query($sql_positionskill_SA_txt);
						$rows_positionskill_SA_txt = $stmt_positionskill_SA_txt->rowCount();
						
						if ($rows_positionskill_SA_txt > 0)
							while ($result_positionskill_SA_txt = $stmt_positionskill_SA_txt->fetch())
								$SA_skill_txt = $result_positionskill_SA_txt['skill'];
						else
							$SA_skill_txt ='';
						
					?>
					<tr> <!--SA-->
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_SA" name="chkPosition[]" value="SA" <?php echo $SA?>>&nbsp;&nbsp;SA</label>
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radSACode_y" name="radSACode" value="Y" <?php echo ($SA_skill== 'Y' ? "checked" : "") ?>> Yes&nbsp;&nbsp;</label>
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radSACode_n" name="radSACode" value="N" <?php echo ($SA_skill== 'N' ? "checked" : "") ?>> No</label>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<input class="form-control" type="text" id="txtSALange" name="txtSALange" style="width: 100%" value="<?php echo $SA_skill_txt?>">
						</td>
					</tr>
					<?php
						$sql_position_BA ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='BA' ";
						//echo 'sql BA - '.$sql_position_BA;
						
						$stmt_position_BA = $con->query($sql_position_BA);
						$rows_position_BA = $stmt_position_BA->rowCount();
						
						if ($rows_position_BA > 0)
							while ($result_position_BA = $stmt_position_BA->fetch())
								$BA = 'checked';
						else	
							$BA = '';
						
						$sql_positionskill_BA ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='BA' and skill_type='choice' ";
						//echo 'sql BA - '.$sql_positionskill_BA."<br/>";
						$stmt_positionskill_BA  = $con->query($sql_positionskill_BA);
						$rows_positionskill_BA = $stmt_positionskill_BA ->rowCount();
						
						if ($rows_positionskill_BA > 0)
							while ($result_positionskill_BA = $stmt_positionskill_BA ->fetch())
								$BA_skill = $result_positionskill_BA['skill'];
						else	
							$BA_skill = 'N';
						
						$sql_positionskill_BA_txt ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='BA' and skill_type='text' ";
						//echo 'sql BA - '.$sql_positionskill_BA."<br/>";
						$stmt_positionskill_BA_txt = $con->query($sql_positionskill_BA_txt);
						$rows_positionskill_BA_txt = $stmt_positionskill_BA_txt->rowCount();
						
						if ($rows_positionskill_BA_txt > 0)
							while ($result_positionskill_BA_txt = $stmt_positionskill_BA_txt->fetch())
								$BA_skill_txt = $result_positionskill_BA_txt['skill'];
						else
							$BA_skill_txt ='';
					?>
					<tr> <!--BA-->
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_BA" name="chkPosition[]" value="BA" <?php echo $BA?>>&nbsp;&nbsp;BA</label>
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBACode_y" name="radBACode" value="Y" <?php echo ($BA_skill== 'Y' ? "checked" : "") ?>> Yes&nbsp;&nbsp;</label>
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBACode_n" name="radBACode" value="N" <?php echo ($BA_skill== 'N' ? "checked" : "") ?>> No</label>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<input class="form-control" type="text" id="txtBALange" name="txtBALange" style="width: 100%" value="<?php echo $BA_skill_txt?>">
						</td>
					</tr>
					<?php
						$sql_position_Tester ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='Tester' ";
						//echo 'sql Tester - '.$sql_position_Tester;
						$stmt_position_Tester = $con->query($sql_position_Tester);
						$rows_position_Tester = $stmt_position_Tester->rowCount();
						
						if ($rows_position_Tester > 0)
							while ($result_position_Tester = $stmt_position_Tester->fetch())
								$Tester = 'checked';
						else	
							$Tester = '';
						
						$sql_positionskill_Tester ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='Tester' and skill_type='choice' ";
						//echo 'sql Tester - '.$sql_positionskill_Tester."<br/>";
						$stmt_positionskill_Teste = $con->query($sql_positionskill_Tester);
						$rows_positionskill_Tester = $stmt_positionskill_Teste->rowCount();
						
						$Tester_skill = array();
						if ($rows_positionskill_Tester > 0){
							$tt = 0;
							while ($result_positionskill_Tester = $stmt_positionskill_Teste->fetch()){
								$Tester_skill[$tt] = $result_positionskill_Tester['skill'];
								$tt++;
							}
						}
					?>
					<tr> <!--Tester-->
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Tester" name="chkPosition[]" value="Tester" <?php echo $Tester?>>&nbsp;&nbsp;Tester</label>
						</td>
						<td style="text-align:right;">Testing :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="checkbox" class="checkbox label_inline lblcontainer" id="chkTester_Automate" name="chkTester[]" value="Automate" <?php echo (in_array('Automate',$Tester_skill) ? "checked" : "") ?>> Automate</label>
								<label class="lblcontainer"><input type="checkbox" class="checkbox label_inline lblcontainer" id="chkTester_Manual" name="chkTester[]" value="Manual" <?php echo (in_array('Manual',$Tester_skill) ? "checked" : "") ?>> Manual</label>
							</div>
						</td>
					</tr>
					<?php
						$sql_position_PM ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='PM' ";
						//echo 'sql PM - '.$sql_position_PM;
						$stmt_position_PM = $con->query($sql_position_PM);
						$rows_position_PM = $stmt_position_PM->rowCount();
						
						if ($rows_position_PM > 0)
							while ($result_position_PM = $stmt_position_PM->fetch())
								$PM = 'checked';
						else	
							$PM = '';
						
						$sql_positionskill_PM ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='PM' and skill_type='choice' ";
						//echo 'sql PM - '.$sql_positionskill_PM."<br/>";
						$stmt_positionskill_PM = $con->query($sql_positionskill_PM);
						$rows_positionskill_PM = $stmt_positionskill_PM->rowCount();
						if ($rows_positionskill_PM > 0)
							while ($result_positionskill_PM = $stmt_positionskill_PM->fetch())
								$PM_skill = $result_positionskill_PM['skill'];
						else
							$PM_skill = 'N';
						
						$sql_positionskill_PM_txt ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='PM' and skill_type='text' ";
						//echo 'sql PM - '.$sql_positionskill_PM."<br/>";
						$stmt_positionskill_PM_txt = $con->query($sql_positionskill_PM_txt);
						$rows_positionskill_PM_txt = $stmt_positionskill_PM_txt->rowCount();
						
						if ($rows_positionskill_PM_txt > 0)
							while ($result_positionskill_PM_txt = $stmt_positionskill_PM_txt->fetch())
								$PM_skill_txt = $result_positionskill_PM_txt['skill'];
						else
							$PM_skill_txt ='';
					?>
					<tr> <!--PM-->
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_PM" name="chkPosition[]" value="PM" <?php echo $PM?>>&nbsp;&nbsp;Project Manager</label>
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radProjectManager_y" name="radProjectManager" value="Y" <?php echo ($PM_skill== 'Y' ? "checked" : "") ?>> Yes&nbsp;&nbsp;</label>
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radProjectManager_n" name="radProjectManager" value="N" <?php echo ($PM_skill== 'N' ? "checked" : "") ?>> No</label>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<input class="form-control" type="text" id="txtProjectManagerLang" name="txtProjectManagerLang" style="width: 100%" value="<?php echo $PM_skill_txt?>">
						</td>
					</tr>
					<?php
						$sql_position_Admin ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='Admin' ";
						//echo 'sql Admin - '.$sql_position_Admin;
						$stmt_position_Admin = $con->query($sql_position_Admin);
						$rows_position_Admin = $stmt_position_Admin->rowCount();
						if ($rows_position_Admin > 0)
							while ($result_position_Admin = $stmt_position_Admin->fetch())
								$Admin = 'checked';
						else	
							$Admin = '';
						
						$sql_positionskill_Admin_txt ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='Admin' and skill_type='text' ";
						//echo 'sql Admin - '.$sql_positionskill_Admin."<br/>";
						$stmt_positionskill_Admin_txt= $con->query($sql_positionskill_Admin_txt);
						$rows_positionskill_Admin_txt = $stmt_positionskill_Admin_txt->rowCount();
						if ($rows_positionskill_Admin_txt > 0)
							while ($result_positionskill_Admin_txt = $stmt_positionskill_Admin_txt->fetch())
								$Admin_skill_txt = $result_positionskill_Admin_txt['skill'];
						else
							$Admin_skill_txt ='';
					?>
					<tr> <!--Admin-->
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Admin" name="chkPosition[]" value="Admin" <?php echo $Admin?>>&nbsp;&nbsp;Project Admin</label>
						</td>
						<td style="text-align:right;">Skill :&nbsp;</td>
						<td colspan="3">
							<input class="form-control" type="text" id="txtProjectAdminSkill" name="txtProjectAdminSkill" style="width: 100%" value="<?php echo $Admin_skill_txt?>">
						</td>
					</tr>
					<?php
						$sql_position_Other ="SELECT * FROM candidate_position where candidate_ID = '".$id."' and position='Other' ";
						//echo 'sql Other - '.$sql_position_Other;
						$stmt_position_Other  = $con->query($sql_position_Other);
						$rows_position_Other = $stmt_position_Other ->rowCount();
						
						if ($rows_position_Other > 0)
							while ($result_position_Other = $stmt_position_Other ->fetch()){
								$Other = 'checked';
								$Other_txt = $result_position_Other['position_other'];
							}
						else{	
							$Other = '';
							$Other_txt = '';
						}
						$sql_positionskill_Other_txt ="SELECT skill FROM candidate_positionskill where candidate_ID = '".$id."' and position='Other' and skill_type='text' ";
						//echo 'sql Other - '.$sql_positionskill_Other."<br/>";
						$stmt_positionskill_Other_txt = $con->query($sql_positionskill_Other_txt);
						$rows_positionskill_Other_txt = $stmt_positionskill_Other_txt->rowCount();
						
						if ($rows_positionskill_Other_txt > 0){
							while ($result_positionskill_Other_txt = $stmt_positionskill_Other_txt->fetch()){
								$Other_skill_txt = $result_positionskill_Other_txt['skill'];
							}
						}
						else
							$Other_skill_txt ='';
					?>
					<tr> <!--Other-->
						<td>
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Other" name="chkPosition[]" value="Other" <?php echo $Other?>>&nbsp;&nbsp;Other</label>
						</td>
						<td>
							<input class="form-control" type="text" name="txtPositionOther" id="txtPositionOther" style="width: 100%" value="<?php echo $Other_txt?>">
						</td>
						<td style="text-align:right;">Skill :&nbsp;</td>
						<td colspan="3">
							<input class="form-control" type="text" id="txtPositionOtherSkill" name="txtPositionOtherSkill" style="width: 100%" value="<?php echo $Other_skill_txt?>">
						</td>
					</tr>
					<tr>
						<td style="width: 5%"></td>
						<td style="width: 10%"></td>
						<td style="width: 7%"></td>
						<td style="width: 7%"></td>
						<td style="width: 7%"></td>
						<td></td>
					</tr>
					</table>
				</div>
				<!--End Part2-->
				<br/>
				<!--Start Part3-1-->
				<div class="part_form">
					<?php
						$sql_callrecord ="SELECT * FROM candidate_callrecord where candidate_ID = '".$id."' order by call_date";
						//echo 'sql_callrecord - '.$sql_callrecord.'<br>';
						$stmt_callrecord= $con->query($sql_callrecord);
						$rows_callrecord = $stmt_callrecord->rowCount();
					?>
					<div class="div_inline"><h4 class="mb-4 div_inline">Part 3-1 : Call Record</h4>&nbsp;&nbsp;
					<button type="button" class="addrow btn btn-success" title="Add more call record" id="btn_add31" name="btn_add31" ><i class="fa fa-plus-square-o"></i> Add</button>
						<input type="hidden" id="txtPart31ID" style="width: 20px" value="<?php echo $rows_callrecord ?>">
					</div>
					<table border="0" style="width: 100%;border-color:#DDDDDD" id="tab31" class="tbl31">
					<tbody>
					<?php
						if ($rows_callrecord == 0){
					?>
						<tr>
							<td>
								<button class="delrow btn btn-danger" title="Delete call record"><i class="fa fa-trash-o fa-lg"></i> Delete</button><input type="hidden" id="callRow1" name="callRow[]" style="width: 20px" value="1">
								<table border="0" style="width: 100%" class="tabForm_part">
								<tr>
									<td style="text-align:right;">Call Date : </td>
									<td colspan="3">
										<input class="datepicker form-control" id="txtCallDate1" name="txtCallDate1" size="16" type="text" style="width: 200px;cursor:pointer">
									</td>
									<td style="text-align:right;">Call By : </td>
									<td colspan="2">
										<div class="col-sm-5"><input class="form-control" type="text" name="txtCallBy1" id="txtCallBy1" value="<?php echo $str_l ?>"></div>
									</td>
									<td></td>
								</tr>
								<tr>
									<td style="text-align:right;">Current Position : </td>
									<td colspan="2">
										<select id="ddCurrentPosition1" name="ddCurrentPosition1" class="ddStyle ddSearch" style="width: 100%"></select>   
									</td>
									<td>
										<button type="button" class="btn btn-success" title="Add Position" data-toggle="modal" data-target="#modalPosition"  id="btn_addPosition" name="btn_addPosition"><i class="fa fa-plus-square-o"></i></button>
									</td>
									<td style="text-align:right;">Interested Position : </td>
									<td colspan="2">
										<select id="ddInterestedPosition1" name="ddInterestedPosition1" class="ddStyle ddSearch" style="width: 100%"></select>
									</td>
									<td>
										<button type="button" class="btn btn-success" title="Add Position" data-toggle="modal" data-target="#modalPosition"  id="btn_addIPosition" name="btn_addIPosition"><i class="fa fa-plus-square-o"></i></button>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Years of Experience : </td>
									<td colspan="2">
										<table border="0" style="width: 100%" style="padding: 0px 0px 0px 0px;">
										<tr>
											<td style="text-align:right;width: 25%"><input class="form-control col-sm-5r" type="text" id="txtYearExp1" name="txtYearExp1" style="width: 100%" maxlength="2" value="0"></td><td>&nbsp;Year&nbsp;</td>
											<td style="text-align:right;width: 25%"><input class="form-control col-sm-5r" type="text" id="txtMonthExp1" name="txtMonthExp1" style="width: 100%" maxlength="2" value="0"></td><td>&nbsp;Month&nbsp;</td>
											<td style="text-align:right;width: 25%"><input class="form-control col-sm-5r" type="text" id="txtDayExp1" name="txtDayExp1" style="width: 100%" maxlength="2" value="0"></td><td>&nbsp;Day&nbsp;</td>
										</tr>
										</table>
									</td>
									<td></td>
									<td style="text-align:right;">Present Type of Employment : </td>
									<td colspan="3">
										<select name="ddTypeEmp1" id="ddTypeEmp1" class="ddStyle" style="width: 100%">
											<option value="">--Select--</option>
											<option value="Contract">Contract</option>
											<option value="FullTime">Full-time</option>
											<option value="Freelance">Freelance</option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Present Salary : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtPresentSalary1" name="txtPresentSalary1" style="width: 100%" value="0.00"></td>
									<td>฿</td>
									<td style="text-align:right;">Bonus (Months) : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtBonus1" name="txtBonus1" style="width: 100%" value="0"></td>
									<td>month</td>
								</tr>
								<tr>
									<td style="text-align:right;background-color:#EAEAEA">Other Income : </td>
									<td style="text-align:right;background-color:#EAEAEA">Notebook : </td>
									<td style="background-color:#EAEAEA"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_notebook1" name="txtOtherIncome_notebook1" style="width: 100%" value="0.00"></td>
									<td style="background-color:#EAEAEA">฿</td>
									<td style="text-align:right;background-color:#EAEAEA">Stand By : </td>
									<td style="background-color:#EAEAEA" colspan="2"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_StandBy1" name="txtOtherIncome_StandBy1" style="width: 100%" value="0.00"></td>
									<td style="background-color:#EAEAEA">฿</td>
								</tr>
								<tr>
									<td style="text-align:right;background-color:#EAEAEA"></td>
									<td style="text-align:right;background-color:#EAEAEA">Transportation : </td>
									<td style="background-color:#EAEAEA"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_transportation1" name="txtOtherIncome_transportation1" style="width: 100%" value="0.00"></td>
									<td style="background-color:#EAEAEA">฿</td>
									<td style="text-align:right;background-color:#EAEAEA">Shift Work : </td>
									<td style="background-color:#EAEAEA" colspan="2"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_ShiftWork1" name="txtOtherIncome_ShiftWork1" style="width: 100%" value="0.00"></td>
									<td style="background-color:#EAEAEA">฿</td>
								</tr>
								<tr>
									<td style="text-align:right;background-color:#EAEAEA"></td>
									<td style="text-align:right;background-color:#EAEAEA">OT : </td>
									<td style="background-color:#EAEAEA"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_OT1" name="txtOtherIncome_OT1" style="width: 100%" value="0.00"></td>
									<td style="background-color:#EAEAEA">฿</td>
									<td style="text-align:right;background-color:#EAEAEA">Others : </td>
									<td style="background-color:#EAEAEA"><input class="form-control" type="text" id="txtOtherIncome_Others1" name="txtOtherIncome_Others1" style="width: 100%" maxlength="200"></td>
									<td style="background-color:#EAEAEA">
										<input class="form-control col-sm-5r" type="text" id="txtOtherIncome_Others1_baht" name="txtOtherIncome_Others1_baht" style="width: 100%" value="0.00">
									</td>
									<td style="background-color:#EAEAEA">฿</td>
								</tr>
								<tr>
									<td style="text-align:right;">BBS Offer by Calculation : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtBBSOfferCalculation1" name="txtBBSOfferCalculation1" readonly style="width: 100%" value="0.00"></td>
									<td>฿</td>
									<td style="text-align:right;">Starting date for new job : </td>
									<td colspan="3"><input class="datepicker form-control" id="txtStartDateNewJob1" name="txtStartDateNewJob1" size="16" type="text" style="width: 200px;cursor:pointer"></td>
								</tr>
								<tr>
									<td style="text-align:right;">Salary Offer by BBS : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtBBSOffer1" name="txtBBSOffer1" style="width: 100%" value="0.00"></td>
									<td>฿</td>
									<td style="text-align:right;">Expectation Salary : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtExpectationSalary1" name="txtExpectationSalary1" style="width: 100%" value="0.00"></td>
									<td>฿</td>
								</tr>
								<tr>
									<td style="text-align:right;">Note : </td>
									<td colspan="7">
										<textarea id="txtNote1" name="txtNote1" rows="2" style="width: 100%" maxlength="300"></textarea>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Matching Requirement Number : </td>
									<td colspan="7"><input class="form-control" type="text" id="txtCallRec_matchingNo1" name="txtCallRec_matchingNo1" style="width: 100%" readonly value="autogen1234"></td>
								</tr>
								<tr>
									<td style="width: 17%"></td>
									<td style="width: 10%"></td>
									<td style="width: 20%"></td>
									<td style="width: 5%"></td>
									<td style="width: 15%"></td>
									<td></td>
									<td></td>
									<td style="width: 5%"></td>
								</tr>
								<tr><td style="background-color:#008df3;height:1px;overflow:hidden;" colspan="8"></td></tr>
								</table>
								<script type="text/javascript">
									var nowTemp = new Date();
									var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
									var txtCallDate1 = $('#txtCallDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
										txtCallDate1.hide();
										var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#callRow1').val();	//YYYYMMDD-row
										$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
									}).data('datepicker');
									txtCallDate1.setValue(now);
								
									var dateStr = $("#candidate_ID").val()+'-'+$('#txtCallDate1').val().substring(0,4)+$('#txtCallDate1').val().substring(5,7)+$('#txtCallDate1').val().substring(8,10)+'-'+$('#callRow1').val();	 //YYYYMMDD-row
									$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
								
									var txtStartDateNewJob1 = $('#txtStartDateNewJob1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDateNewJob1.hide()}).data('datepicker');
									txtStartDateNewJob1.setValue(now);
									
									$("#txtPresentSalary1").keyup(function(){
										var txtBBSOfferCalculation1 = 0;
										txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary1').val()) + (parseInt($('#txtPresentSalary1').val()) * parseInt($('#txtBonus1').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary1').val());
										$("#txtBBSOfferCalculation"+$('#callRow1').val()).val(txtBBSOfferCalculation1);
									});
									$("#txtBonus1").keyup(function(){
										var txtBBSOfferCalculation1 = 0;
										txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary1').val()) + (parseInt($('#txtPresentSalary1').val()) * parseInt($('#txtBonus1').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary1').val());
										$("#txtBBSOfferCalculation"+$('#callRow1').val()).val(txtBBSOfferCalculation1);
									});
								</script>
							</td>
						</tr>
					<?php
						}else{
							$cr=0;
							while ($result_callrecord = $stmt_callrecord->fetch()) {
								$cr++;
					?>
						<tr>
							<td>
								<button class="delrow btn btn-danger" title="Delete call record"><i class="fa fa-trash-o fa-lg"></i> Delete</button><input type="hidden" id="callRow<?php echo $cr?>" name="callRow[]" style="width: 20px" value="<?php echo $cr?>">
								<table border="0" style="width: 100%" class="tabForm_part">
								<tr>
									<td style="text-align:right;">Call Date : </td>
									<td colspan="3">
										<input class="datepicker form-control" id="txtCallDate<?php echo $cr?>" name="txtCallDate<?php echo $cr?>" size="16" type="text" style="width: 200px;cursor:pointer" value="<?php echo $result_callrecord['call_date'] ?>">
										<script type="text/javascript">
											var txtCallDate = $('#txtCallDate<?php echo $cr?>').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
												$(this).datepicker('hide');
												var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#callRow<?php echo $cr?>').val();	//YYYYMMDD-row
												$("#txtCallRec_matchingNo"+$('#callRow<?php echo $cr?>').val()).val(dateStr);
											}).data('datepicker');
										</script>
									</td>
									<td style="text-align:right;">Call By : </td>
									<td colspan="2">
										<div class="col-sm-5"><input class="form-control" type="text" name="txtCallBy<?php echo $cr?>" id="txtCallBy<?php echo $cr?>" value="<?php echo $result_callrecord['call_by'] ?>"></div>
									</td>
									<td></td>
								</tr>
								<tr>
									<td style="text-align:right;">Current Position : </td>
									<td colspan="2">
										<select id="ddCurrentPosition<?php echo $cr?>" name="ddCurrentPosition<?php echo $cr?>" class="ddStyle ddSearch" style="width: 100%"></select>   
										<script type="text/javascript">
											$(function(){
												$.post("load-dropdown.php",{position_id:"<?php echo $result_callrecord['current_position']?>",action:"load-position",act:'1'},function(data){
													$("#ddCurrentPosition<?php echo $cr?>").html(data);
												});
											}); //end function load drop down
										</script>
									</td>
									<td>
										<button type="button" class="btn btn-success" title="Add Position" data-toggle="modal" data-target="#modalPosition"  id="btn_addPosition" name="btn_addPosition"><i class="fa fa-plus-square-o"></i></button>
									</td>
									<td style="text-align:right;">Interested Position : </td>
									<td colspan="2">
										<select id="ddInterestedPosition<?php echo $cr?>" name="ddInterestedPosition<?php echo $cr?>" class="ddStyle ddSearch" style="width: 100%"></select>
										<script type="text/javascript">
											$(function(){
												$.post("load-dropdown.php",{position_id:"<?php echo $result_callrecord['interested_position']?>",action:"load-position",act:'1'},function(data){
													$("#ddInterestedPosition<?php echo $cr?>").html(data);
												});
											}); //end function load drop down
										</script>
									</td>
									<td>
										<button type="button" class="btn btn-success" title="Add Position" data-toggle="modal" data-target="#modalPosition"  id="btn_addIPosition" name="btn_addIPosition"><i class="fa fa-plus-square-o"></i></button>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Years of Experience : </td>
									<td colspan="2">
										<table border="0" style="width: 100%" style="padding: 0px 0px 0px 0px;">
										<tr>
											<td style="text-align:right;width: 25%"><input class="form-control col-sm-5r" type="text" id="txtYearExp<?php echo $cr?>" name="txtYearExp<?php echo $cr?>" style="width: 100%" maxlength="2" value="<?php echo $result_callrecord['exp_year'] ?>"></td><td>&nbsp;Year&nbsp;</td>
											<td style="text-align:right;width: 25%"><input class="form-control col-sm-5r" type="text" id="txtMonthExp<?php echo $cr?>" name="txtMonthExp<?php echo $cr?>" style="width: 100%" maxlength="2" value="<?php echo $result_callrecord['exp_month'] ?>"></td><td>&nbsp;Month&nbsp;</td>
											<td style="text-align:right;width: 25%"><input class="form-control col-sm-5r" type="text" id="txtDayExp<?php echo $cr?>" name="txtDayExp<?php echo $cr?>" style="width: 100%" maxlength="2" value="<?php echo $result_callrecord['exp_day'] ?>"></td><td>&nbsp;Day&nbsp;</td>
										</tr>
										</table>
									</td>
									<td></td>
									<td style="text-align:right;">Present Type of Employment : </td>
									<td colspan="3">
										<select name="ddTypeEmp<?php echo $cr?>" id="ddTypeEmp<?php echo $cr?>" class="ddStyle" style="width: 100%">
											<option value="">--Select--</option>
											<option value="Contract" <?php echo ($result_callrecord['present_empType']== 'Contract' ? "selected" : "") ?>>Contract</option>
											<option value="FullTime" <?php echo ($result_callrecord['present_empType']== 'FullTime' ? "selected" : "") ?>>Full-time</option>
											<option value="Freelance" <?php echo ($result_callrecord['present_empType']== 'Freelance' ? "selected" : "") ?>>Freelance</option>
										</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Present Salary : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtPresentSalary<?php echo $cr?>" name="txtPresentSalary<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['present_salary'] ?>"></td>
									<td>฿</td>
									<td style="text-align:right;">Bonus (Months) : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtBonus<?php echo $cr?>" name="txtBonus<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['bonus_month'] ?>"></td>
									<td>month</td>
								</tr>
								<tr>
									<td style="text-align:right;background-color:#EAEAEA">Other Income : </td>
									<td style="text-align:right;background-color:#EAEAEA">Notebook : </td>
									<td style="background-color:#EAEAEA"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_notebook<?php echo $cr?>" name="txtOtherIncome_notebook<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['otherIncome_notebook'] ?>"></td>
									<td style="background-color:#EAEAEA">฿</td>
									<td style="text-align:right;background-color:#EAEAEA">Stand By : </td>
									<td style="background-color:#EAEAEA" colspan="2"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_StandBy<?php echo $cr?>" name="txtOtherIncome_StandBy<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['otherIncome_standby'] ?>"></td>
									<td style="background-color:#EAEAEA">฿</td>
								</tr>
								<tr>
									<td style="text-align:right;background-color:#EAEAEA"></td>
									<td style="text-align:right;background-color:#EAEAEA">Transportation : </td>
									<td style="background-color:#EAEAEA"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_transportation<?php echo $cr?>" name="txtOtherIncome_transportation<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['otherIncome_transportation'] ?>"></td>
									<td style="background-color:#EAEAEA">฿</td>
									<td style="text-align:right;background-color:#EAEAEA">Shift Work : </td>
									<td style="background-color:#EAEAEA" colspan="2"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_ShiftWork<?php echo $cr?>" name="txtOtherIncome_ShiftWork<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['otherIncome_shiftwork'] ?>"></td>
									<td style="background-color:#EAEAEA">฿</td>
								</tr>
								<tr>
									<td style="text-align:right;background-color:#EAEAEA"></td>
									<td style="text-align:right;background-color:#EAEAEA">OT : </td>
									<td style="background-color:#EAEAEA"><input class="form-control col-sm-5r" type="text" id="txtOtherIncome_OT<?php echo $cr?>" name="txtOtherIncome_OT<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['otherIncome_ot'] ?>"></td>
									<td style="background-color:#EAEAEA">฿</td>
									<td style="text-align:right;background-color:#EAEAEA">Others : </td>
									<td style="background-color:#EAEAEA"><input class="form-control" type="text" id="txtOtherIncome_Others<?php echo $cr?>" name="txtOtherIncome_Others<?php echo $cr?>" style="width: 100%" maxlength="200" value="<?php echo $result_callrecord['otherIncome_others'] ?>"></td>
									<td style="background-color:#EAEAEA">
										<input class="form-control col-sm-5r" type="text" id="txtOtherIncome_Others<?php echo $cr?>_baht" name="txtOtherIncome_Others<?php echo $cr?>_baht" style="width: 100%" value="<?php echo $result_callrecord['otherIncome_others_baht'] ?>">
									</td>
									<td style="background-color:#EAEAEA">฿</td>
								</tr>
								<tr>
									<td style="text-align:right;">BBS Offer by Calculation : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtBBSOfferCalculation<?php echo $cr?>" name="txtBBSOfferCalculation<?php echo $cr?>" readonly style="width: 100%" value="<?php echo $result_callrecord['BBSOffer_calculation'] ?>"></td>
									<td>฿</td>
									<td style="text-align:right;">Starting date for new job : </td>
									<td colspan="3"><input class="datepicker form-control" id="txtStartDateNewJob<?php echo $cr?>" name="txtStartDateNewJob<?php echo $cr?>" size="16" type="text" style="width: 200px;cursor:pointer" value="<?php echo $result_callrecord['startdate_newjob'] ?>"></td>
								</tr>
								<tr>
									<td style="text-align:right;">Salary Offer by BBS : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtBBSOffer<?php echo $cr?>" name="txtBBSOffer<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['BBSOffer_salary'] ?>"></td>
									<td>฿</td>
									<td style="text-align:right;">Expectation Salary : </td>
									<td colspan="2"><input class="form-control col-sm-5r" type="text" id="txtExpectationSalary<?php echo $cr?>" name="txtExpectationSalary<?php echo $cr?>" style="width: 100%" value="<?php echo $result_callrecord['expectation_salary'] ?>"></td>
									<td>฿</td>
								</tr>
								<script type="text/javascript">
									var txtStartDateNewJob1 = $('#txtStartDateNewJob<?php echo $cr?>').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {$(this).datepicker('hide');}).data('datepicker');
									$("#txtPresentSalary<?php echo $cr?>").keyup(function(){
										var txtBBSOfferCalculation1 = 0;
										txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary<?php echo $cr?>').val()) + (parseInt($('#txtPresentSalary<?php echo $cr?>').val()) * parseInt($('#txtBonus<?php echo $cr?>').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary<?php echo $cr?>').val());
										$("#txtBBSOfferCalculation"+$('#callRow<?php echo $cr?>').val()).val(txtBBSOfferCalculation1);
									});
									$("#txtBonus<?php echo $cr?>").keyup(function(){
										var txtBBSOfferCalculation1 = 0;
										txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary<?php echo $cr?>').val()) + (parseInt($('#txtPresentSalary<?php echo $cr?>').val()) * parseInt($('#txtBonus<?php echo $cr?>').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary<?php echo $cr?>').val());
										$("#txtBBSOfferCalculation"+$('#callRow<?php echo $cr?>').val()).val(txtBBSOfferCalculation1);
									});
								</script>
								<tr>
									<td style="text-align:right;">Note : </td>
									<td colspan="7">
										<textarea id="txtNote<?php echo $cr?>" name="txtNote<?php echo $cr?>" rows="2" style="width: 100%" maxlength="300"><?php echo $result_callrecord['call_note'] ?></textarea>
									</td>
								</tr>
								<tr>
									<td style="text-align:right;">Matching Requirement Number : </td>
									<td colspan="7"><input class="form-control" type="text" id="txtCallRec_matchingNo<?php echo $cr?>" name="txtCallRec_matchingNo<?php echo $cr?>" style="width: 100%" readonly value="<?php echo $result_callrecord['call_reqNo'] ?>"></td>
								</tr>
								<tr>
									<td style="width: 17%"></td>
									<td style="width: 10%"></td>
									<td style="width: 20%"></td>
									<td style="width: 5%"></td>
									<td style="width: 15%"></td>
									<td></td>
									<td></td>
									<td style="width: 5%"></td>
								</tr>
								<tr><td style="background-color:#008df3;height:1px;overflow:hidden;" colspan="8"></td></tr>
								</table>
							</td>
						</tr>	
					<?php 
							} //end while
						} //end else
					?>
					</tbody>
					</table>
				</div>
				<!--End Part3-1-->
				<br/>
				<!--Start Part3-2-->
				<div class="part_form">
					<?php
						$sql_interviewrecord ="SELECT * FROM candidate_interviewrecord where candidate_ID = '".$id."' order by interview_date";
						//echo 'sql_interviewrecord - '.$sql_interviewrecord.'<br>';
						$stmt_interviewrecord = $con->query($sql_interviewrecord);
						$rows_interviewrecord = $stmt_interviewrecord->rowCount();
					?>
					<div class="div_inline"><h4 class="mb-4 div_inline">Part 3-2 : Interview Record</h4>&nbsp;&nbsp;
						<button type="button" class="addrow btn btn-success" title="Add interview record" id="btn_add32" name="btn_add32" ><i class="fa fa-plus-square-o"></i> Add</button>
						<input type="hidden" id="txtPart32ID" style="width: 200px" value="<?php echo $rows_interviewrecord ?>">
					</div>
					<table border="0" style="width: 100%;border-color:#DDDDDD" id="tab32" class="tbl32">
					<?php
						if ($rows_interviewrecord == 0){
					?>
					<tr>
						<td>
							<button class="delrow btn btn-danger" title="Delete interview record"><i class="fa fa-trash-o fa-lg"></i> Delete</button><input type="hidden" id="invRow1" name="invRow[]" style="width: 200px" value="1">
							<table border="0" style="width: 100%" class="tabForm_part">
							<tr>
								<td style="text-align:right;">Interview Date : </td>
								<td>
									<input class="datepicker form-control" id="txtInterviewDate1" name="txtInterviewDate1" size="16" type="text" style="width: 100%;cursor:pointer">
								</td>
								<td style="text-align:right;">Time : </td>
								<td>
									<!--<input class="form-control col-sm-5r" type="text" id="txtTime1" name="txtTime1" style="width: 25%"> : <input class="form-control col-sm-5r" type="text" id="txtMin1" name="txtMin1" style="width: 25%" maxlength="2" value="00">-->
									<input class="form-control col-sm-5r" type="text" id="txtTime1" name="txtTime1" data-format="HH:mm" data-template="HH : mm" >
								</td>
								<td style="text-align:right;">Client Customer Company : </td>
								<td>
									<select id="ddClientCompany1" name="ddClientCompany1" class="ddStyle ddSearch" style="width: 100%"></select>
									<input type="hidden" id="txtClientID1" name="txtClientID1" style="width: 20px">
									<input type="hidden" id="txtClientCompany1" name="txtClientCompany1" style="width: 20px">
								</td>
								<td>
									<button type="button" class="btn btn-success" title="Add Company" data-toggle="modal" data-target="#modalCompany"  id="btn_addCustomerCompany" name="btn_addCustomerCompany"><i class="fa fa-plus-square-o"></i></button>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Pass : </td>
								<td>
									<select name="ddPass1" id="ddPass1" class="ddStyle" style="width: 100%">
										<option value="">--Select--</option>
										<option value="Y">Y</option>
										<option value="N">N</option>
									</select>
								</td>
								<td style="text-align:right;">Start Date : </td>
								<td>
									<input class="datepicker form-control" id="txtStartDate1" name="txtStartDate1" size="16" type="text" style="width: 100%;cursor:pointer">
								</td>
								<td style="text-align:right;">Client Customer Department : </td>
								<td colspan="2">
									<input class="form-control" type="text" id="txtClientDepartment1" name="txtClientDepartment1" style="width: 100%" readonly value=""> <!--//Dynamic with ddCustomerCompany -->
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Sign Contract : </td>
								<td>
									<select name="ddSignContract1" id="ddSignContract1" class="ddStyle" style="width: 100%">
										<option value="">--Select--</option>
										<option value="Y">Y</option>
										<option value="N">N</option>
									</select>
								</td>
								<td style="text-align:right;">Contract Period : </td>
								<td>
									<input class="form-control" type="text" id="txtContractPeriod1" name="txtContractPeriod1" style="width: 100%">
								</td>
								<td style="text-align:right;">Client Customer Contact Name : </td>
								<td colspan="2">
									<input class="form-control" type="text" id="txtClientContact1" name="txtClientContact1" style="width: 100%" readonly value="">  <!--//Dynamic with ddCustomerCompany -->
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Note : </td>
								<td colspan="6">
									<textarea id="txtNote321" name="txtNote321" rows="2" style="width: 100%" maxlength="300"></textarea>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Matching Requirement Number : </td>
								<td colspan="6"><input class="form-control" type="text" id="txtIntvRec_matchingNo1" name="txtIntvRec_matchingNo1" style="width: 100%" readonly value="autogen1234"></td>
							</tr>
							<tr>
								<td style="width: 17%"></td>
								<td style="width: 15%"></td>
								<td style="width: 9%"></td>
								<td style="width: 15%"></td>
								<td style="width: 17%"></td>
								<td></td>
								<td style="width: 5%"></td>
							</tr>
							<tr>
								<td style="background-color:#008df3;height:1px;overflow:hidden;" colspan="7"></td>
							</tr>
							</table>
							<script type="text/javascript">
								var nowTemp = new Date();
								var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
								var txtInterviewDate1 = $('#txtInterviewDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
									txtInterviewDate1.hide();
									var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#invRow1').val();	//YYYYMMDD-row
									$("#txtIntvRec_matchingNo"+$('#invRow1').val()).val(dateStr);
								}).data('datepicker');
								txtInterviewDate1.setValue(now);
								
								var dateStri = $("#candidate_ID").val()+'-'+$('#txtInterviewDate1').val().substring(0,4)+$('#txtInterviewDate1').val().substring(5,7)+$('#txtInterviewDate1').val().substring(8,10)+'-'+$('#invRow1').val();	 //YYYYMMDD-row
								$("#txtIntvRec_matchingNo"+$('#invRow1').val()).val(dateStri);
								
								var txtStartDate1 = $('#txtStartDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDate1.hide()}).data('datepicker');
								txtStartDate1.setValue(now);
								
								$("#ddClientCompany1").change(function() {
									var splitString = '';
									//alert(this.value);
									splitString = this.value.split("|");
									$("#txtClientID1").val(splitString[0]);
									$("#txtClientDepartment1").val(splitString[1]);
									$("#txtClientContact1").val(splitString[2]);
									$("#txtClientCompany1").val(splitString[3]);
								});
			
								$(function(){
									$.post("load-dropdown.php",{position_id:$(this).val(),action:"load-client",act:'1'},function(data){
										$("#ddClientCompany1").html(data);
									});
									$('#txtTime1').combodate({
										firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
										minuteStep: 1
									});  
								}); //end function load drop down
							</script>
						</td>
					</tr>
					<?php
						}else{
							$ir=0;
							while ($result_interviewrecord = $stmt_interviewrecord->fetch()) {
								$ir++;
								$interview_date = explode(" ", $result_interviewrecord['interview_date']);
								$interview_date[1] = substr($interview_date[1], 0, 5);
					?>
					<tr>
						<td>
							<button class="delrow btn btn-danger" title="Delete interview record"><i class="fa fa-trash-o fa-lg"></i> Delete</button><input type="hidden" id="invRow<?php echo $ir?>" name="invRow[]" style="width: 200px" value="<?php echo $ir?>">
							<table border="0" style="width: 100%" class="tabForm_part">
							<tr>
								<td style="text-align:right;">Interview Date : </td>
								<td>
									<input class="datepicker form-control" id="txtInterviewDate<?php echo $ir?>" name="txtInterviewDate<?php echo $ir?>" size="16" type="text" style="width: 100%;cursor:pointer" value="<?php echo $interview_date[0] ?>">
									<script type="text/javascript">
										var txtInterviewDate1 = $('#txtInterviewDate<?php echo $ir?>').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
											$(this).datepicker('hide');
											var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#invRow<?php echo $ir?>').val();	//YYYYMMDD-row
											$("#txtIntvRec_matchingNo"+$('#invRow<?php echo $ir?>').val()).val(dateStr);
										}).data('datepicker');
										
										var dateStri = $("#candidate_ID").val()+'-'+$('#txtInterviewDate<?php echo $ir?>').val().substring(0,4)+$('#txtInterviewDate<?php echo $ir?>').val().substring(5,7)+$('#txtInterviewDate<?php echo $ir?>').val().substring(8,10)+'-'+$('#invRow<?php echo $ir?>').val();	 //YYYYMMDD-row
										$("#txtIntvRec_matchingNo"+$('#invRow<?php echo $ir?>').val()).val(dateStri);
									</script>
								</td>
								<td style="text-align:right;">Time : </td>
								<td>
									<input class="form-control col-sm-5r" type="text" id="txtTime<?php echo $ir?>" name="txtTime<?php echo $ir?>" data-format="HH:mm" data-template="HH : mm" value="<?php echo $interview_date[1]  ?>">
									<script type="text/javascript">
										$(function(){
											$('#txtTime<?php echo $ir?>').combodate({
												firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
												minuteStep: 1
											});  
										}); //end function load drop down
									</script>
								</td>
								<td style="text-align:right;">Client Customer Company :</td>
								<td>
									<select id="ddClientCompany<?php echo $ir?>" name="ddClientCompany<?php echo $ir?>" class="ddStyle ddSearch" style="width: 100%"></select>
									<input type="hidden" id="txtClientID<?php echo $ir?>" name="txtClientID<?php echo $ir?>" style="width: 20px">
									<input type="hidden" id="txtClientCompany<?php echo $ir?>" name="txtClientCompany<?php echo $ir?>" style="width: 20px">
									<script type="text/javascript">
										$(function(){
											$.post("load-dropdown.php",{position_id:"<?php echo $result_interviewrecord['client_ID']?>",action:"load-client",act:'3'},function(data){
												$("#ddClientCompany<?php echo $ir?>").html(data);
											});
										}); //end function load drop down
										$("#ddClientCompany<?php echo $ir?>").change(function() {
											var splitString = '';
											//alert(this.value);
											splitString = this.value.split("|");
											$("#txtClientID<?php echo $ir?>").val(splitString[0]);
											$("#txtClientDepartment<?php echo $ir?>").val(splitString[1]);
											$("#txtClientContact<?php echo $ir?>").val(splitString[2]);
											$("#txtClientCompany<?php echo $ir?>").val(splitString[3]);
										});
									</script>
								</td>
								<td>
									<button type="button" class="btn btn-success" title="Add Company" data-toggle="modal" data-target="#modalCompany"  id="btn_addCustomerCompany" name="btn_addCustomerCompany"><i class="fa fa-plus-square-o"></i></button>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Pass : </td>
								<td>
									<select name="ddPass<?php echo $ir?>" id="ddPass<?php echo $ir?>" class="ddStyle" style="width: 100%">
										<option value="">--Select--</option>
										<option value="Y" <?php echo ($result_interviewrecord['pass']== 'Y' ? "selected" : "") ?>>Y</option>
										<option value="N" <?php echo ($result_interviewrecord['pass']== 'N' ? "selected" : "") ?>>N</option>
									</select>
								</td>
								<td style="text-align:right;">Start Date : </td>
								<td>
									<input class="datepicker form-control" id="txtStartDate<?php echo $ir?>" name="txtStartDate<?php echo $ir?>" size="16" type="text" style="width: 100%;cursor:pointer" value="<?php echo $result_interviewrecord['startdate'] ?>">
								</td>
								<td style="text-align:right;">Client Customer Department : </td>
								<td colspan="2">
									<?php
										$sql_company ="SELECT * FROM client_company where client_ID = '".$result_interviewrecord['client_ID']."' ";
										$stmt_company = $con->query($sql_company);
										$rows_company = $stmt_company->rowCount();
										//echo 'rows - '.$rows."<br/>";
										$client_company = '';
										$client_department = '';
										$client_contact = '';
										if ($rows_company > 0){
											while ($result_company = $stmt_company->fetch()) {
												$client_company = $result_company['client_company'];
												$client_department = $result_company['client_department'];
												$client_contact = $result_company['client_contact'];
											}
										}
									?>
									<input class="form-control" type="text" id="txtClientDepartment<?php echo $ir?>" name="txtClientDepartment<?php echo $ir?>" style="width: 100%" readonly value="<?php echo $client_department?>"> <!--//Dynamic with ddCustomerCompany -->
								</td>
							</tr>
							<script type="text/javascript">
								var txtStartDate1 = $('#txtStartDate<?php echo $ir?>').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {$(this).datepicker('hide')}).data('datepicker');
							</script>
							<tr>
								<td style="text-align:right;">Sign Contract : </td>
								<td>
									<select name="ddSignContract<?php echo $ir?>" id="ddSignContract<?php echo $ir?>" class="ddStyle" style="width: 100%">
										<option value="">--Select--</option>
										<option value="Y" <?php echo ($result_interviewrecord['sign_contract']== 'Y' ? "selected" : "") ?>>Y</option>
										<option value="N" <?php echo ($result_interviewrecord['sign_contract']== 'N' ? "selected" : "") ?>>N</option>
									</select>
								</td>
								<td style="text-align:right;">Contract Period : </td>
								<td>
									<input class="form-control" type="text" id="txtContractPeriod<?php echo $ir?>" name="txtContractPeriod<?php echo $ir?>" style="width: 100%" value="<?php echo $result_interviewrecord['contract_period'] ?>">
								</td>
								<td style="text-align:right;">Client Customer Contact Name : </td>
								<td colspan="2">
									<input class="form-control" type="text" id="txtClientContact<?php echo $ir?>" name="txtClientContact<?php echo $ir?>" style="width: 100%" readonly value="<?php echo $client_contact?>">  <!--//Dynamic with ddCustomerCompany -->
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Note : </td>
								<td colspan="6">
									<textarea id="txtNote32<?php echo $ir?>" name="txtNote32<?php echo $ir?>" rows="2" style="width: 100%" maxlength="300"><?php echo $result_interviewrecord['interview_note'] ?></textarea>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Matching Requirement Number : </td>
								<td colspan="6"><input class="form-control" type="text" id="txtIntvRec_matchingNo<?php echo $ir?>" name="txtIntvRec_matchingNo<?php echo $ir?>" style="width: 100%" readonly value="<?php echo $result_interviewrecord['interview_reqNo'] ?>"></td>
							</tr>
							<tr>
								<td style="width: 17%"></td>
								<td style="width: 15%"></td>
								<td style="width: 9%"></td>
								<td style="width: 15%"></td>
								<td style="width: 17%"></td>
								<td></td>
								<td style="width: 5%"></td>
							</tr>
							<tr>
								<td style="background-color:#008df3;height:1px;overflow:hidden;" colspan="7"></td>
							</tr>
							</table>
						</td>
					</tr>
					<?php 
							} //end while
						} //end else
					?>
					</table>
				</div>
				<!--End Part3-2-->			
				<br/>
				<!--Start Part Upload-->
				<div class="part_form">
					<div class="mb-3">
						<label for="formFile" class="form-label"><h4 class="mb-4 div_inline">Upload document </h4><b>max 2mb</b> (doc, docx, jpg, jpeg, pdf, png, ppt, pptx, xls, xlsx, xlsm)</label>
						<?php 
							echo "<div class='displayFile'  style='color:red'>Check for Delete</div>";
							include_once 'db.php';
							$sql_candidate_file_sel="SELECT * FROM candidate_file where candidate_ID = '".$id."' ";
						
							$stmt_candidate_file_sel = $con->query($sql_candidate_file_sel);
							while ($result_file = $stmt_candidate_file_sel->fetch()) {
									echo "<div class='displayFile'><input type='checkbox' class='checkbox label_inline lblcontainer' id='fileDelete' name='chkFileDelete[]' value='".$result_file['file_ID']."'> <a href='download.php?id=".urlencode($result_file['file_ID'])."'>".$result_file['filename']."</a></div>";
							}
						?>
						<input type="file" style="cursor:pointer;" name="upload_file1" id="upload_file1" readonly="true" onchange="Filevalidation(1)"/>
						<div style="font-size:8px">&nbsp;</div>
						<div id="moreFileUpload"></div>
						<div style="clear:both;"></div>
						<div id="moreFileUploadLink" style="display:none;margin-left: 10px;">
							<button type="button" class="addrow btn btn-success" title="Add interview record" id="attachMore" name="attachMore" ><i class="fa fa-plus-square-o"></i> Add</button>
						</div>
					</div>
				</div>
				<!--End Upload-->		
				<div class="row">
					<div class="col-sm-12" id="wrappered">
						<input type="submit" class="send_btn" id="btn_submit" name="btn_submit" value="SAVE">
						<input type="button" class="send_btn" id="btn_reset" name="btn_reset" value="CANCEL">
					</div>
				</div>
				</form>
			</div>
		</div>
		<!-- Start Modal Position -->
		<form id="frmPosition" method="post" action="">
		<!-- The Modal -->
		  <div class="modal" id="modalPosition">
			<div class="modal-dialog modal-lg">
			  <div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
				  <h4 class="modal-title">Position</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="part_form">
						<table border="0" style="width: 100%;border-color:#DDDDDD" id="tabaddPosition">
						<tr>
							<td>
								<table border="0" style="width: 100%" class="tabForm_part">
								<tr>
									<td style="text-align:right;">Job title (EN) : </td>
									<td><input class="form-control col-sm-5r" type="text" id="txtPositionEN" name="txtPositionEN" style="width: 100%"></td>
								</tr>
								<tr>
									<td style="text-align:right;">Job title (TH) : </td>
									<td><input class="form-control col-sm-5r" type="text" id="txtPositionTH" name="txtPositionTH" style="width: 100%"></td>
								</tr>
								<tr>
									<td style="text-align:right;">Job details : </td>
									<td>
										<textarea id="txtNote" name="txtNote" rows="4" style="width: 100%" maxlength="300"></textarea>
									</td>
								</tr>
								<tr>
									<td style="width: 20%"></td>
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
					<button type="button" class="btn btn-lg btn-success"  id="btn_submitPosition" name="btn_submitPosition" data-dismiss="modal"><i class="fa fa-save"></i> Save</button>
					<button type="button" class="btn btn-lg btn-danger"  id="btn_cancelPosition" name="btn_cancelPosition" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				</div>
			  </div>
			</div>
		  </div>
		</form>
		<!-- End Modal Position -->
		<!-- Start Modal Company -->
		<form id="frmCompany" method="post" action="">
			<!-- The Modal -->
			<div class="modal" id="modalCompany">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Client Customer</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body">
							<div class="part_form">
								<table border="0" style="width: 100%;border-color:#DDDDDD" id="tabCompany">
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
							<button type="button" class="btn btn-lg btn-success"  id="btn_submitCompany" name="btn_submitCompany" data-dismiss="modal"><i class="fa fa-save"></i> Save</button>
							<button type="button" class="btn btn-lg btn-danger"  id="btn_cancelCompany" name="btn_cancelCompany" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- End Modal Company -->
		<!-- Start Modal Alert -->
		<div class="modal" id="modalAlert">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content" id="modalContentAlert"></div>
			</div>
		</div>
		<!-- End Modal Alert -->
	<script type="text/javascript">
		$( "#btn_submit" ).click(function() {
			var dataURL = '';
			//var txtIDcard = $('#txtIDcard').val();
			var name_en 		= $('#txtNameEn').val();
			var sname_en 	= $('#txtSNameEn').val();
			var name_th 		= $('#txtNameTh').val();
			var sname_th 	= $('#txtSNameTh').val();
			var candidate_ID 		= $('#candidate_ID').val();

			event.preventDefault(); 
			$.post("validate.php",{candidate_ID:candidate_ID, name_th:name_th, sname_th:sname_th, name_en:name_en, sname_en:sname_en ,action:"validate-candidate"},function(data){
				//alert(data);
				if (data == '1')
					$("#frmRecruit").submit();
				else {
					dataURL = 'alert.php?id=3&l=<?php echo $l?>';
					$('#modalContentAlert').load(dataURL,function(){$('#modalAlert').modal('show')});
				}	
			});
		});
		
		$("#btn_reset").click(function(){
			location.replace('form.php?l=<?php echo $l?>');
		});
		$.validator.setDefaults( {
			submitHandler: function () {
				//alert( "submitted!" );
			}
		});

		//$( document ).ready( function () {});
	</script>
     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>
	<script type="text/javascript"> 
		<!----------------------------------------------------------------------------------------------------------------------------------set up Default 3-1 3-2 date------------------------------------------------------------------------------------------------------->
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		//$(".datepicker").datepicker({format: "yyyy-mm-dd"});
		var txtBDDate = $('#txtBDDate').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {ageCalculator()}).data('datepicker');
		//txtBDDate.setValue(now);
		
		//var txtCallDate1 = $('#txtCallDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
		//	txtCallDate1.hide();
			//var dateStr = this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#callRow1').val();	//YYYYMMDD-row
			//$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
		//}).data('datepicker');
		//txtCallDate1.setValue(now);
		
		//var dateStr = $('#txtCallDate1').val().substring(0,4)+$('#txtCallDate1').val().substring(5,7)+$('#txtCallDate1').val().substring(8,10)+'-'+$('#callRow1').val();	 //YYYYMMDD-row
		//$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
		
		//var txtStartDateNewJob1 = $('#txtStartDateNewJob1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDateNewJob1.hide()}).data('datepicker');
		//txtStartDateNewJob1.setValue(now);
		
		//var txtInterviewDate1 = $('#txtInterviewDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
		//	txtInterviewDate1.hide();
			//var dateStr = this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#invRow1').val();	//YYYYMMDD-row
			//$("#txtIntvRec_matchingNo"+$('#invRow1').val()).val(dateStr);
		//}).data('datepicker');
		//txtInterviewDate1.setValue(now);
		
		//var dateStri = $('#txtInterviewDate1').val().substring(0,4)+$('#txtInterviewDate1').val().substring(5,7)+$('#txtInterviewDate1').val().substring(8,10)+'-'+$('#invRow1').val();	 //YYYYMMDD-row
		//$("#txtIntvRec_matchingNo"+$('#invRow1').val()).val(dateStri);
		
		//var txtStartDate1 = $('#txtStartDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDate1.hide()}).data('datepicker');
		//txtStartDate1.setValue(now);

		<!----------------------------------------------------------------------------------------------------------------------------------set up Default 3-1 3-2 date------------------------------------------------------------------------------------------------------->
		//$(function(){
			//$.post("load-dropdown.php",{position_id:$(this).val(),action:"load-position",act:'1'},function(data){
				//$("#ddCurrentPosition1").html(data);
				//$("#ddInterestedPosition1").html(data);
			//});
			//$.post("load-dropdown.php",{position_id:$(this).val(),action:"load-client",act:'1'},function(data){
			//	$("#ddClientCompany1").html(data);
			//});
			
			//$('#txtTime1').combodate({
			//	firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
			//	minuteStep: 1
			//});  
		//}); //end function load drop down
		/*
		$("#txtPresentSalary1").keyup(function(){
			var txtBBSOfferCalculation1 = 0;
			txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary1').val()) + (parseInt($('#txtPresentSalary1').val()) * parseInt($('#txtBonus1').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary1').val());
			$("#txtBBSOfferCalculation"+$('#callRow1').val()).val(txtBBSOfferCalculation1);
		});
		$("#txtBonus1").keyup(function(){
			var txtBBSOfferCalculation1 = 0;
			txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary1').val()) + (parseInt($('#txtPresentSalary1').val()) * parseInt($('#txtBonus1').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary1').val());
			$("#txtBBSOfferCalculation"+$('#callRow1').val()).val(txtBBSOfferCalculation1);
		});
		*/ 
		$('#ddModule').change(function() {
			$('#position_SAP').prop('checked', true);
		});
		$('#ddLanguage').change(function() {
			$('#position_Programmer').prop('checked', true);
		});
		$("#txtSALange").keyup(function(){
			$('#position_SA').prop('checked', true);
			$('#radSACode_y').prop('checked', true);
		});
		$("#txtBALange").keyup(function(){
			$('#position_BA').prop('checked', true);
			$('#radBACode_y').prop('checked', true);
		});
		$("#txtProjectManagerLang").keyup(function(){
			$('#position_PM').prop('checked', true);
			$('#radProjectManager_y').prop('checked', true);
		});
		$('#chkTester_Automate').change(function() {
			if(this.checked) 
				$('#position_Tester').prop('checked', true);
			else
				if (!$('#chkTester_Manual').is(':checked'))
					$('#position_Tester').prop('checked', false);
		});
		$('#chkTester_Manual').change(function() {
			if(this.checked) 
				$('#position_Tester').prop('checked', true);
			else
				if (!$('#chkTester_Automate').is(':checked'))
					$('#position_Tester').prop('checked', false);
		});
		$('#position_Tester').change(function() {
			if(!this.checked) {
				$('#chkTester_Automate').prop('checked', false);
				$('#chkTester_Manual').prop('checked', false);
			}      
		});
		$("#txtProjectAdminSkill").keyup(function(){
			$('#position_Admin').prop('checked', true);
		});
		$("#txtPositionOther").keyup(function(){
			$('#position_Other').prop('checked', true);
		});
		$("#txtPositionOtherSkill").keyup(function(){
			$('#position_Other').prop('checked', true);
		});
		$('#position_Other').change(function() {
			if(!this.checked) {
				$('#txtPositionOther').val('');
				$('#txtPositionOtherSkill').val('');
			}      
		});
    </script>
	<script type="text/javascript"> <!--attachMore-->
		$(document).ready(function () {
			$("input[id^='upload_file']").each(function () {
				var id = parseInt(this.id.replace("upload_file", ""));
				$("#upload_file" + id).change(function () {
					if ($("#upload_file" + id).val() !== "") {
						$("#moreFileUploadLink").show();
					}
				});
			});
			var upload_number = 2;
			$('#attachMore').click(function () {
				//add more file
				var moreUploadTag = '';
				moreUploadTag += '<div class="element">';
				moreUploadTag += '<input type="file" style="cursor:pointer;" onchange="Filevalidation(' + upload_number + ')" id="upload_file' + upload_number + '" name="upload_file' + upload_number + '" readonly="true"/>';
				moreUploadTag += '<a href="javascript:void" style="cursor:pointer;color: #008df3;padding-left:20px" onclick="deletefileLink(' + upload_number + ')">Delete</a>';
				moreUploadTag += '</div>';
					
				$('<dl id="delete_file' + upload_number + '">' + moreUploadTag + '</dl>').fadeIn('slow').appendTo('#moreFileUpload');
				upload_number++;
			});
			ageCalculator();
			
			$('#ddModule').multiselect({
				columns: 1,
				placeholder: '--Select Module--',
				search: true
			});
			
			$('#ddLanguage').multiselect({
				columns: 1,
				placeholder: '--Select Language--',
				search: true
			});
			/*Exp. Status*/
			$("#radExpStatus_normal").click(function(){
				document.getElementById("txtExpStatus").value='';
			});
			$("#txtExpStatus").keyup(function(){
				var $radios = $('input:radio[name=radExpStatus]');
				$radios.filter('[value=Blacklist]').prop('checked', true);
			}).click(function(){
				var $radios = $('input:radio[name=radExpStatus]');
				$radios.filter('[value=Blacklist]').prop('checked', true);
			});
			/*Nationality*/
			$("#radNationality_thai").click(function(){
				document.getElementById("txtNationality").value='';
			});
			$("#txtNationality").keyup(function() {
				var $radios = $('input:radio[name=radNationality]');
				$radios.filter('[value=Other]').prop('checked', true);
			}).click(function(){
				var $radios = $('input:radio[name=radNationality]');
				$radios.filter('[value=Other]').prop('checked', true);
			});
			/*Ethnicity*/
			$("#radEthnicity_thai").click(function(){
				document.getElementById("txtEthnicity").value='';
			});
			$("#txtEthnicity").keyup(function() {
				var $radios = $('input:radio[name=radEthnicity]');
				$radios.filter('[value=Other]').prop('checked', true);
			}).click(function(){
				var $radios = $('input:radio[name=radEthnicity]');
				$radios.filter('[value=Other]').prop('checked', true);
			});
			
			var addroweMail ="<tr>";
			addroweMail +="<td style=\"text-align:right;width: 15%;height:40px\">Email&nbsp;</td>";
			addroweMail +="<td><div class=\"col-sm-5\"><input class=\"form-control\" type=\"text\" name=\"txtEmail[]\"></div></td>";
			addroweMail +="<td></td></tr>";
			
			var addrowTel ="<tr>";
			addrowTel +="<td style=\"text-align:right;width: 22%;height:40px\">Telephone&nbsp;</td>";
			addrowTel +="<td><div class=\"col-sm-5\"><input class=\"form-control\" type=\"text\" name=\"txtTelephone[]\"></div></td>";
			addrowTel +="<td></td></tr>";

			$("#tab31").on('click','.delrow',function(){
			   $(this).closest('tr').remove();
			 });
			 
			 $("#tab32").on('click','.delrow',function(){
			   $(this).closest('tr').remove();
			 });
			 
			 $("#btn_addeMail").click(function(){
				$(".tbleMail").append(addroweMail);
			});
			
			$("#btn_addTel").click(function(){
				$(".tblTelephone").append(addrowTel);
			});
			
			$("#btn_add31").click(function(){
				var txtPart31ID = parseInt($("#txtPart31ID").val())+1;
				$("#txtPart31ID").val(txtPart31ID);
				var str_l = '<?php echo $str_l ?>';
				var addrow31 ="<tr><td>";
				addrow31 +="<button class=\"delrow btn btn-danger\" title=\"Delete call record\"><i class=\"fa fa-trash-o fa-lg\"></i> Delete</button><input type=\"hidden\" id=\"callRow"+txtPart31ID+"\" name=\"callRow[]\" style=\"width: 20px\" value=\""+txtPart31ID+"\">";
				addrow31 +="<table border=\"0\" style=\"width: 100%\" class=\"tabForm_part\">";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">Call Date : </td>";
				addrow31 +="<td colspan=\"3\"><input class=\"datepicker form-control\" id=\"txtCallDate"+txtPart31ID+"\" name=\"txtCallDate"+txtPart31ID+"\" size=\"16\" type=\"text\" style=\"width: 200px;cursor:pointer\"></td>";
				addrow31 +="<td style=\"text-align:right;\">Call By : </td>";
				addrow31 +="<td colspan=\"2\"><input class=\"form-control\" type=\"text\" name=\"txtCallBy"+txtPart31ID+"\" id=\"txtCallBy"+txtPart31ID+"\" value=\""+str_l+"\"></td>";
				addrow31 +="<td></td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">Current Position : </td>";
				addrow31 +="<td colspan=\"2\">";
				addrow31 +="<select id=\"ddCurrentPosition"+txtPart31ID+"\" name=\"ddCurrentPosition"+txtPart31ID+"\" class=\"ddStyle ddSearch\" style=\"width: 100%\">";
				addrow31 +="</select>";
				addrow31 +="</td>";
				addrow31 +="<td>";
				addrow31 +="<button type=\"button\" class=\"btn btn-success\" title=\"Add Position\" data-toggle=\"modal\" data-target=\"#modalPosition\"  id=\"btn_addPosition\" name=\"btn_addPosition\"><i class=\"fa fa-plus-square-o\"></i></button>";
				addrow31 +="</td>";
				addrow31 +="<td style=\"text-align:right;\">Interested Position : </td>";
				addrow31 +="<td colspan=\"2\">";
				addrow31 +="<select id=\"ddInterestedPosition"+txtPart31ID+"\" name=\"ddInterestedPosition"+txtPart31ID+"\" class=\"ddStyle ddSearch\" style=\"width: 100%\">";
				addrow31 +="</select>";
				addrow31 +="</td>";
				addrow31 +="<td>";
				addrow31 +="<button type=\"button\" class=\"btn btn-success\" title=\"Add Position\" data-toggle=\"modal\" data-target=\"#modalPosition\"  id=\"btn_addIPosition\" name=\"btn_addIPosition\"><i class=\"fa fa-plus-square-o\"></i></button>";
				addrow31 +="</td>";
				addrow31 +="</tr>";		
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">Years of Experience : </td>";
				addrow31 +="<td colspan=\"2\">";
				addrow31 +="<table border=\"0\" style=\"width: 100%\" class=\"tabForm_part\">";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;width: 25%\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtYearExp"+txtPart31ID+"\" name=\"txtYearExp"+txtPart31ID+"\" style=\"width: 100%\" maxlength=\"2\" value=\"0\"></td><td>&nbsp;Year&nbsp;</td>";
				addrow31 +="<td style=\"text-align:right;width: 25%\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtMonthExp"+txtPart31ID+"\" name=\"txtMonthExp"+txtPart31ID+"\" style=\"width: 100%\" maxlength=\"2\" value=\"0\"></td><td>&nbsp;Month&nbsp;</td>";
				addrow31 +="<td style=\"text-align:right;width: 25%\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtDayExp"+txtPart31ID+"\" name=\"txtDayExp"+txtPart31ID+"\" style=\"width: 100%\" maxlength=\"2\" value=\"0\"></td><td>&nbsp;Day&nbsp;</td>";
				addrow31 +="</tr>";
				addrow31 +="</table>";
				addrow31 +="</td>";
				addrow31 +="<td></td>";
				addrow31 +="<td style=\"text-align:right;\">Present Type of Employment : </td>";
				addrow31 +="<td colspan=\"3\">";
				addrow31 +="<select name=\"ddTypeEmp"+txtPart31ID+"\" id=\"ddTypeEmp"+txtPart31ID+"\" class=\"ddStyle\" style=\"width: 100%\">";
				addrow31 +="<option value=\"\">--Select--</option>";
				addrow31 +="<option value=\"Contract\">Contract</option>";
				addrow31 +="<option value=\"FullTime\">Full-time</option>";
				addrow31 +="<option value=\"Freelance\">Freelance</option>";
				addrow31 +="</select>";
				addrow31 +="</td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">Present Salary : </td>";
				addrow31 +="<td colspan=\"2\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtPresentSalary"+txtPart31ID+"\" name=\"txtPresentSalary"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td>฿</td>";
				addrow31 +="<td style=\"text-align:right;\">Bonus (Months) : </td>";
				addrow31 +="<td colspan=\"2\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtBonus"+txtPart31ID+"\" name=\"txtBonus"+txtPart31ID+"\" style=\"width: 100%\" value=\"0\"></td>";
				addrow31 +="<td>month</td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\">Other Income : </td>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\">Notebook : </td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtOtherIncome_notebook"+txtPart31ID+"\" name=\"txtOtherIncome_notebook"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\">฿</td>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\">Stand By : </td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\" colspan=\"2\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtOtherIncome_StandBy"+txtPart31ID+"\" name=\"txtOtherIncome_StandBy"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\">฿</td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\"></td>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\">Transportation : </td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtOtherIncome_transportation"+txtPart31ID+"\" name=\"txtOtherIncome_transportation"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\">฿</td>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\">Shift Work : </td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\" colspan=\"2\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtOtherIncome_ShiftWork"+txtPart31ID+"\" name=\"txtOtherIncome_ShiftWork"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\">฿</td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\"></td>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\">OT : </td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtOtherIncome_OT"+txtPart31ID+"\" name=\"txtOtherIncome_OT"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\">฿</td>";
				addrow31 +="<td style=\"text-align:right;background-color:#EAEAEA\">Others : </td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\"><input class=\"form-control\" type=\"text\" id=\"txtOtherIncome_Others"+txtPart31ID+"\" name=\"txtOtherIncome_Others"+txtPart31ID+"\" maxlength=\"200\" style=\"width: 100%\"></td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\">";
				addrow31 +="<input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtOtherIncome_Others"+txtPart31ID+"_baht\" name=\"txtOtherIncome_Others"+txtPart31ID+"_baht\" style=\"width: 100%\" value=\"0.00\">";
				addrow31 +="</td>";
				addrow31 +="<td style=\"background-color:#EAEAEA\">฿</td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">BBS Offer by Calculation : </td>";
				addrow31 +="<td colspan=\"2\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtBBSOfferCalculation"+txtPart31ID+"\" name=\"txtBBSOfferCalculation"+txtPart31ID+"\" readonly style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td>฿</td>";
				addrow31 +="<td style=\"text-align:right;\">Starting date for new job : </td>";
				addrow31 +="<td colspan=\"3\"><input class=\"datepicker form-control\" id=\"txtStartDateNewJob"+txtPart31ID+"\" name=\"txtStartDateNewJob"+txtPart31ID+"\" size=\"16\" type=\"text\" style=\"width: 200px;cursor:pointer\"></td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">Salary Offer by BBS : </td>";
				addrow31 +="<td colspan=\"2\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtBBSOffer"+txtPart31ID+"\" name=\"txtBBSOffer"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td>฿</td>";
				addrow31 +="<td style=\"text-align:right;\">Expectation Salary : </td>";
				addrow31 +="<td colspan=\"2\"><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtExpectationSalary"+txtPart31ID+"\" name=\"txtExpectationSalary"+txtPart31ID+"\" style=\"width: 100%\" value=\"0.00\"></td>";
				addrow31 +="<td>฿</td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">Note : </td>";
				addrow31 +="<td colspan=\"7\"><textarea id=\"txtNote"+txtPart31ID+"\" name=\"txtNote"+txtPart31ID+"\" rows=\"2\" style=\"width: 100%\" maxlength=\"300\"></textarea></td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"text-align:right;\">Matching Requirement Number : </td>";
				addrow31 +="<td colspan=\"7\"><input class=\"form-control\" type=\"text\" id=\"txtCallRec_matchingNo"+txtPart31ID+"\" name=\"txtCallRec_matchingNo"+txtPart31ID+"\" style=\"width: 100%\" readonly value=\"autogen1234\"></td>";
				addrow31 +="</tr>";
				addrow31 +="<tr>";
				addrow31 +="<td style=\"width: 17%\"></td>";
				addrow31 +="<td style=\"width: 10%\"></td>";
				addrow31 +="<td style=\"width: 20%\"></td>";
				addrow31 +="<td style=\"width: 5%\"></td>";
				addrow31 +="<td style=\"width: 15%\"></td>";
				addrow31 +="<td></td>";
				addrow31 +="<td></td>";
				addrow31 +="<td style=\"width: 5%\"></td>";
				addrow31 +="</tr>";
				addrow31 +="<tr><td style=\"background-color:#008df3;height:1px;overflow:hidden;\" colspan=\"8\"></td></tr>";
				addrow31 +="</table>";
				addrow31 +="</td></tr>";
				
				$(".tbl31").append(addrow31);
				$(".ddSearch").select2();
				<!----------------------------------------------------------------------------------------------------------------------------------set up add 3-1 date------------------------------------------------------------------------------------------------------->
				var nowTemp = new Date();
				var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
				
				var txtCallDate = $('#txtCallDate'+txtPart31ID).datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
					txtCallDate.hide();
					var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#callRow'+txtPart31ID).val();	//YYYYMMDD-row
					$("#txtCallRec_matchingNo"+$('#callRow'+txtPart31ID).val()).val(dateStr);
				}).data('datepicker');
				txtCallDate.setValue(now);
				
				var dateStr = $("#candidate_ID").val()+'-'+$('#txtCallDate'+txtPart31ID).val().substring(0,4)+$('#txtCallDate'+txtPart31ID).val().substring(5,7)+$('#txtCallDate'+txtPart31ID).val().substring(8,10)+'-'+$('#callRow'+txtPart31ID).val();	 //YYYYMMDD-row
				$("#txtCallRec_matchingNo"+txtPart31ID).val(dateStr);
				
				var txtStartDateNewJob = $('#txtStartDateNewJob'+txtPart31ID).datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDateNewJob.hide()}).data('datepicker');
				txtStartDateNewJob.setValue(now);	
				<!----------------------------------------------------------------------------------------------------------------------------------set up add 3-1 date------------------------------------------------------------------------------------------------------->
				$(function(){
					$.post("load-dropdown.php",{position_id:$(this).val(),action:"load-position",act:'1'},function(data){
						$("#ddCurrentPosition"+txtPart31ID).html(data);
						$("#ddInterestedPosition"+txtPart31ID).html(data);
					});
				});//end function load
				<!----------------------------------------------------------------------------------------------------------------------------------set up add 3-1 function------------------------------------------------------------------------------------------------------->
				$("#txtPresentSalary"+txtPart31ID).keyup(function(){
					var txtBBSOfferCalculation = 0;
					txtBBSOfferCalculation = ((( parseInt($('#txtPresentSalary'+txtPart31ID).val()) + (parseInt($('#txtPresentSalary'+txtPart31ID).val()) * parseInt($('#txtBonus'+txtPart31ID).val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary'+txtPart31ID).val());
					$("#txtBBSOfferCalculation"+$('#callRow'+txtPart31ID).val()).val(txtBBSOfferCalculation);
				});
				$("#txtBonus"+txtPart31ID).keyup(function(){
					var txtBBSOfferCalculation = 0;
					txtBBSOfferCalculation = ((( parseInt($('#txtPresentSalary'+txtPart31ID).val()) + (parseInt($('#txtPresentSalary'+txtPart31ID).val()) * parseInt($('#txtBonus'+txtPart31ID).val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary'+txtPart31ID).val());
					$("#txtBBSOfferCalculation"+$('#callRow'+txtPart31ID).val()).val(txtBBSOfferCalculation);
				});
				<!----------------------------------------------------------------------------------------------------------------------------------set up add 3-1 Salary------------------------------------------------------------------------------------------------------->
			}); //end add row 31
			
			$("#btn_add32").click(function(){
				var txtPart32ID = parseInt($("#txtPart32ID").val())+1;
				$("#txtPart32ID").val(txtPart32ID);
				
				var addrow32 ="<tr><td>";
				addrow32 +="<button class=\"delrow btn btn-danger\" title=\"Delete interview record\"><i class=\"fa fa-trash-o fa-lg\"></i> Delete</button><input type=\"hidden\" id=\"invRow"+txtPart32ID+"\" name=\"invRow[]\" style=\"width: 20px\" value=\""+txtPart32ID+"\">";
				addrow32 +="<table border=\"0\" style=\"width: 100%\" class=\"tabForm_part\">";
				addrow32 +="<tr>";
				addrow32 +="<td style=\"text-align:right;\">Interview Date : </td>";
				addrow32 +="<td><input class=\"datepicker form-control\" id=\"txtInterviewDate"+txtPart32ID+"\" name=\"txtInterviewDate"+txtPart32ID+"\" size=\"16\" type=\"text\" style=\"width: 100%;cursor:pointer\"></td>";
				addrow32 +="<td style=\"text-align:right;\">Time : </td>";
				addrow32 +="<td><input class=\"form-control col-sm-5r\" type=\"text\" id=\"txtTime"+txtPart32ID+"\" name=\"txtTime"+txtPart32ID+"\" data-format=\"HH:mm\" data-template=\"HH : mm\"></td>";
				addrow32 +="<td style=\"text-align:right;\">Client Customer Company : </td>";
				addrow32 +="<td>";
				addrow32 +="<select id=\"ddClientCompany"+txtPart32ID+"\" name=\"ddClientCompany"+txtPart32ID+"\" class=\"ddStyle ddSearch\" style=\"width: 100%\">";
				addrow32 +="</select><input type=\"hidden\" id=\"txtClientID"+txtPart32ID+"\" name=\"txtClientID"+txtPart32ID+"\" style=\"width: 20px\">";
				addrow32 +="<input type=\"hidden\" id=\"txtClientCompany"+txtPart32ID+"\" name=\"txtClientCompany"+txtPart32ID+"\" style=\"width: 20px\">";
				addrow32 +="</td>";
				addrow32 +="<td>";
				addrow32 +="<button type=\"button\" class=\"btn btn-success\" title=\"Add Company\" data-toggle=\"modal\" data-target=\"#modalCompany\"  id=\"btn_addCustomerCompany\" name=\"btn_addCustomerCompany\"><i class=\"fa fa-plus-square-o\"></i></button>";
				addrow32 +="</td>";
				addrow32 +="</tr>";
				addrow32 +="<tr>";
				addrow32 +="<td style=\"text-align:right;\">Pass : </td>";
				addrow32 +="<td>";
				addrow32 +="<select name=\"ddPass"+txtPart32ID+"\" id=\"ddPass"+txtPart32ID+"\" class=\"ddStyle\" style=\"width: 100%\">";
				addrow32 +="<option value=\"\">--Select--</option>";
				addrow32 +="<option value=\"Y\">Y</option>";
				addrow32 +="<option value=\"N\">N</option>";
				addrow32 +="</select>";
				addrow32 +="</td>";
				addrow32 +="<td style=\"text-align:right;\">Start Date : </td>";
				addrow32 +="<td>";
				addrow32 +="<input class=\"datepicker form-control\" id=\"txtStartDate"+txtPart32ID+"\" name=\"txtStartDate"+txtPart32ID+"\" size=\"16\" type=\"text\" style=\"width: 100%;cursor:pointer\">";
				addrow32 +="</td>";
				addrow32 +="<td style=\"text-align:right;\">Client Customer Department : </td>";
				addrow32 +="<td colspan=\"2\">";
				addrow32 +="<input class=\"form-control\" type=\"text\" id=\"txtClientDepartment"+txtPart32ID+"\" name=\"txtClientDepartment"+txtPart32ID+"\" style=\"width: 100%\" readonly value=\"\">"; <!--//Dynamic with ddCustomerCompany -->
				addrow32 +="</td>";
				addrow32 +="</tr>";
				addrow32 +="<tr>";
				addrow32 +="<td style=\"text-align:right;\">Sign Contract : </td>";
				addrow32 +="<td>";
				addrow32 +="<select name=\"ddSignContract"+txtPart32ID+"\" id=\"ddSignContract"+txtPart32ID+"\" class=\"ddStyle\" style=\"width: 100%\">";
				addrow32 +="<option value=\"\">--Select--</option>";
				addrow32 +="<option value=\"Y\">Y</option>";
				addrow32 +="<option value=\"N\">N</option>";
				addrow32 +="</select>";
				addrow32 +="</td>";
				addrow32 +="<td style=\"text-align:right;\">Contract Period : </td>";
				addrow32 +="<td>";
				addrow32 +="<input class=\"form-control\" type=\"text\" id=\"txtContractPeriod"+txtPart32ID+"\" name=\"txtContractPeriod"+txtPart32ID+"\" style=\"width: 100%\">";
				addrow32 +="</td>";
				addrow32 +="<td style=\"text-align:right;\">Client Customer Contact Name : </td>";
				addrow32 +="<td colspan=\"2\">";
				addrow32 +="<input class=\"form-control\" type=\"text\" id=\"txtClientContact"+txtPart32ID+"\" name=\"txtClientContact"+txtPart32ID+"\" style=\"width: 100%\" readonly value=\"\">";  <!--//Dynamic with ddCustomerCompany -->
				addrow32 +="</td>";
				addrow32 +="</tr>";
				addrow32 +="<tr>";
				addrow32 +="<td style=\"text-align:right;\">Note : </td>";
				addrow32 +="<td colspan=\"6\">";
				addrow32 +="<textarea id=\"txtNote32"+txtPart32ID+"\" name=\"txtNote32"+txtPart32ID+"\" rows=\"2\" style=\"width: 100%\" maxlength=\"300\"></textarea>";
				addrow32 +="</td>";
				addrow32 +="</tr>";
				addrow32 +="<tr>";
				addrow32 +="<td style=\"text-align:right;\">Matching Requirement Number : </td>";
				addrow32 +="<td colspan=\"6\"><input class=\"form-control\" type=\"text\" id=\"txtIntvRec_matchingNo"+txtPart32ID+"\" name=\"txtIntvRec_matchingNo"+txtPart32ID+"\" style=\"width: 100%\" readonly value=\"autogen1234\"></td>";
				addrow32 +="</tr>";
				addrow32 +="<tr>";
				addrow32 +="<td style=\"width: 17%\"></td>";
				addrow32 +="<td style=\"width: 15%\"></td>";
				addrow32 +="<td style=\"width: 9%\"></td>";
				addrow32 +="<td style=\"width: 15%\"></td>";
				addrow32 +="<td style=\"width: 17%\"></td>";
				addrow32 +="<td></td>";
				addrow32 +="<td style=\"width: 5%\"></td>";
				addrow32 +="</tr>";
				addrow32 +="<tr><td style=\"background-color:#008df3;height:1px;overflow:hidden;\" colspan=\"7\"></td></tr>";
				addrow32 +="</table>";
				addrow32 +="</td></tr>";
				$(".tbl32").append(addrow32);
				$(".ddSearch").select2();
				$("#ddClientCompany"+txtPart32ID).change(function() {
					var splitString = '';
					splitString = this.value.split("|");
					$("#txtClientID"+txtPart32ID).val(splitString[0]);
					$("#txtClientDepartment"+txtPart32ID).val(splitString[1]);
					$("#txtClientContact"+txtPart32ID).val(splitString[2]);
					$("#txtClientCompany"+txtPart32ID).val(splitString[2]);
				});
				<!----------------------------------------------------------------------------------------------------------------------------------set up add 3-2 date------------------------------------------------------------------------------------------------------->
				var nowTemp = new Date();
				var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
				
				var txtInterviewDate = $('#txtInterviewDate'+txtPart32ID).datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
					txtInterviewDate.hide();
					var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#invRow'+txtPart32ID).val();	//YYYYMMDD-row
					$("#txtIntvRec_matchingNo"+$('#invRow'+txtPart32ID).val()).val(dateStr);
				}).data('datepicker');
				txtInterviewDate.setValue(now);
				
				var dateStr = $("#candidate_ID").val()+'-'+$('#txtInterviewDate'+txtPart32ID).val().substring(0,4)+$('#txtInterviewDate'+txtPart32ID).val().substring(5,7)+$('#txtInterviewDate'+txtPart32ID).val().substring(8,10)+'-'+$('#invRow'+txtPart32ID).val();	 //YYYYMMDD-row
				$("#txtIntvRec_matchingNo"+txtPart32ID).val(dateStr);
				
				var txtStartDate = $('#txtStartDate'+txtPart32ID).datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDate.hide()}).data('datepicker');
				txtStartDate.setValue(now);
				
				$('#txtTime'+txtPart32ID).combodate({
					firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
					minuteStep: 1
				});  
				<!----------------------------------------------------------------------------------------------------------------------------------set up add 3-2 date------------------------------------------------------------------------------------------------------->
				$(function(){
					$.post("load-dropdown.php",{position_id:$(this).val(),action:"load-client",act:'1'},function(data){
						$("#ddClientCompany"+txtPart32ID).html(data);
					});
				}); //end function load drop down
			});//end add row 32
			
			$(".ddSearch").select2();
			/*
			$("#ddClientCompany1").change(function() {
				var splitString = '';
				//alert(this.value);
				splitString = this.value.split("|");
				$("#txtClientID1").val(splitString[0]);
				$("#txtClientDepartment1").val(splitString[1]);
				$("#txtClientContact1").val(splitString[2]);
				$("#txtClientCompany1").val(splitString[3]);
			});
			*/
			$("#btn_check").click(function(){
				//
			});
			
			//Start Validate
			$( "#frmRecruit" ).validate( {
					rules: {
						txtNameEn: "required",
						txtSNameEn: "required",
						txtNameTh: "required",
						txtSNameTh: "required",
						ddTitleEn: "required",
						ddTitleTh: "required",
						txtIDcard: "required",
						txtBDDate: "required",
						txtAgeYear: {required: true, min: 1, number: true},
						"chkPosition[]" : {required: true, minlength: 1}
					},
					messages: {
						txtNameEn: "required",
						txtSNameEn: "required",
						txtNameTh: "required",
						txtSNameTh: "required",
						ddTitleEn: "required",
						ddTitleTh: "required",
						txtIDcard: "required",
						txtBDDate: "required",
						txtAgeYear: "required",
						"chkPosition[]" : "required"
					},
					errorElement: "em",
					errorPlacement: function ( error, element ) {
						// Add the `help-block` class to the error element
						error.addClass( "help-block" );
						
						if ( element.prop( "type" ) === "checkbox" ) {
							error.insertBefore( element.parent( "label" ) );
						}
						//else if ( element.prop( "type" ) === "radio" ) {
						//	error.insertAfter( element.parent( "label" ) );
						//}
						else {
							error.insertAfter( element );
						}
					},
					highlight: function ( element, errorClass, validClass ) {
						$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
						//$( element ).parents( ".error" ).addClass( "has-error" ).removeClass( "has-success" );
					},
					unhighlight: function (element, errorClass, validClass) {
						$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					},
					
					 submitHandler: function(form) {
						form.submit();
					},
					invalidHandler: function() {
						//alert("form is invalid");
					}
				});
			//End Validate*/
		});
	</script>
</body>
</html>
<?php
//if ($con)
//	mysqli_close($con);
//if ($con)
//	mysqli_close($con);
?>