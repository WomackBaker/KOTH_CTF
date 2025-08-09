<?php
// Dale's File Archive Browser
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dale's Secure File Archive - Top Secret</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, #2d4a22 0%, #1a2f16 100%);
            min-height: 100vh;
            color: #e8f5e8;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(26, 47, 22, 0.95);
            border: 3px solid #28a745;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 30px rgba(40, 167, 69, 0.4);
        }
        h1 {
            color: #28a745;
            text-align: center;
            font-size: 2.2em;
            text-shadow: 0 0 15px rgba(40, 167, 69, 0.6);
            letter-spacing: 2px;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #ffc107;
            text-align: center;
            font-size: 0.9em;
            margin-bottom: 30px;
            font-style: italic;
        }
        .warning {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
            border: 2px solid #ffc107;
        }
        .file-list {
            background: rgba(0, 0, 0, 0.4);
            border: 2px solid #28a745;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .file-item {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .file-name {
            color: #ffc107;
            font-weight: bold;
            flex-grow: 1;
        }
        .file-info {
            color: #e8f5e8;
            font-size: 0.9em;
            margin-right: 15px;
        }
        .file-link {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            border: 1px solid #ffc107;
            transition: all 0.3s ease;
        }
        .file-link:hover {
            background: linear-gradient(45deg, #ffc107, #fd7e14);
            border-color: #28a745;
        }
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        .back-link a {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
            text-decoration: none;
            border: 2px solid #ffc107;
            border-radius: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .back-link a:hover {
            background: linear-gradient(45deg, #28a745, #20c997);
        }        .no-files {
            text-align: center;
            color: #ffc107;
            font-style: italic;
            padding: 40px;
        }
        .file-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .file-item {
            background: rgba(40, 167, 69, 0.15);
            border: 2px solid #28a745;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .file-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
            border-color: #ffc107;
        }
        .file-icon {
            font-size: 3em;
            margin-bottom: 15px;
        }
        .file-name {
            font-weight: 600;
            color: #ffc107;
            word-break: break-all;
            margin-bottom: 10px;
        }
        .file-size {
            color: #e8f5e8;
            font-size: 0.9em;
            margin-bottom: 15px;
        }
        .file-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9em;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .btn-primary {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            border-color: #ffc107;
        }
        .btn-success {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
            border-color: #ffc107;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .nav-links {
            text-align: center;
            margin-bottom: 30px;
        }
        .nav-links a {
            display: inline-block;
            padding: 12px 25px;
            margin: 0 10px;
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
            text-decoration: none;
            border: 2px solid #ffc107;
            border-radius: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            font-weight: bold;
        }
        .nav-links a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            background: linear-gradient(45deg, #28a745, #20c997);
        }
    </style>
</head>
<body>    <div class="container">
        <h1>🗃️ DALE'S SECURE FILE ARCHIVE 🗃️</h1>
        <div class="subtitle">CLASSIFIED EVIDENCE STORAGE - AUTHORIZED PERSONNEL ONLY</div>
        
        <div class="nav-links">
            <a href="/index.html">⬅️ RETURN TO UPLOAD STATION</a>
            <a href="javascript:location.reload()">🔄 REFRESH ARCHIVE</a>
        </div>
        
        <div class="warning">
            🚨 RESTRICTED ACCESS - TOP SECRET CLEARANCE REQUIRED 🚨<br>
            "They can't monitor what they can't find!" - Dale Gribble
        </div>
        
        <?php
        $upload_dir = './uploads/';
        $files = scandir($upload_dir);
        $evidence_files = array();
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && $file != 'index.php') {
                $evidence_files[] = $file;
            }
        }
        ?>
        
        <div class="file-list">
            <h3 style="color: #28a745; margin-bottom: 20px;">📂 ARCHIVED EVIDENCE FILES:</h3>
            
            <?php if (empty($evidence_files)): ?>
            <div class="no-files">🚫 NO EVIDENCE FILES CURRENTLY STORED<br><em>The vault is secure... for now.</em></div>
            <?php else: ?>
            <div class="file-grid">
                <?php foreach ($evidence_files as $file): 
                    $file_path = $upload_dir . $file;
                    $file_size = filesize($file_path);
                    $file_date = date('Y-m-d H:i:s', filemtime($file_path));
                    $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    
                    // Determine file type and icon
                    $file_type = "Unknown";
                    $icon = '📄';
                    if (preg_match('/\.php$/i', $file)) {
                        $file_type = "⚠️ PHP Script";
                        $icon = '🐘';
                    } elseif (preg_match('/\.(jpg|jpeg|png|gif|bmp|webp)$/i', $file)) {
                        $file_type = "🖼️ Image";
                        $icon = '🖼️';
                    } elseif (preg_match('/\.(txt|log)$/i', $file)) {
                        $file_type = "📄 Text";
                        $icon = '📝';
                    } elseif (preg_match('/\.(html|htm)$/i', $file)) {
                        $file_type = "🌐 HTML";
                        $icon = '🌐';
                    } elseif (preg_match('/\.(zip|rar|7z)$/i', $file)) {
                        $file_type = "📦 Archive";
                        $icon = '📦';
                    }
                    
                    $fileSizeFormatted = $file_size < 1024 ? $file_size . ' B' : 
                                       ($file_size < 1048576 ? round($file_size/1024, 2) . ' KB' : 
                                        round($file_size/1048576, 2) . ' MB');
                ?>
                <div class="file-item">
                    <div class="file-icon"><?php echo $icon; ?></div>
                    <div class="file-name">🔍 <?php echo htmlspecialchars($file); ?></div>
                    <div class="file-size"><?php echo $file_type; ?> | <?php echo $fileSizeFormatted; ?></div>
                    <div style="font-size: 0.8em; color: #e8f5e8; margin-bottom: 15px;"><?php echo $file_date; ?></div>
                    <div class="file-actions">
                        <a href="uploads/<?php echo htmlspecialchars($file); ?>" class="btn btn-primary" target="_blank">
                            <?php echo $fileExt === 'php' ? '🚀 EXECUTE' : '👁️ ACCESS'; ?>
                        </a>
                        <a href="uploads/<?php echo htmlspecialchars($file); ?>" class="btn btn-success" download>
                            💾 DOWNLOAD
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>        
        <div style="background: rgba(220, 53, 69, 0.1); border: 2px dashed #dc3545; padding: 15px; border-radius: 10px; text-align: center; color: #ffc107; margin-top: 30px;">
            🕵️ <strong>SECURITY NOTICE:</strong> All file access is monitored by Dale's advanced surveillance detection systems.<br>
            <em>If you can read this, you're probably not a government agent... probably.</em>
        </div>
    </div>
</body>
</html>
