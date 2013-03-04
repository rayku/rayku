<?php
// auto-generated by sfDefineEnvironmentConfigHandler
// date: 2013/03/04 08:46:20
sfConfig::add(array(
  'app_rayku_url' => 'http://qa.rayku.com',
  'app_whiteboard_url' => 'http://w2-qa.rayku.com',
  'app_facebook_url' => 'http://facebook.rayku.local',
  'app_notification_bot_url' => 'http://notification-bot.rayku.local',
  'app_bots_url' => 'http://bots.rayku.com',
  'app_cookies_domain' => '.rayku.com',
  'app_g_chat_port' => 8892,
  'app_fb_chat_port' => 8893,
  'app_mac_server_port' => 5678,
  'app_data_cache' => array (
  'class' => 'sfMemcacheCache',
  'param' => 
  array (
    'servers' => 
    array (
      'localhost1' => 
      array (
        'port' => 11211,
        'host' => 'localhost',
      ),
    ),
  ),
),
  'app_general_admin_email' => 'administration@mail.rayku.com',
  'app_general_allowed_html_tags' => '<b><a><u><i>',
  'app_general_date_format' => 'M j, Y',
  'app_general_referral_points' => 5,
  'app_general_avatar_max_width' => 100,
  'app_general_avatar_max_height' => 100,
  'app_general_avatar_max_width2' => 54,
  'app_general_avatar_max_height2' => 54,
  'app_general_avatar_max_width3' => 69,
  'app_general_avatar_max_height3' => 54,
  'app_general_avatar_max_width4' => 188,
  'app_general_avatar_max_height4' => 155,
  'app_general_avatar_folder' => 'avatar',
  'app_general_avatar_default_image' => 'anon',
  'app_general_avatar_default_image_type' => 'jpg',
  'app_homepage_count_newest_users' => 4,
  'app_forum_threads_per_page' => 25,
  'app_forum_posts_per_page' => 25,
  'app_group_threads_per_page' => 5,
  'app_group_posts_per_page' => 25,
  'app_group_request_exipry_time' => 30,
  'app_group_monthly_point_tax' => 10,
  'app_group_bankrupt_expiry_time' => 60,
  'app_group_members_per_page' => 30,
  'app_users_autocomplete_limit' => 10,
  'app_profile_threads_per_page' => 5,
  'app_profile_posts_per_page' => 25,
  'app_profile_online_activity_timeout' => 60,
  'app_messages_messages_per_page' => 25,
  'app_bulletin_expiry_time' => 30,
  'app_gallery_thumbnail2_max_width' => 120,
  'app_gallery_thumbnail2_max_height' => 120,
  'app_items_upload_folder' => 'item',
  'app_items_image_large_width' => 229,
  'app_items_image_large_height' => 202,
  'app_items_image_thumb_width' => 91,
  'app_items_image_thumb_height' => 91,
  'app_items_award_price' => 2,
  'app_items_award_limit' => 0,
));
