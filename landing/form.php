<?php
include_once 'db_utf8.php';
include_once 'function.php';	
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
					<li class="active"><a href="form.php?l=<?php echo $l?>"><span class="fa fa-sticky-note"></span> FORM</a></li>
					<li><a href="search.php?l=<?php echo $l?>"><span class="fa fa-search"></span> SEARCH</a></li>
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
								<li class="nav-item active">
									<a class="nav-link" href="form.php">FORM - Recruit</a>
								</li>
							</ul>
						</div>
					 </div>
				  </nav>
				<form id="frmRecruit" name="frmRecruit" method="POST" action="form_view.php" enctype="multipart/form-data"><input type="hidden" id="l" name="l" value="<?php echo $l?>">
				<!--Start Part1-->
				<div class="part_form">
					<h4 class="mb-4">Part 1 :  Information</h4><input type="hidden" id="candidate_ID" name="candidate_ID" value="">
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
												<option value="Mr.">Mr.</option>
												<option value="Mrs.">Mrs.</option>
												<option value="Miss">Miss</option>
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
										<div class="col-sm-5"><input class="form-control" type="text" name="txtNameEn" id="txtNameEn"></div>
									</td>
									<td style="text-align:right;">Surname&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtSNameEn" id="txtSNameEn"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">ID Card&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtIDcard" id="txtIDcard" maxlength="13"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Nickname&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtNickname" id="txtNickname" style="width: 100%" maxlength="50"></div>
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
												<option value="นาย">นาย</option>
												<option value="นาง">นาง</option>
												<option value="นางสาว">นางสาว</option>
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
										<div class="col-sm-5"><input class="form-control" type="text" name="txtNameTh" id="txtNameTh"></div>
									</td>
									<td style="text-align:right;">นามสุกล&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtSNameTh" id="txtSNameTh"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Passport&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtPassport" id="txtPassport" maxlength="20"></div>
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
													$sql_country= "SELECT country,country_val FROM passport_country Where country_pop=1 order by country";
													$stmt_country = $con->query($sql_country);
													while ($result_country = $stmt_country->fetch()) {
												?>
													<option value="<?php echo $result_country['country_val']?>"><?php echo $result_country['country']?></option>
													<?php } ?>
											</optgroup>
											<optgroup label="ทั้งหมด">
												<?php
													$sql_countrya = "SELECT country,country_val FROM passport_country order by country";
													$stmt_countrya = $con->query($sql_countrya);
													while ($result_countrya = $stmt_countrya->fetch()) {
												?>
													<option value="<?php echo $result_countrya['country_val']?>"><?php echo $result_countrya['country']?></option>
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
								<div class="col-sm-5"><input class="form-control" type="text" name="txtAddress" id="txtAddress" maxlength="300"></div>
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
											//echo $sql_province."<br>";
											$stmt_province = $con->query($sql_province);	
										?>
										<select name="ddProvince" id="ddProvince" class="ddStyle" style="width: 100%;cursor: pointer;">
											<option value="">-เลือกจังหวัด-</option>
											<?php while ($result_province = $stmt_province->fetch()) { ?>
											<option value="<?php echo $result_province['provinceID']?>"><?php echo $result_province['provinceThai']?></option>
											<?php } ?>
										 </select>
										 <input type="hidden" name="ddProvince_info" id="ddProvince_info">
									</td>
									<td style="text-align:right">District&nbsp;</td>
									<td style="width: 30%">
										<select name="ddDistrict" id="ddDistrict" class="ddStyle" style="width: 100%;cursor: pointer;">
											<option value="">-เลือกอำเภอ-</option>
										 </select>
										 <input type="hidden" name="ddDistrict_info" id="ddDistrict_info">
									</td>
									<td style="text-align:right">SubDistrict&nbsp;</td>
									<td style="width: 30%">
										<select name="ddSubDistrict" id="ddSubDistrict" class="ddStyle" style="width: 100%;cursor: pointer;">
											<option value="">-เลือกตำบล-</option>
										 </select>
										 <input type="hidden" name="ddSubDistrict_info" id="ddSubDistrict_info">
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 30%">ZipCode&nbsp;</td>
									<td>
										<div class="col-sm-5"><input class="form-control" type="text" name="txtZipcode" id="txtZipcode"></div>
									</td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td style="text-align:right;width: 25%">LineID&nbsp;</td>
										<td>
											<div class="col-sm-5"><input class="form-control" type="text" name="txtLineID" id="txtLineID"></div>
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
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_O" name="radBlood" value="O" checked> O</label>
										</td>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_A" name="radBlood" value="A"> A</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_AB" name="radBlood" value="AB"> AB</label>
										</td>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBlood_B" name="radBlood" value="B"> B</label>
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
													<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radGender_male" name="radGender" value="Male" checked> Male&nbsp;</label>
												</td>
											</tr>
											<tr>
												<td>
													<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radGender_female" name="radGender" value="Female"> Female&nbsp;</label>
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
														<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radContract_y" name="radContract" value="Y"> Yes&nbsp;&nbsp;</label>
													</td>
												</tr>
												<tr>
													<td>
														<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radContract_n" name="radContract" value="N" checked> No</label>
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
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radExpStatus_normal" name="radExpStatus" value="Normal" checked> Normal&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radExpStatus_blacklist" name="radExpStatus" value="Blacklist"> Blacklist&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td><label class="lblcontainer"><input class="form-control" type="text" id="txtExpStatus" name="txtExpStatus" maxlength="100"></label></td>
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
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radMarital_single" name="radMarital" value="Single" checked> Single&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radMarital_married" name="radMarital" value="Married"> Married</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radMarital_widowed" name="radMarital" value="Widowed"> Widowed&nbsp;</label>
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
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radNationality_thai" name="radNationality" value="Thai" checked> Thai&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radNationality_Other" name="radNationality" value="Other"> Other&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td><label class="lblcontainer"><input class="form-control" type="text" name="txtNationality" id="txtNationality" maxlength="100"></label></td>
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
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radEthnicity_thai" name="radEthnicity" value="Thai" checked> Thai&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>
											<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radEthnicity_other" name="radEthnicity" value="Other"> Other&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td><label class="lblcontainer"><input class="form-control" type="text" name="txtEthnicity" id="txtEthnicity" maxlength="100"></label></td>
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
										<input class="datepicker form-control" id="txtBDDate" name="txtBDDate" size="16" type="text" style="width: 200px">
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
									<tr>
										<td style="text-align:right;width: 15%;height:40px">Email&nbsp;</td>
										<td>
											<div class="col-sm-5"><input class="form-control" type="text" name="txtEmail[]"></div>
										</td>
										<td>
											<button type="button" class="addrow btn btn-success" title="Add more email" id="btn_addeMail" name="btn_addeMail" ><i class="fa fa-plus-square-o"></i></button>
										</td>
									</tr>
									</table>
								</td>
								<td>
									<table border="0" style="width: 100%" class="tabForm_inside tblTelephone">
									<tr>
										<td style="text-align:right;width: 22%;height:40px">Telephone&nbsp;</td>
										<td>
											<div class="col-sm-5"><input class="form-control" type="text" name="txtTelephone[]"></div>
										</td>
										<td>
											<button type="button" class="addrow btn btn-success" title="Add more telephone" id="btn_addTel" name="btn_addTel" ><i class="fa fa-plus-square-o"></i></button>
										</td>
									</tr>
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
					<tr>
						<td colspan="2">
							<div class="col-sm-5"><label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_SAP" name="chkPosition[]" value="SAP">&nbsp;&nbsp;SAP</label></div>
						</td>
						<td style="text-align:right;">Module :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							 <select name="ddModule[]" id="ddModule" class="ddStyle" style="width: 100%" multiple>
								<?php
									$sql_SAPm = "SELECT SAP_module,SAP_moduleVal FROM sap_modules order by SAP_module";
									$stmt_SAPm = $con->query($sql_SAPm);
									while ($result_SAPm = $stmt_SAPm->fetch()) {
								?>
									<option value="<?php echo $result_SAPm['SAP_moduleVal']?>"><?php echo $result_SAPm['SAP_module'].' ('.$result_SAPm['SAP_moduleVal'].')' ?></option>
								<?php }?>
							 </select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="col-sm-5"><label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Programmer" name="chkPosition[]" value="Programmer">&nbsp;&nbsp;Programmer</label></div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							<select name="ddLanguage[]" id="ddLanguage" class="ddStyle" style="width: 100%" multiple>
								<?php
									$sql_prolang = "SELECT lang,lang_val FROM prog_lang order by lang";
									$stmt_prolang = $con->query($sql_prolang);
									while ($result_prolang = $stmt_prolang->fetch()) {
								?>
									<option value="<?php echo $result_prolang['lang_val']?>"><?php echo $result_prolang['lang']?></option>
								<?php } ?>
							 </select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_SA" name="chkPosition[]" value="SA">&nbsp;&nbsp;SA</label>
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radSACode_y" name="radSACode" value="Y"> Yes&nbsp;&nbsp;</label>
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radSACode_n" name="radSACode" value="N" checked> No</label>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<input class="form-control" type="text" id="txtSALange" name="txtSALange" style="width: 100%" maxlength="500">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_BA" name="chkPosition[]" value="BA">&nbsp;&nbsp;BA</label>
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBACode_y" name="radBACode" value="Y"> Yes&nbsp;&nbsp;</label>
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radBACode_n" name="radBACode" value="N" checked> No</label>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<input class="form-control" type="text" id="txtBALange" name="txtBALange" style="width: 100%" maxlength="500">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Tester" name="chkPosition[]" value="Tester">&nbsp;&nbsp;Tester</label>
						</td>
						<td style="text-align:right;">Testing :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="checkbox" class="checkbox label_inline lblcontainer" id="chkTester_Automate" name="chkTester[]" value="Automate"> Automate</label>
								<label class="lblcontainer"><input type="checkbox" class="checkbox label_inline lblcontainer" id="chkTester_Manual" name="chkTester[]" value="Manual"> Manual</label>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_PM" name="chkPosition[]" value="PM">&nbsp;&nbsp;Project Manager</label>
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radProjectManager_y" name="radProjectManager" value="Y"> Yes&nbsp;&nbsp;</label>
								<label class="lblcontainer"><input type="radio" class="lblcontainer" id="radProjectManager_n" name="radProjectManager" value="N" checked> No</label>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<input class="form-control" type="text" id="txtProjectManagerLang" name="txtProjectManagerLang" style="width: 100%" maxlength="500">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Admin" name="chkPosition[]" value="Admin">&nbsp;&nbsp;Project Admin</label>
						</td>
						<td style="text-align:right;">Skill :&nbsp;</td>
						<td colspan="3">
							<input class="form-control" type="text" id="txtProjectAdminSkill" name="txtProjectAdminSkill" style="width: 100%" maxlength="500">
						</td>
					</tr>
					<tr>
						<td>
							<label class="lblcontainer">&nbsp;<input type="checkbox" class="checkbox label_inline lblcontainer" id="position_Other" name="chkPosition[]" value="Other">&nbsp;&nbsp;Other</label>
						</td>
						<td>
							<input class="form-control" type="text" name="txtPositionOther" id="txtPositionOther" style="width: 100%" maxlength="100">
						</td>
						<td style="text-align:right;">Skill :&nbsp;</td>
						<td colspan="3">
							<input class="form-control" type="text" id="txtPositionOtherSkill" name="txtPositionOtherSkill" style="width: 100%" maxlength="500">
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
					<div class="div_inline"><h4 class="mb-4 div_inline">Part 3-1 : Call Record</h4>&nbsp;&nbsp;
						<!--<input type="button" class="addrow add_btn" id="btn_add31" name="btn_add31" value="Add">-->
						<button type="button" class="addrow btn btn-success" title="Add more call record" id="btn_add31" name="btn_add31" ><i class="fa fa-plus-square-o"></i> Add</button>
						<input type="hidden" id="txtPart31ID" style="width: 20px" value="1">
					</div>
					<table border="0" style="width: 100%;border-color:#DDDDDD" id="tab31" class="tbl31">
					<tbody>
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
								<td></td>
								<td style="text-align:right;">Interested Position : </td>
								<td colspan="3">
									<select id="ddInterestedPosition1" name="ddInterestedPosition1" class="ddStyle ddSearch" style="width: 100%"></select>
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
						</td>
					</tr>
					</tbody>
					</table>
				</div>
				<!--End Part3-1-->
				<br/>
				<!--Start Part3-2-->
				<div class="part_form">
					<div class="div_inline"><h4 class="mb-4 div_inline">Part 3-2 : Interview Record</h4>&nbsp;&nbsp;
						<!--<input type="button" class="addrow add_btn div_inline" id="btn_add32" name="btn_add32" value="Add">
						<input type="button" class="addrow add_btn div_inline" id="btn_check" name="btn_check" value="Check">-->
						<button type="button" class="addrow btn btn-success" title="Add interview record" id="btn_add32" name="btn_add32" ><i class="fa fa-plus-square-o"></i> Add</button>
						<input type="hidden" id="txtPart32ID" style="width: 200px" value="1">
					</div>
					<table border="0" style="width: 100%;border-color:#DDDDDD" id="tab32" class="tbl32">
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
								<td colspan="2">
									<select id="ddClientCompany1" name="ddClientCompany1" class="ddStyle ddSearch" style="width: 100%"></select>
									<input type="hidden" id="txtClientID1" name="txtClientID1" style="width: 20px">
									<input type="hidden" id="txtClientCompany1" name="txtClientCompany1" style="width: 20px">
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
						</td>
					</tr>
					</table>
				</div>
				<!--End Part3-2-->			
				<br/>
				<!--Start Part Upload-->
				<div class="part_form">
					<div class="mb-3">
						<label for="formFile" class="form-label"><h4 class="mb-4 div_inline">Upload document </h4><b>max 2mb</b> (doc, docx, jpg, jpeg, pdf, png, ppt, pptx, xls, xlsx, xlsm)</label>
						<input type="file" style="cursor:pointer;" name="upload_file1" id="upload_file1" readonly="true" onchange="Filevalidation(1)"/>
						<div style="font-size:8px">&nbsp;</div>
						<div id="moreFileUpload"></div>
						<div style="clear:both;"></div>
						<div id="moreFileUploadLink" style="display:none;margin-left: 10px;">
							<!--<a href="javascript:void(0);" id="attachMore" style="color: #008df3;">Attach another file</a>-->
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
		<!-- Start Modal Add Edit -->
		<div class="modal" id="modalAddEdt">
			<div class="modal-dialog modal-lg">
			  <div class="modal-content" id="modalContentAddEdt"></div>
			</div>
		</div>
		<!-- End Modal Add Edit -->
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
			if (name_th&& sname_th&&name_en&&sname_en)
				$.post("validate.php",ID:candidate_ID, name_th:name_th, sname_th:sname_th, name_en:name_en, sname_en:sname_en ,action:"validate-candidate"},function(data){
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
		//alert(nowTemp.getFullYear());
		//alert(nowTemp.getMonth());
		//alert( nowTemp.getDate());
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		var m = nowTemp.getMonth()+1;
		var m_st = m.toString();
		if (m_st.length ==1)
			m_st = '0'+m_st;
		var d_st = nowTemp.getDate().toString();
		if (d_st.length ==1)
			d_st = '0'+d_st;
		
		const candidate_ID = nowTemp.getFullYear().toString()+m_st+d_st+$('#txtNameEn').val().substring(0,4)+$('#txtSNameEn').val().substring(0,4);
		$("#candidate_ID").val(candidate_ID);
		
		$(".datepicker").datepicker({format: "yyyy-mm-dd"});
		var txtBDDate = $('#txtBDDate').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {ageCalculator()}).data('datepicker');
		txtBDDate.setValue(now);
		
		var txtCallDate1 = $('#txtCallDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
			txtCallDate1.hide();
			var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#callRow1').val(); 
			//{create date} YYYYMMDD(2)S(2)- {call date} YYYYMMDD-row
			$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
		}).data('datepicker');
		txtCallDate1.setValue(now);
		
		var dateStr = $("#candidate_ID").val()+'-'+$('#txtCallDate1').val().substring(0,4)+$('#txtCallDate1').val().substring(5,7)+$('#txtCallDate1').val().substring(8,10)+'-'+$('#callRow1').val();	 //YYYYMMDD-row
		$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
		
		var txtStartDateNewJob1 = $('#txtStartDateNewJob1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDateNewJob1.hide()}).data('datepicker');
		txtStartDateNewJob1.setValue(now);
		
		var txtInterviewDate1 = $('#txtInterviewDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {
			txtInterviewDate1.hide();
			var dateStri = t$("#candidate_ID").val()+'-'+his.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#invRow1').val();	//YYYYMMDD-row
			$("#txtIntvRec_matchingNo"+$('#invRow1').val()).val(dateStri);
		}).data('datepicker');
		txtInterviewDate1.setValue(now);
		
		var dateStri = $("#candidate_ID").val()+'-'+$('#txtInterviewDate1').val().substring(0,4)+$('#txtInterviewDate1').val().substring(5,7)+$('#txtInterviewDate1').val().substring(8,10)+'-'+$('#invRow1').val();	 //YYYYMMDD-row
		$("#txtIntvRec_matchingNo"+$('#invRow1').val()).val(dateStri);
		
		var txtStartDate1 = $('#txtStartDate1').datepicker({format: "yyyy-mm-dd"}).on('changeDate', function(ev) {txtStartDate1.hide()}).data('datepicker');
		txtStartDate1.setValue(now);

		<!----------------------------------------------------------------------------------------------------------------------------------set up Default 3-1 3-2 date------------------------------------------------------------------------------------------------------->
		$(function(){
			$.post("load-dropdown.php",{position_id:$(this).val(),action:"load-position",act:'1'},function(data){
				$("#ddCurrentPosition1").html(data);
				$("#ddInterestedPosition1").html(data);
			});
			$.post("load-dropdown.php",{position_id:$(this).val(),action:"load-client",act:'1'},function(data){
				$("#ddClientCompany1").html(data);
			});
			
			$('#txtTime1').combodate({
				firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
				minuteStep: 1
			});  
		}); //end function load drop down
		
		$("#txtNameEn").keyup(function(){
			//var m = nowTemp.getMonth()+1;
			const candidate_ID = nowTemp.getFullYear().toString()+m_st+d_st+this.value.substring(0,4)+$('#txtSNameEn').val().substring(0,4);
			$("#candidate_ID").val(candidate_ID);
			
			var dateStr = $("#candidate_ID").val()+'-'+$('#txtCallDate1').val().substring(0,4)+$('#txtCallDate1').val().substring(5,7)+$('#txtCallDate1').val().substring(8,10)+'-'+$('#callRow1').val();
			$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
		});
		$("#txtSNameEn").keyup(function(){
			//var m = nowTemp.getMonth()+1;
			const candidate_ID = nowTemp.getFullYear().toString()+m_st+d_st+$('#txtNameEn').val().substring(0,4)+this.value.substring(0,4);
			$("#candidate_ID").val(candidate_ID);
			
			var dateStr = $("#candidate_ID").val()+'-'+$('#txtCallDate1').val().substring(0,4)+$('#txtCallDate1').val().substring(5,7)+$('#txtCallDate1').val().substring(8,10)+'-'+$('#callRow1').val();
			$("#txtCallRec_matchingNo"+$('#callRow1').val()).val(dateStr);
		});
		
		$("#txtPresentSalary1").keyup(function(){
			var txtBBSOfferCalculation1 = 0;
			//txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary1').val()) + (parseInt($('#txtPresentSalary1').val()) * parseInt($('#txtBonus1').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary1').val());
			txtBBSOfferCalculation1 = (((parseInt($('#txtBonus1').val()) + 12) * parseInt($('#txtPresentSalary1').val())) / 12)*1.2;
			$("#txtBBSOfferCalculation"+$('#callRow1').val()).val(txtBBSOfferCalculation1);
		});
		$("#txtBonus1").keyup(function(){
			var txtBBSOfferCalculation1 = 0;
			//txtBBSOfferCalculation1 = ((( parseInt($('#txtPresentSalary1').val()) + (parseInt($('#txtPresentSalary1').val()) * parseInt($('#txtBonus1').val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary1').val());
			txtBBSOfferCalculation1 = (((parseInt($('#txtBonus1').val()) + 12) * parseInt($('#txtPresentSalary1').val())) / 12)*1.2;
			$("#txtBBSOfferCalculation"+$('#callRow1').val()).val(txtBBSOfferCalculation1);
		});
		 
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
				//moreUploadTag += '<div class="element"><label for="upload_file"' + upload_number + '>Upload File ' + upload_number + '</label>';
				moreUploadTag += '<div class="element">';
				moreUploadTag += '<input type="file" style="cursor:pointer;" onchange="Filevalidation(' + upload_number + ')" id="upload_file' + upload_number + '" name="upload_file' + upload_number + '" readonly="true"/>';
				moreUploadTag += '<a href="javascript:void" style="cursor:pointer;color: #008df3;padding-left:20px" onclick="deletefileLink(' + upload_number + ')">Delete</a>';
				moreUploadTag += '</div>';
					
				$('<dl id="delete_file' + upload_number + '">' + moreUploadTag + '</dl>').fadeIn('slow').appendTo('#moreFileUpload');
				upload_number++;
			});
			ageCalculator();
			
			//var moduelObject 	= $('#ddModule');
			/*moduelObject.html('<option value="">-เลือกตำบล-</option>');
			$.get('get_SAPModule.php', function(data){
				var result = JSON.parse(data);
				$.each(result, function(index, item){
					moduelObject.append(
						$('<option></option>').val(item.SAP_moduleVal).html(item.SAP_module)
					);
				});
			});
			$.get('get_amphure.php?province_id=10', function(data){
				var result = JSON.parse(data);
				$.each(result, function(index, item){
					moduelObject.append(
						$('<option></option>').val(item.districtID).html(item.districtThai)
					);
				});
			});*/
			
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
			
			//$("#btn_submit").click(function(){
				//alert( "Handler for .click() called." );
			// });
			//$(".tblcls tr").each(function(x) { if (x % 2) this.style.backgroundColor = "#EAEAEA"; });
			
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
				//$(".ddSearch").select2();
			});
			
			$("#btn_addTel").click(function(){
				$(".tblTelephone").append(addrowTel);
				//$(".ddSearch").select2();
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
				//addrow31 +="<button type=\"button\" class=\"btn btn-success\" title=\"Add Position\" data-toggle=\"modal\" data-target=\"#modalPosition\"  id=\"btn_addPosition\" name=\"btn_addPosition\"><i class=\"fa fa-plus-square-o\"></i></button>";
				addrow31 +="</td>";
				addrow31 +="<td style=\"text-align:right;\">Interested Position : </td>";
				addrow31 +="<td colspan=\"3\">";
				addrow31 +="<select id=\"ddInterestedPosition"+txtPart31ID+"\" name=\"ddInterestedPosition"+txtPart31ID+"\" class=\"ddStyle ddSearch\" style=\"width: 100%\">";
				addrow31 +="</select>";
				addrow31 +="</td>";
				//addrow31 +="<td>";
				//addrow31 +="<button type=\"button\" class=\"btn btn-success\" title=\"Add Position\" data-toggle=\"modal\" data-target=\"#modalPosition\"  id=\"btn_addIPosition\" name=\"btn_addIPosition\"><i class=\"fa fa-plus-square-o\"></i></button>";
				//addrow31 +="</td>";
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
					//var dateStr = this.value.substring(6,10)+this.value.substring(3,5)+this.value.substring(0,2)+'-'+$('#callRow'+txtPart31ID).val();
					var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#callRow'+txtPart31ID).val();	//YYYYMMDD-row
					$("#txtCallRec_matchingNo"+$('#callRow'+txtPart31ID).val()).val(dateStr);
				}).data('datepicker');
				txtCallDate.setValue(now);
				
				//var date = nowTemp.getDate();
				//var month = nowTemp.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
				//var year = nowTemp.getFullYear();
				//if (date.toString().length == 1)
				//	date = '0'+date.toString();
				//var dateStr = year.toString()+month.toString()+date+'-'+txtPart31ID;
				//var dateStr = $('#txtCallDate'+txtPart31ID).val().substring(6,10)+$('#txtCallDate'+txtPart31ID).val().substring(3,5)+$('#txtCallDate'+txtPart31ID).val().substring(0,2)+'-'+$('#callRow'+txtPart31ID).val();	 //YYYYMMDD-row
				var dateStr =  $("#candidate_ID").val()+'-'+$('#txtCallDate'+txtPart31ID).val().substring(0,4)+$('#txtCallDate'+txtPart31ID).val().substring(5,7)+$('#txtCallDate'+txtPart31ID).val().substring(8,10)+'-'+$('#callRow'+txtPart31ID).val();	 //YYYYMMDD-row
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
					//txtBBSOfferCalculation = ((( parseInt($('#txtPresentSalary'+txtPart31ID).val()) + (parseInt($('#txtPresentSalary'+txtPart31ID).val()) * parseInt($('#txtBonus'+txtPart31ID).val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary'+txtPart31ID).val());
					txtBBSOfferCalculation = (((parseInt($('#txtBonus'+txtPart31ID).val()) + 12) * parseInt($('#txtPresentSalary'+txtPart31ID).val())) / 12)*1.2;
					$("#txtBBSOfferCalculation"+$('#callRow'+txtPart31ID).val()).val(txtBBSOfferCalculation);
				});
				$("#txtBonus"+txtPart31ID).keyup(function(){
					var txtBBSOfferCalculation = 0;
					//txtBBSOfferCalculation = ((( parseInt($('#txtPresentSalary'+txtPart31ID).val()) + (parseInt($('#txtPresentSalary'+txtPart31ID).val()) * parseInt($('#txtBonus'+txtPart31ID).val()) ) )/12)*1.2) + parseInt($('#txtPresentSalary'+txtPart31ID).val());
					txtBBSOfferCalculation = (((parseInt($('#txtBonus'+txtPart31ID).val()) + 12) * parseInt($('#txtPresentSalary'+txtPart31ID).val())) / 12)*1.2;
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
				addrow32 +="<td colspan='2'>";
				addrow32 +="<select id=\"ddClientCompany"+txtPart32ID+"\" name=\"ddClientCompany"+txtPart32ID+"\" class=\"ddStyle ddSearch\" style=\"width: 100%\">";
				addrow32 +="</select><input type=\"hidden\" id=\"txtClientID"+txtPart32ID+"\" name=\"txtClientID"+txtPart32ID+"\" style=\"width: 20px\">";
				addrow32 +="<input type=\"hidden\" id=\"txtClientCompany"+txtPart32ID+"\" name=\"txtClientCompany"+txtPart32ID+"\" style=\"width: 20px\">";
				addrow32 +="</td>";
				//addrow32 +="<td>";
				//addrow32 +="<button type=\"button\" class=\"btn btn-success\" title=\"Add Company\" data-toggle=\"modal\" data-target=\"#modalCompany\"  id=\"btn_addCustomerCompany\" name=\"btn_addCustomerCompany\"><i class=\"fa fa-plus-square-o\"></i></button>";
				//addrow32 +="</td>";
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
					//var dateStr = this.value.substring(6,10)+this.value.substring(3,5)+this.value.substring(0,2)+'-'+$('#invRow'+txtPart32ID).val();
					var dateStr = $("#candidate_ID").val()+'-'+this.value.substring(0,4)+this.value.substring(5,7)+this.value.substring(8,10)+'-'+$('#invRow'+txtPart32ID).val();	//YYYYMMDD-row
					$("#txtIntvRec_matchingNo"+$('#invRow'+txtPart32ID).val()).val(dateStr);
				}).data('datepicker');
				txtInterviewDate.setValue(now);
				
				//var dateStr = $('#txtInterviewDate'+txtPart32ID).val().substring(6,10)+$('#txtInterviewDate'+txtPart32ID).val().substring(3,5)+$('#txtInterviewDate'+txtPart32ID).val().substring(0,2)+'-'+$('#invRow'+txtPart32ID).val();	 //YYYYMMDD-row
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
			$("#ddClientCompany1").change(function() {
				var splitString = '';
				//alert(this.value);
				splitString = this.value.split("|");
				$("#txtClientID1").val(splitString[0]);
				$("#txtClientDepartment1").val(splitString[1]);
				$("#txtClientContact1").val(splitString[2]);
				$("#txtClientCompany1").val(splitString[3]);
			});
			
			$("#btn_check").click(function(){
				/*var selected = $('select[name="ddCustomerCompany"]').map(function(){
					if ($(this).val())
						return $(this).val();
				}).get();
				alert(document.getElementsByName('ddCustomerCompany').length);
				alert(selected);
				*/
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