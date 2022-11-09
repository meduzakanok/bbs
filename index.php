<!doctype html>
<html lang="en">
  <head>
  	<title>BBS Recruit Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="images/BBS_logo.ico">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="landing/css/bootstrap.min.css" />
    <link rel="stylesheet" href="landing/css/css.css">
	<link rel="stylesheet" href="landing/css/style.css">
	<!--<link rel="stylesheet" href="../css/style.css">-->
  </head>
  <body class="main-layout"
		
	  <div class="wrapper d-flex align-items-stretch">

        <!-- Page Content  -->
     <div id="content" class="p-4 p-md-5">
		<div class="titlepage"><h2><img src="images/BBS_logo.jpg" width="137" height="80"></h2><h3>Recruit Management</h3></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 ">
					<form class="main_form" id="frmRecruitLogin" method="post" autocomplete="off">
						<div class="row">
							<div class="col-md-12">
								<table border="0" style="width: 100%" class="tabForm"> 
								<tr>
									<td><div class="col-sm-5"><input class="form-control" type="text" placeholder="User" name="txtUser" id="txtUser"></div></td>
								</tr>
								<tr>
									<td>
										<div class="col-sm-5">
											<input class="form-control" type="password" placeholder="Password" name="txtPass" id="txtPass">
											<label class="lblcontainer">&nbsp;&nbsp;&nbsp;<input type="checkbox" onclick="showpass()"> Show Password</label>
										</div>
									</td>
								</tr>
								</table>
							</div>
							<div class="col-sm-12" id="wrappered">
								<input type="submit" class="send_btn" id="btn_submit" value="SUBMIT">&nbsp;
								<input type="reset" class="send_btn" id="btn_reset" value="CANCEL">
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-12" id="wrappered">
					<div id="show_message" class="alert alert-success" style="display: none">Success</div>
					<div id="error" class="alert alert-danger" style="display: none"></div>
				</div>
            </div>
         </div>
    </div>
     <!--<script src="landing/js/jquery.min.js"></script>-->
	 <script src="landing/js/jquery-3.6.0.min.js"></script>
     <script src="landing/js/popper.js"></script>
     <script src="landing/js/bootstrap.min.js"></script>
	<script src="landing/js/main.js"></script>
	<script src="landing/js/jquery.validate.js"></script>
	<script src="landing/js/script.js"></script>
	<script type="text/javascript">
		//document.getElementById("btn_submit").onclick = function() {fn_submit()};
		document.getElementById("btn_reset").onclick = function() {fn_reset()};
		function fn_submit() {
			//window.location.replace("landing");
		}
		function fn_reset() {
			//document.getElementById("txt_user").value='';
			//document.getElementById("frmRecruitLogin").submit();
			window.location.replace("");
		}

		$.validator.setDefaults( {
			submitHandler: function () {
				//alert( "submitted!" );
				//window.location.replace("landing");
			}
		} );

		$( document ).ready( function () {
			$( "#frmRecruitLogin" ).validate( {
				rules: {
					txtUser: "required",
					txtPass: "required"
				},
				messages: {
					txtUser: "Please enter User",
					txtPass: "Please enter Password"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			}); //end frm validate
			
			// hide messages 
            $("#error").hide();
            $("#show_message").hide();
		 
            // on submit...
            $('#frmRecruitLogin').submit(function(e){
				e.preventDefault();
				$("#error").hide();
				
				var txtUser = $("input#txtUser").val();
                if(txtUser == ""){
                    $("#error").fadeIn().text("Please enter user/password.");
                    $("input#txtUser").focus();
                    return false;
                }
                var txtPass = $("input#txtPass").val();
                if(txtPass == ""){
                    $("#error").fadeIn().text("Please enter user/password.");
                    $("input#txtPass").focus();
                    return false;
                }
                
				
                $.ajax({
					type:"POST",
                    url: "login.php",
                    data: $(this).serialize(), // get all form field value in serialize form
                    success: function(dat){
						alert('Data from the server' + dat);
						//$("#show_message").fadeIn();
						//$("#ajax-form").fadeOut();
						var jsonData = JSON.parse(dat);
						if (jsonData.success != '')
							location.href = 'landing/?l='+jsonData.success;
						else
						{
							$("#error").fadeIn().text("Cannot Login! Please try again.");
							//$("#error").fadeIn().text("Something went wrong! "+jsonData.success);
							return false;
						}
                    },
					error: function() {
						$("#error").fadeIn().text("Something went wrong!");
						return false;
					}
                });
            });  //end form submit
		}); //end doc ready
	</script>
  </body>
</html>
