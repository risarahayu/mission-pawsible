import './bootstrap';

import Swal from 'sweetalert2';
window.Swal = Swal;

$(function() {
  $('.btn-empty').mouseenter(function() { $('.btn-auth').css('color', '#fff') })
  $('.btn-empty').mouseleave(function() { $('.btn-auth').css('color', '#BD1A8D') })
})
