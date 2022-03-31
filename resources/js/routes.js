import Nopermission from './components/Nopermission.vue';

import WikiPagesIndex from './components/wikipages/WikiPagesIndex.vue'
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

function requireAuth(to, from, next) {
    var auth = window.Laravel.user;
    var isLoggedin = window.Laravel.isLoggedin;

    if (isLoggedin) {
        if (auth.permissions_allow_routes.includes(to.name)) {
            next();
        } else {
            next({name: 'nopermission'});
        }
    } else {
        next({name: 'nopermission'});
    }

};

export const routes = [
    {
        name: 'nopermission',
        path: '/admin/nopermission',
        component: Nopermission,
    },
    {
        name: 'wikipages_index',
        path: '/admin/wikipages',
        component: WikiPagesIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'wikipages_create',
        path: '/admin/wikipages/create',
        component: WikiPagesCreate,
        beforeEnter: requireAuth,
    },
    {
        name: 'wikipages_edit',
        path: '/admin/wikipages/edit/:id',
        component: WikiPagesEdit,
        beforeEnter: requireAuth,
    },
    {
        name: 'users_index',
        path: '/admin/users',
        component: UsersIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'users_create',
        path: '/admin/users/create',
        component: UsersCreate,
        beforeEnter: requireAuth,
    },
    {
        name: 'users_edit',
        path: '/admin/users/edit/:id',
        component: UsersEdit,
        beforeEnter: requireAuth,
    },
    {
        name: 'users_permission',
        path: '/admin/users/permission/:id',
        component: UsersPermissions,
        beforeEnter: requireAuth,
    },
    {
        name: 'usersroles_index',
        path: '/admin/usersroles',
        component: UsersRolesIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'usersroles_create',
        path: '/admin/usersroles/create',
        component: UsersRolesCreate,
        beforeEnter: requireAuth,
    },
    {
        name: 'usersroles_edit',
        path: '/admin/usersroles/edit/:id',
        component: UsersRolesEdit,
        beforeEnter: requireAuth,
    },
    {
        name: 'usersroles_permission',
        path: '/admin/usersroles/permission/:id',
        component: UsersRolesPermissions,
        beforeEnter: requireAuth,
    },
    {
        name: 'permissions_index',
        path: '/admin/permissions',
        component: PermissionsIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'permissions_edit',
        path: '/admin/permissions/edit/:id',
        component: PermissionsEdit,
        beforeEnter: requireAuth,
    }
];
