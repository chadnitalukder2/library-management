import Dashboard from '../admin/Components/Dashboard.vue';
import Settings from '../admin/Components/Settings';
import Supports from '../admin/Components/Supports';
import Books from '../admin/page/books/AllBooks.vue';

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
    {
        path: '/supports',
        name: 'supports',
        component: Supports
    }
];
