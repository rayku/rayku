<div id="popup_content"> 
    <div id="tutors-popup">    
        <div id="tutors-popup-inner" class="clearfix">
            <h3>Selected Tutors:</h3>
            <ul id="tutor-list">            		
                <?php
                    $counter = 1;
                    foreach ($users as $user) {
                ?>
                    <li class="clearfix">
                        <div class="tutor-number">
                            <?php echo $counter++; ?>
                        </div>
                        <div class="tutor-info">
                            <p class="name"><?php echo $user->getName(); ?></p>
                            <p class="subjects"></p>
                        </div>
                    </li>
                <?php
                    }
                ?>
            </ul>
            <p class="limit">select up to <strong><?php echo $tutorsMissingCount; ?></strong> more</p>

            <a href="javascript: document.listform.submit()" onclick="return checkExpertCheckBoxes();" type="submit" id="submit_connect" class="connect-now">Connect Now</a>
        </div>
    </div> 
</div> 	