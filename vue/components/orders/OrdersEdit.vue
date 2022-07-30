<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link :to="{name: 'orders_index'}" class="btn btn-dark btn-sm" title="Назад">{{
                    $t('default.back')
                }}
            </router-link>
        </div>
    </div>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>
    <div v-else class=" mt-1">
        <div class="card-title mt-1">{{ $t('default.edit') }} #{{ model.id }}</div>
        <div class="p-1">
            <form v-on:submit.prevent="saveForm()" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('orders.status') }}</label>
                        <select v-model="model.status"
                                class="form-control"
                                v-bind:class="{ 'is-invalid': errors.status }"
                                id="inputSearchStatus">
                            <option v-for="(item, id) in statuses" :value="item.id">
                                {{ item.title }}
                            </option>
                        </select>
                        <div class="invalid-feedback" v-if="errors.status">
                            {{ errors.status }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('orders.manager') }}</label>
                        <select v-model="model.manager_id"
                                class="form-control"
                                v-bind:class="{ 'is-invalid': errors.manager_id }"
                                id="inputSearchStatus">
                            <option value="">{{ $t('default.select') }}</option>
                            <option v-for="(item, id) in managers" :value="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                        <div class="invalid-feedback" v-if="errors.manager_id">
                            {{ errors.status }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                        <label class="control-label">{{ $t('orders.amount') }}</label>
                        <input type="text"
                               v-model="model.amount"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.amount }">
                        <div class="invalid-feedback" v-if="errors.amount">
                            {{ errors.amount }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                        <label class="control-label">{{ $t('orders.comment') }}</label>
                        <input type="text"
                               v-model="model.comment"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.comment }">
                        <div class="invalid-feedback" v-if="errors.comment">
                            {{ errors.comment }}
                        </div>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-xs-12 form-group">
                        <button class="btn btn-success">{{ $t('default.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import VuePreloader from '../preloader.vue';
import {VueEditor} from "vue3-editor";

export default {
    mounted() {
        this.getData(),
        this.getStatusesList(),
        this.getManagerList()
    },
    components: {
        VuePreloader,
        VueEditor
    },
    data: function () {
        return {
            preloader: true,
            errors: {},
            types: {},
            model_id: null,
            statuses: {},
            managers: {},
            model: {
                id: '',
                comment: '',
                amount: '',
                status: '',
                manager_id: '',
            }
        }
    },
    methods: {
        getData: function () {
            let app = this;
            app.preloader = true;
            let id = app.$route.params.id;
            app.model_id = id;
            axios.get('/api/v1/orders/' + id + '/get/')
                .then(function (resp) {
                    app.model = resp.data;
                    app.preloader = false;
                })
                .catch(function (e) {
                    alert($t('alert.cannot_load_data'))
                });
        },
        saveForm(e) {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            axios.post('/api/v1/orders/' + app.model_id + '/update', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'orders_index'});
                })
                .catch(function (resp) {
                    var errors = resp.response.data.errors;
                    for (var row in errors) {
                        app.errors[row] = errors[row][0];
                    }
                });
            app.preloader = false;
        },
        getStatusesList: function () {
            var app = this;
            axios.get('/api/v1/orders/statuseslist')
                .then(function (resp) {
                    app.statuses = resp.data;
                })
                .catch(function (resp) {
                    //alert($t('alert.cannot_load_data'));
                });
        },
        getManagerList: function () {
            var app = this;
            axios.get('/api/v1/orders/mangerslist')
                .then(function (resp) {
                    app.managers = resp.data;
                })
                .catch(function (resp) {
                    //alert($t('alert.cannot_load_data'));
                });
        }
    }
}
</script>
