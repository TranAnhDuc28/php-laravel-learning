$(document).ready(function() {
    $('#updatePasswordForm').on('submit', function() {
        $(this).find('button[type="submit"]').prop('disabled', true);
        return true;
    });
});
// function formatDate(input) {
//     alert(input);
//     const date = new Date(input.value);
//     const year = date.getFullYear();
//     const month = String(date.getMonth() + 1).padStart(2, '0');
//     const day = String(date.getDate()).padStart(2, '0');
//     input.value = `${year}/${month}/${day}`;
// }
//
// // Format initial values
// document.addEventListener('DOMContentLoaded', function() {
//     formatDate(document.getElementById('start_date'));
//     formatDate(document.getElementById('end_date'));
// });
