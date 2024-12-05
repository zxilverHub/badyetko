
document.querySelector('button.right').addEventListener('click', () => {
    const contents = document.querySelectorAll('.meal-plan-type').length;

    const currentScroll = document.querySelector('.meal-plan-cards').scrollLeft;
    const divWidth = document.querySelector('.meal-plan-type').clientWidth;

    if(currentScroll < contents*(divWidth-1)) {
        document.querySelector('.meal-plan-cards').scrollLeft = currentScroll + divWidth;
    }
})

document.querySelector('button.left').addEventListener('click', () => {
    const currentScroll = document.querySelector('.meal-plan-cards').scrollLeft;
    const divWidth = document.querySelector('.meal-plan-type').clientWidth;

    document.querySelector('.meal-plan-cards').scrollLeft = currentScroll - divWidth;
})