<?php
include_once './connectionPDO.php';

    class User extends DB {

        function getTest() {
            $conn = $this->connect(); // Get the database connection

            if ($conn) {
                try {
                    $sql = "SELECT * FROM test"; // Replace with your table name
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        return $result->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        return array(); // Return an empty array if no results are found
                    }
                } catch (PDOException $e) {
                    return false; // Return false to indicate a query error
                }
            } else {
                return false; // Return false to indicate a database connection error
            }
        }

    
        /*
        function callUserManagement($vOption, $vUserID, $vEmail, $vUsername, $vPassword, $vRol, $vImage, $vName, $vLastnameP, $vLastnameM, $vBirthday, $vGender, $vJoinedDate, $vVisibility) {
            $conn = $this->connect(); 

            if ($conn) {
                try {
                    $sql = "CALL userManagement(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(1, $vOption, PDO::PARAM_INT);
                    $stmt->bindParam(2, $vUserID, PDO::PARAM_INT);
                    $stmt->bindParam(3, $vEmail, PDO::PARAM_STR);
                    $stmt->bindParam(4, $vUsername, PDO::PARAM_STR);
                    $stmt->bindParam(5, $vPassword, PDO::PARAM_STR);
                    $stmt->bindParam(6, $vRol, PDO::PARAM_INT);
                    $stmt->bindParam(7, $vImage, PDO::PARAM_STR);
                    $stmt->bindParam(8, $vName, PDO::PARAM_STR);
                    $stmt->bindParam(9, $vLastnameP, PDO::PARAM_STR);
                    $stmt->bindParam(10, $vLastnameM, PDO::PARAM_STR);
                    $stmt->bindParam(11, $vBirthday, PDO::PARAM_STR);
                    $stmt->bindParam(12, $vGender, PDO::PARAM_STR);
                    $stmt->bindParam(13, $vJoinedDate, PDO::PARAM_STR);
                    $stmt->bindParam(14, $vVisibility, PDO::PARAM_INT);

                    $stmt->execute();

                    $stmt->closeCursor();

                    // You can handle the result or do something after calling the procedure here
                } catch (PDOException $e) {
                    return false; // Return false to indicate a query error
                }
            } else {
                return false; // Return false to indicate a database connection error
            }
        }*/

    }


/*
class User {
    private $email;
    private $username;
    private $password;
    private $rol;
    private $image;
    private $name;
    private $lastnameP;
    private $lastnameM;
    private $birthday;
    private $gender;
    private $joinedDate;
    private $visibility;


    public function User($email, $username, $password, $rol, $image, $name, $lastnameP, $lastnameM, $birthday, $gender, $joinedDate, $visibility) {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->rol = $rol;
        $this->image = $image;
        $this->name = $name;
        $this->lastnameP = $lastnameP;
        $this->lastnameM = $lastnameM;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->joinedDate = $joinedDate;
        $this->visibility = $visibility;
    }

    // === EMAIL: get / set ===
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // === USERNAME: get / set ===
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    // === PASSWORD: get / set ===
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // === ROL: get / set ===
    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    // === IMAGE: get / set ===
    public function getImage() {
        return $this->image;
    }

    public function setPassword($image) {
        $this->image = $image;
    }

    // === NAME: get / set ===
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // === LASTNAMEP: get / set ===
    public function getLastnameP() {
        return $this->lastnameP;
    }

    public function setPassword($lastnameP) {
        $this->lastnameP = $lastnameP;
    }

    // === LASTNAMEM: get / set ===
    public function getLastnameM() {
        return $this->lastnameM;
    }

    public function setPassword($lastnameM) {
        $this->lastnameM = $lastnameM;
    }

    // === BIRTHDAY: get / set ===
    public function getBirthday() {
        return $this->birthday;
    }

    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    // === GENDER: get / set ===
    public function getGender() {
        return $this->birthday;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    // === JOINED_DATE: get / set ===
    public function getJoinedDate() {
        return $this->birthday;
    }

    public function setJoinedDate($joinedDate) {
        $this->joinedDate = $joinedDate;
    }

    // === VISIBILITY: get / set ===
    public function getVisibility() {
        return $this->visibility;
    }

    public function setVisibility($visibility) {
        $this->visibility = $visibility;
    }


}
?>*/
?>