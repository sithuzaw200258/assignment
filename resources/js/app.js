import './bootstrap';
import Swal from 'sweetalert2'
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.goBack = function(){
    window.history.go(-1);
    return false;
}

window.showToast = function(status) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: status
    });
}

window.deleteBox = function(table,link) {
    const Toast = Swal.fire({
        title: "Are you sure, you want to delete?",
        showCancelButton: true,
        confirmButtonText: "Confirm",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: link,
                type: 'DELETE',
                success: function(){
                    table.ajax.reload();
                }
            })
        } 
    });
}

document.getElementById("cancel").addEventListener("click",function(e){
    e.preventDefault();
    goBack();
})