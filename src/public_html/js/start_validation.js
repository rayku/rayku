var frmVal = jQuery.noConflict();

frmVal(document).ready(function() {
	// binds form submission and fields to the validation engine
	frmVal("#register-form").validationEngine();
});

function checkName(field, rules, i, options) {
	if(field.val() == "Full Name") {
		// this allows to use i18 for the error msgs
		return "* Please enter Full Name";
	}
}

function checkPassword(field, rules, i, options) {
	if(field.val() == "Password") {
		// this allows to use i18 for the error msgs
		return "* Please enter Password";
	}
}

function checkRPassword(field, rules, i, options) {
	if(field.val() == "Confirm Password") {
		// this allows to use i18 for the error msgs
		return "* Please enter Confirm Password";
	} else if(document.getElementById("password").value != field.val()) {
		return "* Password and Confirm Password fields do not match.";
	}
}

function emailValidateNew(field, rules, i, options) {
	var email = field.val();
	var mailadd = email.split("@");
	if(mailadd.length > 1) {
		var finalsplit = mailadd[1].split(".");

		if(mailadd[1] == "utoronto.ca") {

		} else if(mailadd[1] == "alumni.utoronto.ca") {

		} else if(mailadd[1] == "toronto.edu") {

		} else {
			return '* Rayku is currently available for certain schools only.';
		}
	} else {
		return '* Please enter a valid Email address';
	}
}

function emailDupcheck(field, rules, i, options) {
	var email = field.val();
	var flag = 1;
	frmVal.ajax({
		cache : false,
		type : "POST",
		url : "/quickreg/duplicationcheck",
		data : "emailId=" + email,
		success : function(data) {
			if(data == 'yes') {
				document.getElementById('checkdata').value = data;
			} else {
				document.getElementById('checkdata').value = data;
			}
		}
	});
}

function resData(field, rules, i, options) {
	var storeData = document.getElementById('checkdata').value;
	if(storeData == 'yes') {
		return '* Email address already exist';
	}
}