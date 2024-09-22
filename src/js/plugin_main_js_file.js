import Vue from './elements';
import Router from 'vue-router';
Vue.use(Router);

import { applyFilters, addFilter, addAction, doAction } from '@wordpress/hooks';

export default class libraryManagement {
    constructor() {
        this.applyFilters = applyFilters;
        this.addFilter = addFilter;
        this.addAction = addAction;
        this.doAction = doAction;
        this.Vue = Vue;
        this.Router = Router;
    }

    $publicAssets(path){
        return (window.libraryManagementAdmin.assets_url + path);
    }

    $get(options) {
        return window.jQuery.get(window.libraryManagementAdmin.ajaxurl, options);
    }

    $adminGet(options) {
        options.action = 'library-management_admin_ajax';
        return window.jQuery.get(window.libraryManagementAdmin.ajaxurl, options);
    }

    $post(options) {
        return window.jQuery.post(window.libraryManagementAdmin.ajaxurl, options);
    }

    $adminPost(options) {
        options.action = 'library-management_admin_ajax';
        return window.jQuery.post(window.libraryManagementAdmin.ajaxurl, options);
    }

    $getJSON(options) {
        return window.jQuery.getJSON(window.libraryManagementAdmin.ajaxurl, options);
    }
}
