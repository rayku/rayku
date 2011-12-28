
var identity = function(a) { return a; };
var nameprep = identity;
var nodeprep = identity;
var resourceprep = identity;


function JID(a, b, c) {
    if (a && b == null && c == null) {
        this.parseJID(a);
    } else if (b) {
        this.setUser(a);
        this.setDomain(b);
        this.setResource(c);
    } else
        throw 'Argument error';
}

JID.prototype.parseJID = function(s) {
    if (s.indexOf('@') >= 0) {
        this.setUser(s.substr(0, s.indexOf('@')));
        s = s.substr(s.indexOf('@') + 1);
    }
    if (s.indexOf('/') >= 0) {
        this.setResource(s.substr(s.indexOf('/') + 1));
        s = s.substr(0, s.indexOf('/'));
    }
    this.setDomain(s);
};

JID.prototype.toString = function() {
    var s = this.domain;
    if (this.user)
        s = this.user + '@' + s;
    if (this.resource)
        s = s + '/' + this.resource;
    return s;
};

/**
 * Convenience method to distinguish users
 **/
JID.prototype.bare = function() {
    if (this.resource)
        return new JID(this.user, this.domain, null);
    else
        return this;
};

/**
 * Comparison function
 **/
JID.prototype.equals = function(other) {
    return this.user == other.user &&
        this.domain == other.domain &&
        this.resource == other.resource;
};

/**
 * Setters that do stringprep normalization.
 **/
JID.prototype.setUser = function(user) {
    this.user = user && nodeprep(user);
};
JID.prototype.setDomain = function(domain) {
    this.domain = domain && nameprep(domain);
};
JID.prototype.setResource = function(resource) {
    this.resource = resource && resourceprep(resource);
};

exports.JID = JID;
