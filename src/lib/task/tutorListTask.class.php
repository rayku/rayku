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

        $c = new Criteria();
        $c->add(TutorProfilePeer::ONLINE_STATUS, 1);
        $currentlyOnlineTutors = TutorProfilePeer::doSelect($c);
        foreach($currentlyOnlineTutors as $onlineTutor){
        	$onlineTutor->setOnlineStatus(0);
        	$onlineTutor->save();
        }
        
        foreach($onlineUsers as $onlineUser){
        	$user = UserPeer::retrieveByPk($onlineUser);
        	if($user){
	        	$user->setLastActivityAt(date("Y-m-d H:i:s"));
	        	$user->save();
	        	$c = new Criteria();
	        	$c->add(TutorProfilePeer::USER_ID, $onlineUser);
	        	$tutorProfile = TutorProfilePeer::doSelectOne($c);
	        	if($tutorProfile){
		        	$tutorProfile->setOnlineStatus(1);
		        	$tutorProfile->save();
	        	}
        	}
        }
        StatsD::gauge('user.online', count($onlineUsers));
    }
}


