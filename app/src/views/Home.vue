<template>
  <div class="home">
    <div class="page-body">
		<main-header></main-header>
		<event-filter @filter="filtered" @filterTriggered="loading = true" head-title="Események szűrése"></event-filter>
		<events-table :data="events"></events-table>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
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

<style lang="scss" scoped>
.page-body {
	margin-bottom: 50px;
}
</style>