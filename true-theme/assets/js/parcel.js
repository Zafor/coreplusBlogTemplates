// Support async/await
import 'regenerator-runtime/runtime'

import TrialForm from './vue/TrialForm.vue';
import Vue from 'vue';

// Vue declarations
// Our entry point for Vue app
if (document.getElementById('vueTrialForm')) {
    new Vue({ render: createElement => createElement(TrialForm) }).$mount('#vueTrialForm');
}

// Enable Hot-module-replacement
if (module && module.hot) {
    module.hot.accept()
}
