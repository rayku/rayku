-- this is just for reference
-- those tables are not inside schema.yml and this should be fixed
-- SET FOREIGN_KEY_CHECKS=0;
-- DROP TABLE banned_ips,courses,course_sub,
-- expert_course,expert_course_code,expert_subscribers,gtalkcron,item_featured,
-- missed_question_info,points_paypal,popup_close,referral_code,
-- question,sendmessage,tutor_profile,user_course,user_expert,user_expire_msg,
-- user_profile,user_question,user_question_tag,user_rate,user_score,user_stay,user_tutor, whiteboard_moneyback;


ALTER TABLE  `user_fb` ADD  `fb_uid` VARCHAR( 100 ) NOT NULL;
