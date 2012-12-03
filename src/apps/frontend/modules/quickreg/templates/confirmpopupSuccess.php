<div id="confirmationcontent">
<link href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/confirmcode/jquery.selectbox.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="http://<?php echo RaykuCommon::getCurrentHttpDomain();?>/css/confirmcode/popup-style.css" />
<!--filter popup-->
<div class="filter-popup"> 
  
  <!--filter popup inner-->
  <div class="filter-popup-inner"> 
  
    <!--row-1-->
    <div class="row-2">
      <h3>Success! Verify your email to ask your first question.</h3>
      <p>We have just sent you an email. Please follow the link inside to confirm your account and submit your question.</p>
    </div>
    <!--row-1-->
     
  </div>
  <!--filter popup inner--> 
  
</div>
<!--filter popup--> 

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
<script type="text/javascript">
var ccp = jQuery.noConflict();      
ccp(".filter-popup").before("<div id='trans'></div>");

ccp(".filter-popup-close").click(function(){
    
    ccp(".filter-popup").fadeOut('slow');
    ccp("#trans").fadeOut('slow');
    return false;
});

ccp('.hide').hide();

</script>
</div>
