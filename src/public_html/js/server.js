HOST = null; // localhost
PORT = 8001;

// when the daemon started
var starttime = (new Date()).getTime();

var mem = process.memoryUsage();
// every 10 seconds poll for the memory.
setInterval(function () {
  mem = process.memoryUsage();
}, 10*1000);


var server_session = Math.floor(Math.random()*99999999999).toString();

var fu = require("./fu"),
    sys = require("sys"),
    url = require("url"),
    qs = require("querystring"),
	fs = require("fs");
	
var MESSAGE_BACKLOG = 200,
    SESSION_TIMEOUT = 60 * 1000;


var channel = new function () {
  var messages = [],
      callbacks = [];

  this.appendMessage = function (session_id, nick, type, text) {
    var m = { nick: nick
            , type: type // "msg", "join", "part"
            , text: text
			, session_id: session_id
            , timestamp: (new Date()).getTime()
            };

    switch (type) {
      case "msg":
        sys.puts("<" + nick + "> " + text);
        break;
      case "join":
        sys.puts(nick + " join");
        break;
      case "part":
        sys.puts(nick + " part");
        break;
	  case "chrono":
	    if(text==0) {
        	sys.puts(nick + " finished session");
		}
		else {
			sys.puts(nick + " started session");
		}
        break;
    }

    messages.push( m );

    while (callbacks.length > 0) {
      callbacks.shift().callback([m]);
    }

    while (messages.length > MESSAGE_BACKLOG)
      messages.shift();
  };
  
  this.drawCanvas = function (session_id, nick, type, tool, color, canvas, x, y, string, x0, y0) {
    var m = { nick: nick
			, type: type
			, tool: tool
			, color: color
            , canvas: canvas
			, x: x
			, y: y
			, string: string
			, x0: x0
			, y0: y0
			, session_id: session_id
            , timestamp: (new Date()).getTime()
            };
			

    sys.puts(nick + " draws a "+ tool +" on (" + x + ","+y+")");
    
    messages.push( m );

    while (callbacks.length > 0) {
      callbacks.shift().callback([m]);
    }

    while (messages.length > MESSAGE_BACKLOG)
      messages.shift();
  };


  this.query = function (since, callback) {
    var matching = [];
    for (var i = 0; i < messages.length; i++) {
      var message = messages[i];
      if (message.timestamp > since)
        matching.push(message)
    }

    if (matching.length != 0) {
      callback(matching);
    } else {
      callbacks.push({ timestamp: new Date(), callback: callback });
    }
  };

  // clear old callbacks
  // they can hang around for at most 30 seconds.
  setInterval(function () {
    var now = new Date();
    while (callbacks.length > 0 && now - callbacks[0].timestamp > 30*1000) {
      callbacks.shift().callback([]);
    }
  }, 3000);
};

var sessions = {};

function createSession (nick, s_id) {
	if (nick.length > 50) return null;
	if (/[^\w_\-^!]/.exec(nick)) return null;
	
	for (var i in sessions) {
		var session = sessions[i];
		if (session && session.nick === nick) {
			return null;
		}
	}
  
	if (s_id === null || s_id == "") {
		s_id = Math.floor(Math.random()*99999999999).toString();
	}
	else {
		var exists = false;
		for (var i in sessions) {
			var session = sessions[i];
			
			if (session.session_id == s_id) { 
				exists = true;
				//session.error = "Invalid ID session";
				//return null;
			}
		}
		if(!exists) {
			return null;
		}
		
	}

  var session = { 
    nick: nick, 
    id: Math.floor(Math.random()*99999999999).toString(),
	session_id: s_id,
    timestamp: new Date(),

    poke: function () {
      session.timestamp = new Date();
    },

    destroy: function () {
      channel.appendMessage(session.session_id, session.nick, "part", "");
      delete sessions[session.id];
    }
  };

  sessions[session.id] = session;
  return session;
}

// interval to kill off old sessions
setInterval(function () {
  var now = new Date();
  for (var id in sessions) {
    if (!sessions.hasOwnProperty(id)) continue;
    var session = sessions[id];

    if (now - session.timestamp > SESSION_TIMEOUT) {
      session.destroy();
    }
  }
}, 1000);

fu.listen(PORT, HOST);



fu.get("/", fu.staticHandler("login.html"));
fu.get("/session", fu.staticHandler("index.html"));
fu.get("/css/style.css", fu.staticHandler("css/style.css"));
fu.get("/css/start/jquery-ui-1.8.2.custom.css", fu.staticHandler("css/start/jquery-ui-1.8.2.custom.css"));
fu.get("/js/excanvas.js", fu.staticHandler("js/excanvas.js"));
fu.get("/js/jquery-1.4.2.min.js", fu.staticHandler("js/jquery-1.4.2.min.js"));
fu.get("/js/jquery-ui-1.8.2.custom.min.js", fu.staticHandler("js/jquery-ui-1.8.2.custom.min.js"));
fu.get("/js/rayku-whiteboard.js", fu.staticHandler("js/rayku-whiteboard.js"));
fu.get("/js/rayku.js", fu.staticHandler("js/rayku.js"));
fu.get("/js/client.js", fu.staticHandler("js/client.js"));
fu.get("/js/login.js", fu.staticHandler("js/login.js"));

fu.get("/images/toolbar.jpg", fu.staticHandler("images/toolbar.jpg"));
fu.get("/images/orange-bt.png", fu.staticHandler("images/orange-bt.png"));
fu.get("/images/yellow-bt.png", fu.staticHandler("images/yellow-bt.png"));
fu.get("/images/dark-green-bt.png", fu.staticHandler("images/dark-green-bt.png"));
fu.get("/images/light-green-bt.png", fu.staticHandler("images/light-green-bt.png"));
fu.get("/images/light-blue-bt.png", fu.staticHandler("images/light-blue-bt.png"));
fu.get("/images/dark-blue-bt.png", fu.staticHandler("images/dark-blue-bt.png"));
fu.get("/images/purple-bt.png", fu.staticHandler("images/purple-bt.png"));
fu.get("/images/fucsia-bt.png", fu.staticHandler("images/fucsia-bt.png"));
fu.get("/images/red-bt.png", fu.staticHandler("images/red-bt.png"));
fu.get("/images/gray-bt.png", fu.staticHandler("images/gray-bt.png"));
fu.get("/images/black-bt.png", fu.staticHandler("images/black-bt.png"));
fu.get("/images/bg-colors.png", fu.staticHandler("images/bg-colors.png"));
fu.get("/images/startsession-bt.png", fu.staticHandler("images/startsession-bt.png"));
fu.get("/images/endsession-bt.png", fu.staticHandler("images/endsession-bt.png"));
fu.get("/images/whiteboard-tab.png", fu.staticHandler("images/whiteboard-tab.png"));
fu.get("/images/chat-text.png", fu.staticHandler("images/chat-text.png"));
fu.get("/images/chat-button.png", fu.staticHandler("images/chat-button.png"));
fu.get("/css/start/images/ui-bg_inset-hard_100_fcfdfd_1x100.png", fu.staticHandler("css/start/images/ui-bg_inset-hard_100_fcfdfd_1x100.png"));


fu.get("/who", function (req, res) {
  var nicks = [];
  for (var id in sessions) {
    if (!sessions.hasOwnProperty(id)) continue;
    var session = sessions[id];
    nicks.push(session.nick);
  }
  res.simpleJSON(200, { nicks: nicks
                      , rss: mem.rss
                      });
});

fu.get("/user", function (req, res) {
  var user = qs.parse(url.parse(req.url).query).userid;
  for (var id in sessions) {
    if (!sessions.hasOwnProperty(id)) continue;
    var session = sessions[id];
  }
  res.simpleJSON(200, { user: session, rss: mem.rss });
});

fu.post("/join", function (req, res) {


	var body ="";
		
	req.addListener("data",function(data){
		body += data;
	});
	
	req.addListener("end",function(){
		var httpParams = qs.parse(body); 
		
		if (httpParams.nick == null || httpParams.nick.length == 0) {
			res.simpleJSON(400, {error: "Bad nick."});
			return;
		}
		
		var session = createSession(httpParams.nick, httpParams.session);
		
		if (session == null) {
			res.simpleJSON(400, {error: "Nick in use"});
			return;
		}
		
		channel.appendMessage(session.session_id, session.nick, "join");
		res.simpleJSON(200, { id: session.id,
					 nick: session.nick,
					 rss: mem.rss,
					 starttime: starttime
					});
	});
});

