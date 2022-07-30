import Nopermission from './components/Nopermission.vue';
/** Статьи */
import WikiPagesIndex from './components/wikipages/WikiPagesIndex.vue'
import WikiPagesCreate from './components/wikipages/WikiPagesCreate.vue';
import WikiPagesEdit from './components/wikipages/WikiPagesEdit.vue';
/** Пользователи */
import UsersIndex from './components/users/UsersIndex.vue';
import UsersCreate from './components/users/UsersCreate.vue';
import UsersEdit from './components/users/UsersEdit.vue';
import UsersPermissions from './components/users/UsersPermissions.vue';
/** Роли пользователей */
import UsersRolesIndex from './components/usersroles/UsersRolesIndex.vue';
import UsersRolesCreate from './components/usersroles/UsersRolesCreate.vue';
import UsersRolesEdit from './components/usersroles/UsersRolesEdit.vue';
import UsersRolesPermissions from './components/usersroles/UsersRolesPermissions.vue';
/** Парава доступа */
import PermissionsIndex from './components/permissions/PermissionsIndex.vue';
import PermissionsEdit from './components/permissions/PermissionsEdit.vue';
/** Точки на карте */
import PointsIndex from './components/points/PointsIndex.vue';
import PointsCreate from './components/points/PointsCreate.vue';
import PointsEdit from './components/points/PointsEdit.vue';
/** Товары */
import ProductsIndex from './components/products/ProductsIndex.vue';
import ProductsCreate from './components/products/ProductsCreate.vue';
import ProductsEdit from './components/products/ProductsEdit.vue';
/** Бренды товаров */
import ProductsBrandIndex from './components/products_brands/ProductsBrandIndex.vue';
import ProductsBrandCreate from './components/products_brands/ProductsBrandCreate.vue';
import ProductsBrandEdit from './components/products_brands/ProductsBrandEdit.vue';
/** Категории товаров */
import ProductsCategoryIndex from './components/products_categories/ProductsCategoryIndex.vue';
import ProductsCategoryCreate from './components/products_categories/ProductsCategoryCreate.vue';
import ProductsCategoryEdit from './components/products_categories/ProductsCategoryEdit.vue';
/** Заказы */
import OrdersIndex from './components/orders/OrdersIndex.vue';
import OrdersEdit from './components/orders/OrdersEdit.vue';

function requireAuth(to, from, next) {
    var auth = window.Laravel.user;
    var isLoggedin = window.Laravel.isLoggedin;
    if (isLoggedin) {
        if (auth.permissions_allow_routes.includes(to.name) || auth.role.is_root) {
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
    },
    {
        name: 'points_index',
        path: '/admin/points',
        component: PointsIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'points_create',
        path: '/admin/points/create',
        component: PointsCreate,
        beforeEnter: requireAuth,
    },
    {
        name: 'points_edit',
        path: '/admin/points/edit/:id',
        component: PointsEdit,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_index',
        path: '/admin/products',
        component: ProductsIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_create',
        path: '/admin/products/create',
        component: ProductsCreate,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_edit',
        path: '/admin/products/edit/:id',
        component: ProductsEdit,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_brand_index',
        path: '/admin/products_brand',
        component: ProductsBrandIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_brand_create',
        path: '/admin/products_brand/create',
        component: ProductsBrandCreate,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_brand_edit',
        path: '/admin/products_brand/edit/:id',
        component: ProductsBrandEdit,
        beforeEnter: requireAuth,
    },

    {
        name: 'products_category_index',
        path: '/admin/products_category',
        component: ProductsCategoryIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_category_create',
        path: '/admin/products_category/create',
        component: ProductsCategoryCreate,
        beforeEnter: requireAuth,
    },
    {
        name: 'products_category_edit',
        path: '/admin/products_category/edit/:id',
        component: ProductsCategoryEdit,
        beforeEnter: requireAuth,
    },
    /** Orders */
    {
        name: 'orders_index',
        path: '/admin/orders',
        component: OrdersIndex,
        beforeEnter: requireAuth,
    },
    {
        name: 'orders_edit',
        path: '/admin/orders/edit/:id',
        component: OrdersEdit,
        beforeEnter: requireAuth,
    },
];
