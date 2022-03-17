<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link to="/" class="btn btn-dark btn-sm">Back</router-link>
        </div>
    </div>

    <div class=" mt-1">
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
export default {
    mounted() {
        this.getResults(),
        this.getParentList()
    },
    data: function () {
        return {
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
        getResults: function () {
            let app = this;
            let id = app.$route.params.id;
            app.model_id = id;
            axios.get('/api/v1/wikipages/' + id + '/get/')
                .then(function (resp) {
                    app.model = resp.data;
                })
                .catch(function () {
                    alert("Could not load your company")
                });
        },
        getParentList: function () {
            var app = this;
            axios.get('/api/v1/wikipages/parentlist')
                .then(function (resp) {
                    app.parents = resp.data.data;
                })
                .catch(function (resp) {
                    alert("Could not load wikipage");
                });
        },
        saveForm() {
            event.preventDefault();
            var app = this;
            var newModel = app.model;
            axios.patch('/api/v1/wikipages/' + app.companyId + '/update/', newModel)
                .then(function (resp) {
                    console.log(resp.data.data);
                    app.model = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not save form");
                });
        }
    }
}
</script>
