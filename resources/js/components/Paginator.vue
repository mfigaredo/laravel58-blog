<template>
	<div>
		<component :is="componentName" :items="items" :title="title"></component>
		<pagination-links :pagination="pagination"></pagination-links>
	</div>
</template>

<script>
export default {
	name: 'Paginator',
	props: ['componentName', 'url'],
	data() {
		return {
			pagination: {},
			items: [],
			title: '',
		}
	},
	mounted() {
		// console.log('month', this.$route.query.month);
		axios.get(`${this.url}?page=${this.$route.query.page || 1}`,{
			params: {
				month: this.$route.query.month,
				year: this.$route.query.year
			}
		})
		.then(res => {
			// console.log(res.data);
			this.items = res.data.posts.data || [];
			this.title = res.data.title || '';
			this.pagination = res.data.posts || {};
			// alert(this.pagination)
			delete this.pagination.data;
		})
		.catch(err => {
			console.error(err);
		});
	}
}
</script>

<style>

</style>