<?php

exec("ruby /var/www/rayku.com/src/public_html/friendship_bot.rb", $o);
echo implode("<br/>", $o);

?>