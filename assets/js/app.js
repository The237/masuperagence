import '../scss/app.scss';
import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.css';
import 'popper.js';
import 'bootstrap';


var modal = document.getElementById('id01');

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
    }
}

$('select').select2();


$('.custom-file-input').on('change',function (e) {
    var inputFile = e.currentTarget;
    $(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
 });
 