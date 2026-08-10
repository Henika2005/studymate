function updateDateTime(){

    const now = new Date();

    const dateOptions = {
        weekday:'long',
        day:'2-digit',
        month:'long',
        year:'numeric'
    };

    document.getElementById("currentDate").innerHTML =
        now.toLocaleDateString('en-US', dateOptions);

    document.getElementById("currentTime").innerHTML =
        now.toLocaleTimeString('en-US');
}

updateDateTime();

setInterval(updateDateTime,1000);

// ================= SCROLL ANIMATION =================

const fadeElements = document.querySelectorAll('.fade-up');

const observer = new IntersectionObserver((entries) => {

    entries.forEach(entry => {

        if(entry.isIntersecting){
            entry.target.classList.add('show');
        }

    });

}, {
    threshold: 0.15
});

fadeElements.forEach(element => {
    observer.observe(element);
});


// ================= BACK TO TOP =================

const topBtn = document.getElementById('topBtn');

window.addEventListener('scroll', () => {

    if(window.scrollY > 300){
        topBtn.style.display = 'flex';
    }
    else{
        topBtn.style.display = 'none';
    }

});

topBtn.addEventListener('click', () => {

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

});

// ================= TOAST NOTIFICATION =================

function showToast(message){

    const toast = document.getElementById("toast");

    if(!toast) return;

    toast.textContent = message;

    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 2500);
}