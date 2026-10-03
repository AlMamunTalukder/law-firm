import './bootstrap';

import 'admin-lte';

import 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
$('.dataTables_class').DataTable({
    pageLength: 25,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
});

import 'overlayscrollbars/overlayscrollbars.css';
import { OverlayScrollbars } from 'overlayscrollbars';
window.OverlayScrollbars = OverlayScrollbars;
OverlayScrollbars(document.querySelector('.sidebar-wrapper'), {
    overflow: {
      x: 'hidden',
    },
    scrollbars: {
          theme: "os-theme-dark",
          autoHide: "leave",
          clickScroll: true,
      },
});

import '@fortawesome/fontawesome-free/js/all.js';

import select2 from 'select2';
select2();
$(".select2").select2({

    allowClear: false
});

import swal from 'sweetalert2';
window.Swal = swal;

import  flatpickr from "flatpickr";
window.flatpickr = flatpickr;
import monthSelectPlugin from "flatpickr/dist/plugins/monthSelect"
flatpickr(".date_picker",{
    wrap: true,
    altInput: true,
    altFormat: "J M, Y",
    dateFormat: "Y-m-d",
});

flatpickr(".time_picker",{
    wrap: true,
    enableTime: true,
    noCalendar: true,
    altInput: true,
    altFormat: "h:i K",
    dateFormat: "H:i",
    minuteIncrement: 1,
});

flatpickr(".year_month_picker_range",{
    wrap: true,
    mode: "range",
    altInput: true,
    onClose: function(selectedDates, dateStr, instance) {
        let start_month = selectedDates[0].getMonth()+1;
        let end_month = selectedDates[1].getMonth()+1;

        let startRange = document.getElementsByClassName('startRange').length;
        let InRange = document.getElementsByClassName('inRange').length;
        let endrange =document.getElementsByClassName('endRange').length;
        let month_total = 0;
        if(start_month==end_month)
        {
            month_total =  startRange+ InRange ;
        }
        else
        {
            month_total =  startRange+ InRange +endrange;
        }

        $("#number_of_month").val(month_total);
      },
    plugins: [
        new monthSelectPlugin({
          shorthand: true,
          dateFormat: "Y-m",
          altFormat: "F Y",
        })
    ]
});

flatpickr(".year_month_picker",{
    wrap: true,
    altInput: true,
    plugins: [
        new monthSelectPlugin({
          shorthand: true,
          dateFormat: "Y-m",
          altFormat: "F Y",
        })
    ]
});

flatpickr(".range_picker",{
    wrap: true,
    mode: "range",
    altInput: true,
    altFormat: "j M, Y",
});

import 'jquery-validation';

import  '../../public/assets/js/apiscript.js';
import '../../public/assets/js/myscript.js';
import '../../public/assets/js/jasny_bootstrap.min.js';
