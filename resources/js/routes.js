import WikiPagesIndex from './components/wikipages/WikiPagesIndex.vue';
import WikiPagesCreate from './components/wikipages/WikiPagesCreate.vue';
import WikiPagesEdit from './components/wikipages/WikiPagesEdit.vue';

import UsersIndex from './components/users/UsersIndex.vue';
import UsersCreate from './components/users/UsersCreate.vue';
import UsersEdit from './components/users/UsersEdit.vue';

export const routes = [
    {
        name: 'wikipages_index',
        path: '/admin/wikipages',
        component: WikiPagesIndex
    },
    {
        name: 'wikipages_create',
        path: '/admin/wikipages/create',
        component: WikiPagesCreate
    },
    {
        name: 'wikipages_edit',
        path: '/admin/wikipages/edit/:id',
        component: WikiPagesEdit
    },
    {
        name: 'users_index',
        path: '/admin/users',
        component: UsersIndex
    },
    {
        name: 'users_create',
        path: '/admin/users/create',
        component: UsersCreate
    },
    {
        name: 'users_edit',
        path: '/admin/users/edit/:id',
        component: UsersEdit
    }
];
