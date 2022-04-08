<template>
    <div v-if="preloader">
        <vue-preloader></vue-preloader>
    </div>

    <div v-else>
        <div class="mt-1">
            <h5 class="card-title">{{ $t('points.index') }}</h5>
        </div>
        <div class="mt-1">
            <div class="form-group">
                <router-link :to="{name: 'points_create'}" class="btn btn-success">{{ $t('default.created') }}</router-link>
            </div>
        </div>

        <div class="mt-1">
            <vue-filter
                :itemssearch="itemssearch"
                @submit="getResults()"></vue-filter>
        </div>

        <div v-if="search">
            <vue-preloader></vue-preloader>
        </div>
        <div v-else class="mt-1">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>{{ $t('points.country') }}</th>
                    <th>{{ $t('points.city') }}</th>
                    <th>{{ $t('points.type') }}</th>
                    <th>{{ $t('points.title') }}</th>
                    <th>{{ $t('points.area') }}</th>
                    <th>{{ $t('points.days') }}</th>
                    <th>{{ $t('default.created_at') }}</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item, index in items.data">
                    <td>{{ item.country }}</td>
                    <td>{{ item.city }}</td>
                    <td>{{ item.type }}</td>
                    <td>{{ item.title }}</td>
                    <td>{{ item.area }}</td>
                    <td>{{ item.days }}</td>
                    <td>{{ short_date(item.created_at) }}</td>
                    <td>
                        <router-link
                            :title="$t('default.edit')"
                            :to="{name: 'points_edit', params: {id: item.id}}"
                            class="btn btn-sm btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </router-link>
                        <router-link
                            :title="$t('default.delete')"
                            :to="{}"
                            class="btn btn-sm btn-danger"
                            v-on:click="deleteEntry(item, index)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </router-link>
                    </td>
                </tr>
                </tbody>
            </table>

            <vue-pagination :pagination="items"
                            @paginate="getResults()"
                            :offset="4">
            </vue-pagination>

        </div>
    </div>
</template>

<script>
import VuePagination from '../pagination.vue';
import VueFilter from './filter.vue';
import VuePreloader from '../preloader.vue';
import moment from 'moment';

export default {
    data: function () {
        return {
            preloader: true,
            search: true,
            items: {
                meta: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                }
            },
            offset: 4,
            itemssearch: {
                search: {
                    country: '',
                    city: '',
                    days: '',
                    title: '',
                    type: '',
                    description: '',
                },
                sort: {
                    country: '',
                    city: '',
                    days: '',
                    title: '',
                    type: '',
                    created_at:'',
                },
                page: 1
            },
        }
    },
    mounted() {
        this.getResults()
    },
    components: {
        VuePagination,
        VueFilter,
        VuePreloader
    },
    methods: {
        getResults: function () {
            var app = this;
            app.preloader = false;
            app.search = true;
            this.itemssearch.page = this.items.meta.current_page;
            axios.post('/api/v1/points', this.itemssearch)
                .then(function (resp) {
                    app.items = resp.data;
                    app.search = false;
                })
                .catch(function (resp) {
                    alert($t('alert.cannot_load_data'));
                });
        },
        deleteEntry: function (item, index) {
            if (confirm("Вы действительно хотите " + item.title + " запись?")) {
                var app = this;
                app.search = true;
                axios.delete('/api/v1/points/' + item.id + '/destroy')
                    .then(function (resp) {
                        app.search = false;
                        app.$router.push({name: 'points_index'});
                    })
                    .catch(function (resp) {
                        alert($t('alert.cannot_delete_data'));
                    });
                this.getResults();
            }
        },
        short_date(date) {
            return moment(String(date)).format('DD.MM.YYYY hh:mm');
        },
    },
}
</script>
