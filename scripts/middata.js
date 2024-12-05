// const reminderBtn = document.querySelector('#reminder-btn');
// const savingBtn = document.querySelector('#saving-btn');

// const reminderSection = document.querySelector('#reminder-section');
// const savingSection = document.querySelector('#saving-section');

document.querySelector('#reminder-btn').addEventListener('click', () => {
    activeBtn()
    // reminderSection.setAttribute('style', 'display: flex');
    // savingSection.setAttribute('style', 'display: none');
})

document.querySelector('#saving-btn').addEventListener('click', () => {
    activeBtn()
    // reminderSection.setAttribute('style', 'display: none');
    // savingSection.setAttribute('style', 'display: flex');
})

function activeBtn() {
    if(document.querySelector('#reminder-btn').classList.contains('active')) {
        document.querySelector('#reminder-btn').classList.remove('active')
    } else {
        document.querySelector('#reminder-btn').classList.add('active')
    }

    if(document.querySelector('#saving-btn').classList.contains('active')) {
        document.querySelector('#saving-btn').classList.remove('active')   
    } else {
        document.querySelector('#saving-btn').classList.add('active') 
    }
}
