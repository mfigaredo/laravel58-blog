<template>
    <div>
        <section class="posts container">
            <!--        @if( isset($title) )-->
            <!--            <h2>{{ $title }}</h2>-->
            <!--        @endif-->
            <article v-for="post in posts"  class="post">

                <!--                @include( $post->viewType('home') )-->

                <div class="content-post">

                    <post-header :post="post"></post-header>

                    <p v-html="post.excerpt"></p>
                    <footer class="container-flex space-between">
                        <div class="read-more">
                            <router-link :to="{name: 'posts_show', params: {url: post.url}}" class="text-uppercase c-green">leer más</router-link>

                        </div>

                        <!--                        @include('posts.tags')-->

                        <div class="tags container-flex">
                            <span class="tag c-gris text-capitalize" v-for="tag in post.tags">
                                <a href="#">
                                    #{{ tag.name }}
                                </a>
                            </span>
                        </div>

                    </footer>
                </div>
            </article>
            <!--        @empty-->
            <article v-if="!posts.length" class="post">
                <div class="content-post">
                    <h1>No hay publicaciones todavía</h1>
                </div>
            </article>

        </section><!-- fin del div.posts.container -->
    </div>
</template>

<script>
export default {
    name: "CategoryPosts",
    data() {
        return {
            posts: [],
        }
    },
    mounted() {
        // console.log('Componente listo');
        // obtener los posts
        axios.get(`/api/categorias/${this.$route.params.category}`)
            .then(res => {
                console.log(res);
                this.posts = res.data.data;
            })
            .catch(err => {
                console.log(err);
            });
    }
}
</script>

<style scoped>

</style>
