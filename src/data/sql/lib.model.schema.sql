
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- album
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `album`;


CREATE TABLE `album`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(150),
	`description` TEXT,
	`owner_id` INTEGER(11),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `album_FI_1`(`owner_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- assignment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `assignment`;


CREATE TABLE `assignment`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`classroom_id` INTEGER(11)  NOT NULL,
	`title` VARCHAR(50)  NOT NULL,
	`description` TEXT  NOT NULL,
	`format` VARCHAR(50)  NOT NULL,
	`attachments` VARCHAR(100)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`due_date` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `assignment_FI_1`(`classroom_id`),
	CONSTRAINT `assignment_FK_1`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- blog_attachments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `blog_attachments`;


CREATE TABLE `blog_attachments`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`classroom_blog_id` INTEGER(11)  NOT NULL,
	`file` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `classroom_blog_id`(`classroom_blog_id`),
	CONSTRAINT `blog_attachments_FK_1`
		FOREIGN KEY (`classroom_blog_id`)
		REFERENCES `classroom_blog` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- bulletin
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bulletin`;


CREATE TABLE `bulletin`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`poster_id` INTEGER(11),
	`content` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `bulletin_FI_1`(`poster_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50)  NOT NULL,
	`description` TEXT  NOT NULL,
	`parent` INTEGER(11)  NOT NULL,
	`prefix` VARCHAR(10)  NOT NULL,
	`updated_at` DATE  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `category_name_unique` (`name`),
	UNIQUE KEY `category_prefix_unique` (`prefix`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- chat_data
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `chat_data`;


CREATE TABLE `chat_data`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(100)  NOT NULL,
	`expert_name` VARCHAR(100)  NOT NULL,
	`text` TEXT  NOT NULL,
	`flag` INTEGER(11)  NOT NULL,
	`time` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- chat_detail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `chat_detail`;


CREATE TABLE `chat_detail`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user` VARCHAR(100)  NOT NULL,
	`expert` VARCHAR(100)  NOT NULL,
	`minutes` INTEGER(10)  NOT NULL,
	`expert_agreed` INTEGER(10)  NOT NULL,
	`user_ask` INTEGER(10)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- chat_history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `chat_history`;


CREATE TABLE `chat_history`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(100)  NOT NULL,
	`expert_name` VARCHAR(100)  NOT NULL,
	`text` TEXT  NOT NULL,
	`time` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- chat_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `chat_user`;


CREATE TABLE `chat_user`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(100)  NOT NULL,
	`status` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- classroom
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom`;


CREATE TABLE `classroom`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`category_id` INTEGER(11)  NOT NULL,
	`classroom_banner` VARCHAR(50)  NOT NULL,
	`fullname` VARCHAR(50)  NOT NULL,
	`shortname` VARCHAR(50)  NOT NULL,
	`class_username` VARCHAR(100)  NOT NULL,
	`email_passcode` VARCHAR(100)  NOT NULL,
	`classroom_email` VARCHAR(100)  NOT NULL,
	`live_webcam` INTEGER(11) default 0 NOT NULL,
	`email_updateblog` INTEGER(11) default 0 NOT NULL,
	`school_name` VARCHAR(100)  NOT NULL,
	`location` VARCHAR(100)  NOT NULL,
	`idnumber` VARCHAR(50)  NOT NULL,
	`summary` TEXT  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `classroom_shortname_unique` (`shortname`),
	KEY `classroom_FI_1`(`user_id`),
	KEY `classroom_FI_2`(`category_id`),
	CONSTRAINT `classroom_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- classroom_blog
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom_blog`;


CREATE TABLE `classroom_blog`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(200)  NOT NULL,
	`message` TEXT  NOT NULL,
	`classroom_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `blog_FI_1`(`classroom_id`),
	CONSTRAINT `classroom_blog_FK_1`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- classroom_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom_comment`;


CREATE TABLE `classroom_comment`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`classroom_blog_id` INTEGER(11)  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`content` TEXT  NOT NULL,
	`posted_at` DATETIME  NOT NULL,
	`approved` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `classroom_comment_FI_2`(`user_id`),
	KEY `classroom_comment_FI_1`(`classroom_blog_id`),
	CONSTRAINT `classroom_comment_FK_1`
		FOREIGN KEY (`classroom_blog_id`)
		REFERENCES `classroom_blog` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `classroom_comment_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- classroom_forum
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom_forum`;


CREATE TABLE `classroom_forum`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`forum_name` VARCHAR(50)  NOT NULL,
	`description` TEXT  NOT NULL,
	`classroom_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- classroom_forum_comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom_forum_comment`;


CREATE TABLE `classroom_forum_comment`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`thread_id` INTEGER(11)  NOT NULL,
	`commentor_id` INTEGER(11)  NOT NULL,
	`content` TEXT  NOT NULL,
	`approved` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- classroom_forum_post
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom_forum_post`;


CREATE TABLE `classroom_forum_post`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(100)  NOT NULL,
	`content` TEXT  NOT NULL,
	`poster_id` INTEGER(11)  NOT NULL,
	`forum_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- classroom_members
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom_members`;


CREATE TABLE `classroom_members`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`category_id` INTEGER(11)  NOT NULL,
	`classroom_id` INTEGER(11)  NOT NULL,
	`approved` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `classroom_members_FI_1`(`user_id`),
	KEY `classroom_members_FI_2`(`category_id`),
	KEY `classroom_members_FI_3`(`classroom_id`),
	CONSTRAINT `classroom_members_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `classroom_members_FK_2`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;


CREATE TABLE `comment`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`journal_entry_id` INTEGER(11),
	`poster_id` INTEGER(11),
	`picture_id` INTEGER(11),
	`video_id` INTEGER(11),
	`content` TEXT,
	`created_at` DATETIME,
	`type` INTEGER(11),
	`approved` INTEGER(11) default 0,
	PRIMARY KEY (`id`),
	KEY `comment_FI_1`(`poster_id`),
	KEY `comment_FI_2`(`picture_id`),
	KEY `comment_FI_3`(`video_id`),
	KEY `comment_FI_4`(`journal_entry_id`),
	CONSTRAINT `comment_FK_1`
		FOREIGN KEY (`journal_entry_id`)
		REFERENCES `journal_entry` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- content_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `content_page`;


CREATE TABLE `content_page`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(100)  NOT NULL,
	`content` TEXT  NOT NULL,
	`classroom_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `content_page_FI_1`(`classroom_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- content_page_attachments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `content_page_attachments`;


CREATE TABLE `content_page_attachments`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`content_page_id` INTEGER(11)  NOT NULL,
	`file` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- expert
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `expert`;


CREATE TABLE `expert`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`title` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`domain` VARCHAR(100)  NOT NULL,
	`language` VARCHAR(100)  NOT NULL,
	`onlinerate` FLOAT,
	`emailrate` FLOAT,
	`moc` VARCHAR(100),
	`rating` INTEGER(11) default 0 NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `expert_FI_1`(`user_id`),
	CONSTRAINT `expert_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- expert_available_days
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `expert_available_days`;


CREATE TABLE `expert_available_days`
(
	`id` INTEGER(40)  NOT NULL AUTO_INCREMENT,
	`expert_id` INTEGER(40)  NOT NULL,
	`monday` INTEGER(10)  NOT NULL,
	`tuesday` INTEGER(10)  NOT NULL,
	`wednesday` INTEGER(10)  NOT NULL,
	`thursday` INTEGER(10)  NOT NULL,
	`friday` INTEGER(10)  NOT NULL,
	`saturday` INTEGER(10)  NOT NULL,
	`sunday` INTEGER(10)  NOT NULL,
	`timings` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- expert_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `expert_category`;


CREATE TABLE `expert_category`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`category_id` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `expert_category_FI_1`(`user_id`),
	KEY `expert_category_FI_2`(`category_id`),
	CONSTRAINT `expert_category_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `expert_category_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- expert_lesson
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `expert_lesson`;


CREATE TABLE `expert_lesson`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(100)  NOT NULL,
	`content` TEXT  NOT NULL,
	`price` FLOAT  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`day` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `expert_lesson_FI_1`(`user_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- expert_lesson_schedule
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `expert_lesson_schedule`;


CREATE TABLE `expert_lesson_schedule`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`date` INTEGER(11)  NOT NULL,
	`timings` VARCHAR(100)  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`expert_lesson_id` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `expert_lesson_schedule_FI_1`(`user_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- expert_student_schedules
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `expert_student_schedules`;


CREATE TABLE `expert_student_schedules`
(
	`id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`exp_id` INTEGER(11)  NOT NULL,
	`student_id` INTEGER(11)  NOT NULL,
	`date` INTEGER(11)  NOT NULL,
	`time` INTEGER(11)  NOT NULL,
	`message` TEXT  NOT NULL,
	`expert_lesson_id` INTEGER(11)  NOT NULL,
	`accept_reject` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- experts_admin_payout
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `experts_admin_payout`;


CREATE TABLE `experts_admin_payout`
(
	`id` INTEGER(100)  NOT NULL AUTO_INCREMENT,
	`expert_id` INTEGER(10)  NOT NULL,
	`amount` FLOAT(5,2)  NOT NULL,
	`paypal_id` VARCHAR(100)  NOT NULL,
	`paid` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- experts_credit_details
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `experts_credit_details`;


CREATE TABLE `experts_credit_details`
(
	`id` INTEGER(100)  NOT NULL AUTO_INCREMENT,
	`student_id` INTEGER(10)  NOT NULL,
	`expert_id` INTEGER(10)  NOT NULL,
	`credit_amount` FLOAT(5,2)  NOT NULL,
	`lesson_id` INTEGER(20)  NOT NULL,
	`immediate_lesson_id` INTEGER(20)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- experts_debit_details
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `experts_debit_details`;


CREATE TABLE `experts_debit_details`
(
	`id` INTEGER(100)  NOT NULL AUTO_INCREMENT,
	`expert_id` INTEGER(10)  NOT NULL,
	`amount` FLOAT(5,2)  NOT NULL,
	`time` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- experts_final_credit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `experts_final_credit`;


CREATE TABLE `experts_final_credit`
(
	`id` INTEGER(100)  NOT NULL AUTO_INCREMENT,
	`expert_id` INTEGER(10)  NOT NULL,
	`amount` FLOAT(5,2)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- experts_immediate_lesson
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `experts_immediate_lesson`;


CREATE TABLE `experts_immediate_lesson`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50)  NOT NULL,
	`content` TEXT  NOT NULL,
	`price` FLOAT  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- experts_lesson_members
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `experts_lesson_members`;


CREATE TABLE `experts_lesson_members`
(
	`id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`student_id` INTEGER(20)  NOT NULL,
	`category_id` INTEGER(20)  NOT NULL,
	`expert_id` INTEGER(20)  NOT NULL,
	`lesson_id` INTEGER(20)  NOT NULL,
	`approve` INTEGER(10)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- experts_promo_text
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `experts_promo_text`;


CREATE TABLE `experts_promo_text`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`exp_id` INTEGER(11)  NOT NULL,
	`content` TEXT  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- forum
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `forum`;


CREATE TABLE `forum`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100),
	`description` TEXT,
	`type` INTEGER(11),
	`entity_id` INTEGER(11),
	`top_or_bottom` INTEGER(10)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- forum_answer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `forum_answer`;


CREATE TABLE `forum_answer`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`answer` TEXT  NOT NULL,
	`forum_question_id` INTEGER(11)  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`best_response` INTEGER(11) default 0 NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `forum_answer_FI_1`(`forum_question_id`),
	KEY `forum_answer_FI_2`(`user_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- forum_question
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `forum_question`;


CREATE TABLE `forum_question`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(100)  NOT NULL,
	`question` TEXT  NOT NULL,
	`category_id` INTEGER(11)  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`visible` INTEGER(11) default 0 NOT NULL,
	`cancel` INTEGER(10)  NOT NULL,
	`notify` INTEGER(11) default 0 NOT NULL,
	`tags` VARCHAR(100)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `forum_question_FI_1`(`category_id`),
	KEY `forum_question_FI_2`(`user_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- friend
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `friend`;


CREATE TABLE `friend`
(
	`user_id1` INTEGER(11),
	`user_id2` INTEGER(11),
	`status` INTEGER(11) default 0,
	`created_at` DATETIME,
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `friend_FI_1`(`user_id1`),
	KEY `friend_FI_2`(`user_id2`),
	CONSTRAINT `friend_FK_1`
		FOREIGN KEY (`user_id1`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `friend_FK_2`
		FOREIGN KEY (`user_id2`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- gallery
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `gallery`;


CREATE TABLE `gallery`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`show_entity` INTEGER(11),
	`user_id` INTEGER(11),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`classroom_id` INTEGER(11),
	PRIMARY KEY (`id`),
	KEY `gallery_FI_1`(`user_id`),
	KEY `gallery_FI_2`(`classroom_id`),
	CONSTRAINT `gallery_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `gallery_FK_2`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- gallery_acl
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `gallery_acl`;


CREATE TABLE `gallery_acl`
(
	`gallery_id` INTEGER(11),
	`user_id` INTEGER(11),
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `gallery_acl_FI_1`(`gallery_id`),
	KEY `gallery_acl_FI_2`(`user_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- gallery_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `gallery_item`;


CREATE TABLE `gallery_item`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`gallery_id` INTEGER(11),
	`user_id` INTEGER(11),
	`file_name` VARCHAR(255),
	`file_system_path` VARCHAR(255),
	`mime_type` VARCHAR(255),
	`is_image` INTEGER(11),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `gallery_item_FI_1`(`gallery_id`),
	KEY `user_id`(`user_id`),
	CONSTRAINT `gallery_item_FK_1`
		FOREIGN KEY (`gallery_id`)
		REFERENCES `gallery` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `gallery_item_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- gift
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `gift`;


CREATE TABLE `gift`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50),
	`image` VARCHAR(100),
	`description` TEXT,
	`cost` INTEGER(11),
	`hidden` INTEGER(11) default 0,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- group_site_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `group_site_page`;


CREATE TABLE `group_site_page`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(100),
	`group_id` INTEGER(11),
	`content` TEXT,
	`page_order` INTEGER(11),
	`template` VARCHAR(150),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `group_site_page_FI_1`(`group_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- group_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `group_user`;


CREATE TABLE `group_user`
(
	`group_id` INTEGER(11),
	`inviter_id` INTEGER(11),
	`user_id` INTEGER(11),
	`status` INTEGER(11),
	`created_at` DATETIME,
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `group_user_FI_1`(`group_id`),
	KEY `group_user_FI_2`(`inviter_id`),
	KEY `group_user_FI_3`(`user_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- history
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `history`;


CREATE TABLE `history`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`entity_type` VARCHAR(100),
	`data` VARCHAR(255),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `history_FI_1`(`user_id`),
	CONSTRAINT `history_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- invitation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `invitation`;


CREATE TABLE `invitation`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`receiver_email` VARCHAR(100)  NOT NULL,
	`receiver_code` VARCHAR(100)  NOT NULL,
	`sent` INTEGER(11) default 0 NOT NULL,
	PRIMARY KEY (`id`),
	KEY `invitation_FI_1`(`user_id`),
	CONSTRAINT `invitation_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item`;


CREATE TABLE `item`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`size_id` INTEGER(11),
	`item_type_id` INTEGER(11),
	`title` VARCHAR(255),
	`description` TEXT,
	`price_per_unit` INTEGER(11),
	`shipping_charge_per_unit` INTEGER(11),
	`actual_value` INTEGER(11),
	`actual_value_currency` VARCHAR(5),
	`quantity` INTEGER(11),
	`image` VARCHAR(255),
	`features` TEXT,
	`is_active` INTEGER(11),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `item_FI_1`(`size_id`),
	KEY `item_FI_2`(`item_type_id`),
	CONSTRAINT `item_FK_1`
		FOREIGN KEY (`size_id`)
		REFERENCES `size` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `item_FK_2`
		FOREIGN KEY (`item_type_id`)
		REFERENCES `item_type` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- item_rating
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item_rating`;


CREATE TABLE `item_rating`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`item_id` INTEGER(11),
	`user_id` INTEGER(11),
	`rating` INTEGER(11),
	PRIMARY KEY (`id`),
	KEY `item_rating_FI_1`(`item_id`),
	KEY `item_rating_FI_2`(`user_id`),
	CONSTRAINT `item_rating_FK_1`
		FOREIGN KEY (`item_id`)
		REFERENCES `item` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `item_rating_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- item_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item_type`;


CREATE TABLE `item_type`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- journal_entry
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `journal_entry`;


CREATE TABLE `journal_entry`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`subject` VARCHAR(150),
	`content` TEXT,
	`created_at` DATETIME,
	`show_entity` INTEGER(11),
	PRIMARY KEY (`id`),
	KEY `journal_entry_FI_1`(`user_id`),
	CONSTRAINT `journal_entry_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- journal_entry_acl
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `journal_entry_acl`;


CREATE TABLE `journal_entry_acl`
(
	`journal_entry_id` INTEGER(11),
	`user_id` INTEGER(11),
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `journal_entry_acl_FI_1`(`journal_entry_id`),
	KEY `journal_entry_acl_FI_2`(`user_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- live_video_chat
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `live_video_chat`;


CREATE TABLE `live_video_chat`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`receiver_id` INTEGER(11)  NOT NULL,
	`sender_id` INTEGER(11)  NOT NULL,
	`classroom_id` INTEGER(11)  NOT NULL,
	`approved` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `video_live_chat_FI_1`(`receiver_id`),
	KEY `video_live_chat_FI_2`(`sender_id`),
	KEY `video_live_chat_FI_3`(`classroom_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- network
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `network`;


CREATE TABLE `network`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(150),
	`description` TEXT,
	`type` INTEGER(11),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- notification_emails
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notification_emails`;


CREATE TABLE `notification_emails`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(100)  NOT NULL,
	`on_off` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- nudge
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `nudge`;


CREATE TABLE `nudge`
(
	`user_from_id` INTEGER(11),
	`user_to_id` INTEGER(11),
	`created_at` DATETIME,
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	KEY `nudge_FI_1`(`user_from_id`),
	KEY `nudge_FI_2`(`user_to_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- offer_voucher
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `offer_voucher`;


CREATE TABLE `offer_voucher`
(
	`id` INTEGER(40)  NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(100)  NOT NULL,
	`valid_till_date` DATE  NOT NULL,
	`is_used` INTEGER(10)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`is_active` INTEGER(10)  NOT NULL,
	`price` INTEGER(100)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- offer_voucher1
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `offer_voucher1`;


CREATE TABLE `offer_voucher1`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`code` VARCHAR(255),
	`valid_till_date` DATE,
	`is_used` INTEGER(11),
	`created_at` DATETIME,
	`is_active` INTEGER(11),
	`price` INTEGER(11) default 0,
	PRIMARY KEY (`id`),
	KEY `user_id`(`user_id`),
	KEY `id`(`id`),
	CONSTRAINT `offer_voucher1_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- picture
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `picture`;


CREATE TABLE `picture`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(150),
	`description` TEXT,
	`album_id` INTEGER(11),
	`owner_id` INTEGER(11),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `picture_FI_1`(`album_id`),
	KEY `picture_FI_2`(`owner_id`),
	CONSTRAINT `picture_FK_1`
		FOREIGN KEY (`album_id`)
		REFERENCES `album` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `picture_FK_2`
		FOREIGN KEY (`owner_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- post
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `post`;


CREATE TABLE `post`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`poster_id` INTEGER(11)  NOT NULL,
	`thread_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	`content` TEXT  NOT NULL,
	`best_response` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- private_message
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `private_message`;


CREATE TABLE `private_message`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`subject` VARCHAR(150),
	`body` TEXT,
	`sender_id` INTEGER(11),
	`recipient_id` INTEGER(11),
	`status` INTEGER(11) default 0,
	`read_status` INTEGER(11) default 0,
	`created_at` DATETIME,
	`type` INTEGER(11) default 0,
	PRIMARY KEY (`id`),
	KEY `private_message_FI_1`(`sender_id`),
	KEY `private_message_FI_2`(`recipient_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- purchase_detail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `purchase_detail`;


CREATE TABLE `purchase_detail`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`sales_id` INTEGER(11),
	`transaction_id` INTEGER(11),
	`full_name` VARCHAR(255),
	`email` VARCHAR(255),
	`address1` VARCHAR(255),
	`address2` VARCHAR(255),
	`city` VARCHAR(255),
	`state` VARCHAR(255),
	`country` VARCHAR(255),
	`telephone_number` VARCHAR(255),
	`zip` VARCHAR(20) default '0',
	PRIMARY KEY (`id`),
	KEY `purchase_detail_FI_1`(`user_id`),
	KEY `purchase_detail_FI_2`(`sales_id`),
	CONSTRAINT `purchase_detail_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `purchase_detail_FK_2`
		FOREIGN KEY (`sales_id`)
		REFERENCES `sales` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- report_entity
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `report_entity`;


CREATE TABLE `report_entity`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`report_count` INTEGER(11),
	`thread_id` INTEGER(11),
	`post_id` INTEGER(11),
	`group_id` INTEGER(11),
	`bulletin_id` INTEGER(11),
	`group_site_page_id` INTEGER(11),
	`comment_id` INTEGER(11),
	`picture_id` INTEGER(11),
	`video_id` INTEGER(11),
	`shout_id` INTEGER(11),
	PRIMARY KEY (`id`),
	UNIQUE KEY `report_entity_thread_id_unique` (`thread_id`),
	UNIQUE KEY `report_entity_post_id_unique` (`post_id`),
	UNIQUE KEY `report_entity_group_id_unique` (`group_id`),
	UNIQUE KEY `report_entity_bulletin_id_unique` (`bulletin_id`),
	UNIQUE KEY `report_entity_group_site_page_id_unique` (`group_site_page_id`),
	UNIQUE KEY `report_entity_comment_id_unique` (`comment_id`),
	UNIQUE KEY `report_entity_picture_id_unique` (`picture_id`),
	UNIQUE KEY `report_entity_video_id_unique` (`video_id`),
	UNIQUE KEY `report_entity_shout_id_unique` (`shout_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- report_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `report_user`;


CREATE TABLE `report_user`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`type` INTEGER(11),
	`entity_id` INTEGER(11),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `report_user_FI_1`(`user_id`),
	CONSTRAINT `report_user_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sales
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sales`;


CREATE TABLE `sales`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`offer_voucher_id` INTEGER(11),
	`status_id` INTEGER(11),
	`total_sale_price` INTEGER(11),
	`total_shipping_charge` INTEGER(11),
	`quantity` INTEGER(11),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`total_item_price` INTEGER(11) default 0,
	PRIMARY KEY (`id`),
	KEY `sales_FI_1`(`offer_voucher_id`),
	KEY `sales_FI_2`(`status_id`),
	CONSTRAINT `sales_FK_1`
		FOREIGN KEY (`offer_voucher_id`)
		REFERENCES `offer_voucher1` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `sales_FK_2`
		FOREIGN KEY (`status_id`)
		REFERENCES `status` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sales_detail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sales_detail`;


CREATE TABLE `sales_detail`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`item_id` INTEGER(11),
	`total_price` INTEGER(11),
	`total_shipping_charge` INTEGER(11),
	`quantity` INTEGER(11),
	`transaction_id` INTEGER(11),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `sales_detail_FI_1`(`item_id`),
	CONSTRAINT `sales_detail_FK_1`
		FOREIGN KEY (`item_id`)
		REFERENCES `item` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- saved_experts
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `saved_experts`;


CREATE TABLE `saved_experts`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`expert_id` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- shopping_cart
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shopping_cart`;


CREATE TABLE `shopping_cart`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`item_id` INTEGER(11),
	`user_id` INTEGER(11),
	`quantity` INTEGER(11),
	`total_price` INTEGER(11),
	`total_shipping_charge` INTEGER(11),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`is_active` TINYINT(4) default 0,
	PRIMARY KEY (`id`),
	KEY `shopping_cart_FI_1`(`item_id`),
	KEY `shopping_cart_FI_2`(`user_id`),
	CONSTRAINT `shopping_cart_FK_1`
		FOREIGN KEY (`item_id`)
		REFERENCES `item` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `shopping_cart_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- shout
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `shout`;


CREATE TABLE `shout`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`poster_id` INTEGER(11),
	`recipient_id` INTEGER(11),
	`created_at` DATETIME,
	`content` TEXT,
	PRIMARY KEY (`id`),
	KEY `shout_FI_1`(`poster_id`),
	KEY `shout_FI_2`(`recipient_id`),
	CONSTRAINT `shout_FK_1`
		FOREIGN KEY (`poster_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `shout_FK_2`
		FOREIGN KEY (`recipient_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- size
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `size`;


CREATE TABLE `size`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `status`;


CREATE TABLE `status`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- student_voice
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student_voice`;


CREATE TABLE `student_voice`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`title` VARCHAR(100)  NOT NULL,
	`description` TEXT  NOT NULL,
	`status` INTEGER(11)  NOT NULL,
	`vote` INTEGER(11)  NOT NULL,
	`classroom_id` INTEGER(11)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `student_voice_FI_1`(`user_id`),
	KEY `student_voice_FI_2`(`classroom_id`),
	CONSTRAINT `student_voice_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `student_voice_FK_2`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- student_voice_votes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student_voice_votes`;


CREATE TABLE `student_voice_votes`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`student_voice_id` INTEGER(11)  NOT NULL,
	`value` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `student_voice_votes_FI_1`(`user_id`),
	KEY `student_voice_votes_FI_2`(`student_voice_id`),
	CONSTRAINT `student_voice_votes_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `student_voice_votes_FK_2`
		FOREIGN KEY (`student_voice_id`)
		REFERENCES `student_voice` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- students_instant_questions
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `students_instant_questions`;


CREATE TABLE `students_instant_questions`
(
	`id` INTEGER(10)  NOT NULL AUTO_INCREMENT,
	`student_question` TEXT  NOT NULL,
	`student_id` INTEGER(10)  NOT NULL,
	`expert_id` INTEGER(10)  NOT NULL,
	`experts_accept` INTEGER(10)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- submission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `submission`;


CREATE TABLE `submission`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`assignment_id` INTEGER(11)  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`data` TEXT  NOT NULL,
	`grade` VARCHAR(10) default 'null' NOT NULL,
	`comment` TEXT  NOT NULL,
	`approved` INTEGER(11) default 0 NOT NULL,
	`path` VARCHAR(100),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `assignment_submission_FI_1`(`assignment_id`),
	KEY `assignment_submission_FI_2`(`user_id`),
	CONSTRAINT `submission_FK_1`
		FOREIGN KEY (`assignment_id`)
		REFERENCES `assignment` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `submission_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- subscription
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `subscription`;


CREATE TABLE `subscription`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`notification_type` INTEGER(11)  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`teacher_id` INTEGER(11)  NOT NULL,
	`classroom_id` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `subscription_FI_1`(`user_id`),
	CONSTRAINT `subscription_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- thread
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `thread`;


CREATE TABLE `thread`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`poster_id` INTEGER(11)  NOT NULL,
	`forum_id` INTEGER(11)  NOT NULL,
	`title` VARCHAR(100)  NOT NULL,
	`tags` VARCHAR(100)  NOT NULL,
	`visible` INTEGER(11) default 1 NOT NULL,
	`cancel` INTEGER(11)  NOT NULL,
	`category_id` INTEGER(11)  NOT NULL,
	`notify_email` INTEGER(10)  NOT NULL,
	`notify_pm` INTEGER(10)  NOT NULL,
	`notify_sms` INTEGER(10)  NOT NULL,
	`cell_number` INTEGER(30)  NOT NULL,
	`school_grade` VARCHAR(100)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`lastpost_at` DATETIME  NOT NULL,
	`stickie` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`picture_id` INTEGER(11),
	`username` VARCHAR(100),
	`email` VARCHAR(100),
	`password` VARCHAR(40),
	`points` INTEGER(11) default 0,
	`created_at` DATETIME,
	`last_activity_at` DATETIME,
	`type` INTEGER(11) default 0,
	`hidden` INTEGER(11) default 0,
	`name` VARCHAR(100),
	`gender` INTEGER(11),
	`hometown` VARCHAR(100),
	`home_phone` VARCHAR(20),
	`mobile_phone` VARCHAR(20),
	`birthdate` DATE,
	`address` TEXT,
	`relationship_status` INTEGER(11) default 0,
	`about_me` TEXT,
	`show_email` INTEGER(11) default 1,
	`show_gender` INTEGER(11) default 1,
	`show_hometown` INTEGER(11) default 1,
	`show_home_phone` INTEGER(11) default 1,
	`show_mobile_phone` INTEGER(11) default 1,
	`show_birthdate` INTEGER(11) default 1,
	`show_address` INTEGER(11) default 1,
	`show_relationship_status` INTEGER(11) default 1,
	`show_hobbies` VARCHAR(200) default '1',
	`password_recover_key` VARCHAR(40),
	`cookie_key` VARCHAR(40),
	`credit` INTEGER(11) default 0 NOT NULL,
	`invisible` INTEGER(11)  NOT NULL,
	`notification` VARCHAR(10)  NOT NULL,
	`phone_number` VARCHAR(20)  NOT NULL,
	`network_id` INTEGER(11),
	`login` INTEGER(10)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_username_unique` (`username`),
	UNIQUE KEY `user_email_unique` (`email`),
	UNIQUE KEY `user_password_recover_key_unique` (`password_recover_key`),
	KEY `user_FI_1`(`picture_id`),
	KEY `network_id`(`network_id`),
	CONSTRAINT `user_FK_1`
		FOREIGN KEY (`picture_id`)
		REFERENCES `picture` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `user_FK_2`
		FOREIGN KEY (`network_id`)
		REFERENCES `network` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_awards
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_awards`;


CREATE TABLE `user_awards`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`awards` INTEGER(11),
	PRIMARY KEY (`id`),
	KEY `user_awards_FI_1`(`user_id`),
	CONSTRAINT `user_awards_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_donations
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_donations`;


CREATE TABLE `user_donations`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`from_user_id` INTEGER(11),
	`points` INTEGER(11),
	`comments` TEXT,
	PRIMARY KEY (`id`),
	KEY `user_donations_FI_1`(`user_id`),
	KEY `user_donations_FI_2`(`from_user_id`),
	CONSTRAINT `user_donations_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `user_donations_FK_2`
		FOREIGN KEY (`from_user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_gift
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_gift`;


CREATE TABLE `user_gift`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`gift_id` INTEGER(11),
	`giver_id` INTEGER(11),
	`created_at` DATETIME,
	`message` TEXT,
	`type` INTEGER(11),
	PRIMARY KEY (`id`),
	KEY `user_gift_FI_1`(`user_id`),
	KEY `user_gift_FI_2`(`gift_id`),
	KEY `user_gift_FI_3`(`giver_id`),
	CONSTRAINT `user_gift_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `user_gift_FK_2`
		FOREIGN KEY (`gift_id`)
		REFERENCES `gift` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `user_gift_FK_3`
		FOREIGN KEY (`giver_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_interest
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_interest`;


CREATE TABLE `user_interest`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11),
	`interest` TEXT,
	PRIMARY KEY (`id`),
	KEY `user_interest_FI_1`(`user_id`),
	CONSTRAINT `user_interest_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- usergroup
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `usergroup`;


CREATE TABLE `usergroup`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(150),
	`points` INTEGER(11) default 0,
	`description` TEXT,
	`type` INTEGER(11) default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`bankrupt_since` DATE,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- users_networks
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users_networks`;


CREATE TABLE `users_networks`
(
	`id` INTEGER(40)  NOT NULL AUTO_INCREMENT,
	`network_id` INTEGER(10)  NOT NULL,
	`user_id` INTEGER(10)  NOT NULL,
	`joined_on` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- video
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video`;


CREATE TABLE `video`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`owner_id` INTEGER(11),
	`name` VARCHAR(150),
	`description` TEXT,
	`type` VARCHAR(5),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `video_FI_1`(`owner_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- whiteboard_chat
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `whiteboard_chat`;


CREATE TABLE `whiteboard_chat`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`is_public` INTEGER(11)  NOT NULL,
	`expert_id` INTEGER(11),
	`asker_id` INTEGER(11),
	`expert_nickname` VARCHAR(100),
	`asker_nickname` VARCHAR(100),
	`question` TEXT,
	`started_at` DATETIME,
	`ended_at` DATETIME,
	`directory` VARCHAR(255),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `whiteboard_chat_FI_1`(`expert_id`, `asker_id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- whiteboard_message
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `whiteboard_message`;


CREATE TABLE `whiteboard_message`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`whiteboard_chat_id` INTEGER(11)  NOT NULL,
	`user_id` INTEGER(11),
	`message` TEXT,
	`created_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `whiteboard_message_FI_1`(`whiteboard_chat_id`),
	CONSTRAINT `whiteboard_message_FK_1`
		FOREIGN KEY (`whiteboard_chat_id`)
		REFERENCES `whiteboard_chat` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- whiteboard_snapshot
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `whiteboard_snapshot`;


CREATE TABLE `whiteboard_snapshot`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`whiteboard_chat_id` INTEGER(11)  NOT NULL,
	`filename` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `whiteboard_snapshot_FI_1`(`whiteboard_chat_id`),
	CONSTRAINT `whiteboard_snapshot_FK_1`
		FOREIGN KEY (`whiteboard_chat_id`)
		REFERENCES `whiteboard_chat` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
