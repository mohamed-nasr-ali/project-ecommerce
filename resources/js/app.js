require('./routes');
//Import Vue Filter
require('./filters');

//Import progressbar
require('./progressbar');

//Setup custom events
require('./customEvents');



//Import Sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast

