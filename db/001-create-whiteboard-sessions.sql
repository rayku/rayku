alter table student_questions engine innodb;

CREATE TABLE `whiteboard_sessions`
(
    `id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
    `question_id` INTEGER(11)  NOT NULL,
    `type` INTEGER(10)  NOT NULL,
    `token` VARCHAR(40)  NOT NULL,
    `user_id` INTEGER(11)  NOT NULL,
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

