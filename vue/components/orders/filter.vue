<template>
    <div class="accordion" id="accordionFilter">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <a class="accordion-button p-1" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                    {{ $t('default.filteres') }}
                </a>
            </h2>
            <div id="collapseFilter" class="accordion-collapse collapse hide" aria-labelledby="headingOne"
                 data-bs-parent="#accordionFilter">
                <div class="accordion-body">
                    <form @submit.prevent="onFormSubmit">
                        <div class="row p-1">
                            <h6 class="card-title">{{ $t('default.search') }}</h6>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchId" class="form-label">{{ $t('orders.id') }}</label>
                                <input v-model="itemssearch.search.id"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchId">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchStatus" class="form-label">{{ $t('orders.status') }}</label>
                                <select v-model="itemssearch.search.status"
                                        class= "form-control form-control-sm"
                                        id="inputSearchStatus">
                                    <option value="">{{ $t('default.select') }}</option>
                                    <option v-for="(item, id) in statuses" :value="item.id">
                                        {{ item.title }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchManager" class="form-label">{{ $t('orders.manager') }}</label>
                                <select v-model="itemssearch.search.manager_id"
                                        class= "form-control form-control-sm"
                                        id="inputSearchManager">
                                    <option value="">{{ $t('default.select') }}</option>
                                    <option v-for="(item, id) in managers" :value="item.id">
                                        {{ item.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchCreatedAt" class="form-label">{{ $t('default.created_at') }}</label>
                                <input v-model="itemssearch.search.created_at"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchCreatedAt">
                            </div>
                        </div>
                        <div class="row p-1">
                            <h6 class="card-title">{{ $t('default.sortable') }}</h6>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortId" class="form-label">{{ $t('orders.id') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.id" :id="'inputSortId' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortId' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortStatus" class="form-label">{{ $t('orders.status') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.country" :id="'inputSortStatus' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortStatus' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortManager" class="form-label">{{ $t('orders.manager') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.city" :id="'inputSortManager' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortManager' + id">
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
                        </div>
                        <div class="row p-1">
                            <div class="col-md-12  col-g-12">
                                <button type="submit" class="btn btn-primary">{{ $t('default.find') }}</button>
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
            statuses: {},
            managers: {},
        }
    },
    mounted() {
        this.getStatusesList(),
        this.getManagerList()
    },
    methods: {
        getStatusesList: function () {
            var app = this;
            axios.get('/api/v1/orders/statuseslist')
                .then(function (resp) {
                    app.statuses = resp.data;
                })
                .catch(function (resp) {
                    alert($t('alert.cannot_load_data'));
                });
        },
        getManagerList: function () {
            var app = this;
            axios.get('/api/v1/orders/mangerslist')
                .then(function (resp) {
                    app.managers = resp.data;
                })
                .catch(function (resp) {
                    alert($t('alert.cannot_load_data'));
                });
        }
    },
}
</script>
