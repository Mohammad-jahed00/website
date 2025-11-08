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
            margin: 60px 40px;
            direction: ltr;
            display: flex;
            gap: 60px;
        }

        .file-section{
            width: 45%;
            border-right: none;
        }

        
        .file-list {
            
            max-height: 74vh;
            overflow-y: auto;
            padding-right: 20px;
            scrollbar-width: thin;
            padding-top: 20px;
            box-sizing: border-box;
           
        }

        .file-list::-webkit-scrollbar{
            width: 6px;
        }

        .file-list::-webkit-scrollbar-track{
            background: #f1f1f1;
        }

        .file-list::-webkit-scrollbar-thumb{
            background: #bbb;
            border-radius: 10px;
        }

        .file-list::webkit-scrollbar-thumb:hover{
            background: #888888ff;
        }

        h2 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #222;
        }

        .line{
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            width: 100%;
            left: 0;
            position: absolute;
            top:72px;
            box-shadow:0 1px 2px rgba(0, 0, 0, 0.05);
            opacity: 0.3;
        }
    


        
       

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 1px;
            border-radius: 10px;
            transition: all 0.35s ease;
            font-size: 13px;
            position: relative; 
            background: transparent ;
        }

        .file-name {
            flex: 1 1 auto;      
            min-width: 0;         
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: 600px;
        }

       

        .file-item:hover {
            background-color: #f4f7ff;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

   
        .delete-btn {       
            background: none;
            border: none;
            color: #ff4d4d;
            font-size: 18px;
            cursor: pointer;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.25s ease;
            margin-left: 10px;
        }

       
        .file-item:hover .delete-btn {
            opacity: 1;
            transform: scale(1);
        }

       
        .delete-btn:hover {
            color: #ff1a1a;
            transform: scale(1.2);
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
            margin-left: 330px;
            margin-top: 60px;
            text-align: center;
            text-overflow: ellipsis;
        }

        .preview img {
            width: 46%;
            height: 24vh;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 17px;
            margin-left: 345px;
            display: none;  
        }
        
        .TimeAndSize {
            display: flex;
            justify-content: space-between; 
            width: 180px; /* عرض ثابت برای منظم ماندن */
            font-size: 13px;
            color: #444;
            
        }

        
        #downloadBtn {
            display: none;
            margin: 18px auto 0 auto;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: bold;
            margin-left: 345px;
           
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

        #search-box{
            display: block;
            font-size: 16px;
            position: absolute;
            margin-top: -45px;
            border: 1px solid  #f0eceaff ;
            border-radius: 5px;
            padding: 13px 16px;
            padding-right: 50px;
            background-color: #fafafa;
            outline: none;
            width: 39%;
            height:6%;
            right: 10%;
            background-color: #f7f3f1ff;
            box-sizing: border-box;
            direction: Itr;
            text-align: left;

            
        }

        #search-box:focus {
            border-color: #007bff;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
            background-color: #fff;
        }

        #search-icon{
            display: block;
            position: absolute;
            margin-top: -40.5px;
            width: 2.4%;
            right:10.5%;
            outline: none;  

        }
       
    </style>
</head>
<body>
    
    <div>
        <input type="text" id="search-box" autocomplete="off" placeholder="Search File"  dir="auto" tabindex="0" aria-label="Search File" role="searchbox" aria-autocomplete="list" aria-expanded="true" aria-haspopup="grid" spellcheck="false">
    </div>
    <img src="loupe.png" alt="Search" id="search-icon">
    
    <div class="file-section">
        <h2>📁 Uploaded Files</h2>
        <div class="file-list">
            <div class="line"></div>
            <?php if (empty($files)): ?>
                <p>هیچ فایلی آپلود نشده است.</p>
            <?php else: ?>
                <?php foreach ($files as $file): 
                    $filePath = $dir . $file;
                    date_default_timezone_set('Asia/Tehran');
                    $uploadTime = date("m-d-Y H:i:s", filemtime($filePath));

                    $fileSize = filesize($filePath);
                    $fileSizeKB = round($fileSize / 1024, 0);
                ?>
                    <div class="file-item"
                        onclick="showImage('uploads/<?php echo htmlspecialchars($file); ?>', '<?php echo htmlspecialchars($file); ?>')"
                        style="cursor:pointer;">
                        <span class="file-name">
                            <?php echo htmlspecialchars($file); ?>
                        </span>
                        <span class="TimeAndSize">
                            <span class="file-time">
                                <?php echo $uploadTime; ?>
                            </span>
                            <span class="file-size">
                                <?php echo $fileSizeKB."KB"; ?>
                            </span>
                        </span>
                        <button class = "delete-btn" onclick="deleteFile('<?php echo htmlspecialchars($file);?>',event)">🗑️</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
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
        function deleteFile(fileName, event) {
            event.stopPropagation(); // 

            if (!confirm("آیا مطمئنی می‌خواهی این فایل را حذف کنی؟")) return;

            fetch("delete.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "file=" + encodeURIComponent(fileName)
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    alert("فایل با موفقیت حذف شد ✅");
                    location.reload();
                } else {
                    alert("خطا در حذف فایل ❌");
                }
            })
            .catch(err => console.error(err));
        }
    </script>
    <script>
        const searchInput = document.getElementById("search-box");

     
        searchInput.addEventListener("input", function () {
            const filter = this.value.trim().toLowerCase(); 
            const files = document.querySelectorAll(".file-item"); 

            files.forEach(file => {
                const name = file.querySelector(".file-name").textContent.toLowerCase();

                
                if (name.includes(filter)) {
                    file.style.display = "flex";
                } else {
                    file.style.display = "none";
                }
            });
        });
    </script>
    
</body>
</html>
