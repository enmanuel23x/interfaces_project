function sync(id){
    document.getElementById('in').innerHTML='<input type="file" accept="image/*" name="files[]" id="files[]" onchange="loadFile(event)" required multiple>';
    document.getElementById('out2').innerHTML="";
    document.getElementById('out').innerHTML="";
    document.getElementById('form').action="./utils/edit.php?id="+id+"&case=1";
}