<?php
// Dale's PHP Upload Handler - Backup to CGI
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dale's Bug Detection Lab</title>
    <style>
        body { 
            font-family: 'Courier New', monospace; 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px;
            background: linear-gradient(135deg, #2d4a22 0%, #1a2f16 100%);
            min-height: 100vh;
            color: #e8f5e8;
        }
        .container {
            background: rgba(26, 47, 22, 0.9);
            border: 3px solid #28a745;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.3);
        }
        h1 {
            color: #28a745;
            text-align: center;
            margin-bottom: 10px;
            font-size: 2.2em;
            text-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
        }
        .success-message {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 2px solid #ffc107;
        }
        .file-info {
            background: rgba(40, 167, 69, 0.2);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #ffc107;
        }
        pre { 
            background: rgba(0, 0, 0, 0.6); 
            padding: 20px; 
            border: 2px solid #28a745;
            border-radius: 8px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            line-height: 1.4;
            color: #00ff00;
        }
        .nav-links {
            text-align: center;
            margin-top: 30px;
        }
        .nav-links a {
            display: inline-block;
            padding: 12px 25px;
            margin: 0 10px;
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            text-decoration: none;
            border: 2px solid #ffc107;
            border-radius: 5px;
            font-weight: bold;
        }
        .error-message {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 2px solid #ffc107;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐛 DALE'S BUG DETECTION LAB 🐛</h1>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            $upload_dir = './uploads/';
            
            // Create uploads directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file = $_FILES['file'];
            $filename = $file['name'];
            $upload_path = $upload_dir . $filename;
            
            if ($file['error'] === UPLOAD_ERR_OK) {
                if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                    // Set permissions
                    chmod($upload_path, 0644);
                    
                    // Get file info
                    $file_size = filesize($upload_path);
                    $file_type = "Unknown";
                    
                    // Determine file type
                    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    if ($file_ext === 'php') {
                        $file_type = "PHP Script";
                    } elseif (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                        $file_type = "Image File";
                    } elseif (in_array($file_ext, ['txt', 'log'])) {
                        $file_type = "Text File";
                    } elseif (in_array($file_ext, ['html', 'htm'])) {
                        $file_type = "HTML File";
                    } elseif (in_array($file_ext, ['zip', 'rar', '7z'])) {
                        $file_type = "Archive File";
                    }
                    
                    // Create analysis output
                    $output = "File Analysis Complete:\n";
                    $output .= "- File Type: $file_type\n";
                    $output .= "- File Size: $file_size bytes\n";
                    $output .= "- Status: File appears to be clean of government tracking devices.\n";
                    $output .= "- Dale's advanced surveillance detection scan: PASSED";
                    ?>
                    
                    <div class="success-message">
                        ✅ File specimen uploaded to secure Dale-Cave storage facility!
                    </div>
                    
                    <div class="file-info">
                        📁 <strong>Specimen File:</strong> <?php echo htmlspecialchars($filename); ?><br>
                        📂 <strong>Secure Location:</strong> <a href="uploads/<?php echo htmlspecialchars($filename); ?>" target="_blank" style="color: #ffc107;">uploads/<?php echo htmlspecialchars($filename); ?></a><br>
                        🔍 <strong>File Type:</strong> <?php echo $file_type; ?><br>
                        📏 <strong>File Size:</strong> <?php echo $file_size; ?> bytes<br>
                        🔒 <strong>Classification Level:</strong> TOP SECRET - DALE EYES ONLY
                    </div>
                    
                    <h3 style="color: #28a745;">📋 DALE'S ANALYSIS REPORT:</h3>
                    <pre><?php echo $output; ?></pre>
                    
                <?php
                } else {
                    ?>
                    <div class="error-message">
                        ❌ Error: Failed to move uploaded file
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="error-message">
                    ❌ Error: File upload failed (Error code: <?php echo $file['error']; ?>)
                </div>
                <?php
            }
        } else {
            ?>
            <div class="error-message">
                ❌ Error: No file uploaded or invalid request
            </div>
            <?php
        }
        ?>
        
        <div class="nav-links">
            <a href="/index.html">🔄 Upload Another File</a>
            <a href="/upload.php">📁 View All Files</a>
        </div>
    </div>
</body>
</html> 