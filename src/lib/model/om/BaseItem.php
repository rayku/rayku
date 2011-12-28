<?php

/**
 * Base class that represents a row from the 'item' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseItem extends BaseObject  implements Persistent {


  const PEER = 'ItemPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ItemPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the size_id field.
	 * @var        int
	 */
	protected $size_id;

	/**
	 * The value for the item_type_id field.
	 * @var        int
	 */
	protected $item_type_id;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * The value for the price_per_unit field.
	 * @var        int
	 */
	protected $price_per_unit;

	/**
	 * The value for the shipping_charge_per_unit field.
	 * @var        int
	 */
	protected $shipping_charge_per_unit;

	/**
	 * The value for the actual_value field.
	 * @var        int
	 */
	protected $actual_value;

	/**
	 * The value for the actual_value_currency field.
	 * @var        string
	 */
	protected $actual_value_currency;

	/**
	 * The value for the quantity field.
	 * @var        int
	 */
	protected $quantity;

	/**
	 * The value for the image field.
	 * @var        string
	 */
	protected $image;

	/**
	 * The value for the features field.
	 * @var        string
	 */
	protected $features;

	/**
	 * The value for the is_active field.
	 * @var        int
	 */
	protected $is_active;

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
	 * @var        Size
	 */
	protected $aSize;

	/**
	 * @var        ItemType
	 */
	protected $aItemType;

	/**
	 * @var        array ItemRating[] Collection to store aggregation of ItemRating objects.
	 */
	protected $collItemRatings;

	/**
	 * @var        Criteria The criteria used to select the current contents of collItemRatings.
	 */
	private $lastItemRatingCriteria = null;

	/**
	 * @var        array SalesDetail[] Collection to store aggregation of SalesDetail objects.
	 */
	protected $collSalesDetails;

	/**
	 * @var        Criteria The criteria used to select the current contents of collSalesDetails.
	 */
	private $lastSalesDetailCriteria = null;

	/**
	 * @var        array ShoppingCart[] Collection to store aggregation of ShoppingCart objects.
	 */
	protected $collShoppingCarts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collShoppingCarts.
	 */
	private $lastShoppingCartCriteria = null;

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
	 * Initializes internal state of BaseItem object.
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
	 * Get the [size_id] column value.
	 * 
	 * @return     int
	 */
	public function getSizeId()
	{
		return $this->size_id;
	}

	/**
	 * Get the [item_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getItemTypeId()
	{
		return $this->item_type_id;
	}

	/**
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [price_per_unit] column value.
	 * 
	 * @return     int
	 */
	public function getPricePerUnit()
	{
		return $this->price_per_unit;
	}

	/**
	 * Get the [shipping_charge_per_unit] column value.
	 * 
	 * @return     int
	 */
	public function getShippingChargePerUnit()
	{
		return $this->shipping_charge_per_unit;
	}

	/**
	 * Get the [actual_value] column value.
	 * 
	 * @return     int
	 */
	public function getActualValue()
	{
		return $this->actual_value;
	}

	/**
	 * Get the [actual_value_currency] column value.
	 * 
	 * @return     string
	 */
	public function getActualValueCurrency()
	{
		return $this->actual_value_currency;
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
	 * Get the [image] column value.
	 * 
	 * @return     string
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Get the [features] column value.
	 * 
	 * @return     string
	 */
	public function getFeatures()
	{
		return $this->features;
	}

	/**
	 * Get the [is_active] column value.
	 * 
	 * @return     int
	 */
	public function getIsActive()
	{
		return $this->is_active;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ItemPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [size_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setSizeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->size_id !== $v) {
			$this->size_id = $v;
			$this->modifiedColumns[] = ItemPeer::SIZE_ID;
		}

		if ($this->aSize !== null && $this->aSize->getId() !== $v) {
			$this->aSize = null;
		}

		return $this;
	} // setSizeId()

	/**
	 * Set the value of [item_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setItemTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->item_type_id !== $v) {
			$this->item_type_id = $v;
			$this->modifiedColumns[] = ItemPeer::ITEM_TYPE_ID;
		}

		if ($this->aItemType !== null && $this->aItemType->getId() !== $v) {
			$this->aItemType = null;
		}

		return $this;
	} // setItemTypeId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = ItemPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ItemPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Set the value of [price_per_unit] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setPricePerUnit($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->price_per_unit !== $v) {
			$this->price_per_unit = $v;
			$this->modifiedColumns[] = ItemPeer::PRICE_PER_UNIT;
		}

		return $this;
	} // setPricePerUnit()

	/**
	 * Set the value of [shipping_charge_per_unit] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setShippingChargePerUnit($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->shipping_charge_per_unit !== $v) {
			$this->shipping_charge_per_unit = $v;
			$this->modifiedColumns[] = ItemPeer::SHIPPING_CHARGE_PER_UNIT;
		}

		return $this;
	} // setShippingChargePerUnit()

	/**
	 * Set the value of [actual_value] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setActualValue($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->actual_value !== $v) {
			$this->actual_value = $v;
			$this->modifiedColumns[] = ItemPeer::ACTUAL_VALUE;
		}

		return $this;
	} // setActualValue()

	/**
	 * Set the value of [actual_value_currency] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setActualValueCurrency($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->actual_value_currency !== $v) {
			$this->actual_value_currency = $v;
			$this->modifiedColumns[] = ItemPeer::ACTUAL_VALUE_CURRENCY;
		}

		return $this;
	} // setActualValueCurrency()

	/**
	 * Set the value of [quantity] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setQuantity($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v) {
			$this->quantity = $v;
			$this->modifiedColumns[] = ItemPeer::QUANTITY;
		}

		return $this;
	} // setQuantity()

	/**
	 * Set the value of [image] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setImage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->image !== $v) {
			$this->image = $v;
			$this->modifiedColumns[] = ItemPeer::IMAGE;
		}

		return $this;
	} // setImage()

	/**
	 * Set the value of [features] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setFeatures($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->features !== $v) {
			$this->features = $v;
			$this->modifiedColumns[] = ItemPeer::FEATURES;
		}

		return $this;
	} // setFeatures()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_active !== $v) {
			$this->is_active = $v;
			$this->modifiedColumns[] = ItemPeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Item The current object (for fluent API support)
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
				$this->modifiedColumns[] = ItemPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     Item The current object (for fluent API support)
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
				$this->modifiedColumns[] = ItemPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

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
			if (array_diff($this->modifiedColumns, array())) {
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
			$this->size_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->item_type_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->title = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->description = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->price_per_unit = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->shipping_charge_per_unit = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->actual_value = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->actual_value_currency = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->quantity = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->image = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->features = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->is_active = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->created_at = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->updated_at = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 15; // 15 = ItemPeer::NUM_COLUMNS - ItemPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Item object", $e);
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

		if ($this->aSize !== null && $this->size_id !== $this->aSize->getId()) {
			$this->aSize = null;
		}
		if ($this->aItemType !== null && $this->item_type_id !== $this->aItemType->getId()) {
			$this->aItemType = null;
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
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSize = null;
			$this->aItemType = null;
			$this->collItemRatings = null;
			$this->lastItemRatingCriteria = null;

			$this->collSalesDetails = null;
			$this->lastSalesDetailCriteria = null;

			$this->collShoppingCarts = null;
			$this->lastShoppingCartCriteria = null;

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
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ItemPeer::doDelete($this, $con);
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
    if ($this->isNew() && !$this->isColumnModified(ItemPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ItemPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
			ItemPeer::addInstanceToPool($this);
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

			if ($this->aSize !== null) {
				if ($this->aSize->isModified() || $this->aSize->isNew()) {
					$affectedRows += $this->aSize->save($con);
				}
				$this->setSize($this->aSize);
			}

			if ($this->aItemType !== null) {
				if ($this->aItemType->isModified() || $this->aItemType->isNew()) {
					$affectedRows += $this->aItemType->save($con);
				}
				$this->setItemType($this->aItemType);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ItemPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ItemPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ItemPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collItemRatings !== null) {
				foreach ($this->collItemRatings as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSalesDetails !== null) {
				foreach ($this->collSalesDetails as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collShoppingCarts !== null) {
				foreach ($this->collShoppingCarts as $referrerFK) {
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

			if ($this->aSize !== null) {
				if (!$this->aSize->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSize->getValidationFailures());
				}
			}

			if ($this->aItemType !== null) {
				if (!$this->aItemType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aItemType->getValidationFailures());
				}
			}


			if (($retval = ItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collItemRatings !== null) {
					foreach ($this->collItemRatings as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSalesDetails !== null) {
					foreach ($this->collSalesDetails as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShoppingCarts !== null) {
					foreach ($this->collShoppingCarts as $referrerFK) {
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
		$pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSizeId();
				break;
			case 2:
				return $this->getItemTypeId();
				break;
			case 3:
				return $this->getTitle();
				break;
			case 4:
				return $this->getDescription();
				break;
			case 5:
				return $this->getPricePerUnit();
				break;
			case 6:
				return $this->getShippingChargePerUnit();
				break;
			case 7:
				return $this->getActualValue();
				break;
			case 8:
				return $this->getActualValueCurrency();
				break;
			case 9:
				return $this->getQuantity();
				break;
			case 10:
				return $this->getImage();
				break;
			case 11:
				return $this->getFeatures();
				break;
			case 12:
				return $this->getIsActive();
				break;
			case 13:
				return $this->getCreatedAt();
				break;
			case 14:
				return $this->getUpdatedAt();
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
		$keys = ItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSizeId(),
			$keys[2] => $this->getItemTypeId(),
			$keys[3] => $this->getTitle(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getPricePerUnit(),
			$keys[6] => $this->getShippingChargePerUnit(),
			$keys[7] => $this->getActualValue(),
			$keys[8] => $this->getActualValueCurrency(),
			$keys[9] => $this->getQuantity(),
			$keys[10] => $this->getImage(),
			$keys[11] => $this->getFeatures(),
			$keys[12] => $this->getIsActive(),
			$keys[13] => $this->getCreatedAt(),
			$keys[14] => $this->getUpdatedAt(),
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
		$pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSizeId($value);
				break;
			case 2:
				$this->setItemTypeId($value);
				break;
			case 3:
				$this->setTitle($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
			case 5:
				$this->setPricePerUnit($value);
				break;
			case 6:
				$this->setShippingChargePerUnit($value);
				break;
			case 7:
				$this->setActualValue($value);
				break;
			case 8:
				$this->setActualValueCurrency($value);
				break;
			case 9:
				$this->setQuantity($value);
				break;
			case 10:
				$this->setImage($value);
				break;
			case 11:
				$this->setFeatures($value);
				break;
			case 12:
				$this->setIsActive($value);
				break;
			case 13:
				$this->setCreatedAt($value);
				break;
			case 14:
				$this->setUpdatedAt($value);
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
		$keys = ItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSizeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setItemTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPricePerUnit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setShippingChargePerUnit($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setActualValue($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setActualValueCurrency($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setQuantity($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setImage($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setFeatures($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIsActive($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCreatedAt($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setUpdatedAt($arr[$keys[14]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(ItemPeer::ID)) $criteria->add(ItemPeer::ID, $this->id);
		if ($this->isColumnModified(ItemPeer::SIZE_ID)) $criteria->add(ItemPeer::SIZE_ID, $this->size_id);
		if ($this->isColumnModified(ItemPeer::ITEM_TYPE_ID)) $criteria->add(ItemPeer::ITEM_TYPE_ID, $this->item_type_id);
		if ($this->isColumnModified(ItemPeer::TITLE)) $criteria->add(ItemPeer::TITLE, $this->title);
		if ($this->isColumnModified(ItemPeer::DESCRIPTION)) $criteria->add(ItemPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ItemPeer::PRICE_PER_UNIT)) $criteria->add(ItemPeer::PRICE_PER_UNIT, $this->price_per_unit);
		if ($this->isColumnModified(ItemPeer::SHIPPING_CHARGE_PER_UNIT)) $criteria->add(ItemPeer::SHIPPING_CHARGE_PER_UNIT, $this->shipping_charge_per_unit);
		if ($this->isColumnModified(ItemPeer::ACTUAL_VALUE)) $criteria->add(ItemPeer::ACTUAL_VALUE, $this->actual_value);
		if ($this->isColumnModified(ItemPeer::ACTUAL_VALUE_CURRENCY)) $criteria->add(ItemPeer::ACTUAL_VALUE_CURRENCY, $this->actual_value_currency);
		if ($this->isColumnModified(ItemPeer::QUANTITY)) $criteria->add(ItemPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(ItemPeer::IMAGE)) $criteria->add(ItemPeer::IMAGE, $this->image);
		if ($this->isColumnModified(ItemPeer::FEATURES)) $criteria->add(ItemPeer::FEATURES, $this->features);
		if ($this->isColumnModified(ItemPeer::IS_ACTIVE)) $criteria->add(ItemPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(ItemPeer::CREATED_AT)) $criteria->add(ItemPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ItemPeer::UPDATED_AT)) $criteria->add(ItemPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(ItemPeer::DATABASE_NAME);

		$criteria->add(ItemPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Item (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSizeId($this->size_id);

		$copyObj->setItemTypeId($this->item_type_id);

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setPricePerUnit($this->price_per_unit);

		$copyObj->setShippingChargePerUnit($this->shipping_charge_per_unit);

		$copyObj->setActualValue($this->actual_value);

		$copyObj->setActualValueCurrency($this->actual_value_currency);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setImage($this->image);

		$copyObj->setFeatures($this->features);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getItemRatings() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addItemRating($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSalesDetails() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSalesDetail($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShoppingCarts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShoppingCart($relObj->copy($deepCopy));
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
	 * @return     Item Clone of current object.
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
	 * @return     ItemPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ItemPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Size object.
	 *
	 * @param      Size $v
	 * @return     Item The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSize(Size $v = null)
	{
		if ($v === null) {
			$this->setSizeId(NULL);
		} else {
			$this->setSizeId($v->getId());
		}

		$this->aSize = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Size object, it will not be re-added.
		if ($v !== null) {
			$v->addItem($this);
		}

		return $this;
	}


	/**
	 * Get the associated Size object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Size The associated Size object.
	 * @throws     PropelException
	 */
	public function getSize(PropelPDO $con = null)
	{
		if ($this->aSize === null && ($this->size_id !== null)) {
			$c = new Criteria(SizePeer::DATABASE_NAME);
			$c->add(SizePeer::ID, $this->size_id);
			$this->aSize = SizePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aSize->addItems($this);
			 */
		}
		return $this->aSize;
	}

	/**
	 * Declares an association between this object and a ItemType object.
	 *
	 * @param      ItemType $v
	 * @return     Item The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setItemType(ItemType $v = null)
	{
		if ($v === null) {
			$this->setItemTypeId(NULL);
		} else {
			$this->setItemTypeId($v->getId());
		}

		$this->aItemType = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ItemType object, it will not be re-added.
		if ($v !== null) {
			$v->addItem($this);
		}

		return $this;
	}


	/**
	 * Get the associated ItemType object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ItemType The associated ItemType object.
	 * @throws     PropelException
	 */
	public function getItemType(PropelPDO $con = null)
	{
		if ($this->aItemType === null && ($this->item_type_id !== null)) {
			$c = new Criteria(ItemTypePeer::DATABASE_NAME);
			$c->add(ItemTypePeer::ID, $this->item_type_id);
			$this->aItemType = ItemTypePeer::doSelectOne($c, $con);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aItemType->addItems($this);
			 */
		}
		return $this->aItemType;
	}

	/**
	 * Clears out the collItemRatings collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addItemRatings()
	 */
	public function clearItemRatings()
	{
		$this->collItemRatings = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collItemRatings collection (array).
	 *
	 * By default this just sets the collItemRatings collection to an empty array (like clearcollItemRatings());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initItemRatings()
	{
		$this->collItemRatings = array();
	}

	/**
	 * Gets an array of ItemRating objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Item has previously been saved, it will retrieve
	 * related ItemRatings from storage. If this Item is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ItemRating[]
	 * @throws     PropelException
	 */
	public function getItemRatings($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collItemRatings === null) {
			if ($this->isNew()) {
			   $this->collItemRatings = array();
			} else {

				$criteria->add(ItemRatingPeer::ITEM_ID, $this->id);

				ItemRatingPeer::addSelectColumns($criteria);
				$this->collItemRatings = ItemRatingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ItemRatingPeer::ITEM_ID, $this->id);

				ItemRatingPeer::addSelectColumns($criteria);
				if (!isset($this->lastItemRatingCriteria) || !$this->lastItemRatingCriteria->equals($criteria)) {
					$this->collItemRatings = ItemRatingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastItemRatingCriteria = $criteria;
		return $this->collItemRatings;
	}

	/**
	 * Returns the number of related ItemRating objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ItemRating objects.
	 * @throws     PropelException
	 */
	public function countItemRatings(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collItemRatings === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ItemRatingPeer::ITEM_ID, $this->id);

				$count = ItemRatingPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ItemRatingPeer::ITEM_ID, $this->id);

				if (!isset($this->lastItemRatingCriteria) || !$this->lastItemRatingCriteria->equals($criteria)) {
					$count = ItemRatingPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collItemRatings);
				}
			} else {
				$count = count($this->collItemRatings);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ItemRating object to this object
	 * through the ItemRating foreign key attribute.
	 *
	 * @param      ItemRating $l ItemRating
	 * @return     void
	 * @throws     PropelException
	 */
	public function addItemRating(ItemRating $l)
	{
		if ($this->collItemRatings === null) {
			$this->initItemRatings();
		}
		if (!in_array($l, $this->collItemRatings, true)) { // only add it if the **same** object is not already associated
			array_push($this->collItemRatings, $l);
			$l->setItem($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Item is new, it will return
	 * an empty collection; or if this Item has previously
	 * been saved, it will retrieve related ItemRatings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Item.
	 */
	public function getItemRatingsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collItemRatings === null) {
			if ($this->isNew()) {
				$this->collItemRatings = array();
			} else {

				$criteria->add(ItemRatingPeer::ITEM_ID, $this->id);

				$this->collItemRatings = ItemRatingPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ItemRatingPeer::ITEM_ID, $this->id);

			if (!isset($this->lastItemRatingCriteria) || !$this->lastItemRatingCriteria->equals($criteria)) {
				$this->collItemRatings = ItemRatingPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastItemRatingCriteria = $criteria;

		return $this->collItemRatings;
	}

	/**
	 * Clears out the collSalesDetails collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSalesDetails()
	 */
	public function clearSalesDetails()
	{
		$this->collSalesDetails = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSalesDetails collection (array).
	 *
	 * By default this just sets the collSalesDetails collection to an empty array (like clearcollSalesDetails());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSalesDetails()
	{
		$this->collSalesDetails = array();
	}

	/**
	 * Gets an array of SalesDetail objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Item has previously been saved, it will retrieve
	 * related SalesDetails from storage. If this Item is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array SalesDetail[]
	 * @throws     PropelException
	 */
	public function getSalesDetails($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSalesDetails === null) {
			if ($this->isNew()) {
			   $this->collSalesDetails = array();
			} else {

				$criteria->add(SalesDetailPeer::ITEM_ID, $this->id);

				SalesDetailPeer::addSelectColumns($criteria);
				$this->collSalesDetails = SalesDetailPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SalesDetailPeer::ITEM_ID, $this->id);

				SalesDetailPeer::addSelectColumns($criteria);
				if (!isset($this->lastSalesDetailCriteria) || !$this->lastSalesDetailCriteria->equals($criteria)) {
					$this->collSalesDetails = SalesDetailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSalesDetailCriteria = $criteria;
		return $this->collSalesDetails;
	}

	/**
	 * Returns the number of related SalesDetail objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SalesDetail objects.
	 * @throws     PropelException
	 */
	public function countSalesDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collSalesDetails === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(SalesDetailPeer::ITEM_ID, $this->id);

				$count = SalesDetailPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(SalesDetailPeer::ITEM_ID, $this->id);

				if (!isset($this->lastSalesDetailCriteria) || !$this->lastSalesDetailCriteria->equals($criteria)) {
					$count = SalesDetailPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collSalesDetails);
				}
			} else {
				$count = count($this->collSalesDetails);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a SalesDetail object to this object
	 * through the SalesDetail foreign key attribute.
	 *
	 * @param      SalesDetail $l SalesDetail
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSalesDetail(SalesDetail $l)
	{
		if ($this->collSalesDetails === null) {
			$this->initSalesDetails();
		}
		if (!in_array($l, $this->collSalesDetails, true)) { // only add it if the **same** object is not already associated
			array_push($this->collSalesDetails, $l);
			$l->setItem($this);
		}
	}

	/**
	 * Clears out the collShoppingCarts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addShoppingCarts()
	 */
	public function clearShoppingCarts()
	{
		$this->collShoppingCarts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collShoppingCarts collection (array).
	 *
	 * By default this just sets the collShoppingCarts collection to an empty array (like clearcollShoppingCarts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initShoppingCarts()
	{
		$this->collShoppingCarts = array();
	}

	/**
	 * Gets an array of ShoppingCart objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Item has previously been saved, it will retrieve
	 * related ShoppingCarts from storage. If this Item is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array ShoppingCart[]
	 * @throws     PropelException
	 */
	public function getShoppingCarts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShoppingCarts === null) {
			if ($this->isNew()) {
			   $this->collShoppingCarts = array();
			} else {

				$criteria->add(ShoppingCartPeer::ITEM_ID, $this->id);

				ShoppingCartPeer::addSelectColumns($criteria);
				$this->collShoppingCarts = ShoppingCartPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ShoppingCartPeer::ITEM_ID, $this->id);

				ShoppingCartPeer::addSelectColumns($criteria);
				if (!isset($this->lastShoppingCartCriteria) || !$this->lastShoppingCartCriteria->equals($criteria)) {
					$this->collShoppingCarts = ShoppingCartPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastShoppingCartCriteria = $criteria;
		return $this->collShoppingCarts;
	}

	/**
	 * Returns the number of related ShoppingCart objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ShoppingCart objects.
	 * @throws     PropelException
	 */
	public function countShoppingCarts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collShoppingCarts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ShoppingCartPeer::ITEM_ID, $this->id);

				$count = ShoppingCartPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(ShoppingCartPeer::ITEM_ID, $this->id);

				if (!isset($this->lastShoppingCartCriteria) || !$this->lastShoppingCartCriteria->equals($criteria)) {
					$count = ShoppingCartPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collShoppingCarts);
				}
			} else {
				$count = count($this->collShoppingCarts);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a ShoppingCart object to this object
	 * through the ShoppingCart foreign key attribute.
	 *
	 * @param      ShoppingCart $l ShoppingCart
	 * @return     void
	 * @throws     PropelException
	 */
	public function addShoppingCart(ShoppingCart $l)
	{
		if ($this->collShoppingCarts === null) {
			$this->initShoppingCarts();
		}
		if (!in_array($l, $this->collShoppingCarts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collShoppingCarts, $l);
			$l->setItem($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Item is new, it will return
	 * an empty collection; or if this Item has previously
	 * been saved, it will retrieve related ShoppingCarts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Item.
	 */
	public function getShoppingCartsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collShoppingCarts === null) {
			if ($this->isNew()) {
				$this->collShoppingCarts = array();
			} else {

				$criteria->add(ShoppingCartPeer::ITEM_ID, $this->id);

				$this->collShoppingCarts = ShoppingCartPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ShoppingCartPeer::ITEM_ID, $this->id);

			if (!isset($this->lastShoppingCartCriteria) || !$this->lastShoppingCartCriteria->equals($criteria)) {
				$this->collShoppingCarts = ShoppingCartPeer::doSelectJoinUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastShoppingCartCriteria = $criteria;

		return $this->collShoppingCarts;
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
			if ($this->collItemRatings) {
				foreach ((array) $this->collItemRatings as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSalesDetails) {
				foreach ((array) $this->collSalesDetails as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShoppingCarts) {
				foreach ((array) $this->collShoppingCarts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collItemRatings = null;
		$this->collSalesDetails = null;
		$this->collShoppingCarts = null;
			$this->aSize = null;
			$this->aItemType = null;
	}

} // BaseItem
