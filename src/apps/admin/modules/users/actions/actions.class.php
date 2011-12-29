<?php

/**
 * users actions.
 *
 * @package    elifes
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class usersActions extends autousersActions
{
    public function executeDeleteUser()
    {
    }

    /**
     * Copied in from autousersActions... modification to the criteria (excludes
     * hidden accounts).
     */
    public function executeList()
    {
        // pager
        $pager = new sfPropelPager('User', false);
        $c = new Criteria();

        //Don't show hidden users
        $c->add(UserPeer::HIDDEN, false);

        //$this->addSortCriteria($c);
        //$this->addFiltersCriteria($c);
        $pager->setCriteria($c);
        $pager->setPage($this->getRequestParameter('page', 1));
        $pager->init();


        $raykuPager = new RaykuPagerRenderer($pager);
        $pagerBaseUrl = 'admin.php/users/list';
        $raykuPager->setBaseUrl( $pagerBaseUrl );
        $raykuPager->setLinkToRemoteElementId('admin_user');
        $this->raykuPager = $raykuPager;


    }

    /**
     * AJAX Action for handling the user deletion/unbanning
     */
    public function executeAjaxDeleteUser()
    {
        //Get a user object for the e-mail address entered
        $c = new Criteria();
        $c->add(UserPeer::USERNAME, $this->getRequestParameter('username'));
        $user = UserPeer::doSelectOne($c);

        //If the admin wants to delete them, forcibly delete the user entry


        if($this->getRequestParameter('commit') == 'DeleteUser')
        {

            $user->delete();
            //$user->forceDelete();
            echo 'Successfully deleted';
        }

        //If the admin wants to unban them, set them to unhidden and save

        if($this->getRequestParameter('commit') == 'UnbanUser')
        {
            $user->setHidden(0);
            $user->save();
            echo 'Successfully unbanned';
        }


        if($this->getRequestParameter('commit') == 'BanUser')
        {

            $user->setHidden(1);
            $user->save();
            echo 'Successfully banned';
        }


    }

    public function executeAutocomplete()
    {
        //Find the e-mail addresses of banned users that're like the one typed
        $c = new Criteria();

        if($this->getRequestParameter('hidden') == 'yes')
            $c->add(UserPeer::HIDDEN, true);
        else
            $c->add(UserPeer::HIDDEN, false);

        $c->add(UserPeer::USERNAME, $this->getRequestParameter('username').'%', Criteria::LIKE);
        $c->setLimit(25);

        //Send that list to the template
        $this->users = UserPeer::doSelect($c);
    }

    public function executeAjaxGivePoints()
    {
        $c = new Criteria();
        $c->add(UserPeer::USERNAME, $this->getRequestParameter('username'));

        $user = UserPeer::doSelectOne($c);
        $user->sendPointsFromAdmin($this->getRequestParameter('points'));
    }

    public function executeGivePoints()
    {
    }



    /**
     * Ban Ip Action for handling the user deletion/unbanning
     */
    public function executeBanIp()
    {
        if($this->getRequestParameter('banip') <>'')
        {
            $ips= $this->getRequestParameter('banip') ;

            $connection = RaykuCommon::getDatabaseConnection();
            $_query = mysql_query("insert into banned_ips set ip='".$ips."'  ", $connection) ;
        }
        $this->redirect('/admin.php/users/deleteUser','Successfully Ip has been banned');
    }
}
