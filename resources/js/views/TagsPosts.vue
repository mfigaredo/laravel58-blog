<template>
    <!-- <posts-list :posts="posts" :title="title"></posts-list> -->
    <paginator
        :url="`/api/etiquetas/${this.tag}`"
        component-name="posts-list"
        >
    </paginator>
</template>

<script>
export default {
    name: "TagsPosts",
    props: ['tag'],
    // data() {
    //     return {
    //         posts: [],
    //         title: '',
    //     }
    // },
    // mounted() {
    //     // console.log('Componente listo');
    //     // obtener los posts
    //     axios.get(`/api/etiquetas/${this.tag}`)
    //         .then(res => {
    //             // console.log(res);
    //             this.posts = res.data.posts.data;
    //             this.title = res.data.title;
    //         })
    //         .catch(err => {
    //             console.log(err);
    //         });
    // }
}
</script>

<style scoped>

</style>
