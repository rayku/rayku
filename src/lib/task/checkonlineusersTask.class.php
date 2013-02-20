<?php

/**
 * This task should be launched using cron 
 * It just check how many online users we have on each IM and sends those numbers to statsD
 */
class checkonlineusersTask extends sfBaseTask
{

    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
        ));

        $this->namespace = 'rayku';
        $this->name = 'check-online-users';
    }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
        
        RaykuCommon::getDatabaseConnection();
        $uac = new UsersAvailabilityChecker();
        $onlineusers=$uac->getOnlineUsersByCategory();
        foreach($onlineusers['students'] as $protocol=>$nr){
            if($protocol=='web'){
                StatsD::increment('students.online.web', $nr);
            }elseif($protocol=='fb'){
                StatsD::increment('students.online.fb', $nr);
            }elseif($protocol=='gtalk'){
                StatsD::increment('students.online.gtalk', $nr);
            }else{
                continue;
            }
        }
        foreach($onlineusers['tutors']  as $protocol=>$nr){
            if($protocol=='web'){
                StatsD::increment('tutors.online.web', $nr);
            }elseif($protocol=='fb'){
                StatsD::increment('tutors.online.fb', $nr);
            }elseif($protocol=='gtalk'){
                StatsD::increment('tutors.online.gtalk', $nr);
            }else{
                continue;
            }
        }
        StatsD::timing('onlineUsersTotal', $uac->getOnlineUsersCount());
    }

}
