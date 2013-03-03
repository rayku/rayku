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
        	$user = UserPeer::retrieveByPk($onlineUser);
        	$user->setLastActivityAt(date("Y-m-d H:i:s"));
        	$user->save();
        	$c = new Criteria();
        	$c->add(TutorProfilePeer::USER_ID, $onlineUser);
        	$tutorProfile = TutorProfilePeer::doSelectOne($c);
        	$tutorProfile->setOnlineStatus(1);
        	$tutorProfile->save();
        }
        StatsD::increment('user.online', count($onlineUsers));
    }
}


