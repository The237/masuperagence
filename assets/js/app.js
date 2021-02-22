import '../scss/app.scss';
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';

var modal = document.getElementById('id01');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
    }
}