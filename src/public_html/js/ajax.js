//senswiz ajax supporting **STRAT**	
var xmlHttp;
var urlMain;
var idrMain="";
var va ="";
var Tpn=1;
var nSp=1;
function AjaxResult(ElementsId,text,va)	{	
	if(va == "1"){result1(text);}if(va == "2"){result2(text);}if(va == "3"){result3(text);}if(va == "4"){result4(text);}if(va == "5"){result5(text);}if(va == "6"){result6(text);}
}

function showHint(ElementById,URl,Count){ 
	idrMain=ElementById; va = Count;
	if (URl.length==0)  { 
		AjaxResult(ElementById,URl,va)
		return;
  	}
	xmlHttp=GetXmlHttpObject()
	if (xmlHttp==null)  {
		alert ("Your browser does not support AJAX!");
  		return;
  	} 
	urlMain=URl;
	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",urlMain,true);
	xmlHttp.send(null);
}
function stateChanged() { 
	if (xmlHttp.readyState==4){ 
		AjaxResult(idrMain,xmlHttp.responseText,va)
	}
}
function GetXmlHttpObject()	{
	var xmlHttp=null;
	try  {
		xmlHttp=new XMLHttpRequest();
  	}
	catch (e)  {
		try    {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
  		catch (e)    {
	    	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    	}
  	}
	return xmlHttp;
}
//senswiz ajax supporting **END**