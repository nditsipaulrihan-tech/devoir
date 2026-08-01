function show(x,y) {
  x.addEventListener('click', ()=>{
    if(x.checked){
      y.type = "text"
    }else{
      y.type = "password"
    }
  })
  
}

let c = document.getElementById('zshow')

let cc = document.querySelector("input[name='zpassword']")

show(c, cc)