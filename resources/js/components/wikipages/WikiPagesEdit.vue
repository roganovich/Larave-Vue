<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link to="/" class="btn btn-dark btn-sm">Back</router-link>
        </div>
    </div>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>
    <div v-else class=" mt-1">
        <div class="card-title mt-1">Редактируем {{ model.title }}</div>
        <div class="p-1">
            <form v-on:submit="saveForm()">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Заголовок</label>
                        <input type="text" v-model="model.title" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Родитель</label>
                        <select v-model="model.parent_id"
                                class="form-control"
                                id="inputSearchParent">
                            <option v-for="(item, id) in parents" :value="item.id">
                                {{ item.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Описание</label>
                        <textarea class="form-control" v-model="model.description" rows="3"></textarea>
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
            this.getParentList()
    },
    components: {
        VuePreloader
    },
    data: function () {
        return {
            preloader: true,
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
                    alert("Could not load your company")
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
                    alert("Could not load wikipage");
                });
        },
        saveForm() {
            var app = this;
            app.preloader = true;
            var newModel = app.model;
            axios.post('/api/v1/wikipages/' + app.model_id + '/update', newModel)
                .then(function (resp) {
                    app.$router.push({name: 'wikipages_index'});
                    app.preloader = false;
                })
                .catch(function (resp) {
                    alert("Could not save form");
                });
        }
    }
}
</script>
