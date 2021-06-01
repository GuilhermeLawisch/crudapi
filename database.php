<?php
/*
CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
*/

class Database {
  private $db_host = 'localhost';
  private $db_name = 'php_api';
  private $db_user = 'root';
  private $db_pass = '';
 
  public function dbConnection() {
    try {
      $conn = new PDO('mysql:host='. $this->db_host. ';dbname='. $this->db_name, $this->db_user, $this->db_pass);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch (PDOException $e) {
      echo "Connection error ".$e->getMessage(); 
      exit;
    }
  }
}
?>