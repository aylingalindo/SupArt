--2 triggers
DELIMITER //
CREATE TRIGGER prevent_newChat
BEFORE INSERT ON usermessages
FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM usermessages WHERE product = NEW.product) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Already an existing chat';
    END IF;
END;
//
DELIMITER ;
