<template>
    <div class="accordion" id="accordionFilter">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <a class="accordion-button p-1" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                    Фильтрация
                </a>
            </h2>
            <div id="collapseFilter" class="accordion-collapse collapse hide" aria-labelledby="headingOne"
                 data-bs-parent="#accordionFilter">
                <div class="accordion-body">
                    <form @submit.prevent="onFormSubmit">
                        <div class="row p-1">
                            <h6 class="card-title">Поиск</h6>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchModule" class="form-label">Модуль</label>
                                <select v-model="itemssearch.search.module"
                                        class= "form-control form-control-sm"
                                        id="inputSearchModule">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'admin':'Админ', 'cabinet': 'Кабинет'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchTitle" class="form-label">Описание</label>
                                <input v-model="itemssearch.search.title"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchTitle"
                                       placeholder="Поиск по Описанию">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchRouteName" class="form-label">Маршрут</label>
                                <input v-model="itemssearch.search.route_name"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchRouteName"
                                       placeholder="Поиск по Маршруту">
                            </div>


                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchRoutePath" class="form-label">Путь</label>
                                <input v-model="itemssearch.search.route_path"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchRoutePath"
                                       placeholder="Поиск по Пути">
                            </div>

                        </div>
                        <div class="row p-1">
                            <h6 class="card-title">Сортировка</h6>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortModule" class="form-label">Модуль</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.module" :id="'inputSortModule' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortModule' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortTitle" class="form-label">Описание</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.title" :id="'inputSortTitle' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortTitle' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortRouteName" class="form-label">Маршрут</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.route_name" :id="'inputSortRouteName' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortRouteName' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortRoutePath" class="form-label">Путь</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.route_path" :id="'inputSortRoutePath' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortRoutePath' + id">
                                        {{ item }}
                                    </label>
                                </div>
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
        itemssearch: Object,
    },
    data: function () {
        return {
            parents: {}
        }
    },
    methods: {
        onFormSubmit: function () {
            //this.itemssearch.search.title = '1234';
            console.log('search');
            //this.$emit('submit');
        },
    },
}
</script>
