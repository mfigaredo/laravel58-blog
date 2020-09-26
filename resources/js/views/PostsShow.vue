<template>
    <section class="post container">


        <div class="content-post">

            <post-header :post="post"></post-header>

            <div class="image-w-text" v-html="post.body"></div>

            <footer class="container-flex space-between">
                <social-links :description="post.title"></social-links>
                <div class="tags container-flex">
                    <span class="tag c-gris text-capitalize" v-for="tag in post.tags" :key="tag.name">
                        <tag-link :tag="tag"></tag-link>
                    </span>
                </div>
            </footer>
            <div class="comments">
                <div class="divider"></div>

                <disqus-comments></disqus-comments>
            </div><!-- .comments -->
        </div>
    </section>
</template>

<script>
export default {
    name: "PostsShow",
    props: ['url'],
    data() {
        return {
            post: {
                owner: {
                    name: ''
                },
                category: {
                    name: '',
                    url: '#',
                }
            }
        }
    },
    mounted() {
        axios.get(`/api/blog/${this.url}`)
            .then(res => {
                // console.log('Post', res.data);
                this.post = res.data;
            })
            .catch(err => {
                console.error(err.response.data);
            });
    }
}
</script>

<style scoped>

</style>
