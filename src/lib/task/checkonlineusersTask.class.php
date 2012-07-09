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
        require_once dirname(__DIR__) . '/vendor/RaykuCommunicationChannelService/src/load.php';
        
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
        
        $CCS = new Rayku\CommunicationChannel\Service();
        $totalCount = 0;
        $counts = $CCS->getOnlineUsersCountByCC();
        foreach ($counts as $cc => $ccCount) {
            $totalCount+= $ccCount;
            StatsD::timing('onlineUsers'.ucfirst($cc), $ccCount);
        }
        
        StatsD::timing('onlineUsersTotal', $totalCount);
    }

}
