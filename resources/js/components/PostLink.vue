<template>
    <router-link
        :to="{
            name: 'posts_show',
            params: {
                url: post.url
            }
        }"
        class="">
        <slot/>
    </router-link>
</template>

<script>
export default {
    name: "Postlink",
    props: ['post'],
}
</script>

<style scoped>

</style>
