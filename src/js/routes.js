import Dashboard from '../admin/page/dashboard_page/Dashboard.vue';
import Settings from '../admin/page/setting_page/Settings';
import Books from '../admin/page/book_page/Books.vue';
import AllBooks from '../admin/page/book_page/books/AllBooks.vue';
import AllCategory from '../admin/page/book_page/category/AllCategory.vue';
import AllMembers from '../admin/page/member_page/AllMembers.vue';

export const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/books',
        name: 'books',
        component: Books,
        children:[
            {
                path: '',
                name: 'all-books',
                component: AllBooks
            },
            {
                path: 'category',
                name: 'category',
                component: AllCategory
            },
        ]
        
    },
    {
        path: '/members',
        name: 'members',
        component: AllMembers
    },
    {
        path: '/settings',
        name: 'settings',
        component: Settings
    },
 
];
