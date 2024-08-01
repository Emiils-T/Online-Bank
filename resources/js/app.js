import './bootstrap';

import Alpine from 'alpinejs';
import $ from 'jquery';
import 'select2/dist/css/select2.min.css';
import 'select2/dist/js/select2.min.js';

$(document).ready(function() {
    $('#currency').select2({
        placeholder: "Choose Currency",
        allowClear: true,
        width: '100%'
    });
});

window.Alpine = Alpine;

Alpine.start();
