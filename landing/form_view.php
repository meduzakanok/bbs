<?php
include 'db_utf8.php';
include 'function.php';	
$l = '';
$str_l = '';
$current_login = '';
isset( $_POST['l'] ) ? $str_l = $_POST['l'] : $str_l = $_GET['l'];

if ($str_l == '')
	header('Location: ../');
else{
	$str_l = getLogin($str_l , 0);
	$l = $str_l;
	$current_login = getLogin($str_l , 3);
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
				<?php
					//-----------------------------------------------------------------------------start part1
					$ddTitleEn 				= "";
					$txtNameEn 				= "";
					$txtSNameEn 			= "";
					
					$ddTitleTh 				= "";
					$txtNameTh 				= "";
					$txtSNameTh 			= "";
					
					$txtNickname 			= "";
					
					$txtIDcard 				= "";
					$txtPassport 				= "";
					$ddPassportCountry 		= "";
					
					$txtAddress 				= "";
					$ddSubDistrict 			= "";
					$ddDistrict 				= "";
					$ddProvince 				= "";
					
					$ddSubDistrict_info 		= "";
					$ddDistrict_info 			= "";
					$ddProvince_info 		= "";
					
					$txtZipcode 				= "";
					
					$radBlood 				= "";
					$radGender 				= "";
					$radContract 				= "";
					
					$radExpStatus 			= "";
					$txtExpStatus 			= "";
					
					$radMarital 				= "";
					
					$radNationality 			= "";
					$txtNationality 			= "";
					
					$radEthnicity 				= "";
					$txtEthnicity 				= "";
					
					$txtBDDate 				= "";
					$txtAgeYear 				= "";
					$txtAgeMonth 			= "";
					$txtAgeDay 				= "";
					
					$txtLineID					= "";
					$txtEmail					= "";
					$txtTelephone			= "";
					//-----------------------------------------------------------------------------end part1
					//-----------------------------------------------------------------------------start part2
					$chkPosition				= "";
					$txtPositionOther		= "";
					$ddModule				= "";
					$ddLanguage				= "";
					
					$radSACode 				= "";
					$txtSALange 				= "";
					
					$radBACode 				= "";
					$txtBALange 				= "";
					
					$radProjectManager		= "";
					$txtProjectManagerLang = "";
					
					$chkTester				= "";
					$txtProjectAdminSkill		= "";
					$txtPositionOtherSkill		= "";
					//-----------------------------------------------------------------------------end part2
					//-----------------------------------------------------------------------------start part3-1 3-2
					$callRow					= "";
					$invRow					= "";
					//-----------------------------------------------------------------------------end part3-1 3-2
					//include_once 'db.php';	
					if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST['btn_submit'])) {
						
						//-----------------------------------------------------------------------------start part1
						$ddTitleEn 				= $_POST['ddTitleEn'];
						isset( $_POST['txtNameEn'] ) 							? $txtNameEn = $_POST['txtNameEn'] 									: $txtNameEn = "";
						isset( $_POST['txtSNameEn'] ) 						? $txtSNameEn = $_POST['txtSNameEn'] 								: $txtSNameEn = "";
						
						$ddTitleTh 				= $_POST['ddTitleTh'];
						isset( $_POST['txtNameTh'] ) 							? $txtNameTh = $_POST['txtNameTh'] 									: $txtNameTh = "";
						isset( $_POST['txtSNameTh'] ) 						? $txtSNameTh = $_POST['txtSNameTh'] 								: $txtSNameTh = "";
						
						isset( $_POST['txtNickname'] ) 						? $txtNickname = $_POST['txtNickname'] 								: $txtNickname = "";
						isset( $_POST['txtIDcard'] ) 							? $txtIDcard = $_POST['txtIDcard'] 										: $txtIDcard = "";
						isset( $_POST['txtPassport'] ) 						? $txtPassport = $_POST['txtPassport'] 									: $txtPassport = "";
						$ddPassportCountry 	= $_POST['ddPassportCountry'];
						
						isset( $_POST['txtAddress'] ) 							? $txtAddress = $_POST['txtAddress'] 									: $txtAddress = "";
						$ddSubDistrict 			= $_POST['ddSubDistrict'];
						$ddDistrict 				= $_POST['ddDistrict'];
						$ddProvince 				= $_POST['ddProvince'];
						
						$ddSubDistrict_info 		= $_POST['ddSubDistrict_info'];
						$ddDistrict_info 			= $_POST['ddDistrict_info'];
						$ddProvince_info 		= $_POST['ddProvince_info'];
						
						isset( $_POST['txtZipcode'] ) 							? $txtZipcode = $_POST['txtZipcode'] 										: $txtZipcode = "";
						isset( $_POST['radBlood'] ) 						? $radBlood = $_POST['radBlood'] 									: $radBlood = "";
						isset( $_POST['radGender'] ) 						? $radGender = $_POST['radGender'] 									: $radGender = "";
						isset( $_POST['radContract'] ) 						? $radContract = $_POST['radContract'] 									: $radContract = "";
						
						isset( $_POST['radExpStatus'] ) 						? $radExpStatus = $_POST['radExpStatus'] 									: $radExpStatus = "";
						isset( $_POST['txtExpStatus'] ) 						? $txtExpStatus = $_POST['txtExpStatus'] 								: $txtExpStatus = "";
						
						isset( $_POST['radMarital'] ) 						? $radMarital = $_POST['radMarital'] 									: $radMarital = "";
						
						isset( $_POST['radNationality'] ) 						? $radNationality = $_POST['radNationality'] 									: $radNationality = "";
						isset( $_POST['txtNationality'] ) 						? $txtNationality = $_POST['txtNationality'] 								: $txtNationality = "";
						
						isset( $_POST['radEthnicity'] ) 							? $radEthnicity = $_POST['radEthnicity'] 									: $radEthnicity = "";
						isset( $_POST['txtEthnicity'] ) 							? $txtEthnicity = $_POST['txtEthnicity'] 									: $txtEthnicity = "";
						
						$txtBDDate 				= $_POST['txtBDDate'];
						//if (isset($txtBDDate)){
						//	$txtBDDate_date		= substr($txtBDDate,6,4)."-".substr($txtBDDate,3,2)."-".substr($txtBDDate,0,2); 
						//}
						isset( $_POST['txtAgeYear_val'] ) 					? $txtAgeYear = $_POST['txtAgeYear_val'] 								: $txtAgeYear = "0";
						isset( $_POST['txtAgeMonth_val'] ) 					? $txtAgeMonth = $_POST['txtAgeMonth_val'] 							: $txtAgeMonth = "0";
						isset( $_POST['txtAgeDay_val'] ) 						? $txtAgeDay = $_POST['txtAgeDay_val'] 									: $txtAgeDay = "0";
						
						isset( $_POST['txtLineID'] ) 							? $txtLineID = $_POST['txtLineID'] 										: $txtLineID = "";
						$txtEmail					= $_POST['txtEmail'];
						$txtTelephone			= $_POST['txtTelephone'];
						//-----------------------------------------------------------------------------end part1
						//-----------------------------------------------------------------------------start part2
						isset( $_POST['chkPosition'] ) ? $chkPosition = $_POST['chkPosition'] : $chkPosition = "";
						isset( $_POST['txtPositionOther'] ) 					? $txtPositionOther = $_POST['txtPositionOther'] 						: $txtPositionOther = "";
						
						isset( $_POST['ddModule'] ) ? $ddModule = $_POST['ddModule'] : $ddModule = "";
						isset( $_POST['ddLanguage'] ) ? $ddLanguage = $_POST['ddLanguage'] : $ddLanguage = "";
						
						isset( $_POST['radSACode'] ) 						? $radSACode = $_POST['radSACode'] 									: $radSACode = "";
						isset( $_POST['txtSALange'] ) 						? $txtSALange = $_POST['txtSALange'] 									: $txtSALange = "";
						
						isset( $_POST['radBACode'] ) 						? $radBACode = $_POST['radBACode'] 									: $radBACode = "";
						isset( $_POST['txtBALange'] ) 						? $txtBALange = $_POST['txtBALange'] 									: $txtBALange = "";
						
						isset( $_POST['radProjectManager'] ) 						? $radProjectManager = $_POST['radProjectManager'] 									: $radProjectManager = "";
						isset( $_POST['txtProjectManagerLang'] ) 			? $txtProjectManagerLang = $_POST['txtProjectManagerLang'] 		: $txtProjectManagerLang = "";
						
						isset( $_POST['chkTester'] ) ? $chkTester = $_POST['chkTester'] : $chkTester = "";
						isset( $_POST['txtProjectAdminSkill'] ) 				? $txtProjectAdminSkill = $_POST['txtProjectAdminSkill'] 				: $txtProjectAdminSkill = "";
						isset( $_POST['txtPositionOtherSkill'] ) 				? $txtPositionOtherSkill = $_POST['txtPositionOtherSkill'] 				: $txtPositionOtherSkill = "";
						//-----------------------------------------------------------------------------end part2
						
						//-----------------------------------------------------------------------------start part3-1 3-2
						$callRow						= $_POST['callRow'];
						$invRow						= $_POST['invRow'];
						//-----------------------------------------------------------------------------end part3-1 3-2
						date_default_timezone_set('Asia/Bangkok');
						$candidate_ID = date("Y").date("m").date("d").strtolower(trim(substr($txtNameEn,0,4))).strtolower(trim(substr($txtSNameEn,0,4)));
						//echo  "candidateID = ".$candidateID."<br/>";
						//echo "File size = ".$_FILES['upload_file1']['size']."<br/>";
						
						$current_date = current_date();
						//$filename_str = '';
						//echo "-->".$filename_str;
						//include_once 'db_utf8.php';
						$pos_ind[0][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[0][1] = '';
						$pos_ind[1][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[1][1] = '';
						$pos_ind[2][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[2][1] = '';
						$pos_ind[3][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[3][1] = '';
						$pos_ind[4][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[4][1] = '';
						$pos_ind[5][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[5][1] = '<img src="images/radioBtnW.png"> Automate';
						$pos_ind[5][2] = '<img src="images/radioBtnW.png"> Manual';
						$pos_ind[6][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[6][1] = '';
						$pos_ind[7][0] = '<img src="images/radioBtnW.png">';
						$pos_ind[7][1] = '';
						
						$radSACode_ind = '<img src="images/radioBtnW.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnW.png"> No';
						$radBACode_ind = '<img src="images/radioBtnW.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnW.png"> No';
						$radProjectManager_ind = '<img src="images/radioBtnW.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnW.png"> No';
						//-----------------------------------------------------------------------------start insert part2
						if (isset($chkPosition) && ($chkPosition != '')){
							foreach( $chkPosition as $key => $pos ) {
								//echo 'pos - '.$pos.'<br>';	
								if($pos != '') {
									$sql_position  = "INSERT INTO candidate_position (candidate_ID, position, ";
									if ($pos=='Other' && isset($txtPositionOther))
										$sql_position .= " position_other, ";
									$sql_position .= " create_date,update_date, update_by)";
									$sql_position .= " VALUES ('".$candidate_ID."', '".$pos."', ";
									if ($pos=='Other' && isset($txtPositionOther))
										$sql_position .= " '".$txtPositionOther."', ";
									$sql_position .= " '".$current_date."', '".$current_date."','".$current_login."')";
									insLog($current_login, $sql_position);
									//echo 'sql_position - '.$sql_position.'<br>';	
									$stmt_position = $con->query($sql_position);
									
									if($pos == 'SAP') {								//-----------------------------------------------------------------------------start insert SAP
										$pos_ind[0][0] = '<img src="images/radioBtnC.png">';
										if (isset($ddModule) && ($ddModule!='')){
											foreach( $ddModule as $key => $sap_skill ) {
												if($sap_skill != '') {
													$sql_sap_skill  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
													$sql_sap_skill .= " create_date,update_date, update_by)";
													$sql_sap_skill .= " VALUES ('".$candidate_ID."', '".$pos."', '".$sap_skill."', 'text', ";
													$sql_sap_skill .= " '".$current_date."', '".$current_date."','".$current_login."')";
													insLog($current_login, $sql_sap_skill);
													$stmt_sap_skil = $con->query($sql_sap_skill);
													$pos_ind[0][1] .= '- '.$sap_skill.'<br/>';
												} //end if sap_skill
											} //end for sap_skill
										} //end if ddModule
									}
									elseif($pos == 'Programmer') {					//-----------------------------------------------------------------------------start insert Programmer
										$pos_ind[1][0] = '<img src="images/radioBtnC.png">';
										if (isset($ddLanguage)&&($ddLanguage!='')){
											foreach( $ddLanguage as $key => $prog_skill ) {
												if($prog_skill != '') {
													$sql_prog_skill  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
													$sql_prog_skill .= " create_date,update_date, update_by)";
													$sql_prog_skill .= " VALUES ('".$candidate_ID."', '".$pos."', '".$prog_skill."', 'text', ";
													$sql_prog_skill .= " '".$current_date."', '".$current_date."','".$current_login."')";
													insLog($current_login, $sql_prog_skill);
													$stmt_prog_skill = $con->query($sql_prog_skill);
													$pos_ind[1][1] .= '- '.$prog_skill.'<br/>';
												} //end if sql_prog_skill
											} //end for sql_prog_skill
										} //end if ddLanguage
									}
									elseif($pos == 'SA') {							//-----------------------------------------------------------------------------start insert SA
										$pos_ind[2][0] = '<img src="images/radioBtnC.png">';
										if (isset($radSACode)){
											$sql_sa_skill  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_sa_skill .= " create_date,update_date, update_by)";
											$sql_sa_skill .= " VALUES ('".$candidate_ID."', '".$pos."', '".$radSACode."', 'choice', ";
											$sql_sa_skill .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_sa_skill);
											$stmt_sa_skill = $con->query($sql_sa_skill);
											if($radSACode == 'Y')
												$radSACode_ind = '<img src="images/radioBtnC.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnW.png"> No';
											else
												$radSACode_ind = '<img src="images/radioBtnW.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnC.png"> No';
										} //end if radSACode
										if (isset($txtSALange) && ($txtSALange !='')){
											$sql_sa_skill_txt  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_sa_skill_txt .= " create_date,update_date, update_by)";
											$sql_sa_skill_txt .= " VALUES ('".$candidate_ID."', '".$pos."', '".$txtSALange."', 'text', ";
											$sql_sa_skill_txt .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_sa_skill_txt);
											$stmt_sa_skill_txt = $con->query($sql_sa_skill_txt);
										} //end if txtSALange
									}
									elseif($pos == 'BA') {							//-----------------------------------------------------------------------------start insert BA
										$pos_ind[3][0] = '<img src="images/radioBtnC.png">';
										if (isset($radBACode)){
											$sql_ba_skill  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_ba_skill .= " create_date,update_date, update_by)";
											$sql_ba_skill .= " VALUES ('".$candidate_ID."', '".$pos."', '".$radBACode."', 'choice', ";
											$sql_ba_skill .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_ba_skill);
											$stmt_ba_skill = $con->query($sql_ba_skill);
											if($radBACode == 'Y')
												$radBACode_ind = '<img src="images/radioBtnC.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnW.png"> No';
											else
												$radBACode_ind = '<img src="images/radioBtnW.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnC.png"> No';
										} //end if radBACode
										if (isset($txtBALange) && ($txtBALange !='')){
											$sql_ba_skill_txt  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_ba_skill_txt .= " create_date,update_date, update_by)";
											$sql_ba_skill_txt .= " VALUES ('".$candidate_ID."', '".$pos."', '".$txtBALange."', 'text', ";
											$sql_ba_skill_txt .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_ba_skill_txt);
											$stmt_ba_skill_txt = $con->query($sql_ba_skill_txt);
										} //end if txtBALange
									}
									elseif($pos == 'PM') {							//-----------------------------------------------------------------------------start insert PM
										$pos_ind[4][0] = '<img src="images/radioBtnC.png">';
										if (isset($radProjectManager)){
											$sql_proj_skill  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_proj_skill .= " create_date,update_date, update_by)";
											$sql_proj_skill .= " VALUES ('".$candidate_ID."', '".$pos."', '".$radProjectManager."', 'choice', ";
											$sql_proj_skill .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_proj_skill);
											$stmt_proj_skill = $con->query($sql_proj_skill);
											if($radProjectManager == 'Y')
												$radProjectManager_ind = '<img src="images/radioBtnC.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnW.png"> No';
											else
												$radProjectManager_ind = '<img src="images/radioBtnW.png"> Yes&nbsp;&nbsp;<img src="images/radioBtnC.png"> No';
										} //end if radProjectManage
										if (isset($txtProjectManagerLang) && ($txtProjectManagerLang !='')){
											$sql_proj_skill_txt  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_proj_skill_txt .= " create_date,update_date, update_by)";
											$sql_proj_skill_txt .= " VALUES ('".$candidate_ID."', '".$pos."', '".$txtProjectManagerLang."', 'text', ";
											$sql_proj_skill_txt .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_proj_skill_txt);
											$stmt_proj_skill_txt = $con->query($sql_proj_skill_txt);
										} //end if txtProjectManagerLang
									}
									elseif($pos == 'Tester') {				//-----------------------------------------------------------------------------start insert Tester
										$pos_ind[5][0] = '<img src="images/radioBtnC.png">';
										if (isset($chkTester)){
											foreach( $chkTester as $key => $tester_skill ) {
												if($tester_skill != '') {
													$sql_tester_skill  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
													$sql_tester_skill .= " create_date,update_date, update_by)";
													$sql_tester_skill .= " VALUES ('".$candidate_ID."', '".$pos."', '".$tester_skill."', 'choice', ";
													$sql_tester_skill .= " '".$current_date."', '".$current_date."','".$current_login."')";
													insLog($current_login, $sql_tester_skill);
													$stmt_tester_skil = $con->query($sql_tester_skill);
													if ($tester_skill == 'Automate')
														$pos_ind[5][1] =  '<img src="images/radioBtnC.png"> Automate';
													if ($tester_skill == 'Manual')
														$pos_ind[5][2] =  '<img src="images/radioBtnC.png"> Manual';
												} //end if sql_tester_skill
											} //end for sql_tester_skill
										} //end if chkTester
									}
									elseif($pos == 'Admin') {				//-----------------------------------------------------------------------------start insert Admin
										$pos_ind[6][0] = '<img src="images/radioBtnC.png">';
										if (isset($txtProjectAdminSkill) && ($txtProjectAdminSkill !='')){
											$sql_proa_skill_txt  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_proa_skill_txt .= " create_date,update_date, update_by)";
											$sql_proa_skill_txt .= " VALUES ('".$candidate_ID."', '".$pos."', '".$txtProjectAdminSkill."', 'text', ";
											$sql_proa_skill_txt .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_proa_skill_txt);
											$stmt_proa_skill_txt = $con->query($sql_proa_skill_txt);
										} //end if txtProjectManagerLang
									}
									elseif($pos == 'Other') {				//-----------------------------------------------------------------------------start insert Other
										$pos_ind[7][0] = '<img src="images/radioBtnC.png">';
										if (isset($txtPositionOtherSkill) && ($txtPositionOtherSkill !='')){
											$sql_other_skill_txt  = "INSERT INTO candidate_positionskill (candidate_ID, position, skill, skill_type, ";
											$sql_other_skill_txt .= " create_date,update_date, update_by)";
											$sql_other_skill_txt .= " VALUES ('".$candidate_ID."', '".$pos."', '".$txtPositionOtherSkill."', 'text', ";
											$sql_other_skill_txt .= " '".$current_date."', '".$current_date."','".$current_login."')";
											insLog($current_login, $sql_other_skill_txt);
											$stmt_other_skill_txt = $con->query($sql_other_skill_txt);
										} //end if txtPositionOtherSkill
									} 											//-----------------------------------------------------------------------------end insert on each position
								} //end if pos
							} //end for pos
						}  
						//-----------------------------------------------------------------------------end insert part2
						
						//-----------------------------------------------------------------------------start insert Email
						if (isset($txtEmail)){
							foreach( $txtEmail as $key => $mail ) {
								if($mail != '') {
									$sql_contactMail  = "INSERT INTO candidate_contact (candidate_ID, contact_info, contact_type, ";
									$sql_contactMail .= " create_date,update_date, update_by)";
									$sql_contactMail .= " VALUES ('".$candidate_ID."', '".$mail."', 'Email', ";
									$sql_contactMail .= " '".$current_date."', '".$current_date."','".$current_login."')";
									insLog($current_login, $sql_contactMail);
									//echo "sql_contactMail - ".$sql_contactMail."<br/>";
									$stmt_contactMail= $con->query($sql_contactMail);
								}
							}
						} 
						//-----------------------------------------------------------------------------end insert Email
						//-----------------------------------------------------------------------------start insert Telephone
						if (isset($txtTelephone)){
							foreach( $txtTelephone as $key => $tel ) {
								if($tel != '') {
									$sql_contactTel  = "INSERT INTO candidate_contact (candidate_ID, contact_info, contact_type, ";
									$sql_contactTel .= " create_date,update_date, update_by)";
									$sql_contactTel .= " VALUES ('".$candidate_ID."', '".$tel."', 'Telephone', ";
									$sql_contactTel .= " '".$current_date."', '".$current_date."','".$current_login."')";
									insLog($current_login, $sql_contactTel);
									//echo "sql_contactTel - ".$sql_contactTel."<br/>";
									$stmt_contactTel = $con->query($sql_contactTel);
								}
							}
						} 
						//-----------------------------------------------------------------------------end insert Telephone
						//-----------------------------------------------------------------------------start insert LineID
						if(isset($_POST['txtLineID']) && $_POST['txtLineID'] != '') {
							$sql_contactLine  = "INSERT INTO candidate_contact (candidate_ID, contact_info, contact_type, ";
							$sql_contactLine .= " create_date,update_date, update_by)";
							$sql_contactLine .= " VALUES ('".$candidate_ID."', '".$txtLineID."', 'LineID', ";
							$sql_contactLine .= " '".$current_date."', '".$current_date."','".$current_login."')";
							insLog($current_login, $sql_contactLine);
							//echo "sql_contactLine - ".$sql_contactLine."<br/>";
							$stmt_contactLine = $con->query($sql_contactLine);
						}
						//-----------------------------------------------------------------------------end insert LineID
						//-----------------------------------------------------------------------------start insert candidate
						$sql_candidate  = "INSERT INTO candidate (candidate_ID, title_en, name_en, sname_en, title_th, name_th, sname_th, nickname, ";
						$sql_candidate .= " idcard, passport, passport_country, address, subdistrict, district, province, zipcode, ";
						$sql_candidate .= " blood, gender, contract, expstatus, expstatus_info, marital, nationality, nationality_info, ethnicity, ethnicity_info, birthdate, ";
						$sql_candidate .= " create_date, update_date, update_by)";
						$sql_candidate .= " VALUES ('".$candidate_ID."', '".$ddTitleEn."', '".$txtNameEn."', '".$txtSNameEn."', '".$ddTitleTh."', '".$txtNameTh."', '".$txtSNameTh."', '".$txtNickname."', ";
						$sql_candidate .= " '".$txtIDcard."', '".$txtPassport."', '".$ddPassportCountry."', '".$txtAddress."', '".$ddSubDistrict_info."', '".$ddDistrict_info."', '".$ddProvince_info."', '".$txtZipcode."', ";
						$sql_candidate .= " '".$radBlood."', '".$radGender."', '".$radContract."', '".$radExpStatus."', '".$txtExpStatus."', '".$radMarital."', '".$radNationality."', '".$txtNationality."', '".$radEthnicity."', '".$txtEthnicity."', '".$txtBDDate."', ";
						$sql_candidate .= " '".$current_date."', '".$current_date."','".$current_login."')";
						insLog($current_login, $sql_candidate);
						$stmt_candidate = $con->query($sql_candidate);
						$r_candidate = $stmt_candidate->rowCount();
						//echo "sql_candidate - ".$sql_candidate."<br/>";
						//echo "r_candidate - ".$r_candidate."<br/>";
						//-----------------------------------------------------------------------------end insert candidate
						$sql_updDel = "Delete FROM record_update WHERE candidate_ID='".$candidate_ID."' and update_date < now() - interval 1 week";
						insLog($current_login, $sql_updDel);
						$stmt_updDel = $con->query($sql_updDel);
						$sql_updIns  = "INSERT INTO record_update(candidate_ID ,update_by, update_date) ";
						$sql_updIns .= "VALUES('".$candidate_ID."', '".$current_login."', '".$current_date."') ";
						insLog($current_login, $sql_updIns);
						$stmt_updIns = $con->query($sql_updIns);
						//-----------------------------------------------------------------------------start insert file /file size
						if ($_FILES['upload_file1']['size'] > 0) {
							foreach ($_FILES as $key => $value) {
								$filename = $value['name'];
								$tmpname = $value['tmp_name'];
								$file_size = $value['size'];
								$file_type = $value['type'];
								$ext = pathinfo($filename, PATHINFO_EXTENSION);
								if (!empty($tmpname)){
									$fp      		= fopen($tmpname, 'r');
									$content 	= fread($fp, filesize($tmpname));
									$content 	= addslashes($content);
									fclose($fp);
									if($ext=="png"||$ext=="PNG"||$ext=="JPG"||$ext=="jpg"||$ext=="jpeg"||$ext=="JPEG"
										||$ext=="pdf"||$ext=="PDF"||$ext=="doc"||$ext=="DOC"||$ext=="docx"||$ext=="DOCX"
										||$ext=="ppt"||$ext=="PPT"||$ext=="pptx"||$ext=="PPTX"
										||$ext=="XLS"||$ext=="xls"||$ext=="XLSX"||$ext=="xlsx"||$ext=="xlsm"||$ext=="XLSM"||$ext=="zip")
									{ 
										include_once 'db.php';
										$sql_candidate_file="INSERT INTO candidate_file(candidate_ID, filename, filetype, size, data,create_date,update_date, update_by)";
										$sql_candidate_file .= " VALUES ('".$candidate_ID."', '".$filename."','".$file_type."','".$file_size."','".$content."', ";
										$sql_candidate_file .= " '".$current_date."', '".$current_date."','".$current_login."')";
										
										$sql_candidate_file_log="INSERT INTO candidate_file(candidate_ID, filename, filetype, size, data,create_date,update_date, update_by)";
										$sql_candidate_file_log .= " VALUES ('".$candidate_ID."', '".$filename."','".$file_type."','".$file_size."','file data', ";
										$sql_candidate_file_log .= " '".$current_date."', '".$current_date."','".$current_login."')";
										insLog($current_login, $sql_candidate_file_log);
										
										$stmt_candidate_file = $con->query($sql_candidate_file);
									}
								} //end tmpname
							}//end foreach
						} //-----------------------------------------------------------------------------end insert file /file size
					} //end submit
				?>
				<form id="frmRecruit" name="frmRecruit" method="POST" action="form_view.php" enctype="multipart/form-data"><input type="hidden" id="login_user" name="login_user">
				<!--Start Part1-->
				<div class="part_form">
					<h4 class="mb-4">Part 1 :  Information</h4>
					<table border="0" style="width: 100%" class="tabForm"> 
						<tr>
							<td colspan="2" style="text-align:right;">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 65px">Name&nbsp;</td>
									<td><div class="divLast">&nbsp;<?php echo $ddTitleEn ?></div></td>
								</tr>
								</table>
							</td>
							<td colspan="3">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="width: 50%"><div class="divLast">&nbsp;<?php echo $txtNameEn ?></div></td>
									<td style="text-align:right;width: 10%">Surname&nbsp;</td>
									<td style="width: 40%"><div class="divLast">&nbsp;<?php echo $txtSNameEn ?></div></td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">ID Card&nbsp;</td>
									<td><div class="divLast">&nbsp;<?php echo $txtIDcard ?></div></td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Nickname&nbsp;</td>
									<td><div class="divLast">&nbsp;<?php echo $txtNickname ?></div></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 65px">ชื่อ&nbsp;</td>
									<td><div class="divLast">&nbsp;<?php echo $ddTitleTh ?></div></td>
								</tr>
								</table>
							</td>
							<td colspan="3">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="width: 50%"><div class="divLast">&nbsp;<?php echo $txtNameTh ?></div></td>
									<td style="text-align:right;width: 10%">นามสุกล&nbsp;</td>
									<td style="width: 40%"><div class="divLast">&nbsp;<?php echo $txtSNameTh ?></div></td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Passport&nbsp;</td>
									<td><div class="divLast">&nbsp;<?php echo $txtPassport ?></div></td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 35%">Country&nbsp;</td>
									<td><div class="divLast">&nbsp;<?php echo $ddPassportCountry ?></div></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">Address&nbsp;</td>
							<td colspan="5"><div class="divLast">&nbsp;<?php echo $txtAddress ?></div></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">Province&nbsp;</td>
							<td colspan="3">
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="width: 30%"><div class="divLast">&nbsp;<?php echo $ddProvince_info ?></div></td>
									<td style="text-align:right">District&nbsp;</td>
									<td style="width: 30%"><div class="divLast">&nbsp;<?php echo $ddDistrict_info ?></div></td>
									<td style="text-align:right">SubDistrict&nbsp;</td>
									<td style="width: 30%"><div class="divLast">&nbsp;<?php echo $ddSubDistrict_info ?></div></td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
								<tr>
									<td style="text-align:right;width: 30%">ZipCode&nbsp;</td>
									<td><div class="divLast">&nbsp;<?php echo $txtZipcode ?></div></td>
								</tr>
								</table>
							</td>
							<td>
								<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td style="text-align:right;width: 25%">LineID&nbsp;</td>
										<td><div class="divLast">&nbsp;<?php echo $txtLineID ?></div></td>
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
											<?php if ($radBlood === 'O') { ?><img src="images/radioBtnC.png"> O
											<?php } else { ?><img src="images/radioBtnW.png"> O<?php } ?>
										</td>
										<td>
											<?php if ($radBlood === 'A') { ?><img src="images/radioBtnC.png"> A
											<?php } else { ?><img src="images/radioBtnW.png"> A<?php } ?>
										</td>
									</tr>
									<tr>
										<td>
											<?php if ($radBlood === 'AB') { ?><img src="images/radioBtnC.png"> AB
											<?php } else { ?><img src="images/radioBtnW.png"> AB<?php } ?>
										</td>
										<td>
											<?php if ($radBlood === 'B') { ?><img src="images/radioBtnC.png"> B
											<?php } else { ?><img src="images/radioBtnW.png"> B<?php } ?>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									</table>
								</fieldset>
							</td>
							<td>
									<table border="0" style="width: 100%" class="tabForm_inside">
									<tr>
										<td style="width: 45%">
											<fieldset>
												<legend>Gender</legend>
												<table border="0" style="width: 100%" class="tabForm_inside">
												<tr>
													<td>
														<?php if ($radGender === 'Male') { ?><img src="images/radioBtnC.png"> Male
														<?php } else { ?><img src="images/radioBtnW.png"> Male<?php } ?>
													</td>
												</tr>
												<tr>
													<td>
														<?php if ($radGender === 'Female') { ?><img src="images/radioBtnC.png"> Female
														<?php } else { ?><img src="images/radioBtnW.png"> Female<?php } ?>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
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
														<?php if ($radContract === 'Y') { ?><img src="images/radioBtnC.png"> Yes
														<?php } else { ?><img src="images/radioBtnW.png"> Yes<?php } ?>
													</td>
												</tr>
												<tr>
													<td style="width: 35%">
														<?php if ($radContract === 'N') { ?><img src="images/radioBtnC.png"> No
														<?php } else { ?><img src="images/radioBtnW.png"> No<?php } ?>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
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
											<?php if ($radExpStatus === 'Normal') { ?><img src="images/radioBtnC.png"> Normal
											<?php } else { ?><img src="images/radioBtnW.png"> Normal<?php } ?>
										</td>
									</tr>
									<tr>
										<td>
											<?php if ($radExpStatus === 'Blacklist') { ?><img src="images/radioBtnC.png"> Blacklist
											<?php } else { ?><img src="images/radioBtnW.png"> Blacklist<?php } ?>
										</td>
									</tr>
									<tr>
										<td><div class="divLast"><?php echo $txtExpStatus ?>&nbsp;</div></td>
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
											<?php if ($radMarital === 'Single') { ?><img src="images/radioBtnC.png"> Single
											<?php } else { ?><img src="images/radioBtnW.png"> Single<?php } ?>
										</td>
									</tr>
									<tr>
										<td>
											<?php if ($radMarital === 'Married') { ?><img src="images/radioBtnC.png"> Married
											<?php } else { ?><img src="images/radioBtnW.png"> Married<?php } ?>
										</td>
									</tr>
									<tr>
										<td style="width: 50%">
											<?php if ($radMarital === 'Widowed') { ?><img src="images/radioBtnC.png"> Widowed
											<?php } else { ?><img src="images/radioBtnW.png"> Widowed<?php } ?>
										</td>
										<td></td>
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
											<?php if ($radNationality === 'Thai') { ?><img src="images/radioBtnC.png"> Thai
											<?php } else { ?><img src="images/radioBtnW.png"> Thai<?php } ?>
										</td>
									</tr>
									<tr>
										<td style="width: 42%">
											<?php if ($radNationality === 'Other') { ?><img src="images/radioBtnC.png"> Other
											<?php } else { ?><img src="images/radioBtnW.png"> Other<?php } ?>
										</td>
									</tr>
									<tr>
										<td><div class="divLast"><?php echo $txtNationality ?>&nbsp;</div></td>
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
											<?php if ($radEthnicity === 'Thai') { ?><img src="images/radioBtnC.png"> Thai
											<?php } else { ?><img src="images/radioBtnW.png"> Thai<?php } ?>
										</td>
									</tr>
									<tr>
										<td>
											<?php if ($radEthnicity === 'Other') { ?><img src="images/radioBtnC.png"> Other
											<?php } else { ?><img src="images/radioBtnW.png"> Other<?php } ?>
										</td>
									</tr>
									<tr>
										<td><div class="divLast"><?php echo $txtEthnicity ?>&nbsp;</div></td>
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
									<td style="width: 15%;height:40px"><div class="divLast">&nbsp;<?php echo $txtBDDate ?></div></td>
									<td style="text-align:right;width: 10%;">Age&nbsp;</td>
									<td style="text-align:center;width: 15%;"><div class="divLast">&nbsp;<?php echo $txtAgeYear ?></div></td>
									<td>Year</td>
									<td style="text-align:center;width: 15%;"><div class="divLast">&nbsp;<?php echo $txtAgeMonth ?></div></td>
									<td>Month</td>
									<td style="text-align:center;width: 15%;"><div class="divLast">&nbsp;<?php echo $txtAgeDay ?></div></td>
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
											<?php 
												if (isset($txtEmail)){
													foreach( $txtEmail as $key => $mail ) {
														if($mail != '') {
															echo "<div class='divLast'>&nbsp;". $mail."</div>";
														}
													}
												} //end if txtEmail
											?>
										</td>
									</tr>
									</table>
								</td>
								<td>
									<table border="0" style="width: 100%" class="tabForm_inside tblTelephone">
									<tr>
										<td style="text-align:right;width: 22%;height:40px">Telephone&nbsp;</td>
										<td>
											<?php 
												if (isset($txtTelephone)){
													foreach( $txtTelephone as $key => $tel ) {
														if($tel != '') {
															echo "<div class='divLast'>&nbsp;". $tel."</div>";
														}
													}
												} //end if txtTelephone
											?>
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
							<?php echo $pos_ind[0][0]; ?>&nbsp;&nbsp;SAP
						</td>
						<td style="text-align:right;">Module :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							 <?php echo $pos_ind[0][1]; ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $pos_ind[1][0]; ?>&nbsp;&nbsp;Programmer
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							 <?php echo $pos_ind[1][1]; ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $pos_ind[2][0]; ?>&nbsp;&nbsp;SA
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<?php echo $radSACode_ind; ?>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<div class="divLast">&nbsp;<?php echo $txtSALange ?></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $pos_ind[3][0]; ?>&nbsp;&nbsp;BA
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<?php echo $radBACode_ind; ?>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<div class="divLast">&nbsp;<?php echo $txtBALange ?></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $pos_ind[5][0]; ?>&nbsp;&nbsp;Tester
						</td>
						<td style="text-align:right;">Testing :&nbsp;</td>
						<td colspan="3" style="text-align:left;">
							<?php echo $pos_ind[5][1]; ?>&nbsp;&nbsp;<?php echo $pos_ind[5][2]; ?>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $pos_ind[4][0]; ?>&nbsp;&nbsp;Project Manager
						</td>
						<td style="text-align:right;">Code :&nbsp;</td>
						<td style="text-align:left;">
							<div class="col-sm-5">
								<?php echo $radProjectManager_ind; ?>
							</div>
						</td>
						<td style="text-align:right;">Language :&nbsp;</td>
						<td>
							<div class="divLast">&nbsp;<?php echo $txtProjectManagerLang ?></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $pos_ind[6][0]; ?>&nbsp;&nbsp;Project Admin
						</td>
						<td style="text-align:right;">Skill :&nbsp;</td>
						<td colspan="3">
							<div class="divLast">&nbsp;<?php echo $txtProjectAdminSkill ?></div>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $pos_ind[7][0]; ?>&nbsp;&nbsp;Other
						</td>
						<td>
							<div class="divLast">&nbsp;<?php echo $txtPositionOther ?></div>
						</td>
						<td style="text-align:right;">Skill :&nbsp;</td>
						<td colspan="3">
							<div class="divLast">&nbsp;<?php echo $txtPositionOtherSkill ?></div>
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
					<div class="div_inline"><h4 class="mb-4 div_inline">Part 3-1 : Call Record</h4>&nbsp;&nbsp;</div>
					<table border="0" style="width: 100%;border-color:#DDDDDD" id="tab31" class="tbl31">
					<tbody>
					<?php 
						include 'db_utf8.php';
						if (isset($callRow)){
							//echo "call_record_count - ".sizeof($call_record)."<br/>";
							foreach( $callRow as $key => $call_record ) {
								if($call_record != '') {
									$txtCallDate				= $_POST['txtCallDate'.$call_record];
									//if (isset($txtCallDate)){
									//	$txtCallDate		= substr($txtCallDate,6,4)."-".substr($txtCallDate,3,2)."-".substr($txtCallDate,0,2);
									//}
									$txtCallBy					= $_POST['txtCallBy'.$call_record];
									$ddCurrentPosition		= $_POST['ddCurrentPosition'.$call_record];
									$ddInterestedPosition	= $_POST['ddInterestedPosition'.$call_record];
									$txtYearExp				= $_POST['txtYearExp'.$call_record];
									$txtMonthExp				= $_POST['txtMonthExp'.$call_record];
									$txtDayExp				= $_POST['txtDayExp'.$call_record];
									$ddTypeEmp				= $_POST['ddTypeEmp'.$call_record];
									$txtPresentSalary		= $_POST['txtPresentSalary'.$call_record];
									$txtBonus					= $_POST['txtBonus'.$call_record];
									$txtOtherIncome_notebook = $_POST['txtOtherIncome_notebook'.$call_record];
									$txtOtherIncome_StandBy = $_POST['txtOtherIncome_StandBy'.$call_record];
									$txtOtherIncome_transportation = $_POST['txtOtherIncome_transportation'.$call_record];
									$txtOtherIncome_ShiftWork = $_POST['txtOtherIncome_ShiftWork'.$call_record];
									$txtOtherIncome_OT = $_POST['txtOtherIncome_OT'.$call_record];
									$txtOtherIncome_Others = $_POST['txtOtherIncome_Others'.$call_record];
									$txtOtherIncome_Others_baht = $_POST['txtOtherIncome_Others'.$call_record.'_baht'];
									$txtBBSOfferCalculation = $_POST['txtBBSOfferCalculation'.$call_record];
									$txtStartDateNewJob = $_POST['txtStartDateNewJob'.$call_record];
									//if (isset($txtStartDateNewJob)){
									//	$txtStartDateNewJob		= substr($txtStartDateNewJob,6,4)."-".substr($txtStartDateNewJob,3,2)."-".substr($txtStartDateNewJob,0,2);
									//}
									$txtExpectationSalary = $_POST['txtExpectationSalary'.$call_record];
									$txtBBSOffer = $_POST['txtBBSOffer'.$call_record];
									$txtNote = $_POST['txtNote'.$call_record];
									
									//$txtCallRec_matchingNo = $_POST['txtCallRec_matchingNo'.$call_record];
									$txtCallRec_matchingNo = $candidate_ID.'-'.str_replace('-', '', $txtCallDate).'-'.$call_record;
									
									//-----------------------------------------------------------------------------start insert callrecord
									$sql_callrecord  = "INSERT INTO candidate_callrecord (candidate_ID, call_date, call_by, current_position, interested_position, exp_year, exp_month, exp_day, ";
									$sql_callrecord .= " present_empType, present_salary, bonus_month, otherIncome_notebook, otherIncome_standby, otherIncome_transportation, otherIncome_shiftwork , otherIncome_ot , ";
									$sql_callrecord .= " otherIncome_others, otherIncome_others_baht, BBSOffer_calculation, startdate_newjob, expectation_salary, BBSOffer_salary, call_note, call_reqNo, ";
									$sql_callrecord .= " create_date,update_date, update_by)";
									$sql_callrecord .= " VALUES ('".$candidate_ID."', '".$txtCallDate."', '".$txtCallBy."', '".$ddCurrentPosition."', '".$ddInterestedPosition."', '".$txtYearExp."', '".$txtMonthExp."', '".$txtDayExp."', ";
									$sql_callrecord .= " '".$ddTypeEmp."', '".$txtPresentSalary."', '".$txtBonus."', '".$txtOtherIncome_notebook."', '".$txtOtherIncome_StandBy."', '".$txtOtherIncome_transportation."', '".$txtOtherIncome_ShiftWork."', '".$txtOtherIncome_OT."', ";
									$sql_callrecord .= " '".$txtOtherIncome_Others."', '".$txtOtherIncome_Others_baht."', '".$txtBBSOfferCalculation."', '".$txtStartDateNewJob."', '".$txtExpectationSalary."', '".$txtBBSOffer."', '".$txtNote."', '".$txtCallRec_matchingNo."', ";
									$sql_callrecord .= " '".$current_date."', '".$current_date."','".$current_login."')";
									insLog($current_login, $sql_callrecord);
									$stmt_callrecord = $con->query($sql_callrecord);
									//-----------------------------------------------------------------------------end insert callrecord
					?>
					<tr>
						<td>
							<table border="0" style="width: 100%" class="tabForm_part">
							<tr>
								<td style="text-align:right;">Call Date : </td>
								<td colspan="3">
									<div class="divLast">&nbsp;<?php echo $txtCallDate ?></div>
								</td>
								<td style="text-align:right;">Call By : </td>
								<td colspan="3">
									<div class="divLast">&nbsp;<?php echo $txtCallBy ?></div>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Current Position : </td>
								<td colspan="3">
									<div class="divLast">&nbsp;<?php echo $ddCurrentPosition ?></div>
								</td>
								<td style="text-align:right;">Interested Position : </td>
								<td colspan="3">
									<div class="divLast">&nbsp;<?php echo $ddInterestedPosition ?></div>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Years of Experience : </td>
								<td colspan="2">
									<table border="0" style="width: 100%" class="tabForm_part">
									<tr>
										<td style="text-align:right;width: 25%"><div class="divLast">&nbsp;<?php echo $txtYearExp ?></div></td><td>&nbsp;Year&nbsp;</td>
										<td style="text-align:right;width: 25%"><div class="divLast">&nbsp;<?php echo $txtMonthExp ?></div></td><td>&nbsp;Month&nbsp;</td>
										<td style="text-align:right;width: 25%"><div class="divLast">&nbsp;<?php echo $txtDayExp ?></div></td><td>&nbsp;Day&nbsp;</td>
									</tr>
									</table>
								</td>
								<td></td>
								<td style="text-align:right;">Present Type of Employment : </td>
								<td colspan="3">
									<div class="divLast">&nbsp;<?php echo $ddTypeEmp ?></div>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Present Salary : </td>
								<td colspan="2" style="text-align:right;">
									<div class="divLast">&nbsp;<?php echo $txtPresentSalary ?></div>
								</td>
								<td>฿</td>
								<td style="text-align:right;">Bonus (Months) : </td>
								<td colspan="2" style="text-align:right;">
									<div class="divLast">&nbsp;<?php echo $txtBonus ?></div>
								</td>
								<td>month</td>
							</tr>
							<tr>
								<td style="text-align:right;background-color:#EAEAEA">Other Income : </td>
								<td style="text-align:right;background-color:#EAEAEA">Notebook : </td>
								<td style="text-align:right;background-color:#EAEAEA"><div class="divLast">&nbsp;<?php echo $txtOtherIncome_notebook ?></div></td>
								<td style="background-color:#EAEAEA">฿</td>
								<td style="text-align:right;background-color:#EAEAEA">Stand By : </td>
								<td style="text-align:right;background-color:#EAEAEA" colspan="2"><div class="divLast">&nbsp;<?php echo $txtOtherIncome_StandBy ?></div></td>
								<td style="background-color:#EAEAEA">฿</td>
							</tr>
							<tr>
								<td style="text-align:right;background-color:#EAEAEA"></td>
								<td style="text-align:right;background-color:#EAEAEA">Transportation : </td>
								<td style="text-align:right;background-color:#EAEAEA"><div class="divLast">&nbsp;<?php echo $txtOtherIncome_transportation ?></div></td>
								<td style="background-color:#EAEAEA">฿</td>
								<td style="text-align:right;background-color:#EAEAEA">Shift Work : </td>
								<td style="text-align:right;background-color:#EAEAEA" colspan="2"><div class="divLast">&nbsp;<?php echo $txtOtherIncome_ShiftWork ?></div></td>
								<td style="background-color:#EAEAEA">฿</td>
							</tr>
							<tr>
								<td style="text-align:right;background-color:#EAEAEA"></td>
								<td style="text-align:right;background-color:#EAEAEA">OT : </td>
								<td style="text-align:right;background-color:#EAEAEA"><div class="divLast">&nbsp;<?php echo $txtOtherIncome_OT ?></div></td>
								<td style="background-color:#EAEAEA">฿</td>
								<td style="text-align:right;background-color:#EAEAEA">Others : </td>
								<td style="background-color:#EAEAEA"><div class="divLast">&nbsp;<?php echo $txtOtherIncome_Others ?></div></td>
								<td style="text-align:right;background-color:#EAEAEA"><div class="divLast">&nbsp;<?php echo $txtOtherIncome_Others_baht ?></div></td>
								<td style="background-color:#EAEAEA">฿</td>
							</tr>
							<tr>
								<td style="text-align:right;">BBS Offer by Calculation : </td>
								<td style="text-align:right;" colspan="2"><div class="divLast">&nbsp;<?php echo $txtBBSOfferCalculation ?></div></td>
								<td>฿</td>
								<td style="text-align:right;">Starting date for new job : </td>
								<td colspan="2"><div class="divLast">&nbsp;<?php echo $txtStartDateNewJob ?></div></td>
								<td></td>
							</tr>
							<tr>
								<td style="text-align:right;">Salary Offer by BBS : </td>
								<td style="text-align:right;" colspan="2"><div class="divLast">&nbsp;<?php echo $txtBBSOffer ?></div></td>
								<td>฿</td>
								<td style="text-align:right;">Expectation Salary : </td>
								<td style="text-align:right;" colspan="2"><div class="divLast">&nbsp;<?php echo $txtExpectationSalary ?></div></td>
								<td>฿</td>
							</tr>
							<tr>
								<td style="text-align:right;">Note : </td>
								<td colspan="7">
									<textarea id="txtNote" name="txtNote" rows="2" style="width: 100%;border: 2px dashed #EAEAEA" maxlength="300" readonly><?php echo $txtNote ?></textarea>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Matching Requirement Number : </td>
								<td colspan="7">
									<div class="divLast">&nbsp;<?php echo $txtCallRec_matchingNo ?></div>
								</td>
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
								} //end if call_record
							} //end for call_record
						} //end isset callRow
					?>
					</tbody>
					</table>
				</div>
				<!--End Part3-1-->
				<br/>
				<!--Start Part3-2-->
				<div class="part_form">
					<div class="div_inline"><h4 class="mb-4 div_inline">Part 3-2 : Interview Record</h4>&nbsp;&nbsp;</div>
					<table border="0" style="width: 100%;border-color:#DDDDDD" id="tab32" class="tbl32">
					<?php 
						if (isset($invRow)){
							//echo "call_record_count - ".sizeof($call_record)."<br/>";
							foreach( $invRow as $key => $inv_record ) {
								if($inv_record != '') {
									$txtInterviewDate			= $_POST['txtInterviewDate'.$inv_record];
									//if (isset($txtInterviewDate)){
									//	$txtInterviewDate		= substr($txtInterviewDate,6,4)."-".substr($txtInterviewDate,3,2)."-".substr($txtInterviewDate,0,2);
									//}
									$txtTime						= $_POST['txtTime'.$inv_record];
									$txtInterviewDate_ins		= $txtInterviewDate." ".$txtTime;
									
									$txtClientCompany			= $_POST['txtClientCompany'.$inv_record];
									//$txtClientID					= $_POST['txtClientID'.$inv_record];
									isset( $_POST['txtClientID'.$inv_record] ) 							? $txtClientID =$_POST['txtClientID'.$inv_record]									: $txtClientID = 0;
									if ($txtClientID =='')
										$txtClientID = 0;
									$txtClientDepartment		= $_POST['txtClientDepartment'.$inv_record];
									$txtClientContact				= $_POST['txtClientContact'.$inv_record];
									
									$ddPass						= $_POST['ddPass'.$inv_record];
									$txtStartDate					= $_POST['txtStartDate'.$inv_record];
									//if (isset($txtStartDate)){
									//	$txtStartDate				= substr($txtStartDate,6,4)."-".substr($txtStartDate,3,2)."-".substr($txtStartDate,0,2);
									//}
									$ddSignContract				= $_POST['ddSignContract'.$inv_record];
									$txtContractPeriod			= $_POST['txtContractPeriod'.$inv_record];
									$txtNote32					= $_POST['txtNote32'.$inv_record];
									//$txtIntvRec_matchingNo		= $_POST['txtIntvRec_matchingNo'.$inv_record];
									$txtIntvRec_matchingNo = $candidate_ID.'-'.str_replace('-', '', $txtInterviewDate).'-'.$inv_record;
									//-----------------------------------------------------------------------------start insert invrecord
									$sql_invrecord  = "INSERT INTO candidate_interviewrecord (candidate_ID, interview_date, client_ID , pass , sign_contract , contract_period, startdate , interview_note , interview_reqNo , ";
									$sql_invrecord .= " create_date,update_date, update_by)";
									$sql_invrecord .= " VALUES ('".$candidate_ID."', '".$txtInterviewDate_ins."', '".$txtClientID."', '".$ddPass."', '".$ddSignContract."', '".$txtContractPeriod."', '".$txtStartDate."', '".$txtNote32."', '".$txtIntvRec_matchingNo."',";
									$sql_invrecord .= " '".$current_date."', '".$current_date."','".$current_login."')";
									insLog($current_login, $sql_invrecord);
									$stmt_invrecord = $con->query($sql_invrecord);
									//-----------------------------------------------------------------------------end insert invrecord
					?>
					<tr>
						<td>
							<table border="0" style="width: 100%" class="tabForm_part">
							<tr>
								<td style="text-align:right;">Interview Date : </td>
								<td>
									<div class="divLast">&nbsp;<?php echo $txtInterviewDate ?></div>
								</td>
								<td style="text-align:right;">Time : </td>
								<td>
									<div class="divLast">&nbsp;<?php echo $txtTime ?></div>
								</td>
								<td style="text-align:right;">Client Customer Company : </td>
								<td colspan="2">
									<div class="divLast">&nbsp;<?php echo $txtClientCompany ?></div>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Pass : </td>
								<td>
									<div class="divLast">&nbsp;<?php echo $ddPass ?></div>
								</td>
								<td style="text-align:right;">Start Date : </td>
								<td>
									<div class="divLast">&nbsp;<?php echo $txtStartDate ?></div>
								</td>
								<td style="text-align:right;">Client Customer Department : </td>
								<td colspan="2">
									<div class="divLast">&nbsp;<?php echo $txtClientDepartment ?></div>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Sign Contract : </td>
								<td>
									<div class="divLast">&nbsp;<?php echo $ddSignContract ?></div>
								</td>
								<td style="text-align:right;">Contract Period : </td>
								<td>
									<div class="divLast">&nbsp;<?php echo $txtContractPeriod ?></div>
								</td>
								<td style="text-align:right;">Client Customer Contact Name : </td>
								<td colspan="2">
									<div class="divLast">&nbsp;<?php echo $txtClientContact ?></div>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Note : </td>
								<td colspan="6">
									<textarea id="txtNote" name="txtNote" rows="2" style="width: 100%;border: 2px dashed #EAEAEA" maxlength="300" readonly><?php echo $txtNote32 ?></textarea>
								</td>
							</tr>
							<tr>
								<td style="text-align:right;">Matching Requirement Number : </td>
								<td colspan="6">
									<div class="divLast">&nbsp;<?php echo $txtIntvRec_matchingNo ?></div>
								</td>
							</tr>
							<tr>
								<td style="width: 17%"></td>
								<td style="width: 8%"></td>
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
								} //end if inv_record
							} //end for inv_record
						} //end isset invRow
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
							include_once 'db.php';
							$sql_candidate_file_sel="SELECT * FROM candidate_file where candidate_ID = '".$candidate_ID."' ";
							$stmt_candidate_file_sel = $con->query($sql_candidate_file_sel);
							while ($result_candidate_file_sel = $stmt_candidate_file_sel->fetch()) 
									echo "<div class='displayFile'>- <a href='download.php?id=".urlencode($result_candidate_file_sel['file_ID'])."'>".$result_candidate_file_sel['filename']."</a></div>";
						?>
					</div>
				</div>
				<!--End Upload-->		
				<div class="row">
					<div class="col-sm-12" id="wrappered">
						<input type="button" class="send_btn" id="btn_submit" name="btn_submit" value="BACK">
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
		//document.getElementById("btn_submit").onclick = function() {fn_submit()};
		//document.getElementById("btn_reset").onclick = function() {fn_reset()};
		//function fn_submit() {
			//document.getElementById("frmRecruit").submit();
			//window.location.replace("form.php");
		//}
		function fn_reset() {
			document.getElementById("frmRecruit").submit();
		}
		$("#btn_submit").click(function(){
			location.replace('form.php?l=<?php echo $l?>');
		});
		<?php 
			if ($r_candidate==1){
		?>
			var dataURL = 'alert.php?id=4&l=<?php echo $l?>';
			$('#modalContentAlert').load(dataURL,function(){$('#modalAlert').modal('show')});
		<?php }?>
	</script>
     <script src="js/popper.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/main.js"></script>
</body>
</html>
<?php
//if ($con)
//	mysqli_close($con);
?>