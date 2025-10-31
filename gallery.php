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
            border-right: 1px solid #ddd;
            padding-right: 20px;
        }

        h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #222;
        }

        a {
            display: block;
            color: #292d30ff;
            text-decoration: none;
            padding: 8px 4px;
            font-size: 13px;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
            background-color: #ddebfcff;
        }

        .divider {
            height: 1px;
            background-color: #ddd;



            
            margin: 4px 0;
        }

      
        .preview {
            flex: 1;
            text-align: center;
        }

        .preview h3 {
            font-size: 18px;
            color: #444;
        }

        .preview img {
            max-width: 90%;
            max-height: 80vh;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>

    
    <div class="file-list">
        <h2>📁 فایل‌های آپلودشده</h2>
        <?php if (empty($files)): ?>
            <p>هیچ فایلی آپلود نشده است.</p>
        <?php else: ?>
            <?php foreach ($files as $file): ?>
                <a href="#" onclick="showImage('uploads/<?php echo htmlspecialchars($file); ?>', '<?php echo htmlspecialchars($file); ?>')">
                    <?php echo htmlspecialchars($file); ?>
                </a>
                <div class="divider"></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    
    <div class="preview" id="preview">
        <h3 id="fileName">یک فایل را انتخاب کنید</h3>
        <img id="previewImg" src="" alt="">
    </div>

    <script>
    function showImage(path, name){
        const img = document.getElementById("previewImg");
        const fileName = document.getElementById("fileName");
        img.src = path;
        fileName.textContent = name;
        img.style.display = "block";
    }
    </script>

</body>
</html>