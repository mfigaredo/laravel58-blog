<template>
    <div class="pagination" v-if="pagination.last_page > 1">
        <ul class="list-unstyled container-flex space-center">
            <li v-for="page in pagination.last_page" :key="page">
                <router-link :class="getActiveClass(page)" :to="{
                        name: $route.name,
                        query: {
                            page: page,
                        },
                     }">{{ page }}</router-link>

            </li>
        </ul>
        
    </div>
</template>

<script>
export default {
    name: "PaginationLinks",
    props: ['pagination'],
    methods: {
        getActiveClass(page) {
            return [
              ! this.$route.query.page && page == 1 ? 'active' : ''
            ];
        }
    },
}
</script>

<style scoped lang="scss">
    .pagination {
        a.active {
            background-color: #1abc9c;
            color: white;
        }
    }
</style>
