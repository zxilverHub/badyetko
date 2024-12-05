document.querySelector('button.add-expenses').addEventListener('click', ()=> {
    document.querySelector("#add-spend-modal").setAttribute('style', 'display: flex;');
    // console.log(document.querySelector("#add-spend-modal"))
})

document.getElementById('close-modal').addEventListener('click', () => {
    document.querySelector("#add-spend-modal").setAttribute('style', 'display: none;');
})