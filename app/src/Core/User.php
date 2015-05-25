<?php namespace Module\Core;


class User extends Database implements Authenticate{

    public function create(array $arrUser) {
        try {
            $sql = "INSERT INTO users(name, email, mobile, password) VALUES(:name, :email, :mobile, :password)";
            $conn = $this->connect->prepare($sql);
            $conn->bindParam(':name', $arrUser['name'], \PDO::PARAM_STR);
            $conn->bindParam(':email', $arrUser['email'], \PDO::PARAM_STR);
            $conn->bindParam(':mobile', $arrUser['mobile'], \PDO::PARAM_STR);
            $conn->bindParam(':password', password_hash($arrUser['password'], PASSWORD_BCRYPT), \PDO::PARAM_STR);

            if($conn->execute()) {
                return true;
            }
            else {
                throw new \Exception('User data can\'t save successfully');
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

    public function getUserById($id) {
        try {
            $conn = $this->connect->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
            $conn->bindParam(':id', $id, \PDO::PARAM_INT);
            $conn->execute();
            if($conn->rowCount() > 0) {
                return $conn->fetch(\PDO::FETCH_ASSOC);
            }
            else{
                throw new \PDOException('No user found', 505);
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

    public function getUserByEmail($strEmail) {
        try {
            $conn = $this->connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
            $conn->bindParam(':email', $strEmail, \PDO::PARAM_STR);
            $conn->execute();
            if($conn->rowCount() > 0) {
                return $conn->fetch(\PDO::FETCH_ASSOC);
            }
            else{
                throw new \PDOException('No user found', 5005);
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

    public function updateUser($intId, $arrUser) {
        try {
            $query = 'UPDATE users SET ';
            foreach($arrUser as $column => $arrSet) {
                $query .= $column . ' = :' . $column . ', ';
            }
            $query = rtrim($query, ', ');
            $query .= ' WHERE id = :id';
            $conn = $this->connect->prepare($query);
            foreach($arrUser as $column => $arrSet) {
                $conn->bindParam(':' . $column, $arrSet, \PDO::PARAM_STR);
            }
            $conn->bindParam(':id', $intId, \PDO::PARAM_INT);

            return $conn->execute();
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

    public function getLogin(array $arrCredentials) {
        if(array_key_exists('email', $arrCredentials) && array_key_exists('password', $arrCredentials)) {
            $arrUser = $this->getUserByEmail($arrCredentials['email']);
            if(password_verify($arrCredentials['password'], $arrUser['password'])) {
                $_SESSION['login_user'] = $arrUser;

                return true;
            }
            else {
                return false;
            }
        }
        else {
            throw new \PDOException('Email and Password not exist');
        }
    }

    public function getLogout() {
        session_destroy();
        unset($_SESSION['login_user']);

        redirect();
    }

}