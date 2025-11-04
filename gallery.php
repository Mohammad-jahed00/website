<?php
$dir = __DIR__ . '/uploads/';
$files = is_dir($dir) ? array_diff(scandir($dir), ['.', '..']) : [];
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8"> 
    <title>لیست تصاویر</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #fff;
            color: #000;
            margin: 30px 80px;
            direction: ltr;
            display: flex;
            gap: 60px;
        }

      
        .file-list {
            width: 40%;
            border-right: none; 
        }

        h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #222;
        }


       
        .file-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 14px;
        border-radius: 10px;
        transition: all 0.35s ease;
        font-size: 13px;
        }

        .file-item:hover {
        background-color: #f4f7ff;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .file-item .file-name{
            font-weight: bold;
        }

        

        
        
        .preview {
            flex: 1;
            text-align: center;
        }

        a {
            display: block;
            color: #292d30ff;
            text-decoration: none;
            padding: 8px 4px;
            font-size: 13px;
            font-weight: bold;
        }

        .preview h3 {
            font-size: 15px;
            color: #595b3fff;
            margin-left: 400px;
            margin-top: 80px;

        }

        .preview img {
            width: 50%;
            height: 30vh;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 20px;
            margin-left: 400px;
            display: none;
            
        }

        #downloadBtn {
            display: none; 
            margin: 22px auto 0 auto;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: bold;
            margin-left: 430px;
           
            color: black;
            background-color: #f1ebbbff; 
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(227, 182, 182, 0.2);
            transition: all 0.3s ease;
            display: block;
            width: fit-content; 
        }

        #downloadBtn:hover {
            background-color: #b0d392ff;
        }

        #downloadBtn:active {
            transform: scale(0.95);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    
    <div class="file-list">
        <h2>📁 فایل‌های آپلودشده</h2>
        <?php if (empty($files)): ?>
            <p>هیچ فایلی آپلود نشده است.</p>
        <?php else: ?>
            <?php foreach ($files as $file): 
                $filePath = $dir . $file;
                date_default_timezone_set('Asia/Tehran');
                $uploadTime = date("m-d-Y H:i:s", filemtime($filePath));
            ?>
                <div class="file-item"
                    onclick="showImage('uploads/<?php echo htmlspecialchars($file); ?>', '<?php echo htmlspecialchars($file); ?>')"
                    style="cursor:pointer;">
                    <span class="file-name">
                        <?php echo htmlspecialchars($file); ?>
                    </span>
                    <span class="file-time">
                        <?php echo $uploadTime; ?>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

 
    <div class="preview" id="preview">
        <h3 id="fileName"style="display:none;"></h3>
        <img id="previewImg" src="" alt="">
        <a id="downloadBtn" href="#"download style="display: none;">Download</a>
    </div>

    <script>
        function showImage(path, name){
            const img = document.getElementById("previewImg");
            const fileName = document.getElementById("fileName");
            const downloadBtn = document.getElementById("downloadBtn");
            img.src = path;
            fileName.textContent = name;

            fileName.style.display = "block";
            img.style.display = "block";

            downloadBtn.href=path;
            downloadBtn.download = name;
            downloadBtn.style.display = "inline-block";
        }
    </script>

</body>
</html>