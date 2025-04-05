
// document.addEventListener('DOMContentLoaded', function() {
//     const toastElement = document.querySelector('.toast');
//     if (toastElement) {
//         setTimeout(() => {
//             const toast = new bootstrap.Toast(toastElement);
//             toast.hide();
//         }, 3000);
//     }
// });

document.addEventListener('DOMContentLoaded', function() {
    const actions = document.querySelectorAll('.btn-outline-info');
    actions.forEach(function(action) {
        action.addEventListener('mouseover', function() {
            this.style.backgroundColor = '#17a2b8';
            this.style.color = '#fff';
        });
        action.addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
            this.style.color = '#17a2b8';
        });
    });
});
