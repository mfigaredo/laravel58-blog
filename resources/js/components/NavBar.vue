<template>
    <nav class="custom-wrapper" id="menu">
        <div class="pure-menu"></div>
        <ul class="container-flex list-unstyled">
            <li>
                <router-link :to="{ name: 'home' }"  class="text-uppercase pure-menu-link c-gris-2 ">Inicio</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'about' }"  class="text-uppercase pure-menu-link c-gris-2 ">Nosotros</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'archive' }"  class="text-uppercase pure-menu-link c-gris-2 ">Archivo</router-link>
            </li>
            <li>
                <router-link :to="{ name: 'contact' }"  class="text-uppercase pure-menu-link c-gris-2 ">Contacto</router-link>
            </li>
            <li>
                <a href="/login" class="text-uppercase pure-menu-link c-gris-2">Entrar</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "NavBar"
}
</script>

<style scoped>

</style>
