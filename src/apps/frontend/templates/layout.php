<?php
RaykuCommon::getDatabaseConnection();
$baseRootPath = sfContext::getInstance()->getRequest()->getRelativeUrlRoot();

if(( sfContext::getInstance()->getModuleName() == 'start' )) :
	
	include('layout_start.php');
	
elseif(( sfContext::getInstance()->getModuleName() == 'jobs' )):
	
	include('layout_jobs.php');

elseif(( sfContext::getInstance()->getModuleName() == 'dev' )):
	
	include('layout_dev.php');

elseif(( sfContext::getInstance()->getModuleName() == 'ryerson' )):
	
	include('layout_ryerson.php');

elseif(( sfContext::getInstance()->getModuleName() == 'static' )):
	
	include('layout_about.php');

else:
	include('layout_all.php');
	
endif;


//////////////////////////////////////////////////////////////
// Layout functions (TODO: move them to an external file)
//////////////////////////////////////////////////////////////

function templateGoogleAnalytics() {
	if ($_SERVER['HTTP_HOST'] != 'local.rayku.com') {
?>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-21399448-5']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
<?php
	}
}

function templateUserVoice() {
	if ($_SERVER['HTTP_HOST'] != 'local.rayku.com') {
?>
<script type="text/javascript">
	var uvOptions = {};
	(function() {
		var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
		uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/zFbqWgC8UzwfpVPULytOQ.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
	})();
</script>
<?php
	}
}
?>
