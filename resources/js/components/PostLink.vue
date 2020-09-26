<template>
    <router-link
        :to="{
            name: 'category_posts',
            params: {
                category: category.url
            }
        }">
        {{ category.name || '' }}
    </router-link>
</template>

<script>
export default {
    name: "CategoryLink",
    props: ['category'],
}
</script>

<style scoped>

</style>
