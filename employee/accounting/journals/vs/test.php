
<link rel="stylesheet" href="js/bootstrap.fd.css">>
<script src="js/bootstrap.fd.js"></script> 
<form>
    <button type="button" onclick="selectFiles();">Select Files</button>
</form>
<script>
    function selectFiles(){
        $.FileDialog({
            "accept":"image/*"
        }).on("files.bs.filedialog",function(event){
            var html="";
            for(var a = 0; a < event.files.length; a++){
                selectedImages.push(event.files[a]);
                html += "<img src='"+event.files[a].content + "' style='width:300px; margin: 10px;'>";
            }
            document.getElementById("selected-images").innerHTML=html;
        });
    }
</script>