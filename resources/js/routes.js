import WikiPagesIndex from './components/wikipages/WikiPagesIndex.vue';
import WikiPagesCreate from './components/wikipages/WikiPagesCreate.vue';
import WikiPagesEdit from './components/wikipages/WikiPagesEdit.vue';

import UsersIndex from './components/users/UsersIndex.vue';
import UsersCreate from './components/users/UsersCreate.vue';
import UsersEdit from './components/users/UsersEdit.vue';
import UsersPermissions from './components/users/UsersPermissions.vue';

import UsersRolesIndex from './components/usersroles/UsersRolesIndex.vue';
import UsersRolesCreate from './components/usersroles/UsersRolesCreate.vue';
import UsersRolesEdit from './components/usersroles/UsersRolesEdit.vue';
import UsersRolesPermissions from './components/usersroles/UsersRolesPermissions.vue';

import PermissionsIndex from './components/permissions/PermissionsIndex.vue';
import PermissionsEdit from './components/permissions/PermissionsEdit.vue';

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
    },
    {
        name: 'users_permission',
        path: '/admin/users/permission/:id',
        component: UsersPermissions
    },
    {
        name: 'usersroles_index',
        path: '/admin/usersroles',
        component: UsersRolesIndex
    },
    {
        name: 'usersroles_create',
        path: '/admin/usersroles/create',
        component: UsersRolesCreate
    },
    {
        name: 'usersroles_edit',
        path: '/admin/usersroles/edit/:id',
        component: UsersRolesEdit
    },
    {
        name: 'usersroles_permission',
        path: '/admin/usersroles/permission/:id',
        component: UsersRolesPermissions
    },
    {
        name: 'permissions_index',
        path: '/admin/permissions',
        component: PermissionsIndex
    },
    {
        name: 'permissions_edit',
        path: '/admin/permissions/edit/:id',
        component: PermissionsEdit
    }
];
