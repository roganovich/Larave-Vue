import WikiPagesIndex from './components/wikipages/WikiPagesIndex.vue';
import WikiPagesCreate from './components/wikipages/WikiPagesCreate.vue';
import WikiPagesEdit from './components/wikipages/WikiPagesEdit.vue';


export const routes = [
    {
        name: 'index',
        path: '/',
        component: WikiPagesIndex
    },
    {
        name: 'create',
        path: '/create',
        component: WikiPagesCreate
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: WikiPagesEdit
    }
];
