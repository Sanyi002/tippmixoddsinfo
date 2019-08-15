<template>
  <div class="home">
    <navbar></navbar>
    <main-header></main-header>
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from '@/components/Navbar.vue'
import MainHeader from '@/components/MainHeader.vue'

export default {
  name: 'home',
  components: {
    Navbar,
    MainHeader
  }
}
</script>
