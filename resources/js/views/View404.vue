<template>
    <section class="pages container">
        <div class="page page-about">
            <h1 class="text-capitalize">Página no encontrada</h1>
            <p class="text-center" style="color:red !important;">

                <i class="fa fa-exclamation-triangle fa-5x"></i>
            </p>
            <p>Regresar al <router-link :to="{ name: 'home' }"  class="text-uppercase pure-menu-link c-gris-2 ">Inicio</router-link>.</p>
        </div>
    </section>
</template>

<script>
export default {
    name: "404"
}
</script>

<style scoped>

</style>
