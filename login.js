const login_form = document.getElementById('login_form');
const tick1 = document.getElementById('tick1');
const tick2 = document.getElementById('tick2');

login_form.addEventListener('submit',()=>{    
    tick1.style.display = "flex";
    tick2.style.display = "flex";
    tick1.textContent = "✔";
    tick2.textContent = "✔";
})