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


DELIMITER //

CREATE TRIGGER generate_folio
BEFORE INSERT ON purchaseinfo
FOR EACH ROW
BEGIN
    DECLARE newFolio INT;
    SET newFolio = 10000 + NEW.purchaseID; 

    -- Check if the generated folio already exists, and increment if it does
    WHILE EXISTS (SELECT * FROM purchaseinfo WHERE folio = newFolio) DO
        SET newFolio = newFolio + 1;
    END WHILE;

    SET NEW.folio = newFolio;
END;
//

DELIMITER ;
