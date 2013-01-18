
var CONFIG={debug:false,nick:"#",id:null,session_id:null,last_message_time:1,focus:true,unread:0};var nicks=[];Date.prototype.toRelativeTime=function(now_threshold){var delta=new Date()-this;now_threshold=parseInt(now_threshold,10);if(isNaN(now_threshold)){now_threshold=0;}
if(delta<=now_threshold){return'Just now';}
var units=null;var conversions={millisecond:1,second:1000,minute:60,hour:60,day:24,month:30,year:12};for(var key in conversions){if(delta<conversions[key]){break;}else{units=key;delta=delta/conversions[key];}}
delta=Math.floor(delta);if(delta!==1){units+="s";}
return[delta,units].join(" ");};Date.fromString=function(str){return new Date(Date.parse(str));};function userJoin(s_id,nick,timestamp){userList(s_id,nick,"joined",timestamp,"join");addMessage(s_id,nick,"joined",timestamp,"join");for(var i=0;i<nicks.length;i++){if(nicks[i]==nick){return true;}}
nicks.push(nick);}
function userPart(s_id,nick,timestamp){for(var i=0;i<nicks.length;i++){if(nicks[i]==nick){nicks.splice(i,1);break;}}
userList(s_id,nick,"left",timestamp,"part");addMessage(s_id,nick,"left",timestamp,"part");}
function userList(s_id,from,text,time,clase){if(s_id!=CONFIG.session_id){return;}
if(text===null){return;}
if(time==null){time=new Date();}else if((time instanceof Date)===false){time=new Date(time);}
switch(clase){case"join":var listClass="even";if((nicks.length%2)==0||nicks.length==0){listClass="odd";}
var rollChat="<span class='participant'>Participant</span>";if(nicks.length==0){rollChat="<span class='host'>Host</span>";}
$("#participants-list ul").append("<li id="+from+" class="+listClass+">"+from+rollChat+"</li>");scrollDown();break;case"part":$("#participants-list ul").find("li#"+from).replaceWith();break;}}
util={urlRE:/https?:\/\/([-\w\.]+)+(:\d+)?(\/([^\s]*(\?\S+)?)?)?/g,toStaticHTML:function(inputHtml){inputHtml=inputHtml.toString();return inputHtml.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;");},zeroPad:function(digits,n){n=n.toString();while(n.length<digits){n='0'+n;}
return n;},timeString:function(date){var minutes=date.getMinutes().toString();var hours=date.getHours().toString();return this.zeroPad(2,hours)+":"+this.zeroPad(2,minutes);},isBlank:function(text){var blank=/^\s*$/;return(text.match(blank)!==null);}};function scrollDown(){$('#chat-list').animate({scrollTop:$('#chat-list ul').height()},'slow');}
function addMessage(s_id,from,text,time,clase){if(s_id!=CONFIG.session_id){return;}
if(text===null){return;}
if(time==null){time=new Date();}else if((time instanceof Date)===false){time=new Date(time);}
var messageElement=$(document.createElement("li"));messageElement.addClass("message");if(clase){messageElement.addClass(clase);}
text=util.toStaticHTML(text);var nick_re=new RegExp(CONFIG.nick);if(nick_re.exec(text)){messageElement.addClass("personal");}
text=text.replace(util.urlRE,'<a target="_blank" href="$&">$&</a>');var content;switch(clase){case"join":content=util.timeString(time)+'<span class="name">'+util.toStaticHTML(from)+'</span> '+text;break;case"part":content=util.timeString(time)+'<span class="name">'+util.toStaticHTML(from)+'</span> '+text;break;default:content=util.timeString(time)+'<span class="name">'+util.toStaticHTML(from)+':</span> '+text;break;}
messageElement.html(content);$("#chat-list ul").append(messageElement);scrollDown();}
function drawCanvas(s_id,from,tool,color,canvas,posX,posY,string,x0,y0){if(s_id!=CONFIG.session_id){return;}
colorStroke=context.strokeStyle;colorFill=context.fillStyle;set_color(color);$('ul#color-tools li a').removeClass('current');$('ul#color-tools li'+color+' a').addClass('current');switch(tool){case"draw":switch(string){case"open":context.beginPath();break;case"close":context.closePath();break;default:context.lineTo(posX,posY);context.stroke();break;}
break;case"erase":switch(string){case"open":context.strokeStyle='#ffffff';context.fillStyle='#ffffff';context.lineWidth=10;context.beginPath();break;case"close":context.closePath();context.strokeStyle=colorStroke;context.fillStyle=colorFill;context.lineWidth=1;break;default:context.lineTo(posX,posY);context.stroke();break;}
break;case"text":context.fillText(string,posX,posY);break;case"line":context.beginPath();context.moveTo(posX,posY);context.lineTo(x0,y0);context.stroke();context.closePath();break;case"arrow":context.beginPath();context.moveTo(posX,posY);context.lineTo(x0,y0);context.stroke();context.closePath();var endPoint1=new Array();var endPoint2=new Array();endPoint1=calc_arrow1(posX,posY,x0,y0);endPoint2=calc_arrow2(posX,posY,x0,y0);context.beginPath();context.moveTo(x0,y0);context.lineTo(endPoint1[0],endPoint1[1]);context.moveTo(x0,y0);context.lineTo(endPoint2[0],endPoint2[1]);context.lineTo(endPoint1[0],endPoint1[1]);context.stroke();context.fill();context.closePath();break;case"arrow2":context.beginPath();context.moveTo(posX,posY);context.lineTo(x0,y0);context.stroke();context.closePath();var endPoint1=new Array();var endPoint2=new Array();endPoint1=calc_arrow1(posX,posY,x0,y0);endPoint2=calc_arrow2(posX,posY,x0,y0);context.beginPath();context.moveTo(x0,y0);context.lineTo(endPoint1[0],endPoint1[1]);context.moveTo(x0,y0);context.lineTo(endPoint2[0],endPoint2[1]);context.lineTo(endPoint1[0],endPoint1[1]);context.stroke();context.fill();context.closePath();var startPoint1=new Array();var startPoint2=new Array();startPoint1=calc_arrow1(x0,y0,posX,posY);startPoint2=calc_arrow2(x0,y0,posX,posY);context.beginPath();context.moveTo(posX,posY);context.lineTo(startPoint1[0],startPoint1[1]);context.moveTo(posX,posY);context.lineTo(startPoint2[0],startPoint2[1]);context.lineTo(startPoint1[0],startPoint1[1]);context.stroke();context.fill();context.closePath();break;case"rect":context.fillRect(posX,posY,x0-posX,y0-posY);break;case"circle":context.beginPath();context.arc(posX,posY,x0-posX,0,Math.PI*2,false);context.stroke();context.fill();context.closePath();break;case"clear":context.clearRect(0,0,645,535);break;}}
function updateRSS(){var bytes=parseInt(rss);if(bytes){var megabytes=bytes/(1024*1024);megabytes=Math.round(megabytes*10)/10;$("#rss").text(megabytes.toString());}}
function updateUptime(){if(starttime){$("#uptime").text(starttime.toRelativeTime());}}
function controlSession(s_id,from,control){if(s_id!=CONFIG.session_id){return;}
if(control==0){$('#session a').removeClass('end');$('#session a').addClass('start');tool='';useboard=false;$('ul#drawing-tools li a').removeClass('current-tool');clearTimeout(timerID);$('#dialog-2 p').replaceWith("<p>Session ended.</p>");$('#dialog-2').dialog('open');}
else{$('#session a').removeClass('start');$('#session a').addClass('end');useboard=true;$('ul#drawing-tools li a').removeClass('current-tool');chrono();}}
var transmission_errors=0;var first_poll=true;function longPoll(data){if(transmission_errors>2){showConnect();return;}
if(data&&data.rss){rss=data.rss;updateRSS();}
if(data&&data.messages){for(var i=0;i<data.messages.length;i++){var message=data.messages[i];if(message.timestamp>CONFIG.last_message_time){CONFIG.last_message_time=message.timestamp;}
switch(message.type){case"msg":if(!CONFIG.focus){CONFIG.unread++;}
addMessage(message.session_id,message.nick,message.text,message.timestamp);break;case"join":userJoin(message.session_id,message.nick,message.timestamp);break;case"part":userPart(message.session_id,message.nick,message.timestamp);break;case"draws":if(message.nick!=CONFIG.nick){drawCanvas(message.session_id,message.nick,message.tool,message.color,message.canvas,message.x,message.y,message.string,message.x0,message.y0);}
break;case"chrono":if(message.nick!=CONFIG.nick){controlSession(message.session_id,message.nick,message.text);start=new Date();}
break;}}
updateTitle();if(first_poll){first_poll=false;who();}}
$.ajax({cache:false,type:"GET",url:"/recv",dataType:"json",data:{since:CONFIG.last_message_time,id:CONFIG.id},error:function(){addMessage(CONFIG.session_id,"","long poll error. trying again...",new Date(),"error");transmission_errors+=1;setTimeout(longPoll,10*1000);},success:function(data){transmission_errors=0;longPoll(data);}});}
function send(msg){if(CONFIG.debug===false){jQuery.get("/send",{id:CONFIG.id,text:msg},function(data){},"json");}}
function showConnect(){$("#connect").show();$("#sub-left").hide();$("#sub-right").hide();$("#nickInput").focus();}
function showLoad(){$("#connect").hide();$("#loading").show();}
function showChat(nick){$("#sub-left").show();$("#sub-right").show();$("#connect").hide();$("#loading").hide();scrollDown();}
function updateTitle(){if(CONFIG.unread){document.title="("+CONFIG.unread.toString()+") Rayku - Whiteborad";}else{document.title="Rayku - Whiteboard";}}
var starttime;var rss;function onConnect(session){if(session.error){alert("error connecting: "+session.error);showConnect();return;}
CONFIG.nick=session.nick;CONFIG.id=session.id;starttime=new Date(session.starttime);rss=session.rss;updateRSS();updateUptime();showChat(CONFIG.nick);$(window).bind("blur",function(){CONFIG.focus=false;updateTitle();});$(window).bind("focus",function(){CONFIG.focus=true;CONFIG.unread=0;updateTitle();});}
function who(){jQuery.get("/who",{},function(data,status){if(status!="success"){return true;}
nicks=data.nicks;},"json");}
function send_message(){var msg=$("#entry").attr("value").replace("\n","");if(!util.isBlank(msg)){send(msg);}
$("#entry").attr("value","");}
function draw_canvas(tool,x,y,string,x0,y0){switch(tool){case"draw":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string},function(data){},"json");break;case"erase":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string},function(data){},"json");break;case"text":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string},function(data){},"json");break;case"line":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string,posX0:x0,posY0:y0},function(data){},"json");break;case"arrow":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string,posX0:x0,posY0:y0},function(data){},"json");break;case"arrow2":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string,posX0:x0,posY0:y0},function(data){},"json");break;case"rect":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string,posX0:x0,posY0:y0},function(data){},"json");break;case"circle":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id,color:context.fillStyle,posX:x,posY:y,string:string,posX0:x0,posY0:y0},function(data){},"json");break;case"clear":jQuery.post("/send_canvas",{tool:tool,id:CONFIG.id},function(data){},"json");break;}}
$(document).ready(function(){$("#entry").keypress(function(e){if(e.keyCode!=13){return true;}
send_message();});$("#entry-button").click(function(e){send_message();});userID=window.location.href.split('=');jQuery.get("/user",{userid:userID},function(data,status){CONFIG.session_id=data.user.session_id;CONFIG.id=data.user.id;CONFIG.nick=data.user.nick;$("#session-id").html("<span> ID: "+data.user.session_id+"</span>");},"json");setInterval(function(){updateUptime();},10*1000);if(CONFIG.debug){$("#loading").hide();$("#connect").hide();return true;}
$("#log table").remove();longPoll();window.onbeforeunload=function(){jQuery.get("/part",{id:CONFIG.id,s_id:CONFIG.session_id},function(data){},"json");}
$(window).unload(function(){jQuery.get("/part",{id:CONFIG.id,s_id:CONFIG.session_id},function(data){},"json");});});function chrono(){end=new Date();diff=end-start;diff=new Date(diff);var sec=diff.getUTCSeconds();var min=diff.getUTCMinutes();var hr=diff.getUTCHours();if(hr<10){hr="0"+hr;}
if(min<10){min="0"+min;}
if(sec<10){sec="0"+sec;}
document.getElementById("timer").innerHTML=hr+":"+min+":"+sec;timerID=setTimeout("chrono()",10);}