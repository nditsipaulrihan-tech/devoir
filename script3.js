function show(x,y) {
  x.addEventListener('click', ()=>{
    if(x.checked){
      y.type = "text"
    }else{
      y.type = "password"
    }
  })
  
}

let a = document.getElementById('show')
let b = document.getElementById('cshow')
let aa = document.querySelector("input[name='password']")
let bb = document.querySelector("input[name='cpassword']")

show(a, aa)
show(b, bb)

