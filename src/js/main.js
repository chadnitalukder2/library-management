window.libraryManagementBus = new window.libraryManagement.Vue();

window.libraryManagement.Vue.mixin({
    methods: {
        applyFilters: window.libraryManagement.applyFilters,
        addFilter: window.libraryManagement.addFilter,
        addAction: window.libraryManagement.addFilter,
        doAction: window.libraryManagement.doAction,
        $get: window.libraryManagement.$get,
        $adminGet: window.libraryManagement.$adminGet,
        $adminPost: window.libraryManagement.$adminPost,
        $post: window.libraryManagement.$post,
        $publicAssets: window.libraryManagement.$publicAssets
    }
});

import {routes} from './routes';

const router = new window.libraryManagement.Router({
    routes: window.libraryManagement.applyFilters('libraryManagement_global_vue_routes', routes),
    linkActiveClass: 'active'
});

import App from './AdminApp';

new window.libraryManagement.Vue({
    el: '#library-management_app',
    render: h => h(App),
    router: router
});

