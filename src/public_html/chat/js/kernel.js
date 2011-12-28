_AJAXLOOP = 2000;
_TillABORT = _AJAXLOOP - (_AJAXLOOP/6);
$SEND_RECEIVE_PROBLEM = "There is a problem during send and receive data between you and server!";
var iEE;
function alilg()
{
	this.v236 = null;
	this.v237 = null;
	this.i166 = null;
	this.a412 = null;
	this.k452 = Array();
	this.t200 = Array();
	this.o214 = Array();
	this.o313 = Array();
	this.m405 = Array(0,0,0,0,0,0);
	this.f236 = function(l)
	{
		return document.getElementById(l);
	}
	var y456 = this.f236("c238");
	if(document.addEventListener)
	{
		y456.addEventListener("click", function (){x236.f563()}, false);
	}
	else if(document.attachEvent)
	{
		y456.attachEvent("onclick", function (){x236.f563()});
	}

	this.f563 = function()
	{
		this.v236 = trim(this.f236("c237").value);
		if(this.v236=='')
		{
			alert('Enter your nickname!');
			return;
		}
		this.f564();
	}
	this.f848 = function(l,lc)
	{
		_a = '?al=2';
		if(l==1)
		{
			//x236.o214[i2][1].window.document.getElementById('a236')
			for(var i2=0;i2<x236.o214.length;i2++)
			{
				if(lc==x236.o214[i2][0])
				{
					//var oForm = document.forms[0];
					var sj=x236.o214[i2][1].window.document.forms[0].m523;
					var oForm = x236.o214[i2][1].window.document.forms[0];
					var rsnt = oForm.m523.value;
					var lp=i2;
				}
			}
		}
		else
		{
			var sj=_el("shibaba");
			var oForm = document.forms[0];var ep4='';
			for(var ep3=0;ep3<x236.m405.length;ep3++)
			{
				ep4+='_'+x236.m405[ep3];
			}
			oForm.m2.value = ep4;
			var rsnt = oForm.m523.value;
		}
		
		if(trim(sj.value)=="")
		{
			sj.value='';
			return;
		}
		
		
		for(var j=0;j<x236.k452.length;j++)
		{
		if(x236.k452[j][0]==x236.v237)
		{
			if(l==1)
			{
				var qb = trim(rsnt);
			}
			else
			{
				var qb = x236.g800(trim(rsnt), oForm.m2.value.substr(1,oForm.m2.value.length));
			}
			var q12='<div class="dboo35"><span class="b">'+x236.k452[j][1]+': </span> '+qb+'</div>';
		}
		}
		
		if(l==1)
		{
		x236.o214[lp][1].window.document.getElementById('a236').innerHTML = x236.o214[lp][1].window.document.getElementById('a236').innerHTML+q12;
			x236.o214[lp][1].window.document.getElementById('jain_1').scrollTop = x236.o214[lp][1].window.document.getElementById('jain_1').scrollHeight;
		}
		else
		{
		var v = document.createElement("div");
		v.style.padding='3px';
		for(var sz=0;sz<smz.length;sz++)
		{
			q12=q12.replace(new RegExp(smz[sz],"gi"), '<img src="pix/smileys/'+(smz[sz].replace(/-/g,''))+'.gif">')
		}
		v.innerHTML = q12;
		x236.f236('a216').appendChild(v);
		var l = x236.f236('a217');
		l.scrollTop = l.scrollHeight;
		}
		
		
		
		
		
		
		

		var oCallback = {
			success: function (oResponse) {
				//--
				var i = oResponse.responseText;

		var is = i.split('______');
		//--
		},failure: function (oResponse) {
			saveResult($SEND_RECEIVE_PROBLEM);}};
			//saveResult("An error occurred: " + oResponse.statusText);}};
			YAHOO.util.Connect.setForm(oForm);
			sj.value='';
			YAHOO.util.Connect.asyncRequest("POST", _a, oCallback); 
	}
	this.g800 = function(l,lc)
	{
		var q='';
		lc=lc.split("_");
		if(lc[0]!=='0')
		q+='color:'+lc[0]+';';
		if(lc[1]!=='0')
		q+='font-family:'+lc[1]+';';
		if(lc[2]!=='0')
		q+='font-size:'+lc[2]+'pt;';
		if(lc[3]!=='0')
		q+='font-weight:bold;';
		if(lc[4]!=='0')
		q+='font-style:italic;';
		if(lc[5]!=='0')
		q+='text-decoration:underline;';
		return '<span style="'+q+'">'+l+'</span>';
	}
	this.f899 = function()
	{
		var oCallback = {
			success: function (oResponse) {
		GRUBt = 0;
		var i39 =oResponse.responseText;

		eval(i39);		
		x236.t200[0] = v200;

		var q12='';var q13='';var q13b=null;var q14x='';
		for(var i=0;i<s60.length;i++)
		{
			for(var j=0;j<x236.k452.length;j++)
			{
				if(x236.k452[j][0]==s60[i][0])
				{
					if(s60[i][0]==x236.v237 && s60[i][2]==0)
					{
						
					}
					else
					{
					if(s60[i][2]==0)
					{
						if(s60[i][1]!=='' && s60[i][1]!==' '){
						q12+='<div class="dboo35"><span class="a">'+x236.k452[j][1]+': </span> '+x236.g800(s60[i][1], s60[i][3])+'</div>';}
					}
					else
					{
						var p=0;for(var i2=0;i2<x236.o214.length;i2++)
						{
							if(s60[i][0]==x236.o214[i2][0])
							{
								
								if(s60[i][1]!=='' && s60[i][1]!==' ')
								{
								q13 ='<div class="dboo35"><span class="a">'+x236.k452[j][1]+': </span> '+s60[i][1]+'</div>';
								//q13c = x236.o214[i2][1].window.document.getElementById('a236')
								q13b = i2;
								p++;
								
								x236.o214[i2][1].window.document.getElementById('a236').innerHTML = x236.o214[i2][1].window.document.getElementById('a236').innerHTML+q13;
			x236.o214[i2][1].window.document.getElementById('jain_1').scrollTop = x236.o214[i2][1].window.document.getElementById('jain_1').scrollHeight;
			q13 ='';
								}
							}
						}
						if(p==0)
						{
							//if(s60[i][2]==x236.o214[i2][0])
							//{
								if(s60[i][1]!=='' && s60[i][1]!==' ')
								{
									var q14x ='<div class="dboo35"><span class="a">'+x236.k452[j][1]+': </span> '+s60[i][1]+'</div>';
									var _aXc = '<div style="background-color:#69C;color:#FFF;padding:5px;padding-top:3px;" align="left"><input type="button" onclick="x236.n127('+s60[i][0]+')" value="ANSWER" style="font-size:9pt;border:solid 1px #666;color:blue;font-weight:bold"> <input type="button" onclick="x236.n126('+s60[i][0]+')" value="CLOSE" style="color:#000000;font-size:9pt;border:solid 1px #666;font-weight:bold"> <b>'+x236.k452[j][1]+'</b> want to have private chat with you!<div>'+q14x+'</div></div>';	
									if(!_el("a1203"+s60[i][0]))
									{
									var v = document.createElement("div");
									v.setAttribute("id","a1203"+s60[i][0]);
									v.innerHTML = _aXc;
									_el('a000').style.display='block';
									_el('a000').appendChild(v);
									}
									else
									{
									var v = _el("a1203"+s60[i][0]);
									v.innerHTML = _aXc;
									}			
								}
								//p++;
							//}
							//_el('a000').innerHTML = _el('a000').innerHTML+q13b;//x236.ob43(x236.k452[j][1],s60[i][0]);
							//x236.f634(s60[i][0], 2);
						}
					}
					}
				}
			}			
		}
		
		if(q14x)
		{
			
		}
		
		if(q13)
		{
			
		}
		var q13='';
		for(var i=0;i<s61.length;i++)
		{
			x236.k452.push(Array(s61[i][0], s61[i][1]));
			b='';
			if(s61[i][0]!==x236.v237)
			b='(<a href="javascript:void(0)" style="font-weight:normal" onclick="x236.f635('+s61[i][0]+')">block</a>)';
			q13+='<div id="dbhoo34_'+s61[i][0]+'" class="dboo34"><div style="float:left;overflow:hidden;white-space:nowrap;width:70px;"><a href="javascript:void(0)" onclick="x236.f634('+s61[i][0]+')">'+s61[i][1]+'</a></div><div style="float:right">'+b+'</div></div>';
		}
		
		if(q13!=="")
		{
			x236.f236('a332').innerHTML=q13+x236.f236('a332').innerHTML;
		}
		
		for(var i2=0;i2<s62.length;i2++)
		{
			var ik = _el('dbhoo34_'+s62[i2][0]);
			x236.f236('a332').removeChild(ik);
			for(var j=0;j<x236.k452.length;j++)
			{
				if(x236.k452[j][0]==s62[i2][0])
				{
					x236.k452.splice(j, 1);
				}
			}
			for(var k=0;k<x236.o214.length;k++)
			{
				if(s62[i2][0]==x236.o214[k][0])
				{
					x236.o214[k][1].window.document.getElementById('a236').innerHTML = x236.o214[k][1].window.document.getElementById('a236').innerHTML+'<span style="color:#FF0000">This user got disconnected!</span>';
					x236.o214[k][1].window.document.getElementById('jain_1').scrollTop = x236.o214[k][1].window.document.getElementById('jain_1').scrollHeight;	
					x236.o214[k][1].window.document.getElementById('a215').disabled="disabled";
					x236.o214[k][1].window.document.getElementById('simone').disabled="disabled";
				}
			}
		}
	
		if(q12!=="")
		{
		var v = document.createElement("div");
		v.style.padding='3px';
		for(var sz=0;sz<smz.length;sz++)
		{
			q12=q12.replace(new RegExp(smz[sz],"gi"), '<img src="pix/smileys/'+(smz[sz].replace(/-/g,''))+'.gif">')
		}
		v.innerHTML = q12;
		x236.f236('a216').appendChild(v);
		var l = x236.f236('a217');
		l.scrollTop = l.scrollHeight;
		}
		
		var is = i.split('______');
		},
		failure: function (oResponse) {
			GRUBt = 0;
			displayCustomerInfo($SEND_RECEIVE_PROBLEM);
			}, timeout: _TillABORT};
		//$PLUS[id] = parseInt(e('p_'+id).innerHTML);
		//e('p_'+id).innerHTML = '<img src="img/green_rot.gif" />';
		YAHOO.util.Connect.asyncRequest("GET", "?a458="+x236.i166+'&&j='+x236.t200[0]+"&&v237="+x236.v237, oCallback);
	}
	this.ob43 = function(n,i)
	{
		_el('a000').style.display='block';
		return '<div class="dsp" style="width:300px;height:150px;position:absolute;background-color:#FF0000;z-index:2000"><b>'+n+'</b> invited you to have private chat!<div style="padding:7px;"><a href="javascript:void(0)" onclick="x236.ob44()">Accept</a> | <a href="javascript:void(0)" onclick="x236.ob45()">Reject</a></div></div>';
	}
	this.f635 = function(l)
	{
		
	}
	this.f564 = function()
	{
		//alert(this.v236);
		this.f236('e523a').style.display = 'none';
		this.f236('e524a').style.display = 'block';
		
		//alert(this.f236('c236b').innerHTML);
		var oCallback = {
	success: function (oResponse) {
		GRUBt = 0;
		var i39 =oResponse.responseText;
		eval(i39);
		//alert(i39);
		var q12='';
		for(var i=0;i<s60.length;i++)
		{
			q12+='<div class="c"><div class="a">'+s60[i][2]+' (<a href="javascript:void(0)" onclick="x236.f682('+s60[i][0]+')">Enter</a>)</div><div class="b">'+s60[i][1]+' Online</div></div>';
		}
		x236.f236('c236b').innerHTML=q12;
		var is = i.split('______');
		},
		failure: function (oResponse) {
			GRUBt = 0;
			displayCustomerInfo($SEND_RECEIVE_PROBLEM);
			}};
		//$PLUS[id] = parseInt(e('p_'+id).innerHTML);
		//e('p_'+id).innerHTML = '<img src="img/green_rot.gif" />';
		

		YAHOO.util.Connect.asyncRequest("GET", "?a456="+trim(this.v236), oCallback);
	}
	this.f633 = function(l)
	{
		
	}
	this.n126 = function(l)
	{
		
	}
	this.n127 = function(l)
	{
		var p=0;for(var i2=0;i2<x236.o214.length;i2++)
		{
			if(x236.o214[i2][0]==l)
			{
				p++;
			}
		}
		_el('a000').removeChild(_el("a1203"+l));
		if(p==0)
		{
			x236.f634(l);
		}		
	}
	this.n126 = function(l)
	{
		_el('a000').removeChild(_el("a1203"+l));
	}
	this.f634 = function(l,i)
	{
		var iEE = window.open("?a903="+l+"&&a904="+x236.i166+"&&a905="+x236.v237+"&&i2="+$a090, "alilgchat"+l+"i"+$a090, "location=0,resizable=0,status=0,scrollbars=0,width=384,height=250");
		//setTimeout('x236.t100()', 5000);
		//i.document.getElementById('a215').value = "Mice"
		x236.o214.push(Array(l,iEE));
	}
	this.t100 = function()
	{
		for(var i=0;i<x236.o214.length;i++)
		{
			x236.o214[i][1].window.document.getElementById('a215').value=x236.o214[i][0];
		}
	}
	this.k204 = function()
	{
		
	}
	this.f682 = function(l)
	{

		var oCallback = {
			success: function (oResponse) {
		GRUBt = 0;
		var i39 =oResponse.responseText;
		
		eval(i39);
		
		x236.f236('e523a').style.display = 'none';
		x236.f236('e524a').style.display = 'none';
		x236.f236('cv2').style.display = 'block';
		x236.f236('cv2').innerHTML=s59[0];
		x236.f236('GLX').style.width = '648px';
		x236.f236('GLX').width = '648';
		_el("shibaba").value = "";
		

		_el('m521').value=x236.i166;
		_el('m501').value=x236.v237;
		
		var q12='';
		x236.k452 = [];
		x236.k452 = Array();
		for(var i=0;i<s60.length;i++)
		{
			x236.k452.push(Array(s60[i][0], s60[i][1]));
			b='';
			if(s60[i][0]!==x236.v237)
			b='(<a href="javascript:void(0)" style="font-weight:normal" onclick="x236.f635('+s60[i][0]+')">block</a>)';
			q12+='<div id="dbhoo34_'+s60[i][0]+'" class="dboo34"><div style="float:left;overflow:hidden;white-space:nowrap;width:70px;"><a href="javascript:void(0)" onclick="x236.f634('+s60[i][0]+')">'+s60[i][1]+'</a></div><div style="float:right">'+b+'</div></div>';
		}
		x236.t200[0] = v200;
		x236.f236('a332').innerHTML=q12;
		clearInterval(x236.a412);
		x236.a412 = setInterval('x236.f899();', _AJAXLOOP);
		var is = i.split('______');
		},
		failure: function (oResponse) {
			GRUBt = 0;
			displayCustomerInfo($SEND_RECEIVE_PROBLEM);
			}};
		//$PLUS[id] = parseInt(e('p_'+id).innerHTML);
		//e('p_'+id).innerHTML = '<img src="img/green_rot.gif" />';
		this.i166=l;
		_el('c236b').innerHTML='<div style="text-align:center;padding:5px;">Please wait...</div>';
		YAHOO.util.Connect.asyncRequest("GET", "?a457="+l+"&&a635="+this.v236, oCallback);
	}
}

