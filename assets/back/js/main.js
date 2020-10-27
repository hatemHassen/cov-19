var $ = require('jquery');
import '../vendor/bootstrap/js/bootstrap.bundle.min';
import '../vendor/jquery-easing/jquery.easing.min';
import './admin.min.js';
require('bootstrap-sass');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});