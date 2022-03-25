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
            permissions: {},
            model: {
                id: '',
                title: '',
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
        saveForm(e) {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            axios.post('/api/v1/users/' + app.model_id + '/update', newModel)
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
