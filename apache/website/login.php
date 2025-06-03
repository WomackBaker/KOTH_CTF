<?php
$conn = mysql_connect("localhost", "root", "root");
mysql_select_db("ctf_db", $conn);

$username = $_GET['username'];
$password = $_GET['password'];

// Vulnerable SQL query
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysql_query($query);

if(mysql_num_rows($result) > 0) {
    echo "Login successful!";
    // Flag is in /var/www/html/flag.txt
} else {
    echo "Login failed!";
}
?> 