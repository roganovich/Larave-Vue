<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link :to="{name: 'permissions_index'}" class="btn btn-dark btn-sm" title="Назад">Назад</router-link>
        </div>
    </div>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>
    <div v-else class=" mt-1">
        <div class="card-title mt-1">Редактируем {{ model.route_name }}</div>
        <form v-on:submit.prevent="saveForm()">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-1">Модуль</li>
                <li class="list-group-item col-2">{{ model.module }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-1">
                    Описание
                </li>
                <li class="list-group-item col-2">
                    <div class="col-xs-12 form-group">
                        <input type="text"
                               v-model="model.title"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.title }">
                        <div class="invalid-feedback" v-if="errors.title">
                            {{ errors.title }}
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-1">Маршрут</li>
                <li class="list-group-item col-2">{{ model.route_name }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-1">Путь</li>
                <li class="list-group-item col-2">{{ model.route_path }}</li>
            </ul>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item col-1">Компонент</li>
                <li class="list-group-item col-2">{{ model.route_component }}</li>
            </ul>
            <div class="row mt-3">
                <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import VuePreloader from '../preloader.vue';

export default {
    mounted() {
        this.getData()
    },
    components: {
        VuePreloader
    },
    data: function () {
        return {
            preloader: true,
            errors: {},
            model_id: null,
            model: {
                id: '',
                module: '',
                title: '',
                route_name: '',
                route_path: '',
                route_component: ''
            }
        }
    },
    methods: {
        getData: function () {
            let app = this;
            app.preloader = true;
            let id = app.$route.params.id;
            app.model_id = id;
            axios.get('/api/v1/permissions/' + id + '/get/')
                .then(function (resp) {
                    app.model = resp.data;
                    app.preloader = false;
                })
                .catch(function () {
                    alert("Не смог получить данные")
                });
        },
        saveForm(e) {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            axios.post('/api/v1/permissions/' + app.model_id + '/update', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'permissions_index'});
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
