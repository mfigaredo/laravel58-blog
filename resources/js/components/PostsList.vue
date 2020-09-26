<template>
    <section class="posts container">
        <h2 v-text="title" v-if="title.length"></h2>
        <posts-list-item v-for="post in items" :post="post" :key="post.id"></posts-list-item>

        <article v-if="!items.length" class="post">
            <div class="content-post">
                <h1>No hay publicaciones todavía</h1>
            </div>
        </article>
    </section><!-- fin del div.posts.container -->
</template>

<script>
export default {
    name: "PostsList",
    props: ['items', 'title'],
}
</script>

<style scoped>

</style>
