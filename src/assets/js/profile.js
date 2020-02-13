function setting (e,n){
    console.log(n)
    s= document.getElementsByName('s')
    for(i=0;i<s.length;i++){
        s[i].offsetParent.classList.remove("active")
    }
    e.offsetParent.classList.add("active")
    document.getElementById('content-user').style.display="none";
    document.getElementById('content-pedidos').style.display="none";
    document.getElementById('content-list').style.display="none";
    switch (n){
        case 1:
            document.getElementById('content-user').style.display="block";
            break
        case 2:
            document.getElementById('content-pedidos').style.display="block";
            break
        case 3:
            document.getElementById('content-list').style.display="block";
            break
    }
}