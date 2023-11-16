﻿--- store procedure ---------------------------
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
		--login
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

	ELSEIF vOption = 3 THEN 
		UPDATE users
			SET 
			email = vEmail,
			username = vPassword,
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
	vMessage	TEXT
)
BEGIN
	-- Get all user conversations
    IF vOption = 1 THEN
		SELECT
			messageID,
			senderID,
			receiverID,
			message
		FROM userMessages 
		WHERE senderID = vSenderID;
	END IF;

	-- Insert message to conversation
    IF vOption = 2 THEN
		INSERT INTO userMessages(
			senderID,
			receiverID,
			message
		)
		VALUES(
			vSenderID,
			vReceiverID,
			vMessage
		);
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
			productID
			,stock
			,name
			,description
			,pricingType
			,price
			,review
			,approvedBy
			,uploadedBy
			,category
		FROM products 
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