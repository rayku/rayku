<?php

class tutorListTask extends sfBaseTask {

    public function configure()
    {
    	$this->addOptions(array(
    			new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
    			new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
    	));
    	
        $this->namespace = 'tutor';
        $this->name      = 'list';
    }

    protected function execute($arguments = array(), $options = array()) {
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase('propel')->getConnection();

        $statusFinder=new UsersAvailabilityChecker();
        $onlineUsers=$statusFinder->getOnlineUsers();

        foreach($onlineUsers as $onlineUser){
            if(mysql_num_rows(mysql_query("SELECT * FROM tutor_profile WHERE user_id='$onlineUser'"))>0){
                if(mysql_query("UPDATE tutor_profile SET online_status='0' WHERE user_id='$onlineUser'")){
                    $this->log('Hello, World!');
                };
            }
        }
    }

}


