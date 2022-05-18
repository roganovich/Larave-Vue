<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link :to="{name: 'products_category_index'}" class="btn btn-dark btn-sm" title="Назад">{{ $t('default.back') }}</router-link>
        </div>
    </div>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>
    <div v-else class=" mt-1">
        <h5 class="card-title mt-1">{{ $t('default.created') }}</h5>
        <div class="p-1">
            <form v-on:submit.prevent="saveForm()" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                        <label class="control-label">{{ $t('products.title') }}</label>
                        <input type="text"
                               v-model="model.title"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.title }">
                        <div class="invalid-feedback" v-if="errors.title">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                        <label class="control-label">{{ $t('default.slug') }}</label>
                        <input type="text"
                               v-model="model.slug"
                               class="form-control"
                               v-bind:class="{ 'is-invalid': errors.slug }">
                        <div class="invalid-feedback" v-if="errors.slug">
                            {{ errors.slug }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">{{ $t('products.description') }}</label>

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
                        <label class="control-label">{{ $t('products.thumb') }}</label>
                        <input class="form-control mt-1" type="file" accept="image/*" @change="uploadThumb($event)"
                               id="thumb-input">
                        <div class="form_thumb" v-if="model.thumb">
                            <img class="thumb mt-1" v-bind:src="model.thumb" v-bind:alt="model.title"/>
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
    components: {
        VuePreloader,
        VueEditor
    },
    data: function () {
        return {
            preloader: false,
            errors: {},
            types: {},
            model_id: null,
            model: {
                title: '',
                slug: '',
                description: '',
                thumb: '',
            }
        }
    },
    methods: {
        saveForm(e) {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            axios.post('/api/v1/products_categories/store', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'products_category_index'});
                    app.preloader = false;
                })
                .catch(function (resp) {
                    var errors = resp.response.data.errors;
                    for (var row in errors) {
                        app.errors[row] = errors[row][0];
                    }
                });
            app.preloader = false;
        },
        uploadThumb: function (event) {
            var app = this;
            var formData = new FormData();
            formData.append('images[]', event.target.files[0]);
            axios.post('/api/v1/products_categories/addimages', formData)
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
            axios.post('/api/v1/products_categories/addimages', formData)
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
