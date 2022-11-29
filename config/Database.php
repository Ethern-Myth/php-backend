<?php
class Database
{
    //DB Params
    private $host = 'localhost';
    private $db_name = 'customers';
    private $username = 'root';
    private $password = '';
    private $table = "CREATE TABLE IF NOT EXISTS customer(
        customer_id INT AUTO_INCREMENT NOT NULL,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        phone VARCHAR(30) NULL,
        country VARCHAR(50) NOT NULL,
        PRIMARY KEY(customer_id)
    )
    ";

    //DB Connect
    public function connect(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name);
        $pdo->query("use " . $this->db_name);
        $pdo->exec($this->table);
        return $pdo;
    }

    public function testConnection()
    {
        $link = mysqli_connect($this->host, $this->username, $this->password);
        if ($link == false) {
            die('Not connected!');
        } else {
            echo "Connection Established!!";
        }
    }
}
