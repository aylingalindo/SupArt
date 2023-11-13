--- store procedure ---------------------------
DELIMITER //
CREATE PROCEDURE userManagement(
    vOption     INT,
    vUserID     INT,
    vEmail      VARCHAR(100),
    vUsername   VARCHAR(50),
    vPassword   VARCHAR(50),
    vRol        INT,
    vImage      VARCHAR(255),
    vName       VARCHAR(50),
    vLastnameP  VARCHAR(50),
    vLastnameM  VARCHAR(50),
    vBirthday   DATE,
    vGender     CHAR(1),
    vVisibility BOOLEAN
)
BEGIN
    -- Insert
    IF vOption = 1 THEN
        INSERT INTO users(
            email,
            username,
            password,
            rol,
            image,
            name,
            lastnameP,
            lastnameM,
            birthday,
            gender,
            joinedDate,
            visibility
        )
        VALUES(
            vEmail,
            vUsername, 
            vPassword, 
            vRol,
            vImage,
            vName,
            vLastnameP,
            vLastnameM,
            vBirthday,
            vGender,
            CURDATE(),
            vVisibility
        );
    -- Login
    ELSEIF vOption = 2 THEN 
        SELECT 
            userID,
            email,
            username,
            password,
            rol,
            image,
            name,
            lastnameP,
            lastnameM,
            birthday,
            gender,
            joinedDate,
            visibility
        FROM users 
        WHERE username = vUsername
        AND password = vPassword;

    -- Update
    ELSEIF vOption = 3 THEN 
        UPDATE users
        SET 
            email = vEmail,
            username = vUsername,
            password = vPassword, 
            rol = vRol,
            image = vImage,
            name = vName,
            lastnameP = vLastnameP,
            lastnameM = vLastnameM,
            birthday = vBirthday,
            gender = vGender,
            visibility = vVisibility
        WHERE userID = vUserID;
    END IF;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE cartManagement(
    vOption     INT,
    vID  INT,
    vNumItems   INT, 
    vUser       INT
)
BEGIN
    -- Insert
    SET @currentItems = (SELECT numItems FROM cart WHERE product = vID);
    SET @totalItems = @currentItems + vNumItems;

    IF vOption = 1 THEN
        IF @currentItems = 0 THEN
            INSERT INTO cart(
                product,
                numItems,
                user
            )
            VALUES(
                vID,
                @totalItems,
                vUser
            );
        ELSEIF @currentItems <> 0 THEN
            UPDATE cart SET 
                numItems = @totalItems
            WHERE product = vID;
            SELECT 'Producto insertado correctamente!' as Mensaje;
        END IF;
    END IF;

    -- Select
    IF vOption = 2 THEN
        SELECT 
            cart.cartID, 
            cart.product, 
            cart.numItems, 
            cart.user,
            products.name,
            products.description,
            products.pricingType,
            products.price,
            products.review,
            category.name AS `category`,
            products.stock AS `totalStock`
        FROM cart
        JOIN products ON cart.product = products.productID
        JOIN product_category ON cart.product = product_category.product
        JOIN category ON product_category.category = category.categoryID;
    END IF;

	--	Update numItems
	IF vOption = 3 THEN
		UPDATE cart SET
			numItems = vNumItems
        WHERE cartID = vID;
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE msgManagement(
	vOption		INT,
    vSenderID	INT,
    vReceiverID INT,
	vMessageID	INT,
	vMessage	TEXT,
    vProducto   INT
)
BEGIN
    DECLARE sellerID INT;
    DECLARE existingRowCount INT;

	-- Get all user conversations
    IF vOption = 1 THEN
		SELECT
			chat.messageID,
            chat.senderID,
            chat.receiverID,
            chat.message,
            chat.product,
            product.productID,
            product.name
		FROM chat; 
	END IF;

	-- Insert message to conversation
    IF vOption = 2 THEN
        -- Check if a row with the same productID already exists
        SELECT COUNT(product) INTO existingRowCount
        FROM userMessages
        WHERE product = vProducto;

        IF existingRowCount = 0 THEN
            -- Insert the new message
            INSERT INTO userMessages(senderID, receiverID, message, product)
            VALUES(vSenderID, vReceiverID, vMessage, vProducto);
        END IF;
    END IF;

    -- Get current conversation
    IF vOption = 3 THEN
		SELECT
            name
		FROM products 
        WHERE productID = vProducto;
	END IF;

    -- Get messages from chat
    IF vOption = 4 THEN
		SELECT
            message,
            senderID,
            receiverID
        FROM  chat
        WHERE productID = vProducto;
	END IF;

    -- Send message
    IF vOption = 5 THEN
        SELECT senderID INTO sellerID
        FROM userMessages
        WHERE product = vProducto
        LIMIT 1;

        INSERT INTO userMessages(senderID, receiverID, message, product)
        VALUES(vSenderID, COALESCE(sellerID, vReceiverID), vMessage, vProducto);
    END IF;

    -- SELECT to all different chats
    IF vOption = 6 THEN
        SELECT DISTINCT productID, name, senderID, receiverID
        FROM chat
        WHERE senderID = 6 OR receiverID = 6
        GROUP BY productID, name;
    END IF;
END //
DELIMITER ;

