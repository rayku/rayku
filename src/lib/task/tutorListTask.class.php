<?php

class tutorListTask extends sfBaseTask {

    public function configure()
    {
        $this->addOptions(array(new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'connection name'),));


        $this->namespace = 'tutor';
        $this->name      = 'list';
    }

    protected function execute($arguments = array(), $options = array()) {

        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

        /*$statusFinder=new UsersAvailabilityChecker();
        $onlineUsers=$statusFinder->getOnlineUsers();*/
        mysql_query("SELECT * FROM user")or die('Dead');

        /*foreach($onlineUsers as $onlineUser){
            if(mysql_num_rows(mysql_query("SELECT * FROM tutor_profile WHERE user_id='$onlineUser'"))>0){
                if(mysql_query("UPDATE tutor_profile SET online_status='0' WHERE user_id='$onlineUser'")){
                    $this->log('Hello, World!');
                };
            }
        }*/
    }

}


