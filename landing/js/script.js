$(function(){
    var provinceObject 	= $('#ddProvince');
    var amphureObject 	= $('#ddDistrict');
    var tambonObject 		= $('#ddSubDistrict');
			
    // on change province
    provinceObject.on('change', function(){
        var provinceId = $(this).val();
		
        amphureObject.html('<option value="">-เลือกอำเภอ-</option>');
        tambonObject.html('<option value="">-เลือกตำบล-</option>');
		
		document.getElementById('ddProvince_info').value = '';
		document.getElementById('ddDistrict_info').value = '';
		document.getElementById('ddSubDistrict_info').value = '';
		document.getElementById('txtZipcode').value = '';
		
        $.get('get_amphure.php?province_id=' + provinceId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                amphureObject.append(
                    $('<option></option>').val(item.districtID).html(item.districtThai)
                );
            });
        });
    });
 
    // on change amphure
    amphureObject.on('change', function(){
        var amphureId = $(this).val();
 
        tambonObject.html('<option value="">-เลือกตำบล-</option>');
        document.getElementById('ddDistrict_info').value = '';
		document.getElementById('ddSubDistrict_info').value = '';
		document.getElementById('txtZipcode').value = '';
		
        $.get('get_tambon.php?amphure_id=' + amphureId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                tambonObject.append(
                    $('<option></option>').val(item.provinceThai+ '|' +item.districtThai+ '|' +item.tambonID+ '|' +item.tambonThai+ '|' +item.postCodeMain ).html(item.tambonThai)
                );
            });
        });
    });
	
	// on change tambonObject
    tambonObject.on('change', function(){
        var tambonID = $(this).val();
		if (tambonID == ''){
			document.getElementById('ddProvince_info').value = '';
			document.getElementById('ddDistrict_info').value = '';
			document.getElementById('ddSubDistrict_info').value = '';
			document.getElementById('txtZipcode').value = '';
		}
		else{
			const arrtambonID = tambonID.split('|');
			document.getElementById('ddProvince_info').value = arrtambonID[0];
			document.getElementById('ddDistrict_info').value = arrtambonID[1];
			document.getElementById('ddSubDistrict_info').value = arrtambonID[3];
			document.getElementById('txtZipcode').value = arrtambonID[4];
		}
    });
});

function deletefileLink(eleId) {
//if (confirm("Are you really want to delete ?")) {
	var ele = document.getElementById("delete_file" + eleId);
	ele.parentNode.removeChild(ele);
//}
}

Filevalidation = (eleId) => {
	//const fi = document.getElementById('file');
	const fi =  document.getElementById("upload_file" + eleId);
	var dataURL = '';//'addedt_user.php?id=';
	// Check if any file is selected.
	if (fi.files.length > 0) {
		//alert(fi.files.length);
		
		const arrExt = ['png', 'jpg', 'jpeg', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'xlsm', 'zip'];
		const i = 0;
		const flen =fi.files.length - 1;
		
		//for (i; i <= flen; i++) {
			const fsize = fi.files.item(i).size;
			const fname = fi.files.item(i).name;
			const file = Math.round((fsize / 1024));
			// The size of the file.
			//alert(file);
			if (file >= 2048) {
				//alert("File too Big, please select a file less than 2mb.");
				dataURL = 'alert.php?id=1&l='+$('#l').val();
				$('#modalContentAlert').load(dataURL,function(){$('#modalAlert').modal('show')});
				fi.value = "";
				return;
			} 
			//alert(fname);
			const extension = String(fname.split('.').pop());
			
			//else if (file < 1024) {
				//alert("File too small, please select a file greater than 1mb.");
			//} else {
			//	document.getElementById('size').innerHTML = '<b>' + file + '</b> KB';
			//}
			//alert(extension);
			const ext = extension.toLowerCase();
			//alert(ext);
			if (!arrExt.includes(ext)) {
				//alert("File type not support!, please select a new file.");
				dataURL = 'alert.php?id=2&l='+$('#l').val();
				$('#modalContentAlert').load(dataURL,function(){$('#modalAlert').modal('show')});
				fi.value = "";
				return;
			}
		//}
	}
}

function ageCalculator() {
	//collect input from HTML form and convert into date format
	var userinput = document.getElementById("txtBDDate").value;
	//userinput = userinput.substring(3,5)+'/'+userinput.substring(0,2)+'/'+userinput.substring(6,10); //mm/dd/yyyy
	userinput = userinput.substring(5,7)+'/'+userinput.substring(8,10)+'/'+userinput.substring(0,4); //mm/dd/yyyy
	var dob = new Date(userinput);
	//check user provide input or not
	if(userinput==null || userinput==''){
		document.getElementById("message").innerHTML = "**Choose a date please!";  
		return false; 
	} 
	//execute if the user entered a date 
	else {
		//extract the year, month, and date from user date input
		var dobYear = dob.getYear();
		var dobMonth = dob.getMonth();
		var dobDate = dob.getDate();
		
		//get the current date from the system
		var now = new Date();
		//extract the year, month, and date from current date
		var currentYear = now.getYear();
		var currentMonth = now.getMonth();
		var currentDate = now.getDate();
		
		//declare a variable to collect the age in year, month, and days
		var age = {};
		var ageString = "";
	  
		//get years
		yearAge = currentYear - dobYear;
		
		//get months
		if (currentMonth >= dobMonth)
		  //get months when current month is greater
		  var monthAge = currentMonth - dobMonth;
		else {
			yearAge--;
			var monthAge = 12 + currentMonth - dobMonth;
		}

		//get days
		if (currentDate >= dobDate)
			//get days when the current date is greater
			var dateAge = currentDate - dobDate;
		else {
			monthAge--;
			var dateAge = 31 + currentDate - dobDate;

			if (monthAge < 0) {
				monthAge = 11;
				yearAge--;
			}
		}
		//group the age in a single variable
		age = {
			years: yearAge,
			months: monthAge,
			days: dateAge
		};
		  
		if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
			ageString = age.years + " years, " + age.months + " months, and " + age.days + " days old.";
		else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
			ageString = "Only " + age.days + " days old!";
			//when current month and date is same as birth date and month
		else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
			ageString = age.years +  " years old. Happy Birthday!!";
		else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
			ageString = age.years + " years and " + age.months + " months old.";
		else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
			ageString = age.months + " months and " + age.days + " days old.";
		else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
			ageString = age.years + " years, and" + age.days + " days old.";
		else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
			ageString = age.months + " months old.";
			//when current date is same as dob(date of birth)
		else ageString = "Welcome to Earth! <br> It's first day on Earth!"; 

		//display the calculated age
		document.getElementById('txtAgeYear').innerHTML = age.years;
		document.getElementById('txtAgeMonth').innerHTML = age.months;
		document.getElementById('txtAgeDay').innerHTML = age.days;
		
		document.getElementById('txtAgeYear_val').value = age.years;
		document.getElementById('txtAgeMonth_val').value = age.months;
		document.getElementById('txtAgeDay_val').value = age.days;
		
		//return document.getElementById("result").innerHTML = ageString; 
	}
}

function showpass() {
  var x = document.getElementById("txtPass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}