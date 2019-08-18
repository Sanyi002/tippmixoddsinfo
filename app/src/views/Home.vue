<template>
  <div class="home">
    <navbar></navbar>
    <main-header></main-header>
    <event-filter head-title="Események szűrése"></event-filter>
    <events-table></events-table>
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from '@/components/Navbar.vue'
import MainHeader from '@/components/MainHeader.vue'
import EventFilter from '@/components/EventFilter.vue'
import EventsTable from '@/components/EventsTable.vue'

export default {
  name: 'home',
  components: {
    Navbar,
    MainHeader,
    EventFilter,
    EventsTable
  }
}
</script>
