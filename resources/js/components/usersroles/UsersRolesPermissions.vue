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
        <div class="card-title mt-1">Редактируем {{ model.title }}</div>
        <div class="p-1">
            <form v-on:submit.prevent="saveForm()">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <div class="row mt-2"
                             v-for="(controllers, module) in permissions">
                            <div class="col-xs-12 form-group">
                                <span class="link-danger">{{ module.toUpperCase() }}</span>
                                <div class="mt-2 px-3"
                                     v-for="(perms, page) in controllers">
                                    {{ page.toUpperCase() }}
                                    <div class="form-check px-5"
                                         v-for="(route, id) in perms">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               v-model="model.permissions_ids"
                                               :id="'UsersRolesPermission' + route.id"
                                               :value="route.id"
                                                >
                                        <label class="form-check-label" :for="'UsersRolesPermission' + route.id">
                                            {{ (route.title) ? (route.title) : (route.route_name) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xs-12 form-group">
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </div>
            </form>
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
            permissions: {},
            model_id: null,
            model: {
                id: '',
                title: '',
                permission: {},
            }
        }
    },
    methods: {
        getData: function () {
            let app = this;
            app.preloader = true;
            let id = app.$route.params.id;
            app.model_id = id;
            axios.get('/api/v1/usersroles/' + id + '/get/')
                .then(function (resp) {
                    app.model = resp.data;
                    console.log(app.model);
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
        saveForm(e) {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            console.log(newModel);
            axios.post('/api/v1/permissions/' + app.model_id + '/saveroles', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'usersroles_index'});
                })
                .catch(function (resp) {
                    var errors = resp.response.data.errors;
                    for (var row in errors) {
                        app.errors[row] = errors[row][0];
                    }
                });
            app.preloader = false;
        },
    }
}
</script>
