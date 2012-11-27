<?php

/**
 * Subclass for performing query and update operations on the 'user' table.
 */
class UserPeer extends BaseUserPeer
{

    protected static $typeCodes = array(1 => 'user', 3 => 'moderator', 4 => 'admin', 5 => 'expert');
    protected static $typeValues;
    protected static $genderCodes = array(0 => 'male', 1 => 'female');
    protected static $genderValues;
    protected static $relationshipStatusCodes = array(0 => 'undisclosed', 1 => 'single', 2 => 'in a relationship', 3 => 'married');
    protected static $relationshipStatusValues;

    /**
     * Returns the value associated with a given typeCode index
     */
    public static function getTypeFromIndex($index)
    {
        if (!isset(self::$typeCodes[$index])) {
            throw new PropelException('There is no User type for index ' . $index);
        }

        return self::$typeCodes[$index];
    }

    /**
     * Returns the index associated with a given typeCode value. Makes the
     * typeCode value lower-case before passing it.
     *
     * @param string $value
     *
     * @return int
     */
    public static function getTypeFromValue($value)
    {
        if (!self::$typeValues) {
            self::$typeValues = array_flip(self::$typeCodes);
        }

        if (!isset(self::$typeValues[$value])) {
            throw new PropelException('"' . $value . '" is not a valid User type.');
        }

        return self::$typeValues[strtolower($value)];
    }

    public static function checkLogin($sEmail, $sPassword)
    {
        $c = new Criteria();
        $c->add(UserPeer::EMAIL, $sEmail);
        $c->add(UserPeer::PASSWORD, sha1($sPassword));

        return UserPeer::doSelectOne($c);
    }

    /**
     * Returns the value associated with a given gender index
     *
     * @param int $index
     * @return string
     */
    public static function getGenderFromIndex($index)
    {
        if (!isset(self::$genderCodes[$index])) {
            return null;
        }

        return self::$genderCodes[$index];
    }

    /**
     * Returns the index associated with a given gender value. Makes the
     * typeCode value lower-case before passing it.
     *
     * @param string $value
     * @return int
     */
    public static function getGenderFromValue($value)
    {
        if (!self::$genderValues) {
            self::$genderValues = array_flip(self::$genderCodes);
        }

        if (!isset(self::$genderValues[$value])) {
            throw new PropelException('"' . $value . '" is not a valid gender.');
        }

        return self::$genderValues[strtolower($value)];
    }

    /**
     * Returns an indexed list of all of the genders after applying the
     * ucfirst() function to make the list suitable for direct output
     *
     * @return array
     */
    public static function getGenders()
    {
        return array_map('ucfirst', self::$genderCodes);
    }

    /**
     * Returns the value associated with a given relationship status index
     *
     * @param int $index
     * @return string
     */
    public static function getRelationshipStatusFromIndex($index)
    {
        if (!isset(self::$relationshipStatusCodes[$index])) {
            throw new PropelException('There is no relationship status for index ' . $index);
        }

        return self::$relationshipStatusCodes[$index];
    }

    /**
     * Returns the index associated with a given relationship status value. Makes the
     * typeCode value lower-case before passing it.
     *
     * @param string $value
     * @return int
     */
    public static function getRelationshipStatusFromValue($value)
    {
        if (!self::$relationshipStatusValues) {
            self::$relationshipStatusValues = array_flip(self::$relationshipStatusCodes);
        }

        if (!isset(self::$relationshipStatusValues[$value])) {
            throw new PropelException('"' . $value . '" is not a valid relationship status.');
        }

        return self::$relationshipStatusValues[strtolower($value)];
    }

    /**
     * Returns an indexed list of all of the relationship statuses after applying the
     * ucfirst() function to make the list suitable for direct output
     *
     * @return array
     */
    public static function getRelationshipStatuses()
    {
        return array_map('ucfirst', self::$relationshipStatusCodes);
    }

    /**
     * Find a user from their username
     *
     * @param string $username
     * @return User
     */
    public static function getByUsername($username)
    {
        $c = new Criteria();
        UserPeer::addActiveUserCriteria($c);
        $c->add(self::USERNAME, $username);
        return self::doSelectOne($c);
    }

    /**
     * Find a user from their email address
     *
     * @param string $email
     * @return User
     */
    public static function getByEmail($email)
    {
        $c = new Criteria();
        $c->add(self::EMAIL, $email);
        return self::doSelectOne($c);
    }

    /**
     * Find a user from their password recovery key
     *
     * @param string $key
     * @return User
     */
    public static function getByPasswordRecoveryKey($key)
    {
        $c = new Criteria();
        $c->add(self::PASSWORD_RECOVER_KEY, $key);
        return self::doSelectOne($c);
    }

