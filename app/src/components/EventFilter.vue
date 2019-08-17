<template>
    <div id="event-filter" class="module">
        <div class="container">
            <h1 class="module-title">{{ headTitle }}</h1>
            <div class="module-body filter-wrapper">
                <div class="filter-group">
                    <div class="filter-option">
                    <button class="btn filter-btn" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-tippmixoddsinfo-soccer-ball"></i>
                        <span v-if="!selectedCategoryName">Összes kategória</span>
                        <span v-else>{{ selectedCategoryName }}</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                        <ul v-if="categories.length != 0">
                            <li v-for="(item, key) in categories" :key="key" 
                                @click="selectedCategoryName = item.sportName; selectedCategoryID = item.sportID; getCountries(item.sportID);
                                    selectedCountry = null; countries = [];
                                    selectedLeague = null; leagues = []">
                                <span class="category-name">{{ item.sportName }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="filter-option">
                    <button class="btn filter-btn" :class="{ 'disabled': !selectedCategoryName }" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-tippmixoddsinfo-globe"></i>
                        <span v-if="!selectedCountry">Összes ország</span>
                        <span v-else>{{ selectedCountry }}</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                        <ul v-if="countries.length != 0">
                            <li v-for="(item, key) in countries" :key="key"
                                @click="selectedCountry = item.countryName; getLeagues(selectedCategoryID, selectedCountry);
                                    selectedLeague = null; leagues = []">
                                <span class="category-name">{{ item.countryName }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="filter-option">
                    <button class="btn filter-btn" :class="{ 'disabled': !selectedCountry }" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-tippmixoddsinfo-trophy"></i>
                        <span v-if="!selectedLeague">Összes bajnokság</span>
                        <span v-else>{{ selectedLeague }}</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                        <ul v-if="leagues.length != 0">
                            <li v-for="(item, key) in leagues" :key="key" @click="selectedLeague = item.leagueName">
                                <span class="category-name">{{ item.leagueName }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="filter-option datepicker">
                    <i class="icon-tippmixoddsinfo-calendar"></i>
                    <datepicker v-model="selectedDate" input-class="datepicker-btn" placeholder="Mikor"
                        :language="hu" :disabled-dates="state.disabledDates"
                        format="yyyy MMM dd" :bootstrap-styling="true">
                    </datepicker>
                </div>
                </div>
                <button class="btn btn-secondary filter-submit" @click="filterEvents(selectedCategoryID, selectedDate, selectedCountry, selectedLeague)">
                    Szűrés
                    <i class="icon-tippmixoddsinfo-filter"></i>
                </button>
            </div>
        </div>
        <span v-if="selectedDate">{{ selectedDate }}</span>
        <span>{{ requestParams }}</span>
    </div>
</template>

<script>
import axios from 'axios';
import Datepicker from 'vuejs-datepicker';
import {hu} from 'vuejs-datepicker/dist/locale'

export default {
    name: 'event-filter',
    components: {
        Datepicker
    },
    data() {
        return {
            categories: [],
            countries: [],
            leagues: [],
            filteredEvents: [],
            selectedCategoryName: null,
            selectedCategoryID: null,
            selectedCountry: null,
            selectedLeague: null,
            selectedDate: null,
            state: {
                disabledDates: {
                    to: new Date(Date.now() - 864e5)
                }
            },
            hu: hu,
            requestParams: ''
        }
    },
    props: ['headTitle'],
    mounted() {
        axios.get(this.$ApiHostname + '/categories')
            .then(response => this.categories = response.data);
    },
    methods: {
        getCountries: function(sportID) {
            axios.get(this.$ApiHostname + 'countries' + '/' + sportID)
            .then(response => this.countries = response.data);
        },
        getLeagues: function(sportID, country) {
            axios.get(this.$ApiHostname + 'leagues/' + sportID + '/' + country)
            .then(response => this.leagues = response.data);
        },
        filterEvents: function(sportID, selectedDate, selectedCountry, selectedLeague) {
            let formattedDate = selectedDate ? '/' + selectedDate.getFullYear() + "-0" + (selectedDate.getMonth()+1) + "-" + selectedDate.getDate() : '/' + null;
            if(formattedDate != "/null" && !sportID) {
                axios.get(this.$ApiHostname + 'events/date' + formattedDate)
                .then(response => console.log(response.data));
            } else if(sportID) {
                sportID = sportID ? '/' + sportID : null;
                selectedCountry = selectedCountry ? '/' + selectedCountry : '/' + null;
                selectedLeague = selectedLeague ? '/' + selectedLeague : '/' + null;
                console.log(this.$ApiHostname + 'events' + sportID + selectedCountry + selectedLeague + formattedDate);
                axios.get(this.$ApiHostname + 'events' + sportID + selectedCountry + selectedLeague + formattedDate)
                .then(response => console.log(response.data)); 
            }
        }
    }
}
</script>

<style lang="scss">
.datepicker-btn.form-control {
    appearance: none;
    font-size: 1.6rem;
    color: $globalFontColor;
    border: 0;
    background: transparent;
    position: relative;
    padding: 0 0 0 15px;
    cursor: pointer;
    height: $filterHeight;

    &::placeholder {
        color: $globalFontColor;
        opacity: 1;
        font-size: 1.8rem;
    }

    &:active,
    &:focus {
        outline: none;
        box-shadow: none;
    }
}

.datepicker {
    .vdp-datepicker__calendar {
        background: darken($filterBackground, 10%);
        color: $globalFontColor;
        border: 0;
        left: -30px;
    }

    .vdp-datepicker__calendar .cell.day-header {
        font-size: 14px;
        font-weight: 600;
    }

    .vdp-datepicker__calendar .cell:not(.blank):not(.disabled).day:hover,
    .vdp-datepicker__calendar .cell:not(.blank):not(.disabled).month:hover,
    .vdp-datepicker__calendar .cell:not(.blank):not(.disabled).year:hover {
        border-color: $globalColor;
    }

    .vdp-datepicker__calendar .cell.selected ,
    .vdp-datepicker__calendar .cell.selected:hover {
        background: $globalColor;
    }

    .vdp-datepicker__calendar .disabled,
    .datepicker .vdp-datepicker__calendar .disabled {
        color: lighten($filterBackground, 5%);
    }

    .vdp-datepicker__calendar header .prev:after {
        border-right: 10px solid $globalFontColor;
    }

    .vdp-datepicker__calendar header .next:after {
        border-left: 10px solid $globalFontColor;
    }

    .vdp-datepicker__calendar header .prev.disabled:after {
        border-right: 10px solid lighten($filterBackground, 5%);
    }

    .vdp-datepicker__calendar header .prev:not(.disabled):hover,
    .vdp-datepicker__calendar header .next:not(.disabled):hover {
         background: transparent;
    }

    .vdp-datepicker__calendar header .next:not(.disabled):hover:after {
        border-left: 10px solid $globalColor;
    }

    .vdp-datepicker__calendar header .prev:not(.disabled):hover:after {
        border-right: 10px solid $globalColor;
    }

    .vdp-datepicker__calendar header .up:not(.disabled):hover {
        background: transparent;
        box-shadow: inset 0 0 0 1px $globalColor;
    }
}
</style>

<style lang="scss">
.filter-wrapper {
    height: $filterHeight;
    border-radius: $globalBorderRadius;
    background: $filterBackground;
    padding: 0 35px;
    position: relative;
    display: flex;
    align-items: center;
}

.filter-group {
    display: flex;
    align-items: center;
}

.filter-option {
    margin-right: 45px;
    width: 25%;

    &.datepicker {
        display: flex;
        align-items: center;

        i {
            display: flex;
            font-size: 3rem;
        }
    }
}

.filter-btn {
    background: transparent;
    border: 0;
    font-size: 1.8rem;
    color: $globalFontColor;
    padding: 0;
    display: flex;
    align-items: center;

    span {
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 155px;
    }

    i {
        font-size: 3rem;
        padding-right: 10px;
        display: flex;
        width: auto;
    }

    &:hover,
    &:focus,
    &:active {
        outline: none;
        box-shadow: none;
        color: inherit;
    }

    &:after {
        content: '\0048';
        font-family: 'tippmixoddsinfo-icons';
        font-size: 1rem;
        vertical-align: middle;
        padding-left: 10px;
    }
}

.dropdown-menu {
    top: 100% !important;
    width: 100%;
    transform: none !important;
    background: darken($filterBackground, 10%);
    border: 0;
    color: $globalFontColor;
    font-size: 1.6rem;
    margin: -5px 0 0;
    border-radius: 0 0 $globalBorderRadius $globalBorderRadius;
    max-height: 0;
    display: block;
    transition: all 0.3s ease-in-out;
    overflow: hidden;
    padding: 0;

    ul {
        margin: 0;
        padding: 20px 35px 20px;
        list-style-type: none;

        li {
            display: inline-block;
            width: 25%;
            padding: 4px 0;
        }
    }

    &.show {
        max-height: 1000px;
    }
}

.category-name {
    cursor: pointer;
    transition: $transitionBase;

    &:hover,
    &:active,
    &:focus {
        color: $globalColor;
    }
}

.filter-submit {
    font-weight: 600;
    font-size: 2rem;
    padding: 0 25px 0 30px;
    line-height: 4rem;
    display: flex;
    align-items: center;
    margin-left: auto;

    i {
        font-size: 1.8rem;
        line-height: 1;
        padding-left: 15px;
    }
}
</style>