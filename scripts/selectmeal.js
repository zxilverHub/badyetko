const breakfast = [
    {
        title: "No breakfast",
        value: 0,
        id: "no-breakfast"
    },

    {
        title: "Veggies",
        value: 30,
        id: "veggies"
    },

    {
        title: "Single meat",
        value: 40,
        id: "single-meat"
    },

    {
        title: "Budget meal",
        value: 50,
        id: "budget-meal"
    },

    {
        title: "2 meat combo",
        value: 60,
        id: "meat-combo"
    }
]

let breakfastContent = "";

breakfast.forEach(i => {
    breakfastContent +=
    `
    <label for=${i.id+'breakfast'} class='optionbreakfast'>
        <input type='radio' name='breakfast-meal' value='${i.value}' id=${i.id+'breakfast'} class='option breakfasts'>
        <div class='radio-content'>
            <span>${i.title}</span>
            <span>P ${i.value}</span>
        </div>
    </label>
    `;

})

document.getElementById('breakfast-meal').innerHTML = breakfastContent;



// ----------------------------------------------------

const lunch = [
    {
        title: "No lunch",
        value: 0,
        id: "no-lunch"
    },

    {
        title: "Veggies",
        value: 30,
        id: "veggies"
    },

    {
        title: "Single meat",
        value: 40,
        id: "single-meat"
    },

    {
        title: "Budget meal",
        value: 50,
        id: "budget-meal"
    },

    {
        title: "2 meat combo",
        value: 60,
        id: "meat-combo"
    }
]

let lunchContent = "";

lunch.forEach(i => {
    lunchContent +=
    `
    <label for=${i.id+'lunch'} class='optionlunch'>
        <input type='radio' name='lunch-meal' value='${i.value}' id=${i.id+'lunch'} class='option lunchs'>
        <div class='radio-content'>
            <span>${i.title}</span>
            <span>P ${i.value}</span>
        </div>
    </label>
    `;

})

document.getElementById('lunch-meal').innerHTML = lunchContent;

//---------------------------------------------


const dinner = [
    {
        title: "No dinner",
        value: 0,
        id: "no-dinner"
    },

    {
        title: "Veggies",
        value: 30,
        id: "veggies"
    },

    {
        title: "Single meat",
        value: 40,
        id: "single-meat"
    },

    {
        title: "Budget meal",
        value: 50,
        id: "budget-meal"
    },

    {
        title: "2 meat combo",
        value: 60,
        id: "meat-combo"
    }
]

let dinnerContent = "";

dinner.forEach(i => {
    dinnerContent +=
    `
    <label for=${i.id+'dinner'} class='optiondinner'>
        <input type='radio' name='dinner-meal' value='${i.value}' id=${i.id+'dinner'} class='option'>
        <div class='radio-content'>
            <span>${i.title}</span>
            <span>P ${i.value}</span>
        </div>
    </label>
    `;

})

document.getElementById('dinner-meal').innerHTML = dinnerContent;
document.querySelector('#no-dinnerdinner').checked = true;
document.querySelector('#no-lunchlunch').checked = true;
document.querySelector('#no-breakfastbreakfast').checked = true;

document.querySelectorAll('label.optiondinner input[type="radio"]').forEach((i) => {
    i.addEventListener('click', ()=> {
        document.querySelectorAll('label.optiondinner').forEach((i) => {
            if(i.querySelector('input[type="radio"]').checked) {
                i.setAttribute('style', 'background-color: var(--light);')
            } else {
                i.setAttribute('style', 'background-color: none;')
            }
        })
    })
})

document.querySelectorAll('label.optionlunch input[type="radio"]').forEach((i) => {
    i.addEventListener('click', ()=> {
        document.querySelectorAll('label.optionlunch').forEach((i) => {
            if(i.querySelector('input[type="radio"]').checked) {
                i.setAttribute('style', 'background-color: var(--light);')
            } else {
                i.setAttribute('style', 'background-color: none;')
            }
        })
    })
})

document.querySelectorAll('label.optionbreakfast input[type="radio"]').forEach((i) => {
    i.addEventListener('click', ()=> {
        document.querySelectorAll('label.optionbreakfast').forEach((i) => {
            if(i.querySelector('input[type="radio"]').checked) {
                i.setAttribute('style', 'background-color: var(--light);')
            } else {
                i.setAttribute('style', 'background-color: none;')
            }
        })
    })
})

document.querySelectorAll('label.optiondinner').forEach((i) => {
    if(i.querySelector('input[type="radio"]').checked) {
        i.setAttribute('style', 'background-color: var(--light);')
    } else {
        i.setAttribute('style', 'background-color: none;')
    }
})

document.querySelectorAll('label.optionlunch').forEach((i) => {
    if(i.querySelector('input[type="radio"]').checked) {
        i.setAttribute('style', 'background-color: var(--light);')
    } else {
        i.setAttribute('style', 'background-color: none;')
    }
})

document.querySelectorAll('label.optionbreakfast').forEach((i) => {
    if(i.querySelector('input[type="radio"]').checked) {
        i.setAttribute('style', 'background-color: var(--light);')
    } else {
        i.setAttribute('style', 'background-color: none;')
    }
})