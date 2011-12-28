//*** Rater Settings ***//
var RaterSettings = Class.create({
    initialize: function()
    {
        // Defaults
        this.maxValue =         5;
        this.initalValue =      0;
        this.reRate =           true;
        this.onSrc =            '/images/rate_full.png';
        this.offSrc =           '/images/rate_empty.png';
        this.valSrc =           '/images/rate_value.png';   
    }
});

//*** Rater ***//
var Rater = Class.create({
    initialize: function(id, settings)
    {
        this.id = id;
        this.value = 0;
        this.isRated = false;
        this.settings = new RaterSettings();
        if (settings != null)
            this.settings = settings;

        this.onRate = null;
    },

    // Draws the rating control
    draw: function(rateable)
    {
        var wrapper = $(this.id);
        wrapper.innerHTML = "";

        for (var i = 1; i <= this.settings.maxValue; i++)
        {
            var img = new Element('img', {
                'id': this.id + '_' + i,
                'src': this.settings.offSrc
            });

            if (rateable)
            {
                Element.observe(img, "mouseover", function(rater)
                {
                    return function()
                    {
                        this.setStyle({ cursor: 'pointer' });
                        rater.drawValue(this.id.split('_')[1]);
                    }
                } (this));

                Element.observe(img, "mouseout", function(rater)
                {
                    return function()
                    {
                        this.setStyle({ cursor: 'default' });
                        rater.drawValue(rater.value);
                    }
                } (this));

                Element.observe(img, "click", function(rater)
                {
                    return function()
                    {
                        var value = this.id.split('_')[1];
                        rater.rate(value);
                    }
                } (this));
            }

            // Append Image
            wrapper.insert(img);
        }

        // Initial Drawing
        if (this.settings.initialValue > 0)
        {
            this.value = this.settings.initialValue;
            this.drawValue(this.value);
        }
    },

    // Fires on rate value mouseover
    hover: function(value)
    {
        this.drawValue(value);
    },

    // Fires on rate value mouseout
    leave: function()
    {
        this.drawValue(this.value);
    },

    // Sets the rating value
    rate: function(value)
    {
        this.value = value;
        
        if (!this.settings.reRate)
            this.draw(false);

        this.drawValue(value);

        if (this.onRate != null)
            this.onRate(value);

        this.isRated = true;
    },

    // Sets the value in the UI 
    drawValue: function(value, animate)
    {
        for (var i = 1; i <= this.settings.maxValue; i++)
        {
            var img = $(this.id + "_" + i);
            if (i <= value)
            {
                img.src = this.settings.onSrc;
            }
            else
            {
                if (i <= this.value && !animate)
                {
                    img.src = this.settings.valSrc;
                }
                else
                {
                    img.src = this.settings.offSrc;
                }
            }
        }
    }
});


//*** RaterHelper ***//
var RaterHelper = Class.create({
    initialize: function() { },

    // Automatically sets up Raters based on a|rel
    autoSetup: function()
    {
        var protoraters = $$('a[rel^=Protorater]');
        if (protoraters != null && protoraters.length > 0)
        {
            for (var i = 0; i < protoraters.length; i++)
            {
                var anchor = protoraters[i];

                var relHelper = new RelHelper();
                var options = relHelper.parse(anchor.rel);

                // Create Settings
                var settings = new RaterSettings();
                if (relHelper.getKVPValue(options, "maxValue") != null)
                {
                    settings.maxValue = relHelper.getKVPValue(options, "maxValue");
                }
                if (relHelper.getKVPValue(options, "initialValue") != null)
                {
                    settings.initialValue = relHelper.getKVPValue(options, "initialValue");
                }
                if (relHelper.getKVPValue(options, "onSrc") != null)
                {
                    settings.onSrc = relHelper.getKVPValue(options, "onSrc");
                }
                if (relHelper.getKVPValue(options, "offSrc") != null)
                {
                    settings.offSrc = relHelper.getKVPValue(options, "offSrc");
                }
                if (relHelper.getKVPValue(options, "valSrc") != null)
                {
                    settings.valSrc = relHelper.getKVPValue(options, "valSrc");
                }
                if (relHelper.getKVPValue(options, "reRate") != null)
                {
                    settings.reRate = eval(relHelper.getKVPValue(options, "reRate"));
                }

                // Create the Rater
                var rater = new Rater(anchor.id, settings);
                if (relHelper.getKVPValue(options, "onRate") != null)
                {
                    rater.onRate = eval(relHelper.getKVPValue(options, "onRate"));
                }

                // Determine Rateability
                var rateable = true;
                var rateableValue = relHelper.getKVPValue(options, "rateable");
                if (rateableValue != null && eval(rateableValue) == false)
                {
                    rateable = false;
                }

                // Draw the Rateable
                rater.draw(rateable);
            }
        }
    }
});

//*** RelHelper ***//
var RelHelper = Class.create({
    initialize: function() 
    { 
        this.relOptionsRegExp = new RegExp("\\w{1,}\\[(.{1,})\\]")
        this.relItemRegExp = new RegExp("[(\\w{1,})=(\\d{1,})]{1,}");
    },
    
    // Returns an Array of KVP's for a given REL option name
    // i.e. rel="OptionName[key=value,key=value]
    parse : function(rel)
    {
        var values = new Array();
        var optionMatches = this.relOptionsRegExp.exec(rel);
        if(optionMatches != null)
        {
            var options = optionMatches[1].split(",");
            if(options != null)
            {
                for(var i=0;i<options.length;i++)
                {
                    var option = options[i].split("=");
                    if(option != null)
                    {
                         values.push([option[0], option[1]]);
                    }
                }
            }
        }        
        return values;
    },
    
    // Gets a KVP value from a List for a given key
    getKVPValue : function(list, key)
    {
        for(var i=0;i<list.length;i++)
        {
            if(list[i][0] == key)
            {
                return list[i][1]; 
            }
        }
        return null;
    }
});

/////////////////////////////////////////////////////////////////////////

// Auto Setup Raters
Event.observe(window, "load", function(){
    new RaterHelper().autoSetup();
});