var x236;
setTimeout('x236=new alilg();', 500);
function _el(item)
{
	return document.getElementById(item);
}
cdisaBler = '<table border="0" cellspacing="1" width="60" cellpadding="0" bgcolor="#FFFFFF"><tr><td onclick="cngcolor(this)" bgcolor="#FF0054" height="20">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#4653FF">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#3B6A9F">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#17B4A3">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#FFD200">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#FF0000">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#000000">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#FF9600">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#FFEA00">&nbsp;</td></tr><tr><td onclick="cngcolor(this)" height="20" bgcolor="#0024FF">&nbsp;</td></tr></table>';

var smz=Array();
for(var i=0;i<28;i++)
{
	smz.push('-'+(i+1)+'-');
}
POOM = '<table style="border:1px solid #CCCCCC; " cellspacing="0" cellpadding="0" class="smiley"><tr><td align="center"><table width="100%" cellspacing="0" cellpadding="4"><tr><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-1-\')" src="pix/smileys/1.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-2-\')" src="pix/smileys/2.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-3-\')" src="pix/smileys/3.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-4-\')" src="pix/smileys/4.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-5-\')" src="pix/smileys/5.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-6-\')" src="pix/smileys/6.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-7-\')" src="pix/smileys/7.gif"></td></tr><tr><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-8-\')" src="pix/smileys/8.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-9-\')" src="pix/smileys/9.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-10-\')" src="pix/smileys/10.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-11-\')" src="pix/smileys/11.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-12-\')" src="pix/smileys/12.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-13-\')" src="pix/smileys/13.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-14-\')" src="pix/smileys/14.gif"></td></tr><tr><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-15-\')" src="pix/smileys/15.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-16-\')" src="pix/smileys/16.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-17-\')" src="pix/smileys/17.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-18-\')" src="pix/smileys/18.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-19-\')" src="pix/smileys/19.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-20-\')" src="pix/smileys/20.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-21-\')" src="pix/smileys/21.gif"></td></tr><tr><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-22-\')" src="pix/smileys/22.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-23-\')" src="pix/smileys/23.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-24-\')" src="pix/smileys/24.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-25-\')" src="pix/smileys/25.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-26-\')" src="pix/smileys/26.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-27-\')" src="pix/smileys/27.gif"></td><td onmouseover="smitabcol(this);" onmouseout="smitabout(this);" align="center"><img onclick="SM(\'-28-\')" src="pix/smileys/28.gif"></td></tr></table></td></tr></table>';
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																									  
font_php = '<table border="0" cellpadding="0" cellspacing="0" width="85" style="border-top-width: 0px; position:absolute; z-index:200;" class="fontz"><tr onclick="closefont(\'Arial\')"><td bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg" style="border-top-style: none; border-top-width: medium"><font style="cursor:default;" unselectable="on">&nbsp;Arial</font></td></tr><tr onclick="closefont(\'Tahoma\')"><td  bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg"><font style="cursor:default;" unselectable="on">&nbsp; Tahoma</font></td></tr><tr onclick="closefont(\'Verdana\')"><td  bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg"><font style="cursor:default;" unselectable="on">&nbsp; Verdana</font></td></tr><tr onclick="closefont(\'Impact\')"><td  bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #C0C0C0"><font style="cursor:default;" unselectable="on">&nbsp; Impact</font></td></tr></table>';


