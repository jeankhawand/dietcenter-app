import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import '@mdi/font/css/materialdesignicons.css';
import '@fortawesome/fontawesome-free/css/all.css';

Vue.use(Vuetify);

const opts = {icons: {
        iconfont: 'mdi' || 'fa', // default - only for display purposes
    },};

export default new Vuetify(opts);
