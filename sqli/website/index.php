<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strickland Propane - Employee Portal</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Background elements */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            pointer-events: none;
        }

        .login-container {
            background: linear-gradient(145deg, #F5F5DC 0%, #DEB887 100%);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 50px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            width: 100%;
            max-width: 450px;
            text-align: center;
            border: 3px solid #8B4513;
            position: relative;
            z-index: 1;
        }

        .login-container::before {
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

        .logo {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #FF4500, #FF6347);
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(255, 69, 0, 0.4);
            border: 4px solid #8B4513;
            position: relative;
        }

        .logo::after {
            content: '🔥';
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 20px;
            animation: flame 1s ease-in-out infinite alternate;
        }

        @keyframes flame {
            0% { transform: scale(1) rotate(-5deg); }
            100% { transform: scale(1.1) rotate(5deg); }
        }

        .company-name {
            color: #8B4513;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .subtitle {
            color: #A0522D;
            font-size: 16px;
            margin-bottom: 35px;
            font-style: italic;
        }

        .location {
            color: #8B4513;
            font-size: 14px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #8B4513;
            font-weight: 600;
            font-size: 16px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 18px;
            border: 3px solid #DEB887;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #FFF8DC;
            color: #8B4513;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #FF4500;
            background: white;
            box-shadow: 0 0 15px rgba(255, 69, 0, 0.3);
            transform: translateY(-2px);
        }

        .form-group input::placeholder {
            color: #A0522D;
            opacity: 0.7;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(45deg, #FF4500, #FF6347);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 8px 20px rgba(255, 69, 0, 0.3);
            border: 2px solid #8B4513;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(255, 69, 0, 0.5);
            background: linear-gradient(45deg, #FF6347, #FF4500);
        }

        .login-btn:active {
            transform: translateY(-1px);
        }

        .error-message {
            background: linear-gradient(45deg, #FFE4E1, #FFB6C1);
            color: #8B0000;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 5px solid #8B0000;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(139, 0, 0, 0.2);
        }

        .footer {
            margin-top: 35px;
            color: #8B4513;
            font-size: 13px;
            font-weight: 600;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #228B22;
            font-size: 13px;
            margin-top: 20px;
            font-weight: 600;
        }

        .security-icon {
            width: 18px;
            height: 18px;
            background: #228B22;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .propane-quote {
            margin-top: 20px;
            padding: 15px;
            background: linear-gradient(45deg, #F0E68C, #FFD700);
            border-radius: 10px;
            border: 2px solid #DAA520;
            font-style: italic;
            color: #8B4513;
            font-weight: 600;
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

        .character-hint {
            background: linear-gradient(45deg, #E6F3FF, #B3D9FF);
            border: 2px solid #4A90E2;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            color: #2E5C8A;
            font-size: 14px;
            font-weight: 600;
        }

        .arlen-map {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #90EE90, #32CD32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #006400;
            font-size: 12px;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 100, 0, 0.3);
            border: 2px solid #006400;
        }

        .arlen-map::before {
            content: '📍';
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="texas-flag"></div>
    <div class="arlen-map">Arlen</div>
    <div class="login-container">
        <div class="logo">SP</div>
        <h1 class="company-name">Strickland Propane</h1>
        <p class="subtitle">"Taste the meat, not the heat!"</p>
        <p class="location">📍 Arlen, Texas - Since 1989</p>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="error-message">
                <strong>Dang it, Bobby!</strong> Invalid credentials. Please try again.
            </div>
        <?php endif; ?>
        
        <form action="login.php" method="GET">
            <div class="form-group">
                <label for="username">👤 Employee ID</label>
                <input type="text" id="username" name="username" placeholder="Enter your employee ID" required>
            </div>
            <div class="form-group">
                <label for="password">🔐 Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="login-btn">🚀 Sign In</button>
        </form>
        
        <div class="propane-quote">
            "I sell propane and propane accessories."
        </div>
        
        <div class="character-hint">
            💡 Hint: Try logging in as Hank, Dale, Bill, or Boomhauer...
        </div>
        
        <div class="security-badge">
            <span class="security-icon"></span>
            Secured with propane-grade encryption
        </div>
        
        <div class="footer">
            © 2025 Strickland Propane. "That's my purse! I don't know you!"
        </div>
    </div>
</body>
</html>