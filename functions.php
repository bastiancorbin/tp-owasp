<?php

function connectDb()
{
    try {
        $conn = new PDO("mysql:host=127.0.0.1;dbname=authentication", 'root', '');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function logUser($email, $password)
{
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE email = :email';
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_OBJ);

    if ($user && password_verify($password, $user->password)) {
        return $user;
    } else {
        return false;
    }
}

function getUser($id) {
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE id = :id';
    $stmt = $connexion->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function saveUser($username, $email, $password) {
    $connexion = connectDb();
    $sql = 'INSERT INTO users(username, email, password) VALUES(:username, :email, :password)';
    $stmt = $connexion->prepare($sql);

    return $stmt->execute(['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
}