import WikiPagesIndex from './components/wikipages/WikiPagesIndex.vue';
import WikiPagesCreate from './components/wikipages/WikiPagesCreate.vue';
import WikiPagesEdit from './components/wikipages/WikiPagesEdit.vue';


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
    }
];