    /**
     * Pull out the most recent member of the site
     *
     * @return User
     */
    public static function getNewestUser()
    {
        $c = new Criteria();
        $c->addDescendingOrderByColumn(self::CREATED_AT);
        self::addActiveUserCriteria($c);


        return self::doSelectOne($c);
    }

    static public function generateConfirmationCode(User $user)
    {
        return sha1($user->getPassword() . 'salt' . $user->getId());
    }

    /* For Quick Registration User */

    static public function generateConfirmationValue(User $user)
    {
        return sha1($user->getPassword() . 'salt' . $user->getId());

        /* $resval = sha1( $user->getPassword() . 'salt'. $user->getId() );
          $resval = substr($resval,0,10);
          return $resval; */
    }

    public static function doSelectFromConfirmationValue($code)
    {

        $oC = new Criteria();
        $oC->add(UserPeer::ID, "SHA1( CONCAT( user.password, 'salt', user.id ) ) = '$code'", Criteria::CUSTOM);
        $oC->add(UserPeer::TYPE, '0', Criteria::LESS_THAN);
        return UserPeer::doSelectOne($oC);

        /*
          //echo "Code::".$code;
          //die("Inside CValue");

          $oC = new Criteria();   //SUBSTRING( SHA1( CONCAT( user.password, 'salt', user.id ) ) , 1, 10 ) = '37633b4242'
          $oC->add( UserPeer::ID, " SUBSTRING( ( SHA1( CONCAT( user.password, 'salt', user.id ) ) ), 1, 10 ) = '$code'" , Criteria::CUSTOM );
          //SHA1( CONCAT( user.password, 'salt', user.id ) ) = '$code'
          $oC->add( UserPeer::TYPE, '0', Criteria::LESS_THAN );
          print_r($oC);
          print_r(UserPeer::doSelectOne( $oC ));
          die("Inside CValue");
          //return UserPeer::doSelectOne( $oC ); */
    }

    /**
     * @return User
     */
    public static function doSelectFromConfirmationCode($code)
    {
        $oC = new Criteria();
        $oC->add(UserPeer::ID, "SHA1( CONCAT( user.password, 'salt', user.id ) ) = '$code'", Criteria::CUSTOM);
        $oC->add(UserPeer::TYPE, '0', Criteria::LESS_THAN);
        return UserPeer::doSelectOne($oC);
    }

    static public function getWithMatchingUsername($matchingUsername, $limit = 10)
    {
        $c = new Criteria;
        $c->add(self::USERNAME, "%$matchingUsername%", Criteria::LIKE);
        $c->add(self::HIDDEN, 0);
        $c->setLimit($limit);
        return self::doSelect($c);
    }

    static public function search($criteria, sfUser $user)
    {
        $c = new Criteria;
        $c->addSelectColumn(self::ID . ' ID');
        $c->addSelectColumn(self::USERNAME . ' NAME');
        $c->addSelectColumn(self::NAME . ' DESCRIPTION');
        $tableName = self::TABLE_NAME;
        $c->addSelectColumn("'$tableName' TNAME");
        $c->add(self::HIDDEN, 0);
        if ($user->isAuthenticated()) {
            $c->add(self::ID, $user->getRaykuUserId(), Criteria::NOT_EQUAL);
        }

        $cton = $c->getNewCriterion(self::USERNAME, "%$criteria%", Criteria::LIKE);
        $cton->addOr($c->getNewCriterion(self::NAME, "%$criteria%", Criteria::LIKE));
        $cton->addOr($c->getNewCriterion(self::EMAIL, "%$criteria%", Criteria::LIKE));

        $c->add($cton);

        return self::doSelectStmt($c);
    }

    static public function getMembersCriteriaForLetter($sLetter = '')
    {
        $c = new Criteria();
        if ($sLetter != '') {
            $c->add(UserPeer::NAME, $sLetter . '%', Criteria::LIKE);
        }

        self::addActiveUserCriteria($c);

        return $c;
    }

    static public function getForExpertCategory($iCategoryId)
    {
        $c = new criteria();
        $c->addJoin(UserPeer::ID, ExpertCategoryPeer::USER_ID, Criteria::JOIN);
        $c->add(ExpertCategoryPeer::CATEGORY_ID, $iCategoryId);
        $c->addDescendingOrderbyColumn(UserPeer::POINTS);
        $c->setLimit(5);
        $c->setDistinct();

        return UserPeer::doSelect($c);
    }

    /**
     * @return Criteria;
     */
    static public function addActiveUserCriteria(Criteria &$criteria)
    {
        $criteria->add(self::TYPE, array(1, 2, 3, 4, 5), Criteria::IN);
        $criteria->add(self::HIDDEN, false);
    }

}
