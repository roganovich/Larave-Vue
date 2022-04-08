<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link :to="{name: 'wikipages_index'}" class="btn btn-dark btn-sm" title="Назад">Назад</router-link>
        </div>
    </div>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>
    <div v-else class=" mt-1">
        <div class="card-title mt-1">{{ $t('default.edit') }}  {{ model.title }}</div>
        <div class="p-1">
            <form v-on:submit.prevent="saveForm()">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">{{ $t('wikipages.title') }}</label>
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
                        <label class="control-label">{{ $t('wikipages.parent') }}</label>
                        <select v-model="model.parent_id"
                                class="form-control"
                                v-bind:class="{ 'is-invalid': errors.parent_id }"
                                id="inputSearchParent">
                            <option></option>
                            <option v-for="(item, id) in parents" :value="item.id">
                                {{ item.title }}
                            </option>
                        </select>
                        <div class="invalid-feedback" v-if="errors.parent_id">
                            {{ errors.parent_id }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">{{ $t('wikipages.description') }}</label>

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
        this.getParentList()
    },
    components: {
        VuePreloader,
        VueEditor
    },
    data: function () {
        return {
            preloader: true,
            errors: {},
            parents: {},
            model_id: null,
            model: {
                id: '',
                title: '',
                parent_id: '',
                description: '',
            }
        }
    },
    methods: {
        getData: function () {
            let app = this;
            app.preloader = true;
            let id = app.$route.params.id;
            app.model_id = id;
            axios.get('/api/v1/wikipages/' + id + '/get/')
                .then(function (resp) {
                    app.model = resp.data;
                    app.preloader = false;
                })
                .catch(function () {
                    alert(this.$t('alert.cannot_load_data'))
                });
        },
        getParentList: function () {
            var app = this;
            app.preloader = true;
            axios.get('/api/v1/wikipages/parentlist')
                .then(function (resp) {
                    app.parents = resp.data.data;
                    app.preloader = false;
                })
                .catch(function (resp) {
                    alert(this.$t('alert.cannot_load_data'));
                });
        },
        saveForm(e) {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            axios.post('/api/v1/wikipages/' + app.model_id + '/update', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'wikipages_index'});
                })
                .catch(function (resp) {
                    var errors = resp.response.data.errors;
                    for (var row in errors) {
                        app.errors[row] = errors[row][0];
                    }
                });
            app.preloader = false;
        },
        handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
            var app = this;

            var formData = new FormData();
            formData.append("image", file);

            axios.post('/api/v1/wikipages/addimage', formData)
                .then(function (resp) {
                    const url = resp.data.url; // Get url from response
                    Editor.insertEmbed(cursorLocation, "image", url);
                    resetUploader();
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
}
</script>
