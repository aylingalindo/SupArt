--- store procedure ---------------------------
DELIMITER //

CREATE PROCEDURE userManagement(
	vOption	INT,
	vUserID	INT,
	vEmail	VARCHAR(100),
	vUsername	VARCHAR(50),
	vPassword	VARCHAR(50),
	vRol	INT,
	vImage	VARCHAR(255),
	vName	VARCHAR(50),
	vLastnameP	VARCHAR(50),
	vLastnameM	VARCHAR(50),
	vBirthday	DATE,
	vGender	CHAR(1),
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