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
        <div class="card-title mt-1">Создание</div>
        <div class="p-1">
            <form v-on:submit.prevent="saveForm()">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Роль</label>
                        <select v-model="model.role_id"
                                class="form-control"
                                v-bind:class="{ 'is-invalid': errors.role_id }"
                                id="UsersRoleId">
                            <option v-for="(item, id) in roles" :value="item.id">
                                {{ item.title }}
                            </option>
                        </select>
                        <div class="invalid-feedback" v-if="errors.role_id">
                            {{ errors.role_id }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Имя</label>
                        <input type="text"
                               v-model="model.name"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.name }">
                        <div class="invalid-feedback" v-if="errors.name">
                            {{ errors.name }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Email</label>
                        <input type="text"
                               v-model="model.email"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.email }">
                        <div class="invalid-feedback" v-if="errors.email">
                            {{ errors.email }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Пароль</label>
                        <input type="password"
                               v-model="model.password"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.password }">
                        <div class="invalid-feedback" v-if="errors.password">
                            {{ errors.password }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Повторите пароль</label>
                        <input type="password"
                               v-model="model.password2"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.password2 }">
                        <div class="invalid-feedback" v-if="errors.password2">
                            {{ errors.password2 }}
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
    components: {
        VuePreloader,
    },
    mounted() {
        this.getRolesList()
    },
    data: function () {
        return {
            preloader: false,
            errors: {},
            model_id: null,
            roles: {},
            model: {
                id: '',
                name: '',
                password: '',
                password2: '',
                email: '',
            }
        }
    },
    methods: {
        getRolesList: function () {
            var app = this;
            app.preloader = true;
            axios.get('/api/v1/usersroles/list')
                .then(function (resp) {
                    app.roles = resp.data;
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
            axios.post('/api/v1/users/store', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'users_index'});
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
