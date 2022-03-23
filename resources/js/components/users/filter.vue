<template>
    <div class="accordion" id="accordionFilter">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button p-1" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                    Фильтрация
                </button>
            </h2>
            <div id="collapseFilter" class="accordion-collapse collapse hide" aria-labelledby="headingOne"
                 data-bs-parent="#accordionFilter">
                <div class="accordion-body">
                    <form @submit.prevent="onFormSubmit">
                        <div class="row p-1">
                            <h6 class="card-title">Поиск</h6>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchName" class="form-label">Имя</label>
                                <input v-model="usersearch.search.name"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchName"
                                       placeholder="Поиск по имени">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchEmail" class="form-label">Email</label>
                                <input v-model="usersearch.search.email"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchEmail"
                                       placeholder="Поиск по Email">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchVerified" class="form-label">Верифицирован</label>
                                <select v-model="usersearch.search.email_verified_at"
                                        class= "form-control form-control-sm"
                                        id="inputSearchVerified">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'yes':'Да', 'no': 'Нет'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-1">
                            <h6 class="card-title">Сортировка</h6>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortName" class="form-label">Имя</label>
                                <select v-model="usersearch.sort.name"
                                        class="form-control form-control-sm"
                                        id="inputSortName">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortEmail" class="form-label">Email</label>
                                <select v-model="usersearch.sort.email"
                                        class="form-control form-control-sm"
                                        id="inputSortEmail">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortCreadated" class="form-label">Дата создания</label>
                                <select v-model="usersearch.sort.created_at"
                                        class="form-control form-control-sm"
                                        id="inputSortCreadated">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}"
                                            :value="id">
                                        {{ item }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortVerified" class="form-label">Верификация</label>
                                <select v-model="usersearch.sort.email_verified_at"
                                        class="form-control form-control-sm"
                                        id="inputSortVerified">
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
        usersearch: Object,
    },
    data: function () {
        return {
            parents: {}
        }
    },
    methods: {
        onFormSubmit: function () {
            //this.usersearch.search.title = '1234';
            console.log('search');
            //this.$emit('submit');
        },
    },
}
</script>
