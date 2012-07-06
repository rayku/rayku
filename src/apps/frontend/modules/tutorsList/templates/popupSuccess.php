<div id="popup_content"> 
    <div id="tutors-popup">    
        <div id="tutors-popup-inner" class="clearfix">
            <h3>Selected Tutors:</h3>
            <ul id="tutor-list">            		
                <?php
                    foreach ($users as $user) {
                ?>
                    <li class="clearfix">
                        <div class="tutor-number">
                            LP_TODO
                        </div>
                        <div class="tutor-info">
                            <p class="name"><?php echo $user->getName(); ?></p>
                            <p class="subjects">USER COURSE _ TODO</p>
                        </div>
                    </li>
                <?php
                    }
                ?>
            </ul>
            <p class="limit">select up to <strong>REMAIN_COUNT_TODO</strong> more</p>

            <a href="#" class="connect-now">Connect Now_TODO</a>
        </div>
    </div> 
</div> 	