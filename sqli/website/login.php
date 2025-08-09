<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strickland Propane - Employee Database</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: linear-gradient(135deg, #8B4513 0%, #D2691E 50%, #F4A460 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: linear-gradient(145deg, #F5F5DC 0%, #DEB887 100%);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            border: 3px solid #8B4513;
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #FFD700, #FFA500, #FFD700);
            border-radius: 27px;
            z-index: -1;
            animation: borderGlow 3s ease-in-out infinite alternate;
        }

        @keyframes borderGlow {
            0% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #FF4500, #FF6347);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(255, 69, 0, 0.4);
            border: 3px solid #8B4513;
            position: relative;
        }

        .logo::after {
            content: '🔥';
            position: absolute;
            top: -8px;
            right: -8px;
            font-size: 16px;
            animation: flame 1s ease-in-out infinite alternate;
        }

        @keyframes flame {
            0% { transform: scale(1) rotate(-5deg); }
            100% { transform: scale(1.1) rotate(5deg); }
        }

        .company-name {
            color: #8B4513;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .page-title {
            color: #A0522D;
            font-size: 16px;
            font-style: italic;
        }

        .query-section {
            background: linear-gradient(45deg, #FFF8DC, #F5F5DC);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 5px solid #FF4500;
            border: 2px solid #DEB887;
        }

        .query-title {
            color: #8B4513;
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .query-text {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            word-break: break-all;
            line-height: 1.5;
            border: 2px solid #8B4513;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            border: 3px solid #8B4513;
        }

        .results-table th {
            background: linear-gradient(45deg, #FF4500, #FF6347);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
            font-size: 16px;
        }

        .results-table td {
            padding: 15px;
            border-bottom: 1px solid #DEB887;
            background: #FFF8DC;
            color: #8B4513;
            font-weight: 600;
        }

        .results-table tr:hover td {
            background: #F5F5DC;
        }

        .flag-banner {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            margin: 20px 0;
            font-size: 28px;
            font-weight: bold;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
            animation: pulse 2s infinite;
            border: 3px solid #228B22;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .error-message {
            background: linear-gradient(45deg, #FFE4E1, #FFB6C1);
            color: #8B0000;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border-left: 5px solid #8B0000;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.2);
            border: 2px solid #8B0000;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(45deg, #FF4500, #FF6347);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 20px;
            border: 2px solid #8B4513;
            box-shadow: 0 5px 15px rgba(255, 69, 0, 0.3);
        }

        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 69, 0, 0.5);
            background: linear-gradient(45deg, #FF6347, #FF4500);
        }

        .stats {
            display: flex;
            gap: 20px;
            margin: 20px 0;
        }

        .stat-card {
            flex: 1;
            background: linear-gradient(45deg, #FFF8DC, #F5F5DC);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid #DEB887;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            color: #FF4500;
        }

        .stat-label {
            color: #8B4513;
            font-size: 14px;
            margin-top: 8px;
            font-weight: 600;
        }

        .propane-quote {
            background: linear-gradient(45deg, #F0E68C, #FFD700);
            border: 2px solid #DAA520;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            font-style: italic;
            color: #8B4513;
            font-weight: bold;
            text-align: center;
        }

        .texas-flag {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 30px;
            background: linear-gradient(to right, #002868 0%, #002868 50%, #FFFFFF 50%, #FFFFFF 100%);
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .texas-flag::after {
            content: '★';
            position: absolute;
            top: 50%;
            left: 25%;
            transform: translate(-50%, -50%);
            color: #FFFFFF;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="texas-flag"></div>
    <div class="container">
        <div class="header">
            <div class="logo">SP</div>
            <h1 class="company-name">Strickland Propane</h1>
            <p class="page-title">Employee Database Query Results</p>
        </div>

        <div class="query-section">
            <h2 class="query-title">🔍 Executed Query</h2>
            <div class="query-text"><?php
// Connect to SQLite database
$conn = new SQLite3('/var/www/html/database.sqlite');

$username = $_GET['username'];
$password = $_GET['password'];

// Vulnerable SQL query (intentionally for CTF)
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($query);

echo htmlspecialchars($query);
?></div>
        </div>

        <?php
if($result) {
    $rows = [];
    while($row = $result->fetchArray()) {
        $rows[] = $row;
    }
    
    if(count($rows) > 0) {
        echo '<div class="flag-banner">🎉 FLAG{propane_accessories_are_the_best} 🎉</div>';
        
        echo '<div class="stats">';
        echo '<div class="stat-card"><div class="stat-number">' . count($rows) . '</div><div class="stat-label">Employees Found</div></div>';
        echo '<div class="stat-card"><div class="stat-number">3</div><div class="stat-label">Database Fields</div></div>';
        echo '<div class="stat-card"><div class="stat-number">Arlen</div><div class="stat-label">Location</div></div>';
        echo '</div>';
        
        echo '<table class="results-table">';
        echo '<thead><tr><th>🆔 Employee ID</th><th>👤 Username</th><th>🔐 Password</th></tr></thead>';
        echo '<tbody>';
        
        foreach($rows as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['username']) . '</td>';
            echo '<td>' . htmlspecialchars($row['password']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        
        echo '<div class="propane-quote">';
        echo '"I sell propane and propane accessories." - Hank Hill';
        echo '</div>';
    } else {
        echo '<div class="error-message">';
        echo '<strong>Dang it, Bobby!</strong> No employees found with those credentials.';
        echo '</div>';
    }
} else {
    echo '<div class="error-message">';
    echo '<strong>Query Failed!</strong> There was an error executing the database query.';
    echo '</div>';
}
?>

        <a href="index.php" class="back-button">
            ← Back to Strickland Propane
        </a>
    </div>
</body>
</html>