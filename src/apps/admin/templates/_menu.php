<div id="sidebar">
  <h3>General Settings:</h3>
  <ul id="menu_first">
    <li><?php echo link_to('User Management', 'users/list'); ?></li>
    <li><?php echo link_to('Ban/Unban/Delete Users', 'users/deleteUser'); ?></li>
    <li><?php echo link_to('Award Points', 'users/givePoints'); ?></li>
    <li><?php echo link_to('Categories', 'category/index'); ?></li>
    <li><?php echo link_to('Boards', 'forums/index'); ?></li>
    <li><?php echo link_to('Experts Payouts', 'experts_payouts/index'); ?></li>
    <li><?php echo link_to('Regenerate Cache', 'cache/index'); ?></li>
    <li><?php echo link_to('News Update', 'news/index'); ?></li>
    <li><?php echo link_to('Mass Mail', 'massmail/index'); ?></li>

    <li><?php echo link_to('Threads', 'threads/index'); ?></li>
    <li><?php echo link_to('Reported Posts', 'reportedposts/index'); ?></li>
    <li><?php echo link_to('Log Statistics', 'statistics/index'); ?></li>
    <li><?php echo link_to( 'Logout', "http://$_SERVER[HTTP_HOST]/login/logout", array( 'class' => 'last' ) ); ?></li>
  </ul><br /><br />

  <h3>Manage Users Settings:</h3>
  <ul id="menu_first">
    <li><?php echo link_to('Manage Users & Category', 'manageusers/index'); ?></li>
  </ul><br /><br />

  <h3>Whiteboard Settings:</h3>
  <ul id="menu_first">
    <li><?php echo link_to('Whiteboard Sessions', 'whiteboardsession/index'); ?></li>
    <li><?php echo link_to('Verfied Tutor Whiteboard Sessions', 'whiteboardsession/verify'); ?></li>
    <li><?php echo link_to('Tutor Experience In Whiteboard', 'whiteboardsession/tutor'); ?></li>
  </ul><br /><br />

  <h3>Shop Settings:</h3>
  <ul id="menu_second">
    <li><?php echo link_to('Voucher Management', 'offer_voucher/index'); ?></li>
    <li><?php echo link_to('Item Management', 'item/list'); ?></li>
    <li><?php echo link_to('Item Type', 'itemType/list'); ?></li>
    <li><?php echo link_to('Item Sizes', 'size/list'); ?></li>
    <li><?php echo link_to('Item Status', 'status/list'); ?></li>
    <li><?php echo link_to('Purchase detail', 'purchase_detail/list'); ?></li>
    <li><?php echo link_to('Sales', 'sales/list'); ?></li>
	<li><?php echo link_to('Sales detail', 'sales_detail/list'); ?></li>

 <li><?php echo link_to('Featured Items', 'featured/index', array( 'class' => 'last' ) ); ?></li>
  </ul>
</div>
<!-- End Sidebar-->

<br style="clear:both"/>
<div style="margin:25px;"></div>
