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
                                <label for="inputSearchTitle" class="form-label">Имя</label>
                                <input v-model="itemssearch.search.title"
                                       type="text"
                                       class="form-control form-control-sm"
                                       id="inputSearchTitle"
                                       placeholder="Поиск по имени">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchRoot" class="form-label">Is ROOT?</label>
                                <div class="form-check"
                                     v-for="(item, id) in {'0': 'Нет', '1':'Да'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.search.is_root"
                                           :id="'inputSearchRoot' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSearchRoot' + id">
                                        {{ item }}
                                    </label>
                                </div>

                            </div>

                        </div>
                        <div class="row p-1">
                            <h6 class="card-title">Сортировка</h6>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchTitle" class="form-label">Имя</label>
                                <div class="form-check"
                                     v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.title"
                                           :id="'inputSearchTitle' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSearchTitle' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchRoot" class="form-label">Is ROOT?</label>
                                <div class="form-check"
                                     v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.is_root"
                                           :id="'inputSearchRoot' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSearchRoot' + id">
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
