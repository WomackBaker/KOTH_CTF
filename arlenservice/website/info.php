<?php
echo "<h2>🔧 Arlen Service Center - System Information 🔧</h2>";
echo "<div style='background: #2c3e50; color: #ecf0f1; padding: 20px; border-radius: 10px; font-family: monospace;'>";

echo "<h3>Server Information:</h3>";
echo "<p><strong>Server:</strong> " . $_SERVER['SERVER_NAME'] . "</p>";
echo "<p><strong>Server IP:</strong> " . $_SERVER['SERVER_ADDR'] . "</p>";
echo "<p><strong>Client IP:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>";
echo "<p><strong>User Agent:</strong> " . $_SERVER['HTTP_USER_AGENT'] . "</p>";

echo "<h3>PHP Information:</h3>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

echo "<h3>Network Configuration:</h3>";
$network_output = shell_exec('ip addr show 2>/dev/null');
if ($network_output) {
    echo "<pre style='background: #1a1a1a; color: #00ff00; padding: 10px; border-radius: 5px; overflow-x: auto;'>";
    echo htmlspecialchars($network_output);
    echo "</pre>";
} else {
    echo "<p>Network information not available</p>";
}

echo "<h3>Hidden Network Access:</h3>";
echo "<div style='background: #27ae60; color: white; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
echo "<p><strong>🎉 Congratulations!</strong> You've successfully accessed the hidden Arlen Service Center network!</p>";
echo "<p>This network is only accessible by configuring an additional network adapter on the ghostcat machine.</p>";
echo "</div>";

echo "<h3>Available Flags:</h3>";
if (file_exists('/var/www/html/service_flag.txt')) {
    $flag_content = file_get_contents('/var/www/html/service_flag.txt');
    echo "<div style='background: #e74c3c; color: white; padding: 15px; border-radius: 5px; margin: 10px 0; text-align: center; font-size: 18px; font-weight: bold;'>";
    echo htmlspecialchars($flag_content);
    echo "</div>";
}

echo "</div>";

echo "<div style='margin-top: 20px; text-align: center;'>";
echo "<a href='index.html' style='color: #f39c12; text-decoration: none; padding: 10px 20px; background: #34495e; border-radius: 5px;'>← Back to Home</a>";
echo "</div>";
?>
