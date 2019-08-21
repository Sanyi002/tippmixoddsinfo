<template>
    <div id="contact-page">
        <navbar></navbar>
        <div class="container page-wrapper">
            <h1 class="page-title">Kapcsolat</h1>
            <div class="page-content">
                <p>Valami hibát találtál? Esetleg van valamilyen ötleted, amit szívesen látnál/használnál az oldalon? <br>
                Írd meg a <a href="mailto:tippmixoddsinfo@gmail.com"><b>tippmixoddsinfo@gmail.com</b></a> email címre vagy küldj egy üzenetet <a href="/"><b>Instagramon</b></a> és igyekszem minél hamarabb megcsinálni!</p>
            </div>
        </div>
        <main-footer></main-footer>
    </div>
</template>

<script>
import Navbar from '@/components/Navbar.vue'
import MainFooter from '@/components/MainFooter.vue'

export default {
    name: 'contact',
    components: {
        Navbar,
        MainFooter
    }
}
</script>

<style lang="scss" scoped>
.page-wrapper {
    margin-bottom: 260px;
}
</style>