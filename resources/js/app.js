import Prism from 'prismjs';
import Alpine from 'alpinejs';


// Plugins
import 'prismjs/plugins/toolbar/prism-toolbar';
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard';
import 'prismjs/plugins/show-language/prism-show-language';

import 'prismjs/plugins/toolbar/prism-toolbar.css';

import 'prismjs/plugins/command-line/prism-command-line';
import 'prismjs/plugins/command-line/prism-command-line.css';

import 'prismjs/plugins/line-numbers/prism-line-numbers';
import 'prismjs/plugins/line-numbers/prism-line-numbers.css';

import 'prismjs/plugins/match-braces/prism-match-braces';
import 'prismjs/plugins/match-braces/prism-match-braces.css';

// Theme
import 'prismjs/themes/prism-tomorrow.css';

// Dependencies first
import 'prismjs/components/prism-markup-templating';

// Languages
import 'prismjs/components/prism-bash';
import 'prismjs/components/prism-markup';
import 'prismjs/components/prism-php';
import 'prismjs/components/prism-javascript';
import 'prismjs/components/prism-json';
import 'prismjs/components/prism-yaml';
import 'prismjs/components/prism-css';
import 'prismjs/components/prism-sql';


const mobileMenuButton = document.querySelector('#mobile-menu-button');
const mobileMenu = document.querySelector('#mobile-menu');

mobileMenuButton?.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});

window.Alpine = Alpine;

Alpine.start();

Prism.highlightAll();