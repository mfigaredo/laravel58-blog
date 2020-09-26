<template>
	<div class="form-contact">
		<transition name="fade" mode="out-in">
		<p v-if="sent">Tu mensaje ha sido recibido, te contactaremos pronto.</p>
		<form v-else @submit.prevent="submit">
			<div class="input-container container-flex space-between">
				<input required v-model="form.name" placeholder="Tu nombre" class="input-name">
				<input required v-model="form.email" type="email" placeholder="Correo electrónico" class="input-email">
			</div>
			<div class="input-container">
				<input required v-model="form.subject" placeholder="Asunto" class="input-subject">
			</div>
			<div class="input-container">
				<textarea required v-model="form.message" cols="30" rows="10" placeholder="Tu mensaje"></textarea>
			</div>
			<div class="send-message">
				<button class="text-uppercase c-green" :disabled="working">
					<span v-if="working">Enviando...</span>
					<span v-else>Enviar Mensaje</span>
				</button>
			</div>
		</form>
		</transition>
		<!-- <pre>{{ form }}</pre> -->
	</div>
</template>

<script>
export default {
	name: 'ContactForm',
	data() {
		return {
			sent: false,
			working: false,
			form: {
				name: 'Miguel',
				email: 'mfigaredo@gmail.com',
				subject: 'Mi Asunto',
				message: 'Mi Mensaje...',
			}
		}
	},
	methods: {
		submit() {
			this.working = true;
			axios.post('/api/messages', this.form)
				.then(res => {
					this.sent = true;
					this.working = false;
				})
				.catch(errors => {
					this.sent = false;
					this.working = false;
				});
		}
	}
}
</script>

<style scoped>
.send-message button:disabled {
	cursor: not-allowed;
}
</style>