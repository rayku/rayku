<?php use_helper('Number', 'MyDate'); ?>

<link rel="stylesheet" type="text/css" media="screen" href="/styles/global.css" />

<script type="text/javascript">
	/**
	 * Rayku point updater
	 */
	(function(raykuPoints, jQuery, undefined) {

		// Current user's balance
		var currentBalance = <?php echo $data['user']['points']; ?>;

		// Tutoring price
		var tutoringPrice = <?php echo $data['tutoring']['price']; ?>;

		/**
		 * Returns number formatted as currency
		 *
		 * @param   int     Number
		 * @return  string
		 */
		function formatCurrency(number, prefix, postfix) {
			prefix  = (typeof prefix === 'undefined') ? '' : prefix;
			postfix = (typeof postfix === 'undefined') ? '' : postfix;

			number = isNaN(number) || number === '' || number === null ? 0.00 : number;

			return prefix + parseFloat(number).toFixed(2) + postfix;
		}

		/**
		 * Converts minutes to human readable format
		 *
		 * @param   int     Input minutes
		 * @return  string
		 */
		function minToHuman(minutes)
		{
			var quot, unit, name, plural;
			var output = [];

			var units = [
				{ name: 'week',   'divisor': 7 * 24 * 60 },
				{ name: 'day',    'divisor':     24 * 60 },
				{ name: 'hour',   'divisor':          60 },
				{ name: 'minute', 'divisor':           1 }
			];

			for (i = 0; i < units.length; i++) {
				unit = units[i];
				quot = Math.floor(minutes / unit.divisor);

				if (quot != 0) {
					plural = (quot > 1) ? 's' : '';
					name   = unit.name + plural;

					output.push(quot + ' ' + name);

					minutes -= (quot * unit.divisor);
				}
			}

			return (output.length == 0) ? '0 minutes' : output.join(', ');
		}

		/**
		 * Calculates a new estimated Rayku points
		 *
		 * @param   int     Rayku points to add
		 * @return  int
		 */
		function newEstimate(raykuPoints)
		{
			return currentBalance + parseInt(raykuPoints);
		}

		/**
		 * Calculates tutoring time in minutes for the given Rayku points
		 *
		 * @param   int   Rayku points
		 * @return  int
		 */
		function calculateForRaykuPoints(raykuPoints)
		{
			return parseFloat(raykuPoints) / tutoringPrice;
		}

		/**
		 * Updates the page
		 *
		 * @return  void
		 */
		raykuPoints.update = function() {
			var rp    = jQuery('#rp-package').val();
			var rpEst = newEstimate(rp);

			jQuery('[data-rayku-points="estimated-amount"]').text(formatCurrency(rpEst));
			jQuery('[data-rayku-points="estimated-time"]').text(minToHuman(calculateForRaykuPoints(rpEst)));
			jQuery('[data-rayku-points="price"]').text(formatCurrency(rp, '$'));
			jQuery('[data-rayku-points="amount"]').text(rp);
			jQuery('#payment-container [data-payment="rp"]').val(rp);
		}

	}(window.raykuPoints = window.raykuPoints || {}, jQuery));

	jQuery(document).ready(function() {

		// Update values (in case user refreshed page)
		raykuPoints.update();

		// Disable/Enable button
		jQuery('input[type="submit"][name="payment-button"]')
			.prop('disabled', ! jQuery('[data-payment-container="selection"] input[type="radio"]').is(':checked'));

		// Attach a listener to the Rayku package <select> tag
		jQuery('#rp-package').on('change', function() {
			raykuPoints.update();
		});

		// Handle payment selection
		jQuery('[data-payment-container="selection"] input[type="radio"]').on('click', function() {

			var self = jQuery(this);

			// Disable/Enable button
			jQuery('input[type="submit"][name="payment-button"]')
				.prop('disabled', ! jQuery('[data-payment-container="selection"] input[type="radio"]').is(':checked'));

			// Clean up any previously inserted elements
			jQuery('[data-payment-container="target"] *').remove();

			// Copy selected elements, show them and append to the target
			var copy = self
				.parents('#payment-selection .option')
				.find('[data-payment-container="source"] > div.entry')
				.clone()
				.removeClass('hide')
				.appendTo('[data-payment-container="target"]');
		});

		// Confirm payment remove
		jQuery('#payment-selection a.payment-remove').on('click', function (event) {
			return confirm('You are about to remove a payment method. Proceed?');
		});
	});
</script>

<div class="body-main">
	<div id="what-is">
		<div style="width:30px; float:left;">
			<img src="<?php echo image_path('green_arrow.jpg', false); ?>" width="42" height="25" alt="" />
		</div>
		<p style="font-size:16px; color:#1c517c; font-weight:bold; margin-left:45px;">Purchase Rayku Points</p>
	</div>

	<div id="shop_left">
		<div id="shop_cart">
			<div class="box">
				<div class="t">
					<div class="b">
						<div class="cont">
							<div class="obj" style="font-size:14px;color:#444;line-height:20px;">
								<div class="raykupoints" align="center">
									YOUR RAYKU POINTS<br>
									<span><?php echo $data['user']['points']; ?></span>
								</div>

								<div class="rpcontent">
									<p>Rayku Points are tutoring credits that you can use on the site to pay for premium live tutoring sessions.</p>
								</div>

								<div style="clear:both"></div>
								<div class="rpdivider"></div>

								<form id="buyrp" action="" method="post">
									<p class="buyrp">Buy</p>
									<select name="rp-package" id="rp-package" class="buyrp" style="margin: -5px 5px 0;">
										<?php foreach ($data['points']['packages'] as $package): ?>
										<option value="<?php echo $package; ?>"><?php echo $package; ?></option>
										<?php endforeach; ?>
									</select>

									<p class="buyrp">
										Rayku Points for
										<span data-rayku-points="price" style="color: #060; font-weight: bold;">
											$<?php echo format_currency(reset($data['points']['packages'])); ?>
										</span>
										(CAD)
									</p>

									<div style="clear:both"></div>

									<p style="margin-top: 5px; font-size: 14px; color: #666;">
										This will give you a total of
										<span data-rayku-points="estimated-amount"><?php echo $data['points']['estimate']; ?></span>
										RP, which can account for
										<span data-rayku-points="estimated-time"><?php echo date_min_to_human($data['tutoring']['estimate']); ?></span>
										<span> * of premium tutoring.</span>
									</p>
								</form>
							</div>

							<div class="ch">
								<div class="obj">
									<h1>Item</h1>
								</div>

								<div class="price">
									<h1>Price</h1>
								</div>

								<div class="clear"></div>
								<div class="sep"></div>

								<div class="obj"><span data-rayku-points="amount"><?php echo $data['points']['amount']; ?></span> Rayku Points (RP)</div>
								<div class="price" data-rayku-points="price">$<?php echo format_currency($data['points']['amount']); ?></div>

								<div class="clear"></div>
								<div class="sep"></div>

								<div class="f">
									<img src="../images/securepayment.jpg" title="Secure Payment via PayPal">
								</div>

								<div class="clear"></div>
							</div>

							<div class="rpnote">*estimate is provided assuming an average tutoring rate of 0.40RP/minute.</div>
						</div>

						<div class="rpdivider"></div>

						<div class="cont">
							<div id="payment-selection"> <!-- option container -->
								<p>Select payment option:</p>
								<div class="option">
									<div class="entry" data-payment-container="selection">
										<input id="payment-type-paypal" type="radio" name="payment-type" value="true" />
										<label for="payment-type-paypal" class="inline">PayPal</label>
									</div>

									<div data-payment-container="source">
										<div class="entry hide">
											<label for="payment-paypal-email">Email:</label>
											<input id="payment-paypal-email" type="input" name="payment[data][email]" value="" />
										</div>
									</div>

									<div data-payment-container="source">
										<div class="entry hide">
											<input type="hidden" name="payment[type]" value="paypal" />
										</div>
									</div>
								</div>

								<?php foreach ($data['user']['credit_cards'] as $creditCard): ?>
								<div class="option">
									<div class="entry" data-payment-container="selection">
										<input id="payment-type-cc-<?php echo $creditCard->getId(); ?>" type="radio" name="payment-type" value="" />
										<label for="payment-type-cc-<?php echo $creditCard->getId(); ?>" class="inline">(<?php echo $creditCard->getType(); ?>) XXXX-XXXX-XXXX-<?php echo $creditCard->getNumber(); ?></label>
										<a href="<?php echo url_for(array('sf_route' => 'payment_remove', 'type' => 'cc', 'id' => $creditCard->getId())); ?>" title="Remove Credit Card" class="payment-remove">(Remove Credit Card)</a>
									</div>

									<div data-payment-container="source">
										<div class="entry hide">
											<input type="hidden" name="payment[type]" value="cc" />
											<input type="hidden" name="payment[data][id]" value="<?php echo $creditCard->getId(); ?>" />
										</div>
									</div>
								</div>
								<?php endforeach; ?>

								<div class="option">
									<div class="entry" data-payment-container="selection">
										<input id="payment-type-cc-new" type="radio" name="payment-type" value="" />
										<label for="payment-type-cc-new" class="inline">Enter a new credit card</label>
									</div>

									<div data-payment-container="source">
										<div class="entry hide">
											<label for="payment-cc-name-new" class="title">Cardholder Name:</label>
											<input id="payment-cc-name-new" type="input" name="payment[data][name]" value="" />
										</div>

										<div class="entry hide">
											<label for="payment-cc-number" class="title">Credit Card Number:</label>
											<input id="payment-cc-number" type="input" name="payment[data][number]" value="" />
										</div>

										<div class="entry hide">
											<label for="payment-cc-expiry" class="title">Expiry date (mm/yyyy):</label>
											<input id="payment-cc-expiry" type="input" name="payment[data][expiry]" value="" />
										</div>

										<div class="entry hide">
											<input type="hidden" name="payment[type]" value="cc" />
											<input type="hidden" name="payment[data][id]" value="" />
										</div>
									</div>
								</div>
							</div>  <!-- option container -->

							<form id="payment-container" action="<?php echo url_for('@points_buy'); ?>" method="post" autocomplete="off">
								<div data-payment-container="target"></div>

								<input data-payment="rp" type="hidden" name="payment[rp]" value="5" />
								<input type="hidden" name="_csrf_token" value="" />

								<div align="right">
									<input type="submit" class="myButton" value="Purchase Now" name="payment-button" disabled="disabled" />
								</div>
							</form>

							<div class="bottom"></div>
							<div class="spacer"></div>
						</div> <!-- cont end -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<p style="font-size:14px;color:#666;">You may cash out <?php echo $data['user']['points']; ?>RP for <strong>$<?php echo format_currency($data['user']['points']); ?></strong></p><br />
	<input type="submit" class="myButton" value="Cash Out" name="submit"/>
</div>

<div id="shop_right">
	<div class="text">
		<h2 style="font-size:16px;line-height:20px;border-bottom:1px solid #CCC;color:#666;font-weight:bold;margin-top:10px;">Why?</h2>
		<p style="margin-top:20px;">Full-length, on-demand sessions with the top-rated Rayku tutors.</p>
		<p style="margin-top:20px;">Premium sessions are charged by-the-minute. Only pay for what you use.</p>
		<p style="margin-top:20px;">Rayku Points do not expire. They are yours to keep and use forever!</p>
	</div>
</div>
<!--shop_right-->
