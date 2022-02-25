<template>
    <div class="p-3 mb-2 bg-secondary text-white">
        <form class="row g-3"  @submit.prevent="onFormSubmit">
            <div class="row">
                <h5 class="card-title">Поиск</h5>
                <div class="col-md-3 col-g-2">
                    <label for="inputSearchTitle" class="form-label">Заголовок</label>
                    <input v-model="wikipagesearch.search.title"
                           type="text"
                           class="form-control"
                           id="inputSearchTitle"
                           placeholder="Поиск по заголовку">
                </div>
                <div class="col-md-3 col-g-2">
                    <label for="inputSearchDescription" class="form-label">В тексте</label>
                    <input v-model="wikipagesearch.search.description"
                           type="text" class="form-control"
                           id="inputSearchDescription"
                           placeholder="Поиск в содержимом">
                </div>

                <div class="col-md-3 col-g-2">
                    <label for="inputSearchParent" class="form-label">Родитель</label>
                    <select v-model="wikipagesearch.search.parent"
                            class="form-control"
                            id="inputSearchParent">
                        <option value="">Выбрать</option>
                        <option v-for="(item, id) in parents" :value="item.id">
                            {{ item.title }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <h6 class="card-title">Сортировка</h6>
                <div class="col-md-2 col-g-2">
                    <label for="inputSortTitle" class="form-label">Заголовок</label>
                    <select v-model="wikipagesearch.sort.title"
                            class="form-control"
                            id="inputSortTitle">
                        <option value=""></option>
                        <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}" :value="id">
                            {{ item}}
                        </option>
                    </select>
                </div>
                <div class="col-md-2 col-g-2">
                    <label for="inputSortParent" class="form-label">Дата обновления</label>
                    <select v-model="wikipagesearch.sort.parent"
                            class="form-control"
                            id="inputSortParent">
                        <option value=""></option>
                        <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}" :value="id">
                            {{ item}}
                        </option>
                    </select>
                </div>
                <div class="col-md-2 col-g-2">
                    <label for="inputSortUpdated" class="form-label">Дата обновления</label>
                    <select v-model="wikipagesearch.sort.updated_at"
                            class="form-control"
                            id="inputSortUpdated">
                        <option value=""></option>
                        <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}" :value="id">
                            {{ item}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-12  col-g-12">
                <button type="submit" class="btn btn-primary">Найти</button>
            </div>
        </form>
    </div>
</template>

<script>

export default {
    props: {
        wikipagesearch: Object,
    },
    data: function () {
        return {
            parents: {}
        }
    },
    mounted() {
        this.getParentList()
    },
    methods: {
        getParentList: function () {
            var app = this;
            axios.get('/api/v1/wikipages/parentlist')
                .then(function (resp) {
                    app.parents = resp.data.data;
                    console.log(resp.data.data)
                })
                .catch(function (resp) {
                    alert("Could not load wikipage");
                });
        },
        onFormSubmit: function () {
            //this.wikipagesearch.search.title = '1234';
            console.log('submit');
            //this.$emit('submit');

        },
    },
}
</script>
