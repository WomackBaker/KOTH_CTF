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
            <div class="bill-warning">
                <h2>⚠️ BILL'S NERVOUS CONFESSION ⚠️</h2>
                <p><strong>Bill:</strong> "Well, I tell you what... back in the Army, we had these servers, and I might have, uh..."</p>
                <p><em>*fidgets with his glasses*</em></p>
                <p><strong>Bill:</strong> "I might have left some of the old configuration files when I set up this Tomcat server..."</p>
                <p><strong>Bill:</strong> "Dale keeps telling me something about 'ghosts' and 'cats' but I don't know what he's talking about!"</p>
            </div>
            
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

Security Notes:
- <span class="redacted">AJP CONNECTOR ALLOWS FILE ACCESS</span>
- <span class="redacted">CVE-2020-1938 VULNERABILITY PRESENT</span>
- Flag location: <span class="redacted">/var/lib/tomcat9/flag.txt</span>

Bill's Personal Note: "I don't really understand all this computer stuff, 
but Dale said something about 'ghost cats' being able to read files 
through some 'AJP' thing. I just hope I didn't mess anything up..."
                    </pre>
                </div>
            </div>
            
            <div class="challenge-hint">
                <h3>🐱‍👤 The Ghost Cat Haunts Bill's Server 🐱‍👤</h3>
                <p>Bill's been hearing strange noises from his server room at night...</p>
                <p>Some say it's the spirit of a ghostly cat that can slip through network protocols...</p>
                <div class="hint-text">
                    <p>💡 <strong>Hint:</strong> The ghost cat likes to use port 8009...</p>
                    <p>💡 <strong>Hint:</strong> It can read files that aren't meant to be read...</p>
                    <p>💡 <strong>Hint:</strong> Look up "Ghostcat CVE-2020-1938" for more information!</p>
                </div>
                <div class="ghost-cat">👻🐱💻</div>
            </div>
            
            <div class="army-memories">
                <h3>Bill's Technical Confusion</h3>
                <div class="memory-box">
                    <p><strong>Bill:</strong> "So there's this thing called an 'AJP connector'... I think it stands for 'Apache Just... Protocol'?"</p>
                    <p><em>*scratches head*</em></p>
                    <p><strong>Bill:</strong> "And Dale keeps mumbling about 'binary protocols' and 'file inclusion'... I just want to cut hair!"</p>
                    <p><strong>Bill:</strong> "All I know is that port 8009 is supposed to be for 'internal use only' but I never figured out how to secure it properly..."</p>
                </div>
            </div>
            
            <div style="background: rgba(255,0,0,0.1); padding: 20px; border: 2px solid red; border-radius: 10px; margin: 20px 0;">
                <h3 style="color: red;">🚨 BILL'S PANIC MODE 🚨</h3>
                <p><strong>Bill:</strong> "Oh no, oh no, oh no! Did I just show you classified information?!"</p>
                <p><em>*starts hyperventilating*</em></p>
                <p><strong>Bill:</strong> "Please don't tell anyone about the flag file! The Army will court-martial me!"</p>
                <p style="font-size: 0.9em; color: #666;"><em>Maybe Bill revealed a little too much information...</em></p>
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
            "I tell you what, this computer stuff is confusing...",
            "Back in the Army, we had protocols for everything!",
            "Dale said something about ghost cats... I don't get it.",
            "Why do I hear meowing from the server room?",
            "Sweet Lady Propane, protect my server!"
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
