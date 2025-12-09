<?php

class Database {

    private static $host = "localhost";
    private static $dbname = "inventario_ti";
    private static $username = "root";
    private static $password = "";

    public static function connect() {
        try {
            $conn = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                self::$username,
                self::$password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }
}
