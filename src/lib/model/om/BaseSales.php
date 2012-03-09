<?php

/**
 * Base class that represents a row from the 'sales' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSales extends BaseObject  implements Persistent {


  const PEER = 'SalesPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SalesPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the offer_voucher_id field.
	 * @var        int
	 */
	protected $offer_voucher_id;

	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id;

	/**
	 * The value for the total_sale_price field.
	 * @var        int
	 */
	protected $total_sale_price;

	/**
	 * The value for the total_shipping_charge field.
	 * @var        int
	 */
	protected $total_shipping_charge;

	/**
	 * The value for the quantity field.
	 * @var        int
	 */
	protected $quantity;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * The value for the total_item_price field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $total_item_price;

	/**
	 * @var        OfferVoucher1
	 */
	protected $aOfferVoucher1;

	/**
	 * @var        Status
	 */
	protected $aStatus;

	/**
	 * @var        array PurchaseDetail[] Collection to store aggregation of PurchaseDetail objects.
	 */
	protected $collPurchaseDetails;

	/**
	 * @var        Criteria The criteria used to select the current contents of collPurchaseDetails.
	 */
	private $lastPurchaseDetailCriteria = null;

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
	 * Initializes internal state of BaseSales object.
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
		$this->total_item_price = 0;
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
	 * Get the [offer_voucher_id] column value.
	 * 
	 * @return     int
	 */
	public function getOfferVoucherId()
	{
		return $this->offer_voucher_id;
	}

	/**
	 * Get the [status_id] column value.
	 * 
	 * @return     int
	 */
	public function getStatusId()
	{
		return $this->status_id;
	}

	/**
	 * Get the [total_sale_price] column value.
	 * 
	 * @return     int
	 */
	public function getTotalSalePrice()
	{
		return $this->total_sale_price;
	}

	/**
	 * Get the [total_shipping_charge] column value.
	 * 
	 * @return     int
	 */
	public function getTotalShippingCharge()
	{
		return $this->total_shipping_charge;
	}

	/**
	 * Get the [quantity] column value.
	 * 
	 * @return     int
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [total_item_price] column value.
	 * 
	 * @return     int
	 */
	public function getTotalItemPrice()
	{
		return $this->total_item_price;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SalesPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [offer_voucher_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setOfferVoucherId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->offer_voucher_id !== $v) {
			$this->offer_voucher_id = $v;
			$this->modifiedColumns[] = SalesPeer::OFFER_VOUCHER_ID;
		}

		if ($this->aOfferVoucher1 !== null && $this->aOfferVoucher1->getId() !== $v) {
			$this->aOfferVoucher1 = null;
		}

		return $this;
	} // setOfferVoucherId()

	/**
	 * Set the value of [status_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setStatusId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = SalesPeer::STATUS_ID;
		}

		if ($this->aStatus !== null && $this->aStatus->getId() !== $v) {
			$this->aStatus = null;
		}

		return $this;
	} // setStatusId()

	/**
	 * Set the value of [total_sale_price] column.
	 * 
	 * @param      int $v new value
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setTotalSalePrice($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->total_sale_price !== $v) {
			$this->total_sale_price = $v;
			$this->modifiedColumns[] = SalesPeer::TOTAL_SALE_PRICE;
		}

		return $this;
	} // setTotalSalePrice()

	/**
	 * Set the value of [total_shipping_charge] column.
	 * 
	 * @param      int $v new value
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setTotalShippingCharge($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->total_shipping_charge !== $v) {
			$this->total_shipping_charge = $v;
			$this->modifiedColumns[] = SalesPeer::TOTAL_SHIPPING_CHARGE;
		}

		return $this;
	} // setTotalShippingCharge()

	/**
	 * Set the value of [quantity] column.
	 * 
	 * @param      int $v new value
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setQuantity($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v) {
			$this->quantity = $v;
			$this->modifiedColumns[] = SalesPeer::QUANTITY;
		}

		return $this;
	} // setQuantity()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->created_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->created_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = SalesPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->updated_at = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = SalesPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Set the value of [total_item_price] column.
	 * 
	 * @param      int $v new value
	 * @return     Sales The current object (for fluent API support)
	 */
	public function setTotalItemPrice($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->total_item_price !== $v || $v === 0) {
			$this->total_item_price = $v;
			$this->modifiedColumns[] = SalesPeer::TOTAL_ITEM_PRICE;
		}

		return $this;
	} // setTotalItemPrice()

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
			if (array_diff($this->modifiedColumns, array(SalesPeer::TOTAL_ITEM_PRICE))) {
				return false;
			}

			if ($this->total_item_price !== 0) {
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
			$this->offer_voucher_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->status_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->total_sale_price = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->total_shipping_charge = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->quantity = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->created_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->updated_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->total_item_price = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 9; // 9 = SalesPeer::NUM_COLUMNS - SalesPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Sales object", $e);
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

		if ($this->aOfferVoucher1 !== null && $this->offer_voucher_id !== $this->aOfferVoucher1->getId()) {
			$this->aOfferVoucher1 = null;
		}
		if ($this->aStatus !== null && $this->status_id !== $this->aStatus->getId()) {
			$this->aStatus = null;
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
			$con = Propel::getConnection(SalesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = SalesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aOfferVoucher1 = null;
			$this->aStatus = null;
			$this->collPurchaseDetails = null;
			$this->lastPurchaseDetailCriteria = null;

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
			$con = Propel::getConnection(SalesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SalesPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(SalesPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SalesPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SalesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			SalesPeer::addInstanceToPool($this);
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

			if ($this->aOfferVoucher1 !== null) {
				if ($this->aOfferVoucher1->isModified() || $this->aOfferVoucher1->isNew()) {
					$affectedRows += $this->aOfferVoucher1->save($con);
				}
				$this->setOfferVoucher1($this->aOfferVoucher1);
			}

			if ($this->aStatus !== null) {
				if ($this->aStatus->isModified() || $this->aStatus->isNew()) {
					$affectedRows += $this->aStatus->save($con);
				}
				$this->setStatus($this->aStatus);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = SalesPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SalesPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SalesPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPurchaseDetails !== null) {
				foreach ($this->collPurchaseDetails as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->aOfferVoucher1 !== null) {
				if (!$this->aOfferVoucher1->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aOfferVoucher1->getValidationFailures());
				}
			}

			if ($this->aStatus !== null) {
				if (!$this->aStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStatus->getValidationFailures());
				}
			}


			if (($retval = SalesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPurchaseDetails !== null) {
					foreach ($this->collPurchaseDetails as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = SalesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getOfferVoucherId();
				break;
			case 2:
				return $this->getStatusId();
				break;
			case 3:
				return $this->getTotalSalePrice();
				break;
			case 4:
				return $this->getTotalShippingCharge();
				break;
			case 5:
				return $this->getQuantity();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			case 8:
				return $this->getTotalItemPrice();
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
		$keys = SalesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getOfferVoucherId(),
			$keys[2] => $this->getStatusId(),
			$keys[3] => $this->getTotalSalePrice(),
			$keys[4] => $this->getTotalShippingCharge(),
			$keys[5] => $this->getQuantity(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
			$keys[8] => $this->getTotalItemPrice(),
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
		$pos = SalesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setOfferVoucherId($value);
				break;
			case 2:
				$this->setStatusId($value);
				break;
			case 3:
				$this->setTotalSalePrice($value);
				break;
			case 4:
				$this->setTotalShippingCharge($value);
				break;
			case 5:
				$this->setQuantity($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
			case 8:
				$this->setTotalItemPrice($value);
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
		$keys = SalesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOfferVoucherId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStatusId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTotalSalePrice($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTotalShippingCharge($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setQuantity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTotalItemPrice($arr[$keys[8]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SalesPeer::DATABASE_NAME);

		if ($this->isColumnModified(SalesPeer::ID)) $criteria->add(SalesPeer::ID, $this->id);
		if ($this->isColumnModified(SalesPeer::OFFER_VOUCHER_ID)) $criteria->add(SalesPeer::OFFER_VOUCHER_ID, $this->offer_voucher_id);
		if ($this->isColumnModified(SalesPeer::STATUS_ID)) $criteria->add(SalesPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(SalesPeer::TOTAL_SALE_PRICE)) $criteria->add(SalesPeer::TOTAL_SALE_PRICE, $this->total_sale_price);
		if ($this->isColumnModified(SalesPeer::TOTAL_SHIPPING_CHARGE)) $criteria->add(SalesPeer::TOTAL_SHIPPING_CHARGE, $this->total_shipping_charge);
		if ($this->isColumnModified(SalesPeer::QUANTITY)) $criteria->add(SalesPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(SalesPeer::CREATED_AT)) $criteria->add(SalesPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SalesPeer::UPDATED_AT)) $criteria->add(SalesPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(SalesPeer::TOTAL_ITEM_PRICE)) $criteria->add(SalesPeer::TOTAL_ITEM_PRICE, $this->total_item_price);

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
		$criteria = new Criteria(SalesPeer::DATABASE_NAME);

		$criteria->add(SalesPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Sales (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOfferVoucherId($this->offer_voucher_id);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setTotalSalePrice($this->total_sale_price);

		$copyObj->setTotalShippingCharge($this->total_shipping_charge);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setTotalItemPrice($this->total_item_price);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getPurchaseDetails() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPurchaseDetail($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


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
	 * @return     Sales Clone of current object.
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
	 * @return     SalesPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SalesPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a OfferVoucher1 object.
	 *
	 * @param      OfferVoucher1 $v
	 * @return     Sales The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setOfferVoucher1(OfferVoucher1 $v = null)
	{
		if ($v === null) {
			$this->setOfferVoucherId(NULL);
		} else {
			$this->setOfferVoucherId($v->getId());
		}

		$this->aOfferVoucher1 = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the OfferVoucher1 object, it will not be re-added.
		if ($v !== null) {
			$v->addSales($this);
		}

		return $this;
	}


	/**
	 * Get the associated OfferVoucher1 object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     OfferVoucher1 The associated OfferVoucher1 object.
	 * @throws     PropelException
	 */
	public function getOfferVoucher1(PropelPDO $con = null)
	{
		if ($this->aOfferVoucher1 === null && ($this->offer_voucher_id !== null)) {
			$c = new Criteria(OfferVoucher1Peer::DATABASE_NAME);
			$c->add(OfferVoucher1Peer::ID, $this->offer_voucher_id);
			$this->aOfferVoucher1 = OfferVoucher1Peer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aOfferVoucher1->addSaless($this);
			 */
		}
		return $this->aOfferVoucher1;
	}

	/**
	 * Declares an association between this object and a Status object.
	 *
	 * @param      Status $v
	 * @return     Sales The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setStatus(Status $v = null)
	{
		if ($v === null) {
			$this->setStatusId(NULL);
		} else {
			$this->setStatusId($v->getId());
		}

		$this->aStatus = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Status object, it will not be re-added.
		if ($v !== null) {
			$v->addSales($this);
		}

		return $this;
	}


	/**
	 * Get the associated Status object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Status The associated Status object.
	 * @throws     PropelException
	 */
	public function getStatus(PropelPDO $con = null)
	{
		if ($this->aStatus === null && ($this->status_id !== null)) {
			$c = new Criteria(StatusPeer::DATABASE_NAME);
			$c->add(StatusPeer::ID, $this->status_id);
			$this->aStatus = StatusPeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aStatus->addSaless($this);
			 */
		}
		return $this->aStatus;
	}

	/**
	 * Clears out the collPurchaseDetails collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPurchaseDetails()
	 */
	public function clearPurchaseDetails()
	{
		$this->collPurchaseDetails = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPurchaseDetails collection (array).
	 *
	 * By default this just sets the collPurchaseDetails collection to an empty array (like clearcollPurchaseDetails());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initPurchaseDetails()
	{
		$this->collPurchaseDetails = array();
	}

	/**
	 * Gets an array of PurchaseDetail objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Sales has previously been saved, it will retrieve
	 * related PurchaseDetails from storage. If this Sales is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array PurchaseDetail[]
	 * @throws     PropelException
	 */
	public function getPurchaseDetails($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SalesPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseDetails === null) {
			if ($this->isNew()) {
			   $this->collPurchaseDetails = array();
			} else {

				$criteria->add(PurchaseDetailPeer::SALES_ID, $this->id);

				PurchaseDetailPeer::addSelectColumns($criteria);
				$this->collPurchaseDetails = PurchaseDetailPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PurchaseDetailPeer::SALES_ID, $this->id);

				PurchaseDetailPeer::addSelectColumns($criteria);
				if (!isset($this->lastPurchaseDetailCriteria) || !$this->lastPurchaseDetailCriteria->equals($criteria)) {
					$this->collPurchaseDetails = PurchaseDetailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPurchaseDetailCriteria = $criteria;
		return $this->collPurchaseDetails;
	}

	/**
	 * Returns the number of related PurchaseDetail objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PurchaseDetail objects.
	 * @throws     PropelException
	 */
	public function countPurchaseDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SalesPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPurchaseDetails === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PurchaseDetailPeer::SALES_ID, $this->id);

				$count = PurchaseDetailPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(PurchaseDetailPeer::SALES_ID, $this->id);

				if (!isset($this->lastPurchaseDetailCriteria) || !$this->lastPurchaseDetailCriteria->equals($criteria)) {
					$count = PurchaseDetailPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPurchaseDetails);
				}
			} else {
				$count = count($this->collPurchaseDetails);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a PurchaseDetail object to this object
	 * through the PurchaseDetail foreign key attribute.
	 *
	 * @param      PurchaseDetail $l PurchaseDetail
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPurchaseDetail(PurchaseDetail $l)
	{
		if ($this->collPurchaseDetails === null) {
			$this->initPurchaseDetails();
		}
		if (!in_array($l, $this->collPurchaseDetails, true)) { // only add it if the **same** object is not already associated
			array_push($this->collPurchaseDetails, $l);
			$l->setSales($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Sales is new, it will return
	 * an empty collection; or if this Sales has previously
	 * been saved, it will retrieve related PurchaseDetails from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Sales.
	 */
	public function getPurchaseDetailsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SalesPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPurchaseDetails === null) {
			if ($this->isNew()) {
				$this->collPurchaseDetails = array();
			} else {

				$criteria->add(PurchaseDetailPeer::SALES_ID, $this->id);

				$this->collPurchaseDetails = PurchaseDetailPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PurchaseDetailPeer::SALES_ID, $this->id);

			if (!isset($this->lastPurchaseDetailCriteria) || !$this->lastPurchaseDetailCriteria->equals($criteria)) {
				$this->collPurchaseDetails = PurchaseDetailPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastPurchaseDetailCriteria = $criteria;

		return $this->collPurchaseDetails;
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
			if ($this->collPurchaseDetails) {
				foreach ((array) $this->collPurchaseDetails as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collPurchaseDetails = null;
			$this->aOfferVoucher1 = null;
			$this->aStatus = null;
	}

} // BaseSales
