<?php

/**
 * Base class that represents a row from the 'purchase_detail' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePurchaseDetail extends BaseObject  implements Persistent {


  const PEER = 'PurchaseDetailPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PurchaseDetailPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the user_id field.
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the sales_id field.
	 * @var        int
	 */
	protected $sales_id;

	/**
	 * The value for the transaction_id field.
	 * @var        int
	 */
	protected $transaction_id;

	/**
	 * The value for the full_name field.
	 * @var        string
	 */
	protected $full_name;

	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the address1 field.
	 * @var        string
	 */
	protected $address1;

	/**
	 * The value for the address2 field.
	 * @var        string
	 */
	protected $address2;

	/**
	 * The value for the city field.
	 * @var        string
	 */
	protected $city;

	/**
	 * The value for the state field.
	 * @var        string
	 */
	protected $state;

	/**
	 * The value for the country field.
	 * @var        string
	 */
	protected $country;

	/**
	 * The value for the telephone_number field.
	 * @var        string
	 */
	protected $telephone_number;

	/**
	 * The value for the zip field.
	 * Note: this column has a database default value of: '0'
	 * @var        string
	 */
	protected $zip;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        Sales
	 */
	protected $aSales;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of BasePurchaseDetail object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->zip = '0';
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [sales_id] column value.
	 * 
	 * @return     int
	 */
	public function getSalesId()
	{
		return $this->sales_id;
	}

	/**
	 * Get the [transaction_id] column value.
	 * 
	 * @return     int
	 */
	public function getTransactionId()
	{
		return $this->transaction_id;
	}

	/**
	 * Get the [full_name] column value.
	 * 
	 * @return     string
	 */
	public function getFullName()
	{
		return $this->full_name;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the [address1] column value.
	 * 
	 * @return     string
	 */
	public function getAddress1()
	{
		return $this->address1;
	}

	/**
	 * Get the [address2] column value.
	 * 
	 * @return     string
	 */
	public function getAddress2()
	{
		return $this->address2;
	}

	/**
	 * Get the [city] column value.
	 * 
	 * @return     string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * Get the [state] column value.
	 * 
	 * @return     string
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * Get the [country] column value.
	 * 
	 * @return     string
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * Get the [telephone_number] column value.
	 * 
	 * @return     string
	 */
	public function getTelephoneNumber()
	{
		return $this->telephone_number;
	}

	/**
	 * Get the [zip] column value.
	 * 
	 * @return     string
	 */
	public function getZip()
	{
		return $this->zip;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [sales_id] column.
	 * 
	 * @param      int $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setSalesId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->sales_id !== $v) {
			$this->sales_id = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::SALES_ID;
		}

		if ($this->aSales !== null && $this->aSales->getId() !== $v) {
			$this->aSales = null;
		}

		return $this;
	} // setSalesId()

	/**
	 * Set the value of [transaction_id] column.
	 * 
	 * @param      int $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setTransactionId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->transaction_id !== $v) {
			$this->transaction_id = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::TRANSACTION_ID;
		}

		return $this;
	} // setTransactionId()

	/**
	 * Set the value of [full_name] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setFullName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->full_name !== $v) {
			$this->full_name = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::FULL_NAME;
		}

		return $this;
	} // setFullName()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::EMAIL;
		}

		return $this;
	} // setEmail()

	/**
	 * Set the value of [address1] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setAddress1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->address1 !== $v) {
			$this->address1 = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::ADDRESS1;
		}

		return $this;
	} // setAddress1()

	/**
	 * Set the value of [address2] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setAddress2($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->address2 !== $v) {
			$this->address2 = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::ADDRESS2;
		}

		return $this;
	} // setAddress2()

	/**
	 * Set the value of [city] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setCity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::CITY;
		}

		return $this;
	} // setCity()

	/**
	 * Set the value of [state] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setState($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::STATE;
		}

		return $this;
	} // setState()

	/**
	 * Set the value of [country] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::COUNTRY;
		}

		return $this;
	} // setCountry()

	/**
	 * Set the value of [telephone_number] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setTelephoneNumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->telephone_number !== $v) {
			$this->telephone_number = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::TELEPHONE_NUMBER;
		}

		return $this;
	} // setTelephoneNumber()

	/**
	 * Set the value of [zip] column.
	 * 
	 * @param      string $v new value
	 * @return     PurchaseDetail The current object (for fluent API support)
	 */
	public function setZip($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->zip !== $v || $v === '0') {
			$this->zip = $v;
			$this->modifiedColumns[] = PurchaseDetailPeer::ZIP;
		}

		return $this;
	} // setZip()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array(PurchaseDetailPeer::ZIP))) {
				return false;
			}

			if ($this->zip !== '0') {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->sales_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->transaction_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->full_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->email = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->address1 = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->address2 = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->city = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->state = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->country = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->telephone_number = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->zip = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = PurchaseDetailPeer::NUM_COLUMNS - PurchaseDetailPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PurchaseDetail object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
			$this->aUser = null;
		}
		if ($this->aSales !== null && $this->sales_id !== $this->aSales->getId()) {
			$this->aSales = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PurchaseDetailPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->aSales = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PurchaseDetailPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PurchaseDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			PurchaseDetailPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if ($this->aUser->isModified() || $this->aUser->isNew()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}

			if ($this->aSales !== null) {
				if ($this->aSales->isModified() || $this->aSales->isNew()) {
					$affectedRows += $this->aSales->save($con);
				}
				$this->setSales($this->aSales);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = PurchaseDetailPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PurchaseDetailPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PurchaseDetailPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}

			if ($this->aSales !== null) {
				if (!$this->aSales->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSales->getValidationFailures());
				}
			}


			if (($retval = PurchaseDetailPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseDetailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getSalesId();
				break;
			case 3:
				return $this->getTransactionId();
				break;
			case 4:
				return $this->getFullName();
				break;
			case 5:
				return $this->getEmail();
				break;
			case 6:
				return $this->getAddress1();
				break;
			case 7:
				return $this->getAddress2();
				break;
			case 8:
				return $this->getCity();
				break;
			case 9:
				return $this->getState();
				break;
			case 10:
				return $this->getCountry();
				break;
			case 11:
				return $this->getTelephoneNumber();
				break;
			case 12:
				return $this->getZip();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PurchaseDetailPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getSalesId(),
			$keys[3] => $this->getTransactionId(),
			$keys[4] => $this->getFullName(),
			$keys[5] => $this->getEmail(),
			$keys[6] => $this->getAddress1(),
			$keys[7] => $this->getAddress2(),
			$keys[8] => $this->getCity(),
			$keys[9] => $this->getState(),
			$keys[10] => $this->getCountry(),
			$keys[11] => $this->getTelephoneNumber(),
			$keys[12] => $this->getZip(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PurchaseDetailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setSalesId($value);
				break;
			case 3:
				$this->setTransactionId($value);
				break;
			case 4:
				$this->setFullName($value);
				break;
			case 5:
				$this->setEmail($value);
				break;
			case 6:
				$this->setAddress1($value);
				break;
			case 7:
				$this->setAddress2($value);
				break;
			case 8:
				$this->setCity($value);
				break;
			case 9:
				$this->setState($value);
				break;
			case 10:
				$this->setCountry($value);
				break;
			case 11:
				$this->setTelephoneNumber($value);
				break;
			case 12:
				$this->setZip($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PurchaseDetailPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSalesId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTransactionId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFullName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEmail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAddress1($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAddress2($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCity($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setState($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCountry($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTelephoneNumber($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setZip($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PurchaseDetailPeer::DATABASE_NAME);

		if ($this->isColumnModified(PurchaseDetailPeer::ID)) $criteria->add(PurchaseDetailPeer::ID, $this->id);
		if ($this->isColumnModified(PurchaseDetailPeer::USER_ID)) $criteria->add(PurchaseDetailPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(PurchaseDetailPeer::SALES_ID)) $criteria->add(PurchaseDetailPeer::SALES_ID, $this->sales_id);
		if ($this->isColumnModified(PurchaseDetailPeer::TRANSACTION_ID)) $criteria->add(PurchaseDetailPeer::TRANSACTION_ID, $this->transaction_id);
		if ($this->isColumnModified(PurchaseDetailPeer::FULL_NAME)) $criteria->add(PurchaseDetailPeer::FULL_NAME, $this->full_name);
		if ($this->isColumnModified(PurchaseDetailPeer::EMAIL)) $criteria->add(PurchaseDetailPeer::EMAIL, $this->email);
		if ($this->isColumnModified(PurchaseDetailPeer::ADDRESS1)) $criteria->add(PurchaseDetailPeer::ADDRESS1, $this->address1);
		if ($this->isColumnModified(PurchaseDetailPeer::ADDRESS2)) $criteria->add(PurchaseDetailPeer::ADDRESS2, $this->address2);
		if ($this->isColumnModified(PurchaseDetailPeer::CITY)) $criteria->add(PurchaseDetailPeer::CITY, $this->city);
		if ($this->isColumnModified(PurchaseDetailPeer::STATE)) $criteria->add(PurchaseDetailPeer::STATE, $this->state);
		if ($this->isColumnModified(PurchaseDetailPeer::COUNTRY)) $criteria->add(PurchaseDetailPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(PurchaseDetailPeer::TELEPHONE_NUMBER)) $criteria->add(PurchaseDetailPeer::TELEPHONE_NUMBER, $this->telephone_number);
		if ($this->isColumnModified(PurchaseDetailPeer::ZIP)) $criteria->add(PurchaseDetailPeer::ZIP, $this->zip);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PurchaseDetailPeer::DATABASE_NAME);

		$criteria->add(PurchaseDetailPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PurchaseDetail (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUserId($this->user_id);

		$copyObj->setSalesId($this->sales_id);

		$copyObj->setTransactionId($this->transaction_id);

		$copyObj->setFullName($this->full_name);

		$copyObj->setEmail($this->email);

		$copyObj->setAddress1($this->address1);

		$copyObj->setAddress2($this->address2);

		$copyObj->setCity($this->city);

		$copyObj->setState($this->state);

		$copyObj->setCountry($this->country);

		$copyObj->setTelephoneNumber($this->telephone_number);

		$copyObj->setZip($this->zip);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     PurchaseDetail Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     PurchaseDetailPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PurchaseDetailPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     PurchaseDetail The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUser(User $v = null)
	{
		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}

		$this->aUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addPurchaseDetail($this);
		}

		return $this;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUser(PropelPDO $con = null)
	{
		if ($this->aUser === null && ($this->user_id !== null)) {
			$c = new Criteria(UserPeer::DATABASE_NAME);
			$c->add(UserPeer::ID, $this->user_id);
			$this->aUser = UserPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aUser->addPurchaseDetails($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Declares an association between this object and a Sales object.
	 *
	 * @param      Sales $v
	 * @return     PurchaseDetail The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSales(Sales $v = null)
	{
		if ($v === null) {
			$this->setSalesId(NULL);
		} else {
			$this->setSalesId($v->getId());
		}

		$this->aSales = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Sales object, it will not be re-added.
		if ($v !== null) {
			$v->addPurchaseDetail($this);
		}

		return $this;
	}


	/**
	 * Get the associated Sales object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Sales The associated Sales object.
	 * @throws     PropelException
	 */
	public function getSales(PropelPDO $con = null)
	{
		if ($this->aSales === null && ($this->sales_id !== null)) {
			$c = new Criteria(SalesPeer::DATABASE_NAME);
			$c->add(SalesPeer::ID, $this->sales_id);
			$this->aSales = SalesPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSales->addPurchaseDetails($this);
			 */
		}
		return $this->aSales;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aUser = null;
			$this->aSales = null;
	}

} // BasePurchaseDetail
