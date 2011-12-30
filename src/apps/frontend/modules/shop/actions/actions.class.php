<?php

/**
 * shop actions.
 *
 * @package    elifes
 * @subpackage shop
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class shopActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {


 if(!empty($_COOKIE["timer"])) :


	$this->redirect('/dashboard/rating');

 endif;

     $category = $this->getRequestParameter('category');
	 $c= new Criteria();
	 $c->add(ItemPeer::IS_ACTIVE,true);
	$c->addDescendingOrderByColumn('rand()');
	 // $c->setLimit(5);
	 if($category)
	 	$c->add(ItemPeer::ITEM_TYPE_ID, $category);
	 $this->items = ItemPeer::doSelect($c);
	 $this->itemTypes = ItemTypePeer::doSelect(new Criteria());
	 $this->user = $this->getUser()->getRaykuUser();


  }

  /**
   * Executes itemDetail action
   *
   */
  public function executeItemDetail()
  {


  	$id=$this->getRequestParameter('id');
	$this->user = $this->getUser()->getRaykuUser();
	$this->item = ItemPeer::retrieveByPK($id);

	$total_item_price = $this->item->getPricePerUnit() + $this->item->getShippingChargePerunit() ;

	if($this->getUser()->getRaykuUser()->getPoints() < $total_item_price )
	{
		$this->msg='Sorry! Not enough RP!' ;
	}
	else
	{
		$this->msg='' ;
	}


	$c = new Criteria();
	$c->add(ItemRatingPeer::ITEM_ID, $this->item->getId());
	$item_ratings=ItemRatingPeer::doSelect($c);

	$this->countReviews = count($item_ratings);
	$rating = 0;
	foreach($item_ratings as $item_rating)
	{
		$rating = $rating + $item_rating->getRating();
	}
	 $c= new Criteria();
	 $c->add(ItemPeer::IS_ACTIVE,true);
	 $c->addDescendingOrderByColumn(ItemPeer::CREATED_AT);
	 $c->add(ItemPeer::ID,$this->item->getId(),Criteria::NOT_EQUAL);

	$this->other_items = ItemPeer::doSelect($c);

	$this->avgRating = ($rating > 0 && count($item_ratings) > 0)? (int)($rating/count($item_ratings)):0;
	$features = $this->item->getFeatures();
	if($features && trim($features)!='')
		 $this->features = explode(',',$features);
	else
		$this->features = '';
	 $c = new Criteria();
	 $c->add(ItemRatingPeer::ITEM_ID, $id);
	 $c->add(ItemRatingPeer::USER_ID, $this->user->getId());
	 $item_rating = ItemRatingPeer::doSelect($c);


	if($item_rating)
		$this->allowRate = false;
	else
		$this->allowRate = true;
  	//this protoype script is put in response for rating compatibility
	$this->getResponse()->addJavascript('prototype');
  	$this->getResponse()->addJavascript('protorater');
  }

  public function executeRate()
  {


  	if($this->getRequest()->isXmlHttpRequest())
	{
		$rating = $this->getRequestParameter('rating');
		$item_id = $this->getRequestParameter('it');
		if($rating > 5)
			$rating =5;
		if($rating < 0 )
			$rating =0;
		 $this->user = $this->getUser()->getRaykuUser();
		 $c = new Criteria();
		 $c->add(ItemRatingPeer::ITEM_ID, $item_id);
		 $c->add(ItemRatingPeer::USER_ID, $this->user->getId());
		 $item_rating = ItemRatingPeer::doSelect($c);

		if($item_rating)
			return $this->renderText('already');
		else
		{
			$item_rating = new ItemRating();
			$item_rating->setUserId($this->user->getId());
			$item_rating->setItemId($item_id);
			$item_rating->setRating($rating);
			$item_rating->save();
			return $this->renderText('success');
		}
		return $this->renderText('fail');
	}
  }

  public function executeAddToCart()
  {




  	if($this->getRequest()->isXmlHttpRequest())
	{
		sfProjectConfiguration::getActive()->loadHelpers('Partial');
		$this->user = $this->getUser()->getRaykuUser();

		$item_id = $this->getRequestParameter('it');
		$quantity = 1;
		$this->item = ItemPeer::retrieveByPK($item_id);

		if(!$this->item->getIsActive())
			$this->item = NULL;
		if($this->item)
		{
			if($this->item->getQuantity() > $quantity )
			{
				$this->user = $this->getUser()->getRaykuUser();
				$c = new Criteria();
				$c->add(ShoppingCartPeer::IS_ACTIVE,true);
				$c->add(ShoppingCartPeer::USER_ID,$this->user->getId());
				$c->addDescendingOrderByColumn(ShoppingCartPeer::CREATED_AT);
				$this->cart_items = ShoppingCartPeer::doSelect($c);
				$tot_price = 0;

				foreach($this->cart_items as $cart_item)
				{
					$tot_price = $tot_price + $cart_item->getTotalPrice() + $cart_item->getTotalShippingCharge();
				}

				$tot_price = $tot_price + ($this->item->getPricePerUnit() * $quantity) + ($this->item->getShippingChargePerUnit() * $quantity);
				if($tot_price <= $this->user->getPoints())
				{
					$shopping_cart = new ShoppingCart();
					$shopping_cart->setItemId($item_id);
					$shopping_cart->setUserId($this->user->getId());
					$shopping_cart->setQuantity($quantity);
					$shopping_cart->setTotalPrice($this->item->getPricePerUnit() * $quantity);
					$shopping_cart->setTotalShippingCharge($this->item->getShippingChargePerUnit() * $quantity);
					$shopping_cart->setIsActive(true);
					$shopping_cart->save();

					$quantity_avail = $this->item->getQuantity();
					$quantity_avail = $quantity_avail - $quantity;

					$this->item->setQuantity($quantity_avail);
					$this->item->save();

					return $this->renderText(get_component('shop','cartBox'));
				}
				else
				{

					return $this->renderText('<span style="line-height:26px"><center>Sorry! Not enough RP!</center></span>'.get_component('shop','cartBox'));
				}
			}
			else
			{
				return $this->renderText('Sorry! Item out of stock'.get_component('shop','cartBox'));
			}

		}
		else
			return $this->renderText('Sorry! No item is there'.get_component('shop','cartBox'));
	}

  }


  public function executeRemoveFromCart()
  {




  	if($this->getRequest()->isXmlHttpRequest())
	{
		sfProjectConfiguration::getActive()->loadHelpers('Partial');
		$cart_id = $this->getRequestParameter('cit');
		$this->user = $this->getUser()->getRaykuUser();
		$shopping_cart = ShoppingCartPeer::retrieveByPk($cart_id);
		if($shopping_cart && $shopping_cart->getUserId() == $this->user->getId())
		{
			$this->user->setPoints($this->user->getPoints() - 1);
			$this->user->save();
			if($shopping_cart->getItem())
			{
				$shopping_cart->getItem()->setQuantity($shopping_cart->getItem()->getQuantity() + $shopping_cart->getQuantity());
				$shopping_cart->getItem()->save();
			}
			$shopping_cart->delete();

			return $this->renderText(get_component('shop','cartBox'));
		}
		else
			return $this->renderText('Item is not removed due to some problem'.get_component('shop','cartBox'));
	}
  }

   public function executeRemoveItemFromCart()
  {



  	if($this->getRequest()->isXmlHttpRequest())
	{
		sfProjectConfiguration::getActive()->loadHelpers('Partial');
		$cart_id = $this->getRequestParameter('cit');
		$this->user = $this->getUser()->getRaykuUser();
		$shopping_cart = ShoppingCartPeer::retrieveByPk($cart_id);
		if($shopping_cart && $shopping_cart->getUserId() == $this->user->getId())
		{
			$this->user->setPoints($this->user->getPoints() - 1);
			$this->user->save();
			$shopping_cart->delete();
			return $this->renderText(get_component('shop','cartCheckoutBox'));
		}
		else
			return $this->renderText('Item is not removed due to some problem'.get_component('shop','cartBox'));
	}
  }

  public function executeCheckoutPage()
  {




    $this->user = $this->getUser()->getRaykuUser();

    $this->cart_items = ShoppingCartPeer::getForUser($this->user->getId());

		$this->getResponse()->addJavascript('prototype');
  }

  public function executePaypal()
  {

   $this->user = $this->getUser()->getRaykuUser();


  }

  public function executeVoucherCode()
  {




    $this->user = $this->getUser()->getRaykuUser();

    $voucherCode = $this->getRequestParameter('coupon');

    $c =  new Criteria();
    $c->add(OfferVoucherPeer::CODE, $voucherCode);
   // $c->add(OfferVoucherPeer::USER_ID, $this->user->getId());
    $c->add(OfferVoucherPeer::VALID_TILL_DATE, time(), Criteria::GREATER_THAN);
    $c->add(OfferVoucherPeer::IS_USED, false);
    $c->add(OfferVoucherPeer::IS_ACTIVE, true);
    $offerVoucher = OfferVoucherPeer::doSelectOne($c);


    if($offerVoucher instanceof OfferVoucher)
    {
      $this->getUser()->setAttribute('voucher_id', $offerVoucher->getId());
    }

    $this->redirect('shop/checkoutPage');


  }

  public function executeCheckout()
  {


  	$this->user = $this->getUser()->getRaykuUser();
    $voucher_id = $this->getUser()->getAttribute('voucher_id');
    $offer = OfferVoucherPeer::retrieveByPK($voucher_id);


//$_SESSION['offerid'] = $offer->getId();

    if($this->getRequest()->getMethod()==sfRequest::POST)
    {
      $c = new Criteria();
      $c->add(ShoppingCartPeer::IS_ACTIVE,true);
      $c->add(ShoppingCartPeer::USER_ID,$this->user->getId());
      $c->addDescendingOrderByColumn(ShoppingCartPeer::CREATED_AT);
      $this->cart_items = ShoppingCartPeer::doSelect($c);

      $purchase_detail = $this->getRequestParameter('purchase');




      foreach( $purchase_detail as $index => $value )
        $purchaseDetail[$index] = trim($value);

      if( $purchaseDetail['name'] == ''
          || $purchaseDetail['email'] == ''
          || $purchaseDetail['address_1'] == ''
          || $purchaseDetail['city'] == ''
          || $purchaseDetail['state'] == ''
          || $purchaseDetail['zip'] == ''
          || $purchaseDetail['country'] == ''
          || $purchaseDetail['tel'] == ''
        )
      {
        sfProjectConfiguration::getActive()->loadHelpers(array('Url','Tag'));
        $this->msg="<p>Please fill in all additional information on the <b>Purchase Cart</b> page.</p>";
        $this->msg.="<p>".link_to( 'Go back to the <b>Purchase Cart</b> page.', 'shop/checkoutPage') . "</p>";

      }
      else if(count($this->cart_items)>0)
      {
        $count = 0;$tot_price=0;$tot_item_price=0;$tot_shipping_price=0;$tot_quantity=0;
        foreach($this->cart_items as $cart_item)
        {
          $tot_price = $tot_price + $cart_item->getTotalPrice() + $cart_item->getTotalShippingCharge();
          if($tot_price > $this->user->getPoints())
            break;
          $sales_detail = new SalesDetail();
          $sales_detail->setItemId($cart_item->getItemId());
          $sales_detail->setTotalPrice($cart_item->getTotalPrice());
          $sales_detail->setTotalShippingCharge($cart_item->getTotalShippingCharge());
          $sales_detail->setQuantity($cart_item->getQuantity());
          $sales_detail->save();

          $count++;
          $tot_item_price = $tot_item_price + $cart_item->getTotalPrice();
          $tot_shipping_price = $tot_shipping_price + $cart_item->getTotalShippingCharge();
          $tot_quantity = $tot_quantity + $cart_item->getQuantity();

		$itemPurchased = ItemPeer::retrieveByPK($cart_item->getItemId());

		if(empty($purchasedItems)) :

			$purchasedItems = $itemPurchased->getTitle();
		else :
			$purchasedItems = $purchasedItems.",".$itemPurchased->getTitle();
		endif;


          $cart_item->delete();
        }

        $sales = new Sales();
        if($offer instanceof OfferVoucher)
        {
          $tot_price = $tot_price - $offer->getPrice();
          //$sales->setOfferVoucherId($offer->getId());
          $offer->setIsUsed(true);
          $offer->save();
        }


        $sales->setTotalSalePrice($tot_price);
        $sales->setTotalItemPrice($tot_item_price);
        $sales->setTotalShippingCharge($tot_shipping_price);
        $sales->setQuantity($tot_quantity);
        $sales->setStatusId(1);


        $sales->save();

        $this->user->setPoints($this->user->getPoints() - $tot_price);
        $this->user->save();

        $full_name = htmlentities($purchase_detail['name']);
        $email = htmlentities($purchase_detail['email']);
        $address_1 = htmlentities($purchase_detail['address_1']);
        $address_2 = htmlentities($purchase_detail['address_2']);
        $city = htmlentities($purchase_detail['city']);
        $state = htmlentities($purchase_detail['state']);
        $zip = htmlentities($purchase_detail['zip']);
        $country = htmlentities($purchase_detail['country']);
        $tel = htmlentities($purchase_detail['tel']);

        $purchase_detail = new PurchaseDetail();
        $purchase_detail->setFullName($full_name);
        $purchase_detail->setUserId($this->user->getId());
        $purchase_detail->setEmail($email);
        $purchase_detail->setAddress1($address_1);
        $purchase_detail->setAddress2($address_2);
        $purchase_detail->setCity($city);
        $purchase_detail->setZip($zip);
        $purchase_detail->setState($state);
        $purchase_detail->setCountry($country);
        $purchase_detail->setSalesId($sales->getId());
        $purchase_detail->save();


					$user = $this->getUser()->getRaykuUser();

					$this->mail = Mailman::createCleanMailer();
					$this->mail->setSubject('Rayku.com Shoping Item Purchase Details');
					$this->mail->setFrom($user->getName().' <'.$user->getEmail().'>');
					$to = "admin@rayku.com";


				$items = "<b>". $purchasedItems . "</b>";

    sfProjectConfiguration::getActive()->loadHelpers(array('Partial'));

					$this->mail->setBody(get_partial('purchaseitem', array( 'name' => $user->getName(), 'user' => $user, 'items' => $items ) ));

					$this->mail->setContentType('text/html');
					$this->mail->addAddress($to);
					$this->mail->send();



        $this->msg = "<p style='font-size:14px;color:#444444'>You have just spent ".$tot_price."RP to purchase ".$count." item(s).<br /><br />A Rayku administrator has been notified, and will deliver your purchase as soon as possible. Once your order has been processed, you will be notified by private message here on Rayku.<br /><br />Thanks!<br />Rayku.com Staff</p>";

        $this->getUser()->setAttribute('voucher_id', null);
      }
      else
        $this->msg="<p style='font-size:14px;color:#444444'>No items in cart</p>";
    }
    else
      $this->msg = "<p style='font-size:14px;color:#444444'>Unauthorized access.</p>";
  }

  public function executeDonatePage()
  {

  	$this->user = $this->getUser()->getRaykuUser();




//$this->items = $allItems;



  }

  public function executeDonate()
  {




  	if($this->getRequest()->getMethod() == sfRequest::POST)
	{
		$amount = htmlentities($this->getRequestParameter('points'));
		$username = htmlentities($this->getRequestParameter('name'));
		$comment = htmlentities($this->getRequestParameter('comments'));
		$this->user = $this->getUser()->getRaykuUser();

		if($this->user && $this->user->getPoints() > $amount)
		{

			$c = new Criteria();
			$c->add(UserPeer::USERNAME, $username);
			$c->add(UserPeer::HIDDEN, false);

			$receiver = UserPeer::doSelectOne($c);
			if($receiver)
			{
				$user_donations = new UserDonations();
				$user_donations->setUserId($receiver->getId());
				$user_donations->setFromUserId($this->user->getId());
				$user_donations->setPoints($amount);
				$user_donations->save();
				$this->user->setPoints($this->user->getPoints() - $amount);
				$this->user->save();
				$receiver->setPoints($receiver->getPoints() + $amount);
				$receiver->save();
				$this->msg = "Successful donation of ".$amount."RP!";
			}
			else
			 $this->msg = "The user you want to donate to can not be found.";
		}
		else
		  $this->msg = "Unauthorized access.";
	}
	else
		$this->msg = "Unauthorized access.";
  }

  public function executeAwardPurchase()
  {



  $this->user = $this->getUser()->getRaykuUser();
  }

  public function executeAwardPurchaseSave()
  {




  	if($this->getRequest()->getMethod() == sfRequest::POST)
	{
		$awardcount = htmlentities($this->getRequestParameter('awardcount'));
		$this->user = $this->getUser()->getRaykuUser();

		if($awardcount > 0)
		{
			$limit = sfConfig::get('app_items_award_limit');
			$amount = $awardcount * sfConfig::get('app_items_award_price');
			if($this->user->getPoints() > $amount)
			{
				$c = new Criteria();
				$c->add(UserAwardsPeer::USER_ID, $this->user->getId());
				$user_award = UserAwardsPeer::doSelectOne($c);
				if($user_award)
				{
					$user_award->setAwards($awardcount + $user_award->getAwards());
					$user_award->save();
				}
				else
				{
					$user_award = new UserAwards();
					$user_award->setAwards($awardcount);
					$user_award->setUserId($this->user->getId());
					$user_award->save();
				}

				$this->user->setPoints($this->user->getPoints() - $amount);
				$this->user->save();
				$this->msg = "Profile icon has been successfully added to your profile.";
			}
		}
		else
		 $this->msg = " Wrong input";
	}
	else
	    $this->msg = "Unauthorized access.";

	$this->setTemplate('checkout');
  }

}

