import './bootstrap';
import 'tinymce/tinymce';
import 'tinymce-link-plugin';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/content/default/content.min.css';
import 'tinymce/skins/content/default/content.css';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import { Datepicker, Input, Modal, Ripple, initTE } from "tw-elements";
import "/node_modules/select2/dist/css/select2.css";

initTE({ Modal, Ripple,Datepicker, Input });

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

window.addEventListener('DOMContentLoaded', () => {
    tinymce.init({
        selector: '.wysiwyg',
        skin: false,
        plugins: 'link',
        content_css: false,
        content_style: "body { margin: 0; }",
        promotion: false
    });
});
