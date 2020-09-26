<template>
    <paginator 
        :url="`/api/categorias/${this.category}`"
        component-name="posts-list"
    ></paginator>
</template>

<script>
export default {
    name: "CategoryPosts",
    props: ['category'],
}
</script>

<style scoped>

</style>