fu.get("/part", function (req, res) {
  var id = qs.parse(url.parse(req.url).query).id;
  var session;
  if (id && sessions[id]) {
    session = sessions[id];
    session.destroy();
  }
  res.simpleJSON(200, { rss: mem.rss });
});

fu.get("/recv", function (req, res) {
  if (!qs.parse(url.parse(req.url).query).since) {
    res.simpleJSON(400, { error: "Must supply since parameter" });
    return;
  }
  var id = qs.parse(url.parse(req.url).query).id;
  var session;
  if (id && sessions[id]) {
    session = sessions[id];
    session.poke();
  }

  var since = parseInt(qs.parse(url.parse(req.url).query).since, 10);

  channel.query(since, function (messages, session) {
    if (session) session.poke();
    res.simpleJSON(200, { messages: messages, rss: mem.rss });
  });
});

fu.get("/send", function (req, res) {
  var id = qs.parse(url.parse(req.url).query).id;
  var text = qs.parse(url.parse(req.url).query).text;

  var session = sessions[id];
  if (!session || !text) {
    res.simpleJSON(400, { error: "No such session id" });
    return;
  }

  session.poke();

  channel.appendMessage(session.session_id, session.nick, "msg", text);
  res.simpleJSON(200, { rss: mem.rss });
});

fu.post("/send_canvas", function (req, res) {
	var body ="";
		
	req.addListener("data",function(data){
		body += data;
	});
	
	req.addListener("end",function(){
		var httpParams = qs.parse(body); 
		
		var session = sessions[httpParams.id];
		var tool = httpParams.tool;
		
		if (!session) {
			res.simpleJSON(400, { error: "No such session id" });
			return;
		  }
		
		switch(tool) {
			case "draw":
				channel.drawCanvas(session.session_id, session.nick, "draws", "draw", httpParams.color, Array(), httpParams.posX, httpParams.posY, httpParams.string, 0, 0);
				break;
			case "erase":
				channel.drawCanvas(session.session_id, session.nick, "draws", "erase", httpParams.color, Array(), httpParams.posX, httpParams.posY, httpParams.string, 0, 0);
				break;
			case "text":
				channel.drawCanvas(session.session_id, session.nick, "draws", "text", httpParams.color, Array() , httpParams.posX, httpParams.posY, httpParams.string, 0, 0);
				break;
			case "line":
				channel.drawCanvas(session.session_id, session.nick, "draws", "line", httpParams.color, Array() , httpParams.posX, httpParams.posY, httpParams.string, httpParams.posX0, httpParams.posY0);
				break;
			case "arrow":
				channel.drawCanvas(session.session_id, session.nick, "draws", "arrow", httpParams.color, Array() , httpParams.posX, httpParams.posY, httpParams.string, httpParams.posX0, httpParams.posY0);
				break;
			case "arrow2":
				channel.drawCanvas(session.session_id, session.nick, "draws", "arrow2", httpParams.color, Array() , httpParams.posX, httpParams.posY, httpParams.string, httpParams.posX0, httpParams.posY0);
				break;
			case "rect":
				channel.drawCanvas(session.session_id, session.nick, "draws", "rect", httpParams.color, Array() , httpParams.posX, httpParams.posY, httpParams.string, httpParams.posX0, httpParams.posY0);
				break;
			case "circle":
				channel.drawCanvas(session.session_id, session.nick, "draws", "circle", httpParams.color, Array() , httpParams.posX, httpParams.posY, httpParams.string, httpParams.posX0, httpParams.posY0);
				break;
			case "clear":
				channel.drawCanvas(session.session_id, session.nick, "draws", "clear", "#ffffff", Array() , 0, 0, '', 0, 0);
				break;
			
		}
		res.simpleJSON(200, { rss: mem.rss});
	}); 
});

fu.get("/chrono", function (req, res) {
  var id = qs.parse(url.parse(req.url).query).id;
  var control = qs.parse(url.parse(req.url).query).control;
  
  var session = sessions[id];
  if (!session) {
    res.simpleJSON(400, { error: "No such session id" });
    return;
  }

  session.poke();

  channel.appendMessage(session.session_id, session.nick, "chrono", control);
  res.simpleJSON(200, { rss: mem.rss });
});

