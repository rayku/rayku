var __slice=Array.prototype.slice,__bind=function(a,b){return function(){return a.apply(b,arguments)}},__hasProp=Object.prototype.hasOwnProperty,__extends=function(a,b){function d(){this.constructor=a}for(var c in b)__hasProp.call(b,c)&&(a[c]=b[c]);return d.prototype=b.prototype,a.prototype=new d,a.__super__=b.prototype,a};(function(a){var b;b=a.Wistia;if(a.Wistia==null||a.Wistia.wistia==null)a.Wistia={wistia:"1.0",extend:function(){var a,b,c,d,e;a=arguments[0],c=2<=arguments.length?__slice.call(arguments,1):[],c.length||(c=[a],a=this);for(d=0,e=c.length;d<e;d++)b=c[d],this.obj.eachDeep(b,__bind(function(b,c){var d;d=this.obj.get(a,c);if(this.obj.isArray(b)){if(this.obj.isEmpty(d))return this.obj.set(a,c,[])}else{if(!this.obj.isObject(b))return this.obj.set(a,c,b);if(this.obj.isEmpty(d))return this.obj.set(a,c,{})}},this));return a},mixin:function(a,b){var c,d;for(c in b)d=b[c],b.hasOwnProperty(c)&&(a[c]=d)},obj:{get:function(a,b,c){var d;typeof b=="string"?b=b.split("."):b=b.slice(0,b.length);while(a!=null&&b.length)d=b.shift(),(a[d]===void 0||!this.isObject(a[d]))&&c&&(a[d]={}),a=a[d];return a},set:function(a,b,c){var d;typeof b=="string"?b=b.split("."):b=b.slice(0,b.length),d=b.pop(),a=this.get(a,b,!0);if(a!=null&&(this.isObject(a)||this.isArray(a))&&d!=null)return c!=null?a[d]=c:delete a[d]},unset:function(a,b){return this.set(a,b)},exists:function(a,b){return this.get(a,b)!==void 0},cast:function(a){return a==null?a:(a=""+a,/^\d+?$/.test(a)?parseInt(a,10):/^\d*\.\d+/.test(a)?parseFloat(a):/^true$/i.test(a)?!0:/^false$/i.test(a)?!1:a)},castDeep:function(a){return this.eachLeaf(a,__bind(function(b,c){if(typeof b=="string")return this.set(a,c,this.cast(b))},this)),a},isArray:function(a){return a!=null&&/^\s*function Array()/.test(a.constructor)},isObject:function(a){return a!=null&&/^\s*function Object()/.test(a.constructor)},isRegExp:function(a){return a!=null&&/^\s*function RegExp()/.test(a.constructor)},isBasicType:function(a){return a!=null&&(this.isRegExp(a)||/^string|number|boolean|function$/i.test(typeof a))},isEmpty:function(a){var b,c,d;if(a==null)return!0;if(this.isArray(a)&&!a.length)return!0;if(this.isObject(a)){b=!0;for(c in a)d=a[c],b=!1;return b}return!1},isEmptyDeep:function(a){var b;return this.isEmpty(a)?!0:(b=!0,this.eachLeaf(a,__bind(function(){return b=!1},this)),b)},isSubsetDeep:function(a,b){var c;return a===b?!0:a!=null&&b==null||a==null&&b!=null?!1:(c=!0,this.eachLeaf(a,__bind(function(a,d){var e;e=this.get(b,d);if(a!==e)return c=!1},this)),c)},equalsDeep:function(a,b){return this.isSubsetDeep(a,b)&&this.isSubsetDeep(b,a)},eachDeep:function(a,b,c){var d,e,f;c==null&&(c=[]);if(this.isBasicType(a))b(a,c);else if(this.isObject(a)||this.isArray(a)){b(a,c);for(d in a)f=a[d],e=c.slice(0,c.length),e.push(d),this.eachDeep(f,b,e)}else b(a,c)},eachLeaf:function(a,b){return this.eachDeep(a,__bind(function(a,c){if(!this.isArray(a)&&!this.isObject(a))return b(a,c)},this))}},data:function(a,b){return this.obj.isArray(a)||(a=a.split(".")),b!=null&&this.obj.set(this,["_data"].concat(a),b),this.obj.get(this,["_data"].concat(a))},timeout:function(a,b,c){var d;return c==null&&(c=1),this.clearTimeouts(a),this.obj.isArray(a)||(a=a.split(".")),a=["timeouts"].concat(a),b?(d=setTimeout(__bind(function(){return this.removeData(a),b()},this),c),this.data(a,d)):this.data(a)},clearTimeouts:function(a){var b;return this.obj.isArray(a)||(a=a.split(".")),a=["timeouts"].concat(a),b=this.data(a),this.obj.eachLeaf(b,function(a){return clearTimeout(a)}),this.removeData(a)},removeData:function(a){return this.obj.unset(this,["_data"].concat(a))},seqId:function(a,b){var c,d,e;return a==null&&(a="wistia_"),b==null&&(b=""),e=["sequence","val"],c=this.data(e)||1,d=a+c+b,this.data(e,c+1),d},noConflict:function(){return a.Wistia=b,this},util:{elemHeight:function(b){var c;return c=Wistia.detect.browser.quirks?parseInt(b.offsetHeight,10):a.getComputedStyle&&getComputedStyle(b,null)?parseInt(getComputedStyle(b,null).height,10):b.currentStyle?b.offsetHeight:-1,c},elemWidth:function(b){return Wistia.detect.browser.quirks?parseInt(b.offsetWidth,10):a.getComputedStyle&&getComputedStyle(b,null)?parseInt(getComputedStyle(b,null).width,10):b.currentStyle?b.offsetWidth:-1},elemIsHidden:function(a){while(a&&a.nodeType===1){if(a.style.display==="none")return!0;a=a.parentNode}return!1},winHeight:function(){var b;return b=a.innerHeight?a.innerHeight:document.documentElement?document.documentElement.offsetHeight:document.body.offsetHeight},winWidth:function(){var b;return b=a.innerWidth?a.innerWidth:document.documentElement?document.documentElement.offsetWidth:document.body.offsetWidth},elemStyle:function(b,c){return b.currentStyle?b.currentStyle[c]:a.getComputedStyle?getComputedStyle(b,null).getPropertyValue(c):null},appendElem:function(a,b){return a.appendChild(b)},prependElem:function(a,b){return a.childNodes.length===0?this.appendElem(a,b):a.insertBefore(b,a.childNodes[0])}},bindable:{bind:function(a,b){return this._bindings||(this._bindings={}),this._bindings[a]||(this._bindings[a]=[]),this._bindings[a].push(b),this},unbind:function(a,b){var c,d,e,f;this._bindings||(this._bindings={}),c=this._bindings[a];if(c)if(b){e=[];for(d=0,f=c.length;0<=f?d<f:d>f;0<=f?d++:d--)b!==c[d]&&e.push(c[d]);this._bindings[a]=e}else this._bindings[a]=[];return this._bindings[a]&&!this._bindings[a].length&&(this._bindings[a]=null,delete this._bindings[a]),this},hasBindings:function(){var a,b,c,d;this._bindings||(this._bindings={}),b=!1,d=this._bindings;for(a in d)c=d[a],this._bindings.hasOwnProperty(a)&&(b=!0);return b},trigger:function(){var a,b,c,d,e,f;d=arguments[0],a=2<=arguments.length?__slice.call(arguments,1):[],this._bindings||(this._bindings={});if(b=this._bindings[d])for(e=0,f=b.length;e<f;e++)c=b[e],c&&c.apply(this,a);return this}}};if(b!=null&&b.wistia==null)return Wistia.extend(b)})(window),function(a){a.extend({_detect:{na:navigator.userAgent,rwebkit:/(webkit)[ \/]([^\s]+)/i,ropera:/(opera)(?:.*version)?[ \/]([^\s]+)/i,rmsie:/(msie) ([^\s;]+)/i,rmozilla:/(mozilla)(?:.*? rv:([^\s]+))?/i,randroid:/(android) ([^;]+)/i,riphone:/(iphone)/i,ripad:/(ipad)/i,rwinphone:/(Windows Phone OS (\d+(?:\.\d+)?))/,rios:/OS (\d+)_(\d+)/i,rps3:/(playstation 3)/i,browser:function(){return this.browserMatch()[1].toLowerCase()},browserVersion:function(){return this.browserMatch()[2]},browserMatch:function(){var a;if((a=this.na.match(this.rwebkit))!=null)return a;if((a=this.na.match(this.ropera))!=null)return a;if(a=this.na.match(this.rmsie))return document.documentMode!=null&&(a[2]=document.documentMode),a;if(a=this.na.match(this.rmozilla))return a},android:function(){var a;return a=this.na.match(this.randroid),a==null?!1:{version:a[2]}},iphone:function(){return this.riphone.test(this.na)},retina:function(){return window.devicePixelRatio>1},ipad:function(){return this.ripad.test(this.na)},iosVersion:function(){var a;return a=this.na.match(this.rios),a!=null?parseFloat(""+a[1]+"."+a[2]):0},windowsPhone:function(){return this.rwinphone.test(this.na)},ps3:function(){return this.rps3.test(this.na)},flash:function(){var a;return a=this.flashFullVersion(),{version:parseFloat(a[0]+"."+a[1]),major:parseInt(a[0],10),minor:parseInt(a[1],10),rev:parseInt(a[2],10)}},flashFullVersion:function(){var a;try{try{a=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");try{a.AllowScriptAccess="always"}catch(b){return[6,0,0]}}catch(b){}return(new ActiveXObject("ShockwaveFlash.ShockwaveFlash")).GetVariable("$version").replace(/\D+/g,",").match(/^,?(.+),?$/)[1].split(",")}catch(b){try{if(navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)return(navigator.plugins["Shockwave Flash 2.0"]||navigator.plugins["Shockwave Flash"]).description.replace(/\D+/g,",").match(/^,?(.+),?$/)[1].split(",")}catch(b){}}return[0,0,0]},html5Video:function(){var a,b,c;a=document.createElement("video"),c=!1;try{!a.canPlayType||(c={},b='video/mp4; codecs="avc1.42E01E',c.h264=!!a.canPlayType(b+'"')||!!a.canPlayType(b+', mp4a.40.2"'))}catch(d){c={h264:!1}}return c},localStorage:function(){try{return"localStorage"in window&&window.localStorage!==null}catch(a){return!1}},json:function(){return!!window.JSON&&typeof JSON.parse=="function"},backgroundSize:function(){var a;return a=document.createElement("div"),a.style.backgroundSize===""||a.style.webkitBackgroundSize===""||a.style.mozBackgroundSize===""||a.style.oBackgroundSize===""}}}),a.extend({detect:{browser:{version:a._detect.browserVersion(),quirks:a._detect.browser()==="msie"&&document.compatMode==="BackCompat",old:a._detect.browser()==="msie"&&(document.compatMode==="BackCompat"||a._detect.browserVersion()<7)},android:a._detect.android(),iphone:a._detect.iphone(),ipad:a._detect.ipad(),winphone:{version:a._detect.windowsPhone()[2]},ios:{version:a._detect.iosVersion()},retina:a._detect.retina(),ps3:a._detect.ps3(),flash:a._detect.flash(),video:a._detect.html5Video(),localstorage:a._detect.localStorage(),json:a._detect.json(),backgroundSize:a._detect.backgroundSize()}}),a.detect.browser[a._detect.browser()]=!0}(Wistia),function(a){var b,c;a.detect.browser.msie?b=function(a,b,c){return a.attachEvent("on"+b,c)}:b=function(a,b,c){return a.addEventListener(b,c,!1)},c=!0,b(window,"blur",function(){c=!1}),b(window,"focus",function(){c=!0}),a.IframeApi=function(){function d(a){this.iframe=a}return d.prototype.init=function(){var d;return this._bindings={},(!a.detect.browser.msie||!a.detect.browser.quirks)&&!(a.detect.browser.msie&&a.detect.browser.version<8)&&(this.uuid=(""+(this.iframe.id||a.seqId())).replace(/\-/g,"_DASH_"),this.origWidth=parseInt(this.iframe.width,10),this.origHeight=parseInt(this.iframe.height,10),this.origVideoWidth=parseInt(this.iframe.src.match(/(?:\[|%5B)?videoWidth(?:\]|%5D)?=(\d+)/)[1],10),this.origVideoHeight=parseInt(this.iframe.src.match(/(?:\[|%5B)?videoHeight(?:\]|%5D)?=(\d+)/)[1],10),this.origPluginWidth=this.origWidth-this.origVideoWidth,this.origPluginHeight=this.origHeight-this.origVideoHeight,this.origAspectRatio=this.origVideoHeight?this.origVideoWidth/this.origVideoHeight:1.333,this.src=this.iframe.src,b(this.iframe,"load",__bind(function(){return this.bindId()},this)),this.bindId(),this.monitor(),this._isBound=!1,this._videoIsReady=!1,this.ready(__bind(function(){this._videoIsReady=!0},this)),d=__bind(function(){this._isBound&&this._videoIsReady&&!this._isDown&&!this.isDown()?this.trigger("ready"):a.timeout(""+this.uuid+".ready_poller",d,c?100:500)},this),a.timeout(""+this.uuid+".ready_poller",d,100)),this},d.prototype.ready=function(b){var c;return a.detect.browser.msie&&(a.detect.browser.version<8||a.detect.browser.quirks)?this:(this._isBound&&this._videoIsReady&&!this._isDown&&!this.isDown()?a.timeout(""+this.uuid+"."+a.seqId("ready_callback_"),b):(c=function(){return this.unbind("ready",c),b()},this.bind("ready",c)),this)},d.prototype.rebuild=function(){var b,c,d;if(b=this.iframe.parentNode)this._videoIsReady=!1,c=document.createElement("span"),c.style.display="none",b.insertBefore(c,this.iframe),d=__bind(function(){return b.removeChild(this.iframe),b.insertBefore(this.iframe,c.nextSibling),b.removeChild(c),c=null},this),a.detect.browser.msie&&a.detect.browser.version<9?setTimeout(d,1):d();return this},d.prototype.monitor=function(){var b,d,e;d=this.width(),b=!1,e=__bind(function(){var f;if(this.isDown()&&!this._isDown){try{this.pause()}catch(g){}this._isDown=!0,this.trigger("down")}else!this.isDown()&&this._isDown&&(this._isDown=!1,this.rebuild(),this.trigger("up"));if(/videoFoam=true/.test(this.src)&&this._videoIsReady&&!this._isDown&&!this.isDown()){f=a.util.elemWidth(this.iframe.parentNode);if(d!==f||!b)b=!0,this.width(f),d=f,this.videoHeight((f-this._pluginWidth)/this.origAspectRatio),a.timeout(""+this.uuid+".delayed_resize",__bind(function(){return this.videoHeight((f-this._pluginWidth)/this.origAspectRatio)},this),1e3)}return a.timeout(""+this.uuid+".monitor_and_fix",e,c?500:2e3)},this),a.timeout(""+this.uuid+".monitor_and_fix",e)},d.prototype.stopMonitoring=function(){return a.clearTimeouts(""+this.uuid+".monitor_and_fix")},d.prototype.isDown=function(){return a.util.elemIsHidden(this.iframe)},d.prototype.play=function(){return this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("play","*")},this))},d.prototype.pause=function(){return this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("pause","*")},this))},d.prototype.time=function(a){return a!=null?this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("time-"+a,"*")},this)):this._time||0},d.prototype.volume=function(a){return a!=null?this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("volume-"+a,"*")},this)):this._volume||0},d.prototype.setEmail=function(a){return this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("setEmail-"+a,"*")},this))},d.prototype.height=function(b){return b!=null?(this.iframe.height=this.iframe.style.height=""+b+"px",this):a.util.elemIsHidden(this.iframe)?this.iframe.style.height!=null?parseInt(this.iframe.style.height,10):parseInt(this.iframe.height,10):a.util.elemHeight(this.iframe)},d.prototype.width=function(b){return b!=null?(this.iframe.width=this.iframe.style.width=""+b+"px",this):a.util.elemIsHidden(this.iframe)?this.iframe.style.width!=null?parseInt(this.iframe.style.width,10):parseInt(this.iframe.width,10):a.util.elemWidth(this.iframe)},d.prototype.videoHeight=function(a){return a!=null?(this._height!=null?this.iframe.height=this.iframe.style.height=a+this._height-this._videoHeight:this.iframe.height=this.iframe.style.height=a+this.origPluginHeight,this):this._videoHeight},d.prototype.videoWidth=function(a){return a!=null?(this._width!=null?this.iframe.width=this.iframe.style.width=a+this._width-this._videoWidth:this.iframe.width=this.iframe.style.width=a+this.origPluginWidth,this):this._videoWidth},d.prototype.duration=function(){return this._duration||0},d.prototype.state=function(){return this._state||"unknown"},d.prototype.name=function(){return this._name||""},d.prototype.embedType=function(){return this._embedType},d.prototype.getVisitorKey=function(){return this._visitorKey},d.prototype.getEventKey=function(){return this._eventKey},d.prototype.bindId=function(){return this.iframe.contentWindow.postMessage("bindId-"+this.uuid,"*")},d}(),a.mixin(a.IframeApi.prototype,a.bindable),a.PlaylistIframeAPI=function(){function b(){b.__super__.constructor.apply(this,arguments)}return __extends(b,a.IframeApi),b.prototype.embed=function(a,b){return this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("embed-"+a+"-"+b,"*")},this))},b.prototype.play=function(a,b){return a!=null&&b!=null?this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("play-"+a+"-"+b,"*")},this)):a!=null?this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("play-"+a,"*")},this)):this.ready(__bind(function(){return this.iframe.contentWindow.postMessage("play","*")},this))},b}(),window.wistiaBindIframes=function(){var b,c,d,e,f;c=document.getElementsByTagName("iframe"),f=[];for(d=0,e=c.length;d<e;d++)b=c[d],f.push(/wistia_embed/.test(b.className)||b.name==="wistia_embed"?(b.wistiaApi?void 0:b.wistiaApi=(new a.IframeApi(b)).init(),a.data("iframe_api."+b.wistiaApi.uuid,b.wistiaApi),window.wistiaApi=b.wistiaApi):/wistia_playlist/.test(b.className)||b.name==="wistia_playlist"?(b.wistiaApi?void 0:b.wistiaApi=(new a.PlaylistIframeAPI(b)).init(),a.data("iframe_api."+b.wistiaApi.uuid,b.wistiaApi),window.wistiaApi=b.wistiaApi):void 0);return f},wistiaBindIframes(),window.wistiaDispatch=function(b){var c,d,e,f;if(b.data){e=b.data.split("-");if(e[0]==="wistia"){c=a.data("iframe_api."+e[1]);if(c!=null){if(e[2]==="trigger")if(e[3]==="ready")!c._isDown&&!c.isDown()&&c.trigger.apply(c,e.slice(3,e.length));else{for(d=3,f=e.length;3<=f?d<f:d>f;3<=f?d++:d--)e[d]=e[d].replace(/_DASH_/g,"-");c.trigger.apply(c,e.slice(3,e.length)),e[3]==="timechange"&&(c._time=parseFloat(e[4]))}e[2]==="state"&&c.ready(function(){return c._state=e[3]}),e[2]==="duration"&&c.ready(function(){return c._duration=parseFloat(e[3])}),e[2]==="volume"&&c.ready(function(){return c._volume=parseFloat(e[3])}),e[2]==="embedType"&&c.ready(function(){return c._embedType=e[3]}),e[2]==="bound"&&c.ready(function(){return c._isBound=!0}),e[2]==="widthchanged"&&(c.ready(function(){return c._width=parseInt(e[3],10)}),c.ready(function(){return c._videoWidth=parseInt(e[4],10)}),c.ready(function(){return c._pluginWidth=c._width-c._videoWidth})),e[2]==="heightchanged"&&(c.ready(function(){return c._height=parseInt(e[3],10)}),c.ready(function(){return c._videoHeight=parseInt(e[4],10)}),c.ready(function(){return c._pluginHeight=c._height-c._videoHeight})),e[2]==="visitorkey"&&c.ready(function(){return c._visitorKey=e[3].replace(/_DASH_/g,"-")}),e[2]==="eventkey"&&c.ready(function(){return c._eventKey=e[3].replace(/_DASH_/g,"-")}),e[2]==="name"&&c.ready(function(){return c._name=e[3].replace(/_DASH_/g,"-")})}}}},b(window,"message",wistiaDispatch)}(Wistia);