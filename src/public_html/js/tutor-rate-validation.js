var tp = jQuery.noConflict();

function tutorprofile() {
    tp('#tutor_profile').load('http://' + getHostname() + '/dashboard/tutor', '', function (response) {
        tp("#profile_content").html(response);

    });
}

function tutorprofileedit() {
    tp('#tutor_profile').load('http://' + getHostname() + '/dashboard/tutorprofile', '', function (response) {
        tp("#profile_edit_content").html(response);
    });
}

function validateRate() {
    var rate = document.getElementById('rate').value;
    var Rate = rate.split('.');
    var CheckRate;

    if (Rate.length < 2) {
        CheckRate = Rate[0] + ".00";
    } else {
        CheckRate = rate;
    }
    CheckRate = parseFloat(CheckRate);
    if (CheckRate < '0.00' || CheckRate > '5.00') {
        document.getElementById('rateError').innerHTML = "<font color='red'>Rate Should Be <strong>0.00</strong> to <strong>5.00</strong></font><br>";
        return false;

    }
    return true;
}