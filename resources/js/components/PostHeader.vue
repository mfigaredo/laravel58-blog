<template>
    <div>
        <header class="container-flex space-between">
            <div class="date">
            <span class="c-gray-1">
                {{ post.published_date || '' }} /
                {{ post.owner.name || '' }}
            </span>
            </div>
            <div class="post-category">

            <span class="category text-capitalize">
                <category-link :category="post.category"></category-link>

            </span>

            </div>
        </header>
        <h1>{{ post.title }}</h1>
        <div class="divider"></div>
        <br>
    </div>

</template>

<script>
export default {
    name: "PostHeader",
    props: ['post'],
}
</script>

<style scoped>

</style>
