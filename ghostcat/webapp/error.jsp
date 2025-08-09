<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill's Confused - Page Not Found</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error-container {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(135deg, #FFB6C1, #FFA07A);
            border: 3px solid #DC143C;
            border-radius: 15px;
            margin: 20px 0;
        }
        
        .error-code {
            font-size: 6em;
            color: #B22222;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
            margin: 20px 0;
        }
        
        .confused-bill {
            font-size: 4em;
            margin: 20px 0;
            animation: shake 2s infinite;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="army-stripes"></div>
            <h1>🪖 Bill Dauterive's Army Surplus & Barber Shop 🪖</h1>
            <div class="army-stripes"></div>
            
            <nav style="margin-top: 20px;">
                <a href="index.jsp" style="color: #8B4513; text-decoration: none; margin: 0 15px; font-weight: bold;">🏠 Home</a>
                <a href="classified.jsp" style="color: #B22222; text-decoration: none; margin: 0 15px; font-weight: bold;">🔒 Secret Files</a>
            </nav>
        </header>
        
        <div class="main-content">
            <div class="error-container">
                <div class="error-code">404</div>
                <div class="confused-bill">😵‍💫</div>
                
                <h2>Bill's Having a Moment...</h2>
                <p style="font-size: 1.2em; margin: 20px 0;">
                    <strong>Bill:</strong> "Well, I tell you what... I don't know where that page went!"
                </p>
                
                <div class="bill-quote">
                    "That page, I don't know you!"
                </div>
                
                <p>Looks like you've wandered into a part of Bill's shop that doesn't exist.</p>
                <p>Maybe you should head back to the main area, or check out his secret files...</p>
                
                <div style="margin: 30px 0;">
                    <a href="index.jsp" style="background: #228B22; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px;">
                        🏠 Back to Bill's Shop
                    </a>
                    <a href="classified.jsp" style="background: #B22222; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 10px;">
                        🔒 Check Secret Files
                    </a>
                </div>
                
                <div style="margin-top: 30px; font-style: italic; color: #666;">
                    <p>"I probably messed up the server configuration again..." - Bill</p>
                </div>
            </div>
        </div>
        
        <footer class="footer">
            <p>© 2025 Bill Dauterive's Army Surplus & Barber Shop</p>
            <p>Located on Rainey Street, Arlen, Texas</p>
            <p><em>"That's a clean burning hell, I tell you what!"</em></p>
        </footer>
    </div>
    
    <div class="floating-propane">🔥</div>
</body>
</html>
