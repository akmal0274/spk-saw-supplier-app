<?php

class User extends Model {
    public function getAll() {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM users");
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function findByUsername($username) {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function create($username, $email, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($this->conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashed);
        return mysqli_stmt_execute($stmt);
    }
}
