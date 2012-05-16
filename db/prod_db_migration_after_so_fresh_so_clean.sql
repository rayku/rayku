-- REMOVING of all tables that was removed from schema.yml file and during other cleanup tasks
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE `assignment`, `blog_attachments`, `classroom`, `classroom_blog`, `classroom_comment`,
`classroom_forum`, `classroom_forum_comment`, `classroom_forum_post`, `classroom_members`,
`content_page`, `content_page_attachments`, `experts_immediate_lesson`, `experts_lesson_members`,
`expert_lesson`, `expert_lesson_schedule`, `expert_student_schedules`, `friend`, `gallery`,
`gallery_acl`, `gallery_item`, `gift`, `group_site_page`, `group_user`, `invitation`,
`journal_entry`, `journal_entry_acl`, `network`, `nudge`, `report_entity`, `report_user`,
`saved_experts`, `student_voice`, `student_voice_votes`, `submission`, `subscription`,
`users_networks`, `user_donations`, `user_gift`, `user_interest`;


-- this is just for reference
-- those tables are not inside schema.yml and this should be fixed
-- SET FOREIGN_KEY_CHECKS=0;
-- DROP TABLE banned_ips,courses,course_sub,experts_credit_details,expert_available_days,
-- expert_course,expert_course_code,expert_subscribers,gtalkcron,item_featured,kinkarso_points,
-- log_statistics,log_user_connect_whiteboard,log_user_login,log_user_on_off,log_user_whiteboard,
-- missed_question_info,news_update,points_notify,points_paypal,popup_close,referral_code,
-- question,sendmessage,tutor_profile,usergroup,user_course,user_expert,user_expire_msg,
-- user_fb,user_profile,user_question,user_question_tag,user_rate,user_score,user_stay,user_tutor, whiteboard_moneyback;



-- unifing charset/collation used to utf8_general_ci
ALTER TABLE  `experts_admin_payout` ENGINE = INNODB;
ALTER TABLE  `experts_debit_details` ENGINE = INNODB;
ALTER TABLE  `experts_final_credit` ENGINE = INNODB;
ALTER TABLE  `experts_promo_text` ENGINE = INNODB;
ALTER TABLE  `notification_emails` ENGINE = INNODB;
ALTER TABLE  `offer_voucher` ENGINE = INNODB;
ALTER TABLE  `post` ENGINE = INNODB;
ALTER TABLE  `students_instant_questions` ENGINE = INNODB;
ALTER TABLE  `thread` ENGINE = INNODB;
ALTER TABLE  `user_gtalk` ENGINE = INNODB;
ALTER TABLE  `whiteboard_moneyback` ENGINE = INNODB;
ALTER TABLE  `whiteboard_tutor_feedback` ENGINE = INNODB;

ALTER TABLE  `student_questions` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `user_gtalk` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `whiteboard_chat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `whiteboard_message` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `whiteboard_moneyback` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `whiteboard_sessions` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `whiteboard_snapshot` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE  `whiteboard_tutor_feedback` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE  `student_questions` CHANGE  `question`  `question` VARCHAR( 500 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `student_questions` CHANGE  `course_code`  `course_code` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `student_questions` CHANGE  `year`  `year` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `student_questions` CHANGE  `school`  `school` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `student_questions` CHANGE  `source`  `source` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


ALTER TABLE  `whiteboard_chat` CHANGE  `expert_nickname`  `expert_nickname` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `whiteboard_chat` CHANGE  `asker_nickname`  `asker_nickname` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `whiteboard_chat` CHANGE  `question`  `question` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `whiteboard_chat` CHANGE  `directory`  `directory` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `whiteboard_chat` CHANGE  `timer`  `timer` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `whiteboard_chat` CHANGE  `comments`  `comments` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE  `user_gtalk` CHANGE  `gtalkid`  `gtalkid` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `whiteboard_message` CHANGE  `message`  `message` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `whiteboard_moneyback` CHANGE  `reason`  `reason` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `whiteboard_sessions` CHANGE  `token`  `token` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `whiteboard_sessions` CHANGE  `chat_id`  `chat_id` VARCHAR( 40 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `whiteboard_snapshot` CHANGE  `filename`  `filename` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE  `whiteboard_tutor_feedback` CHANGE  `feedback`  `feedback` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

-- dodanie brakujacych powiazan
ALTER TABLE  `rayku_db`.`student_questions` ADD INDEX  `student_questions_FI_1` (  `user_id` );
ALTER TABLE  `rayku_db`.`student_questions` ADD INDEX  `student_questions_FI_2` (  `checked_id` );
SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE  `student_questions` ADD FOREIGN KEY (  `user_id` ) REFERENCES  `rayku_db`.`user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT ;
ALTER TABLE  `student_questions` ADD FOREIGN KEY (  `checked_id` ) REFERENCES  `rayku_db`.`user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT ;


-- modification of user table
ALTER TABLE  `user` ADD  `credit_card` VARCHAR( 4 ) NULL DEFAULT NULL AFTER  `login` ,
ADD  `credit_card_token` VARCHAR( 10 ) NULL DEFAULT NULL AFTER  `credit_card` ,
ADD  `first_charge` TIMESTAMP NULL DEFAULT NULL AFTER  `credit_card_token`;

-- adding relations
ALTER TABLE  `rayku_db`.`whiteboard_tutor_feedback` ADD INDEX  `whiteboard_tutor_feedback_FI_1` (  `whiteboard_chat_id` );
SET FOREIGN_KEY_CHECKS=0;
ALTER TABLE  `whiteboard_tutor_feedback` ADD FOREIGN KEY (  `whiteboard_chat_id` ) REFERENCES  `rayku_db`.`whiteboard_chat` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT ;


-- removing of journal related elements
ALTER TABLE  `comment` DROP FOREIGN KEY  `comment_FK_1` ;
ALTER TABLE `comment` DROP INDEX `comment_FI_4`;
ALTER TABLE `comment` DROP `journal_entry_id`;

ALTER TABLE live_video_chat DROP INDEX video_live_chat_FI_3;

ALTER TABLE  `user` DROP  `about_me` , DROP  `show_hobbies` ;

ALTER TABLE `user` DROP FOREIGN KEY  `user_ibfk_1` ;
ALTER TABLE `user` DROP `network_id`;