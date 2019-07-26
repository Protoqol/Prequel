import highlight from 'highlight.js';
import 'highlight.js/styles/github.css';
import sql       from 'highlight.js/lib/languages/sql';

highlight.registerLanguage('sql', sql);

Vue.directive('highlightjs', {
    deep            : true,
    bind            : function(el, binding) {
        let targets = el.querySelectorAll('code');
        targets.forEach((target) => {
            if (binding.value) {
                target.textContent = binding.value;
            }
            highlight.highlightBlock(target);
        });
    },
    componentUpdated: function(el, binding) {
        let targets = el.querySelectorAll('code');
        targets.forEach((target) => {
            if (binding.value) {
                target.textContent = binding.value;
                highlight.highlightBlock(target);
            }
        });
    },
});
