--- store procedure ---------------------------
DELIMITER //
CREATE PROCEDURE userManagement(
	vOption	INT,
	vUserID	INT,
	vEmail	VARCHAR(100),
	vUsername	VARCHAR(50),
	vPassword	VARCHAR(50),
	vRol	INT,
	vImage	BLOB,
	vName	VARCHAR(50),
	vLastnameP	VARCHAR(50),
	vLastnameM	VARCHAR(50),
	vBirthday	DATE,
	vGender	VARCHAR(30),
	vVisibility	BOOLEAN
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
    DECLARE userTotal DECIMAL(10, 2);
    SET @currentItems = (SELECT numItems FROM cart WHERE product = vID AND user = vUser);
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
        SET userTotal = CalculateUserCartTotal(vUser);
        SELECT *,
           userTotal AS 'TotalToPay'
    FROM UserCart
    WHERE user = vUser;
    END IF;

	--	Update numItems
	IF vOption = 3 THEN
		UPDATE cart SET
			numItems = vNumItems
        WHERE cartID = vID;
	END IF;

    -- Delete specific product form cart
    IF vOption = 4 THEN
        DELETE FROM cart WHERE cartID = vCartID;
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

DELIMITER //
CREATE PROCEDURE productManagement(
	vOption			INT,
    vProductID		INT,
    vStock 			VARCHAR(50),
	vName			VARCHAR(200),
	vDescription	TEXT,
	vPricingType    ENUM('Sell', 'Negotiable'), 
	vPrice          DECIMAL(10,2), 
	vReview			DECIMAL(2,2),
	vApprovedBy		INT,
	vUploadedBy		INT,
	vCategory		INT,
	vText			varchar(200)
)
BEGIN
	-- Get info from products from one user or one product
    IF vOption = 1 THEN
		SELECT
			a.productID
			,a.stock
			,a.name
			,a.description
			,a.pricingType
			,a.price
			,a.review
			,a.approvedBy
			,a.uploadedBy
			,a.category
			,b.name as categoryName
            ,CONCAT(c.name,' ',c.lastnameP) as uploadedByName
		FROM products a
		Left Join category b on  a.category = b.categoryID
        Left Join users c on a.uploadedBy = c.userID
		WHERE (uploadedBy = coalesce(vUploadedBy, uploadedBy)) and (productID = COALESCE(vProductID,productID));
	END IF;


	-- Insert product
    IF vOption = 2 THEN
		INSERT INTO products(
			stock
			,name
			,description
			,pricingType
			,price
			,review
			,approvedBy
			,uploadedBy
			,category
		)
		VALUES(
			vStock
			,vName
			,vDescription
			,vPricingType
			,vPrice
			,vReview
			,vApprovedBy
			,vUploadedBy
			,vCategory
		);
    SELECT last_insert_id() AS last_insert_id;
	END IF;
    
	-- edit product
    IF vOption = 3 THEN
	UPDATE products
    	    SET
            stock = vStock,
            name = vName,
            description = vDescription,
            pricingType = vPricingType,
            price = vPrice,
            review = vReview,
            approvedBy = vApprovedBy,
            uploadedBy = vUploadedBy,
			category = vCategory
 	WHERE productID = vProductID;
	END IF;
	
	-- general overview of products
  	IF vOption = 4 THEN
    SELECT *
    FROM vProductOverview
    WHERE uploadedBy = COALESCE(vUploadedBy, uploadedBy)
      AND category = COALESCE(vCategory, category)
      AND (vText IS NULL 
        OR name LIKE CONCAT('%', vText, '%')
        OR description LIKE CONCAT('%', vText, '%'))
    ORDER BY 
      CASE 
        WHEN name LIKE CONCAT('%', vText, '%') THEN 0 
        WHEN description LIKE CONCAT('%', vText, '%') THEN 1 
        ELSE 2 END;
  END IF;

    -- pending of approval products
  	IF vOption = 5  then
    Select * from vProductOverview
    WHERE approvedBy is null;
    end if;

    -- populares/mas vendidos DASHBOARD
    IF vOption = 6  then
	    Select 
	    	a.*,
	        SUM(b.numItems) AS totalItemsSold
	    From vProductOverview a
	    Left Join purchaseInfo b on a.productID = b.product
	    group by a.productID
	    order by totalItemsSold DESC
	    limit 15;
    END IF;

    -- mejor calificados DASHBOARD
    IF vOption = 7  then
	    Select *
	    From vProductOverview
	    order by review desc 
	    limit 15;
    END IF;

    -- nuevos DASHBOARD
    IF vOption = 8  then
    	Select *
    	From vProductOverview
    	order by productID desc 
	    limit 15;
    END IF;

    -- mas baratos SEARCH
    IF vOption = 9  then
    	Select *
    	From vProductOverview
    	where (vText IS NULL 
        	OR name LIKE CONCAT('%', vText, '%')
        	OR description LIKE CONCAT('%', vText, '%'))
    	order by price,
	    	CASE 
        		WHEN name LIKE CONCAT('%', vText, '%') THEN 0 
        		WHEN description LIKE CONCAT('%', vText, '%') THEN 1 
        		ELSE 2 END;
    END IF;

    -- populares/mas vendidos SEARCH
    IF vOption = 10 then
	    Select 
	    	a.*,
	        SUM(b.numItems) AS totalItemsSold
	    From vProductOverview a
	    Left Join purchaseInfo b on a.productID = b.product
	    where (vText IS NULL 
        	OR name LIKE CONCAT('%', vText, '%')
        	OR description LIKE CONCAT('%', vText, '%'))
	    group by a.productID
	    order by totalItemsSold DESC,
	    	CASE 
        		WHEN name LIKE CONCAT('%', vText, '%') THEN 0 
        		WHEN description LIKE CONCAT('%', vText, '%') THEN 1 
        		ELSE 2 END;
    END IF;

    -- mejor calificados SEARCH
    IF vOption = 11  then
	    Select *
	    From vProductOverview
	    where (vText IS NULL 
        	OR name LIKE CONCAT('%', vText, '%')
        	OR description LIKE CONCAT('%', vText, '%'))
	    order by review desc,
	    	CASE 
        		WHEN name LIKE CONCAT('%', vText, '%') THEN 0 
        		WHEN description LIKE CONCAT('%', vText, '%') THEN 1 
        		ELSE 2 END;
    END IF;

END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE categoryManagement(
	vOption int,
	vName VARCHAR(50),
	vUserID int
)
BEGIN
	-- Get all user conversations
    IF vOption = 1 THEN
		SELECT
			categoryID,
			name,
			user
		FROM category;
	END IF;

	-- Insert message to conversation
    IF vOption = 2 THEN
		INSERT INTO category(
			name
			,user
		)
		VALUES(
			vName
			,vUserID
		);
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE productFilesManagement(
	vOption			int,
	vFileName 		varchar(100),
	vFileContent 	BLOB,
	vProduct 		int
)
BEGIN
	-- Get all user conversations
    IF vOption = 1 THEN
		SELECT
			product,
			file,
			fileName
		FROM mediaFilesProduct;
	END IF;

	-- Insert message to conversation
    IF vOption = 2 THEN
		INSERT INTO mediaFilesProduct(
			product
			,file
			,fileName
		)
		VALUES(
			vProduct
			,vFileContent
			,vFileName
		);
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE listManagement(
	vOption int,
	vListID int,
	vName VARCHAR(50),
	vDescription VARCHAR(200),
	vUserID int
)
BEGIN
	-- Get all wishlists from one user 
    IF vOption = 1 THEN
		SELECT
			name,
			description,
			user
		FROM lists
		where user = vUserID;
	END IF;

	-- Insert 
    IF vOption = 2 THEN
		INSERT INTO lists(
			name
			,description
			,user
		)
		VALUES(
			vName
			,vDescription
			,vUserID
		);
	END IF;

	-- delete
	IF vOption = 3 THEN
		DELETE a FROM lists a
		WHERE listID = vListID
	END IF;

END //
DELIMITER ;


DELIMITER //

CREATE PROCEDURE SalesManagement(
    vOption int,
	vUser int
)
BEGIN
    -- Seller Sales
    IF vOption = 1 THEN
        SELECT
            productName,
            category,
            image,
            folio,
            purchaseDate,
            review,
            numItems,
            total,
            stock,
            sellerUserID AS SellerID,
            buyerUserID AS BuyerID
        FROM SoldProducts
        WHERE sellerUserID = vUser;
	END IF;

    -- Buyer products
    IF vOption = 2 THEN
        SELECT
            productName,
            category,
            image,
            folio,
            purchaseDate,
            review,
            numItems,
            total,
            stock,
            sellerUserID AS SellerID,
            buyerUserID AS BuyerID
        FROM SoldProducts
        WHERE buyerUserID = vUser;
	END IF;

    -- grouped sales
    IF vOption = 3 THEN
        SELECT Category, SellerID, Date, Sales
        FROM GroupedSales
        WHERE SellerID = vUser;
	END IF;
END //

DELIMITER ;


DELIMITER //

CREATE PROCEDURE chatManagement(
    vOption     INT,
    vProduct    INT,
    vSender     INT,
    vReceiver   INT,
    vMessage    TEXT
)
BEGIN
    DECLARE chatExist INT;
    DECLARE isSeller INT;

    SELECT COUNT(*) INTO chatExist
    FROM chat
    WHERE (receiverID = vReceiver AND senderID = vSender AND productID = vProduct)
    LIMIT 1;

    SELECT COUNT(*) INTO isSeller
    FROM products
    WHERE productID = vProduct AND uploadedBy = vSender;

    -- INSERT FIRST MESSAGE // CREATE NEW CHAT
    IF vOption = 1 THEN
        IF chatExist = 0 AND isSeller = 0 THEN
            INSERT INTO usermessages(
                senderID, 
                receiverID,
                message, 
                product)
            VALUES(
                vSender, 
                vReceiver, 
                vMessage, 
                vProduct
            );
        END IF;
    END IF;

    -- Insert message to existing chat
    IF vOption = 2 THEN
        IF chatExist > 0 THEN
            INSERT INTO usermessages(
                senderID, 
                receiverID, 
                message, 
                product
            )
            VALUES(
                vSender, 
                vReceiver, 
                vMessage, 
                vProduct
            );
        END IF;
    END IF;

    -- Get current chat messages
    IF vOption = 3 THEN
        SELECT
            messageID,
            senderID,
            receiverID,
            message,
            productID,
            name
        FROM chat
        WHERE (receiverID = vReceiver AND senderID = vSender OR receiverID = vSender AND senderID = vReceiver) AND productID = vProduct;
    END IF;

    -- Get all the user chats
    IF vOption = 4 THEN
        SELECT DISTINCT 
            c.productID, 
            c.name,
            CASE
                WHEN c.receiverID = vSender THEN c.senderID
                ELSE c.receiverID
            END AS receiverID,
            CASE
                WHEN c.receiverID = vSender THEN u1.username
                ELSE u2.username
            END AS recieverUser,
            p.uploadedBy AS sellerID
        FROM chat c
        LEFT JOIN users u1 ON c.senderID = u1.userID
        LEFT JOIN users u2 ON c.receiverID = u2.userID
        LEFT JOIN products p ON c.productID = p.productID
        WHERE c.receiverID = vSender OR c.senderID = vSender;
    END IF;

    -- Get current product name
    IF vOption = 5 THEN
		SELECT
            name
		FROM products 
        WHERE productID = vProduct;
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE purchaseManagement(
    vOption INT, 
    vUser INT, 
    vProduct INT, 
    vQuantity INT, 
    vPurchaseDate DATETIME, 
    vTotal DECIMAL(10, 2), 
    vPurchID INT)
BEGIN
    -- insert into purchaseInfo table
    IF vOption = 1 THEN
        INSERT INTO purchaseinfo(
            product, 
            purchaseDate, 
            user, 
            total, 
            numItems, 
            purchID
        ) 
        VALUES (
            vProduct, 
            vPurchaseDate, 
            vUser, 
            vTotal, 
            vQuantity, 
            vPurchID
        );
        
        UPDATE products SET stock = stock - vQuantity WHERE productID = vProduct;
        
        DELETE FROM cart WHERE user = vUser;
    END IF;
END;