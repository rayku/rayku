
function checkedMsgUser()
{



		var dvk = jQuery.noConflict();

		dvk.ajax({ cache: false,
			type : "POST",
			url: "http://"+getHostname()+"/expertmanager/mapmsguser",
			success : function (data)  {

				var result = data.split("<");

				if(result[0].length != 1) {

					var newChecking = result[0].split("-");

					 if(newChecking[0] == "msg") {

						asker_row_id = newChecking[1];
						asker_chat_id = newChecking[4];

						setTimeout('askerMsgOpen(asker_row_id,asker_chat_id)', 5000);

					}
				}


			}

		});



setTimeout("checkedMsgUser()", 5000);

}


function askerMsgOpen(row_id,chat_id) {

	 var details = new Array();

			details[0] = row_id;
  			details[1] = chat_id;

		document.location='http://'+getHostname()+'/expertmanager/answer?details='+details;

}