sizer_php = '<table border="0" cellpadding="0" cellspacing="0" width="22" style="border-top-width: 0px; position:absolute; z-index:200;" class="fontz2"><tr onclick="closesizer(\'8\')"><td  bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg" style="border-top-style: none; border-top-width: medium"><font style="cursor:default;" unselectable="on">8</font></td></tr><tr onclick="closesizer(\'12\')"><td  bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg"><font style="cursor:default;" unselectable="on">12</font></td></tr><tr onclick="closesizer(\'14\')"><td bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg"><font style="cursor:default;" unselectable="on">14</font></td></tr><tr onclick="closesizer(\'18\')"><td bgcolor="#FFFFFF" onmouseover="fontabcol(this);" onmouseout="fontabout(this);" class="fon_inter_bg" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom: 1px solid #C0C0C0"><font style="cursor:default;" unselectable="on">18</font></td></tr></table>';


function ccdisabled()
{
	var ni = _el('smiliz');
	var newdiv = document.createElement('div');
	newdiv.setAttribute("id","SMOLZED");
	newdiv.style.overflow="auto";
	newdiv.style.height="140px";
	newdiv.style.width="80px";
	newdiv.style.position="absolute";
	newdiv.innerHTML = cdisaBler;
	ni.appendChild(newdiv);
}
function cngcolor(CNGI)
{
	clocolor(CNGI.bgColor)
}
function clocolor(CLID)
{
	var ni = _el('smiliz');
	var olddiv = _el('SMOLZED');
	ni.removeChild(olddiv);
	var oTix = _el("shibaba");
	oTix.style.color = CLID;
	x236.m405[0] = CLID;
	if(CLID!="000000")
	{
		$newcolor=CLID;
	}
	else
	{
		$newcolor=null;
	}
}

