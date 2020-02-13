function loadFile (event) {
  console.log(event.target.files)
  let cont=1;
  document.getElementById('out2').innerHTML="";
    document.getElementById('out').innerHTML="";
  for(i=0;i<event.target.files.length;i++){
    let div=document.createElement('div'),div2=document.getElementById('out').appendChild(div),
    img=document.createElement('img'),img2=div2.appendChild(img);
    div2.className = "mySlides fade";
    img2.src = URL.createObjectURL(event.target.files[i]);
    img2.style.width = '450px';
    let SPAN=document.createElement('span'),SPAN2=document.getElementById('out2').appendChild(SPAN);
    SPAN2.className = "dot";
    SPAN2.setAttribute("onclick","currentSlide("+cont+");");
    currentSlide(cont);
    cont++
    }
  };
function reset() {
    document.getElementById('out2').innerHTML="";
    document.getElementById('out').innerHTML="";
    document.getElementById('descripcion').value="";
    document.getElementById('nombre').value="";
    document.getElementById('precio').value="";
    document.getElementById('files[]').value="";
  };
