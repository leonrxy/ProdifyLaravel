import axios from 'axios';
window.axios = axios;
import 'toastr/build/toastr.min.css';
import toastr from 'toastr';
window.toastr = toastr;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
