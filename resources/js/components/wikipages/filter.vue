<template>
    <div class="accordion" id="accordionFilter">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                    Поиск
                </button>
            </h2>
            <div id="collapseFilter" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                 data-bs-parent="#accordionFilter">
                <div class="accordion-body">
                    <form @submit.prevent="onFormSubmit">
                        <div class="row p-1">
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
                        <div class="row p-1">
                            <h6 class="card-title">Сортировка</h6>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortTitle" class="form-label">Заголовок</label>
                                <select v-model="wikipagesearch.sort.title"
                                        class="form-control form-control-sm"
                                        id="inputSortTitle">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortParent" class="form-label">Дата обновления</label>
                                <select v-model="wikipagesearch.sort.parent"
                                        class="form-control form-control-sm"
                                        id="inputSortParent">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortUpdated" class="form-label">Дата обновления</label>
                                <select v-model="wikipagesearch.sort.updated_at"
                                        class="form-control form-control-sm"
                                        id="inputSortUpdated">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-md-12  col-g-12">
                                <button type="submit" class="btn btn-primary">Найти</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
