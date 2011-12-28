<?php 
   include "config.php";
       ?>
	  
<html>
    <head>
        <title>FB Rayku Connect</title>
      
   
    </head>
    <body>
    <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({appId: '<?php echo $apik;?>', status: true, cookie: true, xfbml: true});
			 FB.Event.subscribe('auth.login', function(response) {
        window.location="<?php echo $process_url;?>";})
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());
			

        </script>

        
            <fb:login-button v="2" size="xlarge" length="long" perms="status_update,publish_stream,user_birthday,user_hometown,user_about_me,user_activities,user_interests,user_location,user_relationship_details">Finish Profile with Facebook</fb:login-button>
       
		
    

      
    </body>
</html>