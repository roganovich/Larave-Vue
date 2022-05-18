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
                                <label for="inputSearchTitle" class="form-label">{{ $t('products.title') }}</label>
                                <input v-model="itemssearch.search.title"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchTitle">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchSlug" class="form-label">{{ $t('default.slug') }}</label>
                                <input v-model="itemssearch.search.slug"
                                       type="text"
                                       class= "form-control form-control-sm"
                                       id="inputSearchSlug">
                            </div>

                            <div class="col-md-2 col-g-2">
                                <label for="inputSearchDescription" class="form-label">{{ $t('products.description') }}</label>
                                <input v-model="itemssearch.search.description"
                                       type="text" class= "form-control form-control-sm"
                                       id="inputSearchDescription">
                            </div>

                        </div>
                        <div class="row p-1">
                            <h6 class="card-title">{{ $t('default.sortable') }}</h6>

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
                                <label for="inputSortSlug" class="form-label">{{ $t('default.slug') }}</label>
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
    }
}
</script>
