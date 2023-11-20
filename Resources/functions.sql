--2 funciones
DELIMITER //

CREATE FUNCTION CalculateUserCartTotal(userId INT) RETURNS DECIMAL(10,2)
BEGIN
    DECLARE total DECIMAL(10,2);
    SELECT SUM(numItems * price) INTO total
    FROM UserCart
    WHERE user = userId;
    RETURN total;
END//

DELIMITER ;