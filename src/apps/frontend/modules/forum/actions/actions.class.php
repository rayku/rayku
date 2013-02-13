<?php

/**
 * forum actions.
 *
 * @package    elifes
 * @subpackage forum
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class forumActions extends sfActions
{

	public function preExecute()
	{
		return sfView::ERROR;
	}
	
    public function executeIndex()
    {
        $this->redirect('/tutors', '200');
        /*$a = new Criteria();
        $users = UserPeer::doSelect($a);
//print_r($users);
        $onlineusers = 0;

        foreach ($users as $user) {
            if ($user->isOnline()) {
                $onlineusers = $onlineusers + 1;
            }
        }
        //echo $onlineusers;
        $onlineusers = $onlineusers;
        if ($onlineusers == 0) {
            $onlineusers_msg = "(All members are in offline)";
        }
        if ($onlineusers == 1) {
            $onlineusers_msg = "(One member is in online)";
        }
        if ($onlineusers > 1) {
            $onlineusers_msg = "({$onlineusers} members are in online)";
        }
        $this->onlineusers_msg = $onlineusers_msg;




        if (!empty($_COOKIE["timer"])) {
            $this->redirect('/dashboard/rating');
        }

        if (!empty($_GET['post_id'])) {
            $this->getResponse()->setCookie("_post_Id", $_GET['post_id'], time() + 600, '/', sfConfig::get('app_cookies_domain'));
            $_COOKIE['_post_Id'] = 100;
        }

        $c = new Criteria();
        $c->add(ForumPeer::TYPE, 0);
        $this->publicforums = ForumPeer::doSelect($c);
        $this->categories = CategoryPeer::doSelect(new Criteria());

        $l = new Criteria();
        $l->addDescendingOrderByColumn(ThreadPeer::ID);
        $l->add(ThreadPeer::CANCEL, 0);
        $l->setLimit(5);
        $this->latest = ThreadPeer::doSelect($l);*/
    }

    public function executeSearch()
    {



        $this->keyword = $this->getRequestParameter('threadsearch');

        //	$this->forumId=$this->getRequestParameter('forum_id');

        $c = new Criteria();
        $s = $c->getNewCriterion(ThreadPeer::TITLE, '%' . $this->keyword . '%', Criteria::LIKE);
        $s->addOr($c->getNewCriterion(ThreadPeer::TAGS, '%' . $this->keyword . '%', Criteria::LIKE));
        $c->add($s);

        //Setup the pager and grab the appropriate resultset
        $pager = new sfPropelPager('Thread', 12);
        $pager->setCriteria($c);
        $pager->setPage($this->getRequestParameter('page', 1));
        $pager->init();

        $raykuPager = new RaykuPagerRenderer($pager);
        $raykuPager->setBaseUrl('forum/search' . ( $this->keyword != '' ? '?threadsearch=' . $this->keyword : '' ));

        $this->raykuPager = $raykuPager;
    }

    public function executeBestresponse()
    {
        $this->post = PostPeer::retrieveByPK($this->getRequestParameter('post_id'));

        if (!$this->post instanceof Post) {
            return sfview::ERROR;
        }

        $this->post->setBestResponse(1);
        $this->post->save();



        $connection = RaykuCommon::getDatabaseConnection();


        $query = mysql_query("select * from user_score where user_id =" . $this->post->getPosterId(), $connection) or die(mysql_error());
        $row = mysql_fetch_assoc($query);

        $newScore = $row['score'] + 25;

        mysql_query("update user_score set score = " . $newScore . " where user_id =" . $this->post->getPosterId(), $connection) or die(mysql_error());

        $newScore = '';


        $this->sendBestResponseMessage($this->post);

        return $this->redirect('@view_thread?thread_id=' . $this->post->getThreadId());
    }

    private function sendBestResponseMessage($post)
    {
        $user = UserPeer::retrieveByPK($post->getPosterId());
        $thread = ThreadPeer::retrieveByPK($post->getThreadId());

        $cats = CategoryPeer::getForExpertCategoryUserId($user->getId());

        $cat_tab = array();
        foreach ($cats as $cat) {
            $cat_tab[] = $cat->getName();
        }

        $cat_list = join(', ', $cat_tab);


        if ($user->getType() == UserPeer::getTypeFromValue('expert')) {
            $subject = 'Best Response Selected';
            $body = 'Hi ' . $user->getName() . ',<br><br>
          Your reply to the question, "' . $thread->getTitle() . '" on the question boards, was just selected as the best response.<br><br>
		  Rayku SYS';

            //Grab the user object
            $currentuser = UserPeer::retrieveByPK($this->getUser()->getRaykuUserId());

            //Send the messages
            $currentuser->sendMessage($user->getId(), $subject, $body);
        } else {
            $subject = 'Best Response Selected';
            $body = 'Hi ' . $user->getName() . ',<br><br>
          Congratulations! Your reply to the question, "' . $thread->getTitle() . '" on the question boards, was just selected as the best response.<br><br>
          Your expert score has been increased accordingly.<br><br>
		  Thanks!<br>
		  Rayku SYS'
            ;

            //Grab the user object
            $currentuser = UserPeer::retrieveByPK($this->getUser()->getRaykuUserId());

            //Send the messages
            $currentuser->sendMessage($user->getId(), $subject, $body);
        }


        $sub1 = 'You have selected an Expert Best Response';
        $body1 = 'Hi ' . $this->getUser()->getRaykuUser()->getName() . ',<br><br>
      Thank you for selecting a best response for your question. The author of the response is ' . $user->getName() . ', who is an expert in the following subjects: <br>
	  ' . $cat_list . '<br><br>
      ' . $user->getName() . ' has been teaching avid learners with Rayku since ' . $user->getCreatedAt('Y-m-d') . '. Take a look at the following link, for information on spending an 1-on-1 session with ' . $user->getName() . ':<br><br>
	  <a href="'.sfConfig::get('app_rayku_url').'/expertmanager/portfolio/' . $user->getUsername() . '">http://www.rayku.com/expertmanager/portfolio/' . $user->getUsername() . '</a><br><br>
	  Rayku SYS';

        //Grab the user object
        $expertuser = UserPeer::retrieveByPK($user->getId());

        //Send the messages
        $expertuser->sendMessage($this->getUser()->getRaykuUserId(), $sub1, $body1);
    }

    public function executeThreadstatus()
    {
        $this->threadId = $this->getRequestParameter('thread_id');
        $this->status = $this->getRequestParameter('status');

        $this->thread = ThreadPeer::retrieveByPK($this->threadId);


        if ($this->status == 'delete') {

            $_redirect = 'forum/' . $this->thread->getForumId() . '';

            $this->thread->delete();

            return $this->redirect($_redirect);
        }



        if ($this->status == 'close') {

            $this->thread->setVisible(0);
            $this->thread->save();

            return $this->redirect('@view_thread?thread_id=' . $this->thread->getId());
            //		$this->msg="Your thread '".$this->thread->getTitle()."' is successfully closed!";
        }

        if ($this->status == 'cancel') {
            $this->thread->setCancel(1);
            $this->thread->save();

            return $this->redirect('forum/' . $this->thread->getForumId());
            //	return $this->forward('forum', $this->thread->getForumId());
        }



        if ($this->status == 'reactive') {
            $this->thread->setVisible(1);
            $this->thread->save();

            return $this->redirect('@view_thread?thread_id=' . $this->thread->getId());
            //		$this->msg="Your thread  '".$this->thread->getTitle()."'  is successfully re-activated!";
        }
    }

    public function executeForum()
    {


        $this->userId = $this->getUser()->getRaykuUserId();

        $c = new Criteria();
        $c->add(ForumPeer::TYPE, 0);
        $this->publicforums = ForumPeer::doSelect($c);

        $this->category = CategoryPeer::retrieveByPK($this->getRequestParameter('forum_id'));

        if (!$this->category instanceof Category) {
            $this->category = ForumPeer::retrieveByPK($this->getRequestParameter('forum_id'));
        }

        $this->allcategories = CategoryPeer::doSelect($c = new Criteria());

        $this->page = $this->getRequestParameter('page', 1);
        $this->threadsPerPage = sfConfig::get('app_forum_threads_per_page');
    }

    public function executeThread()
    {

        if (@$_GET['follow'] <> '' and @$_GET['expert_id'] <> '') {


            $connection = RaykuCommon::getDatabaseConnection();
            $userid = $_GET['user_id'];
            $expertid = $_GET['expert_id'];
            $query = mysql_query("select * from expert_subscribers where
					 expert_id = " . $expertid . " and user_id =" . $userid, $connection) or die(mysql_error());

            if (mysql_num_rows($query) == 0) {

                mysql_query("insert into expert_subscribers(expert_id, user_id)
					 values('" . $expertid . "', '" . $userid . "')", $connection) or die(mysql_error());

                $queryScore = mysql_query("select * from user_score where user_id =" . $expertid, $connection) or die(mysql_error());
                $rowScore = mysql_fetch_assoc($queryScore);
                $newScore = '';

                $newScore = $rowScore['score'] + 10;

                mysql_query("update user_score set score = " . $newScore . " where user_id =" . $expertid, $connection) or die(mysql_error());
            }
        }

        if (@$_GET['report'] <> '') {

            $curr_date = date("Y-m-d H:i:s");
            $connection = RaykuCommon::getDatabaseConnection();
            if ($_GET['thread_id'] <> '') {
                $thread_id = $_GET['thread_id'];

                $query = mysql_query("select * from thread where
					 id = " . $thread_id . " and  reported=1", $connection) or die(mysql_error());

                if (mysql_num_rows($query) == 0) {

                    mysql_query("update thread set reported=1,reported_date='" . $curr_date . "' where id=" . $thread_id, $connection) or die(mysql_error());
                }
            }

            if (@$_GET['post_id'] <> '') {
                $post_id = $_GET['post_id'];

                $query = mysql_query("select * from post where
					 id = " . $post_id . " and  reported=1", $connection) or die(mysql_error());

                if (mysql_num_rows($query) == 0) {

                    mysql_query("update post set reported=1 ,reported_date='" . $curr_date . "' where id=" . $post_id, $connection) or die(mysql_error());
                }
            }
        }

        $this->curr_url = "http://www." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        /////////current user id
        //$this->current_user_id= $this->getUser()->getRaykuUser()->getId();

        $_SESSION['post_index'] = 1;

        $c = new Criteria();
        $c->add(ForumPeer::TYPE, 0);
        $this->publicforums = ForumPeer::doSelect($c);

        $this->allcategories = CategoryPeer::doSelect(new Criteria());

        $this->thread = ThreadPeer::retrieveByPK($this->getRequestParameter('thread_id'));


        if (!$this->thread) {
            return sfView::ERROR;
        }


        $this->category = CategoryPeer::retrieveByPK($this->thread->getCategoryId());
        if (!$this->category instanceof Category) {
            $this->category = ForumPeer::retrieveByPK($this->thread->getCategoryId());
        }


        //Set the page and posts per page
        $this->page = $this->getRequestParameter('page', 1);
        $this->postsPerPage = sfConfig::get('app_forum_posts_per_page');





        //Set the link at the bottom
        /* if($this->thread->getForum()->getType() == Forum::TYPE_GROUP_FORUM)
          $this->link = array('Back to Group', '@group?id='.$this->thread->getForum()->getEntityId());
          elseif($this->thread->getForum()->getType() == Forum::TYPE_USER_FORUM)
          $this->link = array('Back to Profile', '@profile?username='.UserPeer::retrieveByPk($this->thread->getForum()->getEntityId())->getUsername());
          else
          $this->link = array('Back to Forum', '@view_forum?forum_id='.$this->thread->getForumId()); */
    }

    /**
     * The action to actually create a post or thread
     * 
     * Displays a message in a <div> which can be used for an AJAX call
     */
    public function executeMakePost()
    {

        //If the forumID passed isn't a number (usually because it's null),
        //display an error
        //if(!is_numeric($this->getRequestParameter('forum_id')))
        //	{
        //	$this->msg = 'No forum was specified... please try again.';
        //	return sfView::SUCCESS;
        //	}
        //If the post body wasn't set
        if ($this->getRequestParameter('post_body') == '') {
            $this->msg = "You can't make an empty post!";
            return sfView::SUCCESS;
        }

        //Grab the user
        $user = $this->getUser()->getRaykuUser();
        /* @var $user User */

        //If no forum ID was specified or the user can't access this forum
        //return an error... canAccessForum will confirm that forum_id actually 
        //points at a valid forum
        //if (!$this->getRequestParameter('forum_id') ||
        //	(!$this->getUser()->isAuthenticated() || !$user->canAccessForum($this->getRequestParameter('forum_id'))))
        //	{
        //	$this->msg = 'You do not have permission to access this forum.';
        //	return sfView::SUCCESS;
        //	}
        //If the threadID isn't set, then the user is making a new thread
        if (!is_numeric($this->getRequestParameter('thread_id'))) {
            //If the user hasn't given the thread a title...
            if ($this->getRequestParameter('thread_title') == '') {
                $this->msg = 'You must specificy a title for your thread.';
                return sfView::SUCCESS;
            }

            $school_grade = $this->getRequestParameter('school_grade');

            $tags = $this->getRequestParameter('tags');

            $arrayoftags = explode(',', $tags);

            foreach ($arrayoftags as $tag) {
                if ($tag == 'I') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'a') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'about') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'an') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'are') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'as') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'at') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'be') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'by') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'com') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'de') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'en') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'for') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'from') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'how') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'in') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'is') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'it') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'la') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'of') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'on') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'or') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'that') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'the') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'this') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'to') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'was') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'what') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'when') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'where') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'who') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'will') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'with') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'und') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'the') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
                if ($tag == 'www') {
                    $this->msg = $tag . ' is a stop word, please add the proper tag';
                    return sfView::SUCCESS;
                }
            }

            //Make the thread or display an error if there was an issue
            $thread = $user->makeNewThread(
                $this->getRequestParameter('forum_id'), $this->getRequestParameter('thread_title'), $this->getRequestParameter('post_body'), $this->getRequestParameter('category_id'), $this->getRequestParameter('notify_email'), $this->getRequestParameter('notify_pm'), $this->getRequestParameter('tags'), $this->getRequestParameter('school_grade')
            );
            if (!$thread) {
                $this->msg = 'Sorry, the thread could not be created due to a database entry error. Please try again.';
                return sfView::SUCCESS;
            }

            //Set the message to a success message
            $this->msg = 'Thread successfully created.';
            return sfView::SUCCESS;
        }

        //Otherwise, they're trying to create a post within a thread
        else {
            //Make the post and display an error if it fails
            if (!$user->makeNewPost($this->getRequestParameter('thread_id'), $this->getRequestParameter('post_body'))) {
                $this->msg = 'Sorry, the post could not be created due to a database entry error. Please try again.';
                return sfView::SUCCESS;
            }

            if ($this->getUser()->getRaykuUser()->getType() == '5') {
                $c = new Criteria();
                $c->add(ThreadPeer::ID, $this->getRequestParameter('thread_id'));
                $thread = ThreadPeer::doSelectOne($c);

                $c = new Criteria();
                $c->add(UserPeer::ID, $thread->getPosterId());
                $user = UserPeer::doSelectOne($c);


                if ($thread->getNotifyPm() == '1') {
                    $subject = 'Expert Response to your Question';
                    $body = 'Hi there,<br>
							A Rayku expert, "' . $this->getUser()->getRaykuUser()->getName() . '", has just responded to your question (below) on the question boards. Take a look!<br><br>
							' . $thread->getTitle();

                    //Grab the user object
                    $currentuser = UserPeer::retrieveByPK($this->getUser()->getRaykuUserId());

                    //Send the message
                    $currentuser->sendMessage($user->getId(), $subject, $body);
                }

                if ($thread->getNotifyEmail() == '1') {
                    $this->mail = new sfMail();

                    //Set the to, from, and subject headers

                    $this->mail->addAddress($user->getEmail());
                    $this->mail->setFrom('Expert <' . $this->getUser()->getRaykuUser()->getEmail() . '>');
                    $this->mail->setSubject('Expert Response for your Question');
                    $this->mail->setBody('Hi there,<br>
							A Rayku expert, "' . $this->getUser()->getRaykuUser()->getName() . '", has just responded to your question (below) on the question boards. Take a look!<br><br>
							' . $thread->getTitle() . '');

                    $this->mail->send();
                }
            }

            //Set the message to a success message
            $this->msg = 'Post successfully created.';
            return sfView::SUCCESS;
        }
    }

    public function executeEdit()
    {


        $c = new Criteria();
        $c->add(ForumPeer::TYPE, 0);
        $this->publicforums = ForumPeer::doSelect($c);


        $this->category = CategoryPeer::retrieveByPK(125);

        if (!$this->category instanceof Category) {
            $this->category = ForumPeer::retrieveByPK(125);
        }


        $this->allcategories = CategoryPeer::doSelect($c = new Criteria());

        $user = $this->getUser()->getRaykuUser();
    }

    public function executeNewThread()
    {



        $this->User = $this->getUser()->getRaykuUser();


        if (!empty($_COOKIE['redirection'])) {
            $this->getResponse()->setCookie("redirection", "", time() - 600, '/', sfConfig::get('app_cookies_domain'));
        }


        $c = new Criteria();
        $c->add(ForumPeer::TYPE, 0);
        $this->publicforums = ForumPeer::doSelect($c);


        $this->category = CategoryPeer::retrieveByPK($this->getRequestParameter('forum_id'));

        if (!$this->category instanceof Category) {
            $this->category = ForumPeer::retrieveByPK($this->getRequestParameter('forum_id'));
        }


        $this->allcategories = CategoryPeer::doSelect($c = new Criteria());

        $user = $this->getUser()->getRaykuUser();

        if ($this->getRequestParameter('thread_title') != '') {




            $theard_title_len = strlen($this->getRequestParameter('thread_title'));
            $theard_body_len = strlen(strip_tags($this->getRequestParameter('post_body')));

            if ($theard_title_len >= 10 and $theard_body_len >= 10) {

                $school_grade = $this->getRequestParameter('school_grade');

                $tags = $this->getRequestParameter('tags');

                $arrayoftags = explode(',', $tags);

                foreach ($arrayoftags as $tag) {
                    if ($tag == 'I') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'a') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'about') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'an') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'are') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'as') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'at') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'be') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'by') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'com') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'de') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'en') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'for') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'from') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'how') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'in') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'is') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'it') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'la') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'of') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'on') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'or') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'that') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'the') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'this') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'to') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'was') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'what') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'when') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'where') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'who') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'will') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'with') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'und') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'the') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                    if ($tag == 'www') {
                        $this->msg = $tag . ' is a stop word, please add the proper tag';
                        return sfView::SUCCESS;
                    }
                }


                $thread = $user->makeNewThread(
                    $this->getRequestParameter('forum_id'), $this->getRequestParameter('thread_title'), $this->getRequestParameter('post_body'), $this->getRequestParameter('forum_id'), $this->getRequestParameter('notify_email'), $this->getRequestParameter('notify_pm'), $this->getRequestParameter('tags'), $this->getRequestParameter('school_grade'), $this->getRequestParameter('stickie')
                );





                $l = new Criteria();
                $l->addDescendingOrderByColumn(PostPeer::ID);
                $l->setLimit(1);
                $latest = PostPeer::doSelect($l);

                $stickie = 0;

                if ($this->getRequestParameter('stickie') == 1) {

                    $stickie = 1;
                }


                ///////////////////updating the ip of the user

                $connection = RaykuCommon::getDatabaseConnection();

                mysql_query("update thread set user_ip='" . $_SERVER['REMOTE_ADDR'] . "', stickie = " . $stickie . " where id=" . $latest[0]->getThreadId() . "", $connection);

                ///////////////////updating the ip of the user

                return $this->redirect('@view_thread?thread_id=' . $latest[0]->getThreadId());
            } else {

                if ($theard_title_len < 10) {
                    $this->title_error = "Title should be more than 10 characters";
                }
                if ($theard_body_len < 10) {
                    $this->desc_error = "Description should be more than 10 characters";
                }
            }
        }
    }

    public function executeUserReplyThread()
    {
        $connection = RaykuCommon::getDatabaseConnection();



        $c = new Criteria();
        $c->add(ForumPeer::TYPE, 0);
        $this->publicforums = ForumPeer::doSelect($c);

        $this->allcategories = CategoryPeer::doSelect($c = new Criteria());


        $this->forum = $this->getRequestParameter('forum_id');
        $this->thread = ThreadPeer::retrieveByPK($this->getRequestParameter('thread_id'));

        $c = new Criteria();
        $c->add(PostPeer::THREAD_ID, $this->thread->getId());
        $this->post = PostPeer::doSelectOne($c);


        $user = $this->getUser()->getRaykuUser();





        if ($this->getRequestParameter('post_edit_content') != '') {


            $threadId = $this->getRequestParameter('thread_id');

            $_thread = ThreadPeer::retrieveByPK($threadId);

            $_post_time = strtotime($_thread->getCreatedAt());

            $_post_time += 300;

            $_now = time();

            if ($_now < $_post_time) {

                $_thread->setTitle($this->getRequestParameter('post_edit_title'));
                $_thread->save();

                $v = new Criteria();
                $v->add(PostPeer::THREAD_ID, $threadId);
                $v->addAscendingOrderByColumn(PostPeer::ID);
                $post = PostPeer::doSelectOne($v);

                $post->setContent($this->getRequestParameter('post_edit_content'));
                $post->save();
            } else {

                $_SESSION['edit_error'] = 1;
            }


            return $this->redirect('@view_thread?thread_id=' . $threadId);
        }

        if ($this->getRequestParameter('post_body') != '') {

            if ($this->getRequestParameter('final_id') != '') {

                $_quick_reply = '';




                $_post_id = $this->getRequestParameter('final_id');

                $_Post = PostPeer::retrieveByPK($_post_id);

                $_User = UserPeer::retrieveByPK($_Post->getPosterId());



                $_quick_reply .= "<div style='margin-left:20px'><em><strong>Quote from " . $_User->getUsername() . "</strong></em><br><br>";

                $_explode_post = explode("*^-", $_Post->getContent());

                if (count($_explode_post) > 1) {

                    $_quick_reply .= $_explode_post[1];
                } else {

                    $_quick_reply .= $_Post->getContent();
                }

                $_quick_reply .= "</div>";



                $_post_body_msg = $this->getRequestParameter('post_body');



                $_quick_reply .= $_post_body_msg;

                $user->makeNewPost($this->getRequestParameter('thread_id'), $_quick_reply);


                ///////////////////updating the ip of the user

                $post_id = mysql_fetch_row(mysql_query("SELECT max(id) from post limit 0,1", $connection));


                mysql_query("update post set 	user_ip='" . $_SERVER['REMOTE_ADDR'] . "' where id=" . $post_id[0] . "", $connection);

                ///////////////////updating the ip of the user
            } else {

                $user->makeNewPost($this->getRequestParameter('thread_id'), $this->getRequestParameter('post_body'));


                ///////////////////updating the ip of the user

                $post_id = mysql_fetch_row(mysql_query("SELECT max(id) from post limit 0,1", $connection));


                mysql_query("update post set 	user_ip='" . $_SERVER['REMOTE_ADDR'] . "' where id=" . $post_id[0] . "", $connection);

                ///////////////////updating the ip of the user
            }


            return $this->redirect('@view_thread?thread_id=' . $this->thread->getId());
        }
    }

    public function executeExpertReplyThread()
    {



        $connection = RaykuCommon::getDatabaseConnection();

        $c = new Criteria();
        $c->add(ForumPeer::TYPE, 0);
        $this->publicforums = ForumPeer::doSelect($c);

        $this->allcategories = CategoryPeer::doSelect($c = new Criteria());


        $this->forum = $this->getRequestParameter('forum_id');
        $this->thread = ThreadPeer::retrieveByPK($this->getRequestParameter('thread_id'));

        $c = new Criteria();
        $c->add(PostPeer::THREAD_ID, $this->thread->getId());
        $this->post = PostPeer::doSelectOne($c);


        $user = $this->getUser()->getRaykuUser();

        if ($this->getRequestParameter('post_edit_content') != '') {


            $threadId = $this->getRequestParameter('thread_id');

            $_thread = ThreadPeer::retrieveByPK($threadId);

            $_thread->setTitle($this->getRequestParameter('post_edit_title'));
            $_thread->save();



            $v = new Criteria();
            $v->add(PostPeer::THREAD_ID, $threadId);
            $v->addAscendingOrderByColumn(PostPeer::ID);
            $post = PostPeer::doSelectOne($v);

            $post->setContent($this->getRequestParameter('post_edit_content'));
            $post->save();


            return $this->redirect('@view_thread?thread_id=' . $threadId);
        }


        if ($this->getRequestParameter('post_body') != '') {


            if ($this->getRequestParameter('final_id') != '') {

                $_quick_reply = '';




                $_post_id = $this->getRequestParameter('final_id');

                $_Post = PostPeer::retrieveByPK($_post_id);

                $_User = UserPeer::retrieveByPK($_Post->getPosterId());



                $_quick_reply .= "<div style='margin-left:20px'><em><strong>Quote from " . $_User->getUsername() . "</strong></em><br><br>";

                $_explode_post = explode("*^-", $_Post->getContent());

                if (count($_explode_post) > 1) {

                    $_quick_reply .= $_explode_post[1];
                } else {

                    $_quick_reply .= $_Post->getContent();
                }
                $_quick_reply .= "</div>";



                $_post_body_msg = $this->getRequestParameter('post_body');



                $_quick_reply .= $_post_body_msg;

                $user->makeNewPost($this->getRequestParameter('thread_id'), $_quick_reply);
                ///////////////////updating the ip of the user

                $post_id = mysql_fetch_row(mysql_query("SELECT max(id) from post limit 0,1", $connection));


                mysql_query("update post set 	user_ip='" . $_SERVER['REMOTE_ADDR'] . "' where id=" . $post_id[0] . "", $connection);

                ///////////////////updating the ip of the user
            } else {




                $user->makeNewPost($this->getRequestParameter('thread_id'), $this->getRequestParameter('post_body'));
                ///////////////////updating the ip of the user

                $post_id = mysql_fetch_row(mysql_query("SELECT max(id) from post limit 0,1", $connection));


                mysql_query("update post set 	user_ip='" . $_SERVER['REMOTE_ADDR'] . "' where id=" . $post_id[0] . "", $connection);

                ///////////////////updating the ip of the user
            }


            if ($this->getUser()->getRaykuUser()->getType() == '5') {
                $c = new Criteria();
                $c->add(ThreadPeer::ID, $this->getRequestParameter('thread_id'));
                $thread = ThreadPeer::doSelectOne($c);

                $c = new Criteria();
                $c->add(UserPeer::ID, $thread->getPosterId());
                $user = UserPeer::doSelectOne($c);





                if ($thread->getNotifyPm() == '1') {
                    $subject = 'Expert Response for your Question';
                    $body = 'Hi there, <br><br>
							A Rayku expert, "' . $this->getUser()->getRaykuUser()->getName() . '" has just responsed to your question, "' . $thread->getTitle() . '" on the question boards. Take a look!<br><br>
							Rayku Administration';

                    //Grab the user object
                    $currentuser = UserPeer::retrieveByPK($this->getUser()->getRaykuUserId());

                    //Send the message
                    $currentuser->sendMessage($user->getId(), $subject, $body);
                }

                if ($thread->getNotifyEmail() == '1') {
                    $this->mail = new sfMail();

                    //Set the to, from, and subject headers

                    $this->mail->addAddress($user->getEmail());
                    $this->mail->setFrom('Expert <' . $this->getUser()->getRaykuUser()->getEmail() . '>');
                    $this->mail->setSubject('Expert Response to your Question');
                    $this->mail->setBody('Hi there,<br>
							A Rayku expert, "' . $this->getUser()->getRaykuUser()->getName() . '", has just responded to your question (below) on the question boards. Take a look!<br><br>
							' . $thread->getTitle() . '');

                    $this->mail->send();
                }
            }



            return $this->redirect('@view_thread?thread_id=' . $this->thread->getId());
        }
    }

}