function asmup(obj,ol,cl)
{
	$loc="smh";
	$blz="SMCH";
	$TTi="shibaba";

	var sa=_el('smh');
	var ni=document.createElement("div");
	ni.setAttribute("id",$blz);
	ni.innerHTML = POOM;
	ni.style.position="absolute";
	sa.appendChild(ni);
}
function smitabcol(SMIsrc)
{
	SMIsrc.bgColor = "#FFFFFF";
}
function smitabout(SMIsrc)
{
	SMIsrc.bgColor = "";
}
function SM(strCode)
{
	_el($TTi).value+=" "+strCode+" ";
	dwmnh();
}


function openfoner()
{
	var ni = _el('fontz');
	var newdiv = document.createElement('div');
	newdiv.setAttribute("id","FONTZC");
	newdiv.innerHTML = font_php;
	ni.appendChild(newdiv);
}

function fontabcol(SMIsrc){SMIsrc.bgColor = "#FFD89D";}function fontabout(SMOsrc){SMOsrc.bgColor = "#FFFFFF";}

function closefont(fntname)
{
	var ni = _el('fontz');
	var olddiv = _el('FONTZC');
	ni.removeChild(olddiv);
	_el("fontface").innerHTML = fntname;
	var oTix = _el("shibaba");
	oTix.style.fontFamily = ""+fntname+"";
	x236.m405[1] = fntname;
	if(fntname!="Verdana")
	{
		$newfont=fntname;
	}
	else
	{
		$newfont=null;
	}
}

