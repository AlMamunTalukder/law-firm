import jQuery from "jquery";
window.$ = jQuery;
window.jQuery = jQuery;

import  * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import {popper} from "@popperjs/core";
window.popper = popper;

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

const cur_formatter = new Intl.NumberFormat('en-IN', {
    style: 'currency',
    currency: 'BDT',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
});

window.cur_formatter = cur_formatter;

if ( $( "#add_modal" ).length ) {
    const addModal = new bootstrap.Modal('#add_modal', {keyboard: false});
    window.addModal = addModal;
}

if ( $( "#ajax_content_modal" ).length ) {
    const ajax_content_modal = new bootstrap.Modal('#ajax_content_modal', {keyboard: false});
    window.ajax_content_modal = ajax_content_modal;
}

if ( $( "#edit_modal" ).length ) {
    const editModal = new bootstrap.Modal('#edit_modal', {keyboard: false});
    window.editModal = editModal;
}
$( document ).ajaxStart(function() {
    $( "#loading" ).show();
 });

 $( document ).ajaxComplete(function() {
    $( "#loading" ).hide();
 });

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
