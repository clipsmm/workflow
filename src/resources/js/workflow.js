import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
import 'sweetalert2/src/sweetalert2.scss'

Vue.component('workflow-form', require('./components/WorkflowForm').default);
Vue.component('stage-form', require('./components/StageForm').default);
Vue.component('action-form', require('./components/ActionForm').default);

window.ClipsmmWorkflow = new Vue();
