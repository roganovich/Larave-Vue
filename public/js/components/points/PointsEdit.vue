<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link :to="{name: 'points_index'}" class="btn btn-dark btn-sm" title="Назад">{{
                    $t('default.back')
                }}
            </router-link>
        </div>
    </div>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>
    <div v-else class=" mt-1">
        <div class="card-title mt-1">{{ $t('default.edit') }} {{ model.title }}</div>
        <div class="p-1">
            <form v-on:submit.prevent="saveForm()" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.type') }}</label>
                        <select v-model="model.type_id"
                                class="form-control"
                                v-bind:class="{ 'is-invalid': errors.type_id }"
                                id="inputSearchType">
                            <option></option>
                            <option v-for="(item, id) in types" :value="item.id">
                                {{ item.title }}
                            </option>
                        </select>
                        <div class="invalid-feedback" v-if="errors.type_id">
                            {{ errors.type_id }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.country') }}</label>
                        <input type="text"
                               v-model="model.country"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.country }">
                        <div class="invalid-feedback" v-if="errors.country">
                            {{ errors.country }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.city') }}</label>
                        <input type="text"
                               v-model="model.city"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.city }">
                        <div class="invalid-feedback" v-if="errors.city">
                            {{ errors.city }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                        <label class="control-label">{{ $t('points.address') }}</label>
                        <input type="text"
                               v-model="model.address"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.address }">
                        <div class="invalid-feedback" v-if="errors.address">
                            {{ errors.address }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                        <label class="control-label">{{ $t('points.title') }}</label>
                        <input type="text"
                               v-model="model.title"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.title }">
                        <div class="invalid-feedback" v-if="errors.title">
                            {{ errors.title }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">{{ $t('points.description') }}</label>

                        <vue-editor
                            id="editor"
                            useCustomImageHandler
                            @imageAdded="handleImageAdded"
                            class="form-control"
                            v-bind:class="{ 'is-invalid': errors.description }"
                            v-model="model.description"
                        >
                        </vue-editor>

                        <div class="invalid-feedback" v-if="errors.description">
                            {{ errors.description }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.map_longitude') }}</label>
                        <input type="text"
                               v-model="model.map_longitude"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.map_longitude }">
                        <div class="invalid-feedback" v-if="errors.map_longitude">
                            {{ errors.map_longitude }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.map_latitude') }}</label>
                        <input type="text"
                               v-model="model.map_latitude"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.map_latitude }">
                        <div class="invalid-feedback" v-if="errors.map_latitude">
                            {{ errors.map_latitude }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.map_zoom') }}</label>
                        <input type="text"
                               v-model="model.map_zoom"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.map_zoom }">
                        <div class="invalid-feedback" v-if="errors.map_zoom">
                            {{ errors.map_zoom }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.area') }}</label>
                        <input type="text"
                               v-model="model.area"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.area }">
                        <div class="invalid-feedback" v-if="errors.area">
                            {{ errors.area }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.days') }}</label>
                        <input type="text"
                               v-model="model.days"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.days }">
                        <div class="invalid-feedback" v-if="errors.days">
                            {{ errors.days }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2 form-group">
                        <label class="control-label">{{ $t('points.thumb') }}</label>
                        <input class="form-control mt-1" type="file" accept="image/*" @change="uploadThumb($event)"
                               id="thumb-input">
                        <div class="form_thumb" v-if="model.thumb">
                            <img class="thumb mt-1" v-bind:src="model.thumb" v-bind:alt="model.title"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-10 form-group">
                        <label class="control-label">{{ $t('points.images') }}</label>
                        <input class="form-control mt-1" type="file" accept="image/*" @change="uploadImages($event)"
                               id="images-input" multiple>
                        <div class="form_thumb d-flex flex-row" v-if="model.images">
                            <div class="p-2" v-for="image, index in model.images">
                                <img class="thumb mt-1" v-bind:src="image" v-bind:alt="model.title"/>
                            </div>
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
            this.getTypesList()
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
            model: {
                id: '',
                country: '',
                city: '',
                address: '',
                title: '',
                type: '',
                thumb: '',
                images: {},
                description: '',
                map_longitude: '',
                map_latitude: '',
                map_zoom: '',
                area: '',
                days: '',
            }
        }
    },
    methods: {
        getData: function () {
            let app = this;
            app.preloader = true;
            let id = app.$route.params.id;
            app.model_id = id;
            axios.get('/api/v1/points/' + id + '/get/')
                .then(function (resp) {
                    app.model = resp.data;
                    app.model.images = JSON.parse(app.model.images);
                    app.preloader = false;
                })
                .catch(function () {
                    alert($t('alert.cannot_load_data'))
                });
        },
        getTypesList: function () {
            var app = this;
            app.preloader = true;
            axios.get('/api/v1/points/typeslist')
                .then(function (resp) {
                    app.types = resp.data;
                    app.preloader = false;
                })
                .catch(function (resp) {
                    alert($t('alert.cannot_load_data'));
                });
        },
        saveForm(e) {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            axios.post('/api/v1/points/' + app.model_id + '/update', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'points_index'});
                })
                .catch(function (resp) {
                    var errors = resp.response.data.errors;
                    for (var row in errors) {
                        app.errors[row] = errors[row][0];
                    }
                });
            app.preloader = false;
        },
        uploadImages: function (event) {
            var app = this;
            var formData = new FormData();
            for (const i of Object.keys(event.target.files)) {
                formData.append('images[]', event.target.files[i])
            }
            axios.post('/api/v1/points/addimages', formData)
                .then(function (resp) {
                    const urls = resp.data.urls;
                    app.model.images = urls;
                })
                .catch(err => {
                    console.log(err);
                });
        },
        uploadThumb: function (event) {
            var app = this;
            var formData = new FormData();
            formData.append('images[]', event.target.files[0]);
            axios.post('/api/v1/points/addimages', formData)
                .then(function (resp) {
                    const url = resp.data.urls;
                    if (url) {
                        app.model.thumb = url[0];
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
            var app = this;
            var formData = new FormData();
            formData.append("images[]", file);
            axios.post('/api/v1/points/addimages', formData)
                .then(function (resp) {
                    const url = resp.data.urls;
                    if (url) {
                        Editor.insertEmbed(cursorLocation, "image", url[0]);
                        resetUploader();
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
}
</script>
