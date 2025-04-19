import './bootstrap';

import Alpine from 'alpinejs';

import AOS from 'aos';
import 'aos/dist/aos.css';
import Swal from 'sweetalert2';

AOS.init();

window.Alpine = Alpine;

Alpine.start();


window.Swal = Swal;