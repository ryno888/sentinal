CREATE TABLE `student_details` (
	`stu_id` INT(11) NOT NULL AUTO_INCREMENT,
	`stu_parent_firstname` VARCHAR(256) NULL DEFAULT '',
	`stu_parent_lastname` VARCHAR(256) NULL DEFAULT '',
	`stu_contact_number` VARCHAR(256) NULL DEFAULT '',
	`stu_email` VARCHAR(256) NULL DEFAULT '',
	`stu_type` TINYINT(4) NULL DEFAULT '0',
	PRIMARY KEY (`stu_id`)
)
ENGINE=InnoDB
;
