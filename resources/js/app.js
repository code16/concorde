import Alpine from 'alpinejs';
import resize from '@alpinejs/resize';
import intersect from '@alpinejs/intersect';

Alpine.plugin(resize);
Alpine.plugin(intersect);

window.Hls = Hls;

document.addEventListener('DOMContentLoaded', () => Alpine.start());
