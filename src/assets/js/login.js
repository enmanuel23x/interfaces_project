function changeopc(opc){
    if(opc==1){
      document.getElementById('signup').style.display='block';
      document.getElementById('login').style.display='none';
      document.getElementById('log').className='tab'
      document.getElementById('sign').className='tab active'
    }else{
      document.getElementById('login').style.display='block';
      document.getElementById('signup').style.display='none';
      document.getElementById('sign').className='tab'
      document.getElementById('log').className='tab active'
    }
    
  }