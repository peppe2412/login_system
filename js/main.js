let alertSuccess = document.querySelector('#alert-success');

if (alertSuccess) {
    setTimeout(() => {
        alertSuccess.style.transition = 'opacity 1s ease'
        alertSuccess.style.opacity = '0'
        setTimeout(() => alertSuccess.remove(), 1000)
    }, 4000);
}


