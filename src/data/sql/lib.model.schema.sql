
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

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
	`status` INTEGER(11),
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
#-- comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;


CREATE TABLE `comment`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
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
	KEY `comment_FI_3`(`video_id`)
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
	`owner_id` INTEGER(11),
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `picture_FI_2`(`owner_id`),
	CONSTRAINT `picture_FK_1`
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
	`reported` INTEGER(4) default 0 NOT NULL,
	`user_ip` VARCHAR(255),
	`banned` INTEGER(2) default 0 NOT NULL,
	`reported_date` DATETIME,
	PRIMARY KEY (`id`),
	KEY `reported`(`reported`),
	KEY `user_ip`(`user_ip`, `banned`)
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
	`user_ip` VARCHAR(255),
	`banned` INTEGER(4) default 0 NOT NULL,
	`reported` INTEGER(4) default 0 NOT NULL,
	`reported_date` DATETIME,
	`stickie` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	KEY `reported`(`reported`)
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
	`points` DECIMAL(11,2) default 0,
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
	`show_email` INTEGER(11) default 1,
	`show_gender` INTEGER(11) default 1,
	`show_hometown` INTEGER(11) default 1,
	`show_home_phone` INTEGER(11) default 1,
	`show_mobile_phone` INTEGER(11) default 1,
	`show_birthdate` INTEGER(11) default 1,
	`show_address` INTEGER(11) default 1,
	`show_relationship_status` INTEGER(11) default 1,
	`password_recover_key` VARCHAR(40),
	`cookie_key` VARCHAR(40),
	`credit` INTEGER(11) default 0 NOT NULL,
	`invisible` INTEGER(11)  NOT NULL,
	`notification` VARCHAR(10)  NOT NULL,
	`phone_number` VARCHAR(20)  NOT NULL,
	`login` INTEGER(10) default 0 NOT NULL,
	`credit_card` VARCHAR(4),
	`credit_card_token` VARCHAR(10),
	`first_charge` DATETIME,
	`where_find_us` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_username_unique` (`username`),
	UNIQUE KEY `user_email_unique` (`email`),
	UNIQUE KEY `user_password_recover_key_unique` (`password_recover_key`),
	KEY `user_FI_1`(`picture_id`),
	CONSTRAINT `user_FK_1`
		FOREIGN KEY (`picture_id`)
		REFERENCES `picture` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
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
#-- user_gtalk
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_gtalk`;


CREATE TABLE `user_gtalk`
(
	`userid` INTEGER(10)  NOT NULL,
	`gtalkid` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`userid`),
	CONSTRAINT `user_gtalk_FK_1`
		FOREIGN KEY (`userid`)
		REFERENCES `user` (`id`)
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
	`timer` VARCHAR(100)  NOT NULL,
	`rating` INTEGER(11)  NOT NULL,
	`amount` FLOAT(5,2)  NOT NULL,
	`comments` VARCHAR(255),
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

#-----------------------------------------------------------------------------
#-- student_questions
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student_questions`;


CREATE TABLE `student_questions`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11)  NOT NULL,
	`checked_id` INTEGER(11)  NOT NULL,
	`category_id` INTEGER(11) default 1 NOT NULL,
	`course_id` INTEGER(11) default 1 NOT NULL,
	`question` VARCHAR(500)  NOT NULL,
	`exe_order` INTEGER(11)  NOT NULL,
	`time` INTEGER(100)  NOT NULL,
	`course_code` VARCHAR(100)  NOT NULL,
	`year` VARCHAR(100)  NOT NULL,
	`school` VARCHAR(100)  NOT NULL,
	`status` INTEGER(10) default 0 NOT NULL,
	`close` INTEGER(10) default 61000 NOT NULL,
	`cron` INTEGER(10) default 1 NOT NULL,
	`source` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `student_questions_FI_1` (`user_id`),
	CONSTRAINT `student_questions_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	INDEX `student_questions_FI_2` (`checked_id`),
	CONSTRAINT `student_questions_FK_2`
		FOREIGN KEY (`checked_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- whiteboard_sessions
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `whiteboard_sessions`;


CREATE TABLE `whiteboard_sessions`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`question_id` INTEGER(11)  NOT NULL,
	`user_id` INTEGER(11)  NOT NULL,
	`type` INTEGER(10)  NOT NULL,
	`token` VARCHAR(40)  NOT NULL,
	`chat_id` VARCHAR(40),
	`last_activity` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `whiteboard_sessions_FI_1` (`question_id`),
	CONSTRAINT `whiteboard_sessions_FK_1`
		FOREIGN KEY (`question_id`)
		REFERENCES `student_questions` (`id`),
	INDEX `whiteboard_sessions_FI_2` (`user_id`),
	CONSTRAINT `whiteboard_sessions_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- whiteboard_tutor_feedback
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `whiteboard_tutor_feedback`;


CREATE TABLE `whiteboard_tutor_feedback`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`whiteboard_chat_id` INTEGER(11)  NOT NULL,
	`expert_id` INTEGER(11),
	`audio` INTEGER(5)  NOT NULL,
	`usability` INTEGER(5)  NOT NULL,
	`overall` INTEGER(5)  NOT NULL,
	`feedback` TEXT,
	`created_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `whiteboard_tutor_feedback_FI_1` (`whiteboard_chat_id`),
	CONSTRAINT `whiteboard_tutor_feedback_FK_1`
		FOREIGN KEY (`whiteboard_chat_id`)
		REFERENCES `whiteboard_chat` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
