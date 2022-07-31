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
                                <label for="inputSearchId" class="form-label">{{ $t('default.id') }}</label>
                                <input v-model="itemssearch.search.id"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchId">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchBrandId" class="form-label">{{ $t('products.brand') }}</label>
                                <select v-model="itemssearch.search.brand_id"
                                        class= "form-control form-control-sm"
                                        id="inputSearchBrandId">
                                    <option value="">{{ $t('default.select') }}</option>
                                    <option v-for="(item, id) in brands" :value="item.id">
                                        {{ item.title }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchCode" class="form-label">{{ $t('products.code') }}</label>
                                <input v-model="itemssearch.search.code"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchCode">
                            </div>


                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchTitle" class="form-label">{{ $t('products.title') }}</label>
                                <input v-model="itemssearch.search.title"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchTitle">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchCategories" class="form-label">{{ $t('products.category') }}</label>
                                <select v-model="itemssearch.search.categories"
                                        class= "form-control form-control-sm"
                                        id="inputSearchCategories">
                                    <option value="">{{ $t('default.select') }}</option>
                                    <option v-for="(item, id) in categories" :value="item.id">
                                        {{ item.title }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchSlug" class="form-label">{{ $t('products.slug') }}</label>
                                <input v-model="itemssearch.search.slug"
                                       type="text" class= "form-control form-control-sm"
                                       id="inputSearchSlug">
                            </div>
                        </div>
                        <div class="row p-1">
                            <h6 class="card-title">{{ $t('default.sortable') }}</h6>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortId" class="form-label">{{ $t('default.id') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.id" :id="'inputSortId' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortId' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortBrandId" class="form-label">{{ $t('products.brand') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.brand_id" :id="'inputSortBrandId' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortBrandId' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortCode" class="form-label">{{ $t('products.code') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.code" :id="'inputSortCode' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortCode' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortTitle" class="form-label">{{ $t('products.title') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.title" :id="'inputSortTitle' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortTitle' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortSlug" class="form-label">{{ $t('products.slug') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.slug" :id="'inputSortSlug' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortSlug' + id">
                                        {{ item }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSortCreated" class="form-label">{{ $t('default.created_at') }}</label>
                                <div class="form-check" v-for="(item, id) in {'ASC':$t('default.search_asc'), 'DESC': $t('default.search_desc')}">
                                    <input class="form-check-input" type="radio" v-model="itemssearch.sort.created_at" :id="'inputSortCreated' + id" :value="id">
                                    <label class="form-check-label" :for="'inputSortCreated' + id">
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
            brands: {},
            categories: {},
        }
    },
    mounted() {
        this.getBrands(),
        this.getCategories()
    },
    methods: {
        getBrands: function () {
            var app = this;
            axios.get('/api/v1/products/brands')
                .then(function (resp) {
                    app.brands = resp.data;
                })
                .catch(function (resp) {
                    alert($t('alert.cannot_load_data'));
                });
        },
        getCategories: function () {
            var app = this;
            axios.get('/api/v1/products/categories')
                .then(function (resp) {
                    app.categories = resp.data;
                })
                .catch(function (resp) {
                    alert($t('alert.cannot_load_data'));
                });
        },
    },
}
</script>