function opensizer()
{
	var ni = _el('sizez');
	var newdiv = document.createElement('div');
	newdiv.setAttribute("id","sizeC");
	newdiv.innerHTML = sizer_php;
	ni.appendChild(newdiv);
}

function closesizer(fntname){var ni = _el('sizez');var olddiv = _el('sizeC');ni.removeChild(olddiv);_el("sizeface").innerHTML = fntname;var oTix = _el("shibaba");
oTix.style.fontSize = ""+fntname+"pt";
x236.m405[2] = fntname;
if(fntname!="9"){$newsize=fntname;}else{$newsize=null;}}
$blodupB=0;
$italicup=0;
$undeleup=0;
function boldup(){if($blodupB==1){var oTix = _el("shibaba");
oTix.style.fontWeight="";
x236.m405[3] = 0;
$newbold=null;var oBix = _el("boldpic");oBix.setAttribute("src","pix/editor_bold_off.gif");$blodupB=0; }else{var oTix = _el("shibaba");oTix.style.fontWeight="bold";x236.m405[3]=1;$newbold=1;var oBix = _el("boldpic");oBix.setAttribute("src","pix/editor_bold_on.gif");$blodupB=1;}}function italicup(){if($italicup==1){var oTix = _el("shibaba");oTix.style.fontStyle="";x236.m405[4] = 0;$newitalic=null;var oBix = _el("italicpic");oBix.setAttribute("src","pix/italic_off.gif");$italicup=0;}else{var oTix = _el("shibaba");oTix.style.fontStyle="italic";x236.m405[4]=1;$newitalic=1;var oBix = _el("italicpic");oBix.setAttribute("src","pix/italic_on.gif");$italicup=1;}}function underlup(){if($undeleup==1){var oTix = _el("shibaba");oTix.style.textDecoration="";x236.m405[5]=0;$newunline=null;var oBix = _el("underlinepic");oBix.setAttribute("src","pix/underline_off.gif");$undeleup=0;}else{var oTix = _el("shibaba");oTix.style.textDecoration="underline";x236.m405[5]=1;$newunline=1;var oBix = _el("underlinepic");oBix.setAttribute("src","pix/underline_on.gif");$undeleup=1;}}

function jusc(piker,ritm, l)
{
	if(piker.keyCode == 13)
	{
		x236.f848(ritm, l);
	}
}
function jusc2(ritm, l)
{
	x236.f848(ritm, l);
}

$blz = null;
function dwmnh()
{
	if(_el($blz))
	{
		var sa=_el($loc);
		var ni=_el($blz);
		sa.removeChild(ni);
	}
}

function ln(l)
{
	for(var i2=0;i2<x236.o214.length;i2++)
	{
		if(l==x236.o214[i2][0])
		{
			x236.o214.splice(i2, 1);
		}
	}
}

if(spd)
{
	_el('cpr').innerHTML = 'powered by <a href="http://www.alilg.com/software/free-php-ajax-chat/">alilg php ajax chat</a> | <a href="http://www.alilg.com">alilg games</a>';
}