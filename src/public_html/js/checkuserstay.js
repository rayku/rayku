function checkUserStay()
{


		var dvd = jQuery.noConflict();

		dvd.ajax({ cache: false,
			type : "POST",
			url: "http://www.rayku.com/dashboard/stay"
		});

setTimeout("checkUserStay()", 300000);

}
