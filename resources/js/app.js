//import './bootstrap';
import axios from 'axios';

// Hacer que axios esté disponible globalmente
window.axios = axios;

// Configurar los encabezados por defecto para Laravel
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

