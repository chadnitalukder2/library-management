import Dashboard from '../admin/page/dashboard_page/Dashboard.vue';
import Settings from '../admin/page/setting_page/Settings';
import Books from '../admin/page/book_page/AllBooks.vue';

export const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/books',
        name: 'books',
        component: Books
    },
    {
        path: '/settings',
        name: 'settings',
        component: Settings
    },
 
];
