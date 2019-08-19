<template>
  <div class="home">
    <navbar></navbar>
    <main-header></main-header>
    <event-filter @filter="filtered" head-title="Események szűrése"></event-filter>
    <events-table v-bind:data="events"></events-table>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from '@/components/Navbar.vue'
import MainHeader from '@/components/MainHeader.vue'
import EventFilter from '@/components/EventFilter.vue'
import EventsTable from '@/components/EventsTable.vue'

export default {
  name: 'home',
  data() {
    return {
      events: []
    }
  },
  components: {
    Navbar,
    MainHeader,
    EventFilter,
    EventsTable
  },
  methods: {
    filtered: function(value) {
		this.events = value;
    }
  },
  mounted() {
    axios.get(this.$ApiHostname + '/events')
    .then(response => this.events = response.data);
  }
}
</script>
