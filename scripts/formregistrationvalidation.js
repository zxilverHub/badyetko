const errpass = document.querySelector('#password-error')
const erremail = document.querySelector('#email-error')
const errcpass = document.querySelector('#confirm-password-error')

document.querySelector('#email').addEventListener('keyup', (e)=> {
        const emailRegex = /^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,6}$/;
        erremail.style.display = emailRegex.test(e.target.value)? 'none' : 'block'
})

document.querySelector('#password').addEventListener('keyup', (e)=> {
    errpass.style.display = e.target.value.length > 7? 'none' : 'block'
})

document.querySelector('#confirm-password').addEventListener('keyup', (e)=> {
    const fPass = document.querySelector('#password').value;
    errcpass.style.display = e.target.value == fPass? 'none' : 'block'
})