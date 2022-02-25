<template>
    <div class="p-1">
        <div class="form-group mt-1">
            <router-link to="/" class="btn btn-dark btn-sm">Back</router-link>
        </div>

        <div class=" mt-1">
            <div class="card-title mt-1">Новая запись</div>
            <div class="p-1">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Заголовок</label>
                            <input type="text" v-model="wikipage.title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Родитель</label>
                            <input type="text" v-model="wikipage.parent_id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Обновлен</label>
                            <input type="text" v-model="wikipage.description" class="form-control">
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
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            wikipage: {
                title: '',
                parent_id: '',
                description: '',
            }
        }
    },
    methods: {
        saveForm() {
            event.preventDefault();
            var app = this;
            var item = app.wikipage;
            axios.post('/api/v1/wikipages/store', item)
                .then(function (resp) {
                    app.$router.push({path: '/'});
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not create your wikipage");
                });
        }
    }
}
</script>
