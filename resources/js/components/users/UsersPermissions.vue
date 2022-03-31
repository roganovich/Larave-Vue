<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link :to="{name: 'users_index'}" class="btn btn-dark btn-sm" title="Назад">Назад</router-link>
        </div>
    </div>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>
    <div v-else class=" mt-1">
        <div class="card-title mt-1">Возможности пользователя {{ model.name }} </div>
        <div class="p-1">
            <h4>Права {{ model.role.title }}</h4>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="row mt-2"
                         v-for="(controllers, module) in permissions">
                        <div class="col-xs-12 form-group">
                            <span class="link-danger">{{ module.toUpperCase() }}</span>
                            <div class="mt-2 px-3"
                                 v-for="(perms, page) in controllers">
                                {{ page.toUpperCase() }}
                                <ol class="px-3" v-for="(route, id) in perms">
                                    <span v-if="checkInArray(route.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                          <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                        </svg>
                                    </span>
                                    <span v-else>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-square" viewBox="0 0 16 16">
                                          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        </svg>
                                    </span>
                                    <label class="form-check-label  px-1">
                                        {{ (route.title) ? (route.title) : (route.route_name) }}
                                    </label>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VuePreloader from '../preloader.vue';

export default {
    mounted() {
        this.getData(),
        this.getPermissionsList()
    },
    components: {
        VuePreloader
    },
    data: function () {
        return {
            preloader: true,
            errors: {},
            model_id: null,
            permissions: {},
            model: {
                id: '',
                title: '',
                role: '',
                role_id: '',
                permissions_ids: '',
            }
        }
    },
    methods: {
        getData: function () {
            let app = this;
            app.preloader = true;
            let id = app.$route.params.id;
            app.model_id = id;
            axios.get('/api/v1/users/' + id + '/get/')
                .then(function (resp) {
                    app.model = resp.data;
                    app.preloader = false;
                })
                .catch(function () {
                    alert("Не смог получить данные")
                });
        },
        getPermissionsList: function () {
            var app = this;
            app.preloader = true;
            axios.get('/api/v1/permissions/list')
                .then(function (resp) {
                    app.permissions = resp.data;
                    app.preloader = false;
                })
                .catch(function (resp) {
                    alert("Не смог получить данные");
                });
        },
        checkInArray(needle) {
            var permissions = this.model.permissions_ids;
            return permissions.includes(needle);
        }
    }
}
</script>
