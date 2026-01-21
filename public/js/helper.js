/**
 * SweetAlert Helper
 * File: public/js/helper.js
 */

/**
 * Alert sukses
 */
function realoadBrowser() {
    window.location.reload();
}

function alertSuccess(title, message) {
    Swal.fire({
        icon: 'success',
        title: title,
        text: message,
        confirmButtonText: 'OK'
    });
}

/**
 * Alert error
 */
function alertError(title, message) {
    Swal.fire({
        icon: 'error',
        title: title,
        text: message,
        confirmButtonText: 'OK'
    });
}

/**
 * Alert warning
 */
function alertWarning(title, message) {
    Swal.fire({
        icon: 'warning',
        title: title,
        text: message,
        confirmButtonText: 'OK'
    });
}

/**
 * Alert konfirmasi (delete, logout, dll)
 */
function alertConfirm(title, callback) {
    Swal.fire({
        title: title,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            if (typeof callback === 'function') {
                callback();
            } else {
                console.error('Callback bukan function');
            }
        }
    });
}

