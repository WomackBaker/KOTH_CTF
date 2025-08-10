<?php
echo "<h2>🌐 Arlen Service Center - Network Configuration Guide 🌐</h2>";
echo "<div style='background: #2c3e50; color: #ecf0f1; padding: 20px; border-radius: 10px; font-family: Arial, sans-serif;'>";

echo "<div style='background: #27ae60; color: white; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>✅ Success! You're on the Hidden Network</h3>";
echo "<p>You've successfully accessed the Arlen Service Center hidden network through the ghostcat machine.</p>";
echo "</div>";

echo "<h3>How to Access This Network:</h3>";
echo "<div style='background: #34495e; padding: 15px; border-radius: 5px; margin: 15px 0;'>";
echo "<h4>Step 1: Access the ghostcat machine</h4>";
echo "<p>First, you need to compromise the ghostcat container (172.20.0.189) using the Ghostcat vulnerability (CVE-2020-1938).</p>";
echo "</div>";

echo "<div style='background: #34495e; padding: 15px; border-radius: 5px; margin: 15px 0;'>";
echo "<h4>Step 2: Enable the hidden network interface</h4>";
echo "<p>Once on ghostcat, you need to discover and enable the hidden network adapter:</p>";
echo "<pre style='background: #1a1a1a; color: #00ff00; padding: 10px; border-radius: 5px;'>";
echo "# Check available network interfaces\n";
echo "ip link show\n\n";
echo "# Enable the hidden interface (if available)\n";
echo "ip link set eth1 up\n";
echo "ip addr add 192.168.100.10/24 dev eth1\n\n";
echo "# Or use network configuration scripts\n";
echo "ifconfig eth1 192.168.100.10 netmask 255.255.255.0 up\n";
echo "</pre>";
echo "</div>";

echo "<div style='background: #34495e; padding: 15px; border-radius: 5px; margin: 15px 0;'>";
echo "<h4>Step 3: Access the Arlen Service Center</h4>";
echo "<p>Once the hidden network is configured, you can access this service:</p>";
echo "<pre style='background: #1a1a1a; color: #00ff00; padding: 10px; border-radius: 5px;'>";
echo "# Ping the service center\n";
echo "ping 192.168.100.20\n\n";
echo "# Browse to the web service\n";
echo "curl http://192.168.100.20\n";
echo "wget http://192.168.100.20/service_flag.txt\n\n";
echo "# SSH to the service center\n";
echo "ssh propane_tech@192.168.100.20\n";
echo "</pre>";
echo "</div>";

echo "<h3>Current Network Status:</h3>";
$route_output = shell_exec('ip route show 2>/dev/null');
if ($route_output) {
    echo "<pre style='background: #1a1a1a; color: #00ff00; padding: 10px; border-radius: 5px; overflow-x: auto;'>";
    echo htmlspecialchars($route_output);
    echo "</pre>";
}

echo "<h3>Network Topology:</h3>";
echo "<div style='background: #34495e; padding: 15px; border-radius: 5px; margin: 15px 0; font-family: monospace;'>";
echo "<pre>";
echo "Main CTF Network (172.20.0.0/16):\n";
echo "├── ghostcat (172.20.0.189) ← Bridge to hidden network\n";
echo "│   └── eth1: 192.168.100.10/24\n";
echo "└── Hidden Network (192.168.100.0/24):\n";
echo "    └── arlenservice (192.168.100.20)\n";
echo "</pre>";
echo "</div>";

echo "</div>";

echo "<div style='margin-top: 20px; text-align: center;'>";
echo "<a href='index.html' style='color: #f39c12; text-decoration: none; padding: 10px 20px; background: #34495e; border-radius: 5px;'>← Back to Home</a>";
echo "</div>";
?>
