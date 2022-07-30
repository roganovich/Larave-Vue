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

                            <div class="col-md-3 col-g-2">
                                <label for="inputSearchRoles" class="form-label">Роль</label>
                                <select v-model="itemssearch.search.role_id"
                                        class= "form-control form-control-sm"
                                        id="inputSearchParent">
                                    <option value="">Выбрать</option>
                                    <option v-for="(item, id) in roles" :value="item.id">
                                        {{ item.title }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchName" class="form-label">Имя</label>
                                <input v-model="itemssearch.search.name"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchName"
                                       placeholder="Поиск по имени">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchEmail" class="form-label">Email</label>
                                <input v-model="itemssearch.search.email"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchEmail"
                                       placeholder="Поиск по Email">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchVerified" class="form-label">Верифицирован</label>
                                <select v-model="itemssearch.search.email_verified_at"
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
                                <label for="inputSortRole" class="form-label">Роль</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.role" :id="'inputSortRole' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortRole' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortName" class="form-label">Имя</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.name" :id="'inputSortName' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortName' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortEmail" class="form-label">Email</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.email" :id="'inputSortEmail' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortEmail' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortCreadated" class="form-label">{{ $t('default.created_at') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.created_at" :id="'inputSortCreadated' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortCreadated' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-g-2">
                                <label for="inputSortVerified" class="form-label">Верификация</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':'По возрастанию', 'DESC': 'По убыванию'}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.email_verified_at" :id="'inputSortVerified' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortVerified' + id">
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
            roles: {}
        }
    },
    mounted() {
        this.getRolesList()
    },
    methods: {
        getRolesList: function () {
            var app = this;
            app.preloader = true;
            axios.get('/api/v1/usersroles/list')
                .then(function (resp) {
                    app.roles = resp.data;
                    app.preloader = false;
                })
                .catch(function (resp) {
                    alert($t('alert.cannot_load_data'));
                });
        }
    },
}
</script>
