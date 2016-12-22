DROP TABLE IF EXISTS `large_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `large_table` (
  `name` varchar(128) DEFAULT NULL,
  `pan` varchar(128) DEFAULT NULL,
  `expiration` varchar(64) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/* Mysql cursor */
DELIMITER $$
USE `php_memory_problem`$$
DROP PROCEDURE IF EXISTS `test`$$
CREATE PROCEDURE `test`()
BEGIN
DECLARE done INT DEFAULT FALSE;

DECLARE name varchar(128);
DECLARE pan varchar(128);
DECLARE expiration varchar(128);
DECLARE address varchar(512);

DECLARE curs1 CURSOR FOR SELECT * FROM `large_table`;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
OPEN curs1;
  read_loop: LOOP
  FETCH curs1 INTO name, pan, expiration, address;
  IF done THEN
    LEAVE read_loop;
END IF;
SELECT name, pan, expiration, address;
END LOOP;
CLOSE curs1;
END$$
DELIMITER ;