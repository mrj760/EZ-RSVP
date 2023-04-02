const fullscreenDivs = document.querySelectorAll('.fullscreenDiv')
let currentDivIdx = 0;
lastY = 0;
let isAnimating = false;

window.addEventListener('scroll', () => {

    if (fullscreenDivs.length <= 1 || isAnimating) return;

    y = window.scrollY.toFixed(2);
    scrolledDown = lastY < y;
    lastY = y;

    if (scrolledDown) {
        if (currentDivIdx === fullscreenDivs.length - 1)
            return;
        fullscreenDivs[++currentDivIdx].scrollIntoView({ behavior: 'auto' , block:'start', inline:'nearest', duration:500});
        isAnimating = true;
    } else {
        if (currentDivIdx === 0)
            return;
        fullscreenDivs[--currentDivIdx].scrollIntoView({ behavior: 'auto' , block:'start', inline:'nearest', duration:500});
        isAnimating = true;
    }
    setTimeout(() => {
        isAnimating = false;
    }, 100);
})
