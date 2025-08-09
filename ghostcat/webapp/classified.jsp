<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill's Secret Army Files - Classified</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .classified-header {
            background: repeating-linear-gradient(
                45deg,
                #FF0000,
                #FF0000 10px,
                #000000 10px,
                #000000 20px
            );
            color: white;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 1.5em;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }
        
        .classified-content {
            background: #000;
            color: #00FF00;
            font-family: 'Courier New', monospace;
            padding: 30px;
            margin: 20px 0;
            border: 3px solid #FF0000;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }
        
        .file-listing {
            background: rgba(0, 0, 0, 0.8);
            color: #00FF00;
            padding: 20px;
            border-radius: 5px;
            margin: 15px 0;
            font-family: monospace;
            border: 1px solid #00FF00;
        }
        
        .redacted {
            background: #000;
            color: #000;
            user-select: none;
        }
        
        .redacted:hover {
            background: #333;
            color: #FF0000;
        }
        
        .bill-warning {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            padding: 20px;
            border: 3px solid #FF4500;
            border-radius: 10px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="classified-header">
            🚨 CLASSIFIED - EYES ONLY 🚨<br>
            PROPERTY OF SGT. WILLIAM "BILL" DAUTERIVE
        </div>
        
        <header class="header">
            <h1>🔒 Bill's Secret Army Server Room 🔒</h1>
            <p style="color: #B22222; font-style: italic;">"I probably shouldn't show you this, but..."</p>
            
            <nav style="margin-top: 20px;">
                <a href="index.jsp" style="color: #8B4513; text-decoration: none; margin: 0 15px; font-weight: bold;">🏠 Back to Shop</a>
                <a href="classified.jsp" style="color: #B22222; text-decoration: none; margin: 0 15px; font-weight: bold;">🔒 Secret Files</a>
            </nav>
        </header>
        
        <div class="main-content">
            
            <div class="classified-content">
                <h3>ARMY SERVER CONFIGURATION NOTES</h3>
                <div class="file-listing">
                    <pre>
Subject: Server Setup - Operation Lone Star
Date: [REDACTED]
From: Sgt. W. Dauterive
To: IT Command

Listen up, y'all. Setting up the new server with these specifications:

- Apache Tomcat 9.0.30 (vulnerable version, but command said use it)
- AJP Connector enabled on port 8009
- HTTP Connector on port 8080
- Default configurations mostly unchanged
- <span class="redacted">SECRET PROTOCOL ENDPOINTS ENABLED</span>
                    </pre>
                </div>
            </div>
        
            
            <div style="background: rgba(255,0,0,0.1); padding: 20px; border: 2px solid red; border-radius: 10px; margin: 20px 0;">
                <h3 style="color: red;">🚨 BILL'S PANIC MODE 🚨</h3>
                <p><strong>Bill:</strong> "Oh no, oh no, oh no! Did I just show you classified information?!"</p>
                <p><em>*starts hyperventilating*</em></p>
            </div>
        </div>
        
        <footer class="footer">
            <p>🔒 This page contains classified military information 🔒</p>
            <p><em>"I tell you what, I shouldn't have shown you this..." - Bill Dauterive</em></p>
        </footer>
    </div>
    
    <div class="floating-propane">🔥</div>
    
    <script>
        // Add some Bill Dauterive quotes that appear randomly
        const billQuotes = [
            "That's my server, I don't know you!",
            "Back in the Army, we had protocols for everything!",
            "Why do I hear meowing from the server room?",
            "Maybe If You Bought Him Another Bowling Ball It’d Be Like Before Peggy Came"
        ];
        
        setInterval(() => {
            if (Math.random() < 0.1) { // 10% chance every interval
                const quote = billQuotes[Math.floor(Math.random() * billQuotes.length)];
                console.log("Bill whispers: " + quote);
            }
        }, 5000);
    </script>
</body>
</html>
