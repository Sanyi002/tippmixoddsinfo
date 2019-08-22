<template>
    <div id="events-table">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sorszám</th>
                        <th>Esemény, időpont</th>
                        <th>Kategória</th>
                        <th>Bajnokság</th>
                        <th class="clickable" @click="sortByHomeOddsSwitch >= 1 ? sortByHomeOddsSwitch = -1 : sortByHomeOddsSwitch++;
                            sortByDrawOddsSwitch = sortByAwayOddsSwitch = -1; sortByHomeOdds(sortByHomeOddsSwitch)">
                            Hazai
                            <span class="sorting-icon">
                                <i v-if="sortByHomeOddsSwitch == 0" class="icon-tippmixoddsinfo-up-arrow"></i>
                                <i v-if="sortByHomeOddsSwitch == 1" class="icon-tippmixoddsinfo-down-arrow"></i>
                            </span>
                        </th>
                        <th class="clickable" @click="sortByDrawOddsSwitch >1 ? sortByDrawOddsSwitch = -1 : sortByDrawOddsSwitch++;
                            sortByHomeOddsSwitch = sortByAwayOddsSwitch = -1; sortByDrawOdds(sortByDrawOddsSwitch)">
                            Döntetlen
                            <span class="sorting-icon">
                                <i v-if="sortByDrawOddsSwitch == 0" class="icon-tippmixoddsinfo-up-arrow"></i>
                                <i v-if="sortByDrawOddsSwitch == 1" class="icon-tippmixoddsinfo-down-arrow"></i>
                            </span>
                        </th>
                        <th class="clickable" @click="sortByAwayOddsSwitch >1 ? sortByAwayOddsSwitch = -1 : sortByAwayOddsSwitch++;
                            sortByHomeOddsSwitch = sortByDrawOddsSwitch = -1; sortByAwayOdds(sortByAwayOddsSwitch)">
                            Vendég
                            <span class="sorting-icon">
                                <i v-if="sortByAwayOddsSwitch == 0" class="icon-tippmixoddsinfo-up-arrow"></i>
                                <i v-if="sortByAwayOddsSwitch == 1" class="icon-tippmixoddsinfo-down-arrow"></i>
                            </span>
                        </th>
                    </tr>
                </thead>
                <load-status v-if="!dataPaginated"></load-status>
                <tbody v-if="dataPaginated">
                    <tr v-for="(item, key) in sortedData" :key="key">
                        <td class="marketNumber">{{ item.marketNumber }}</td>
                        <td>
                            <b>{{ item.eventName }}</b>
                            <br>
                            <small>{{ item.eventDate }}</small>
                        </td>
                        <td>{{ item.sportName }}</td>
                        <td>{{ item.leagueName }}</td>
                        <td class="odds">
                            <b>{{ item.changedHomeOdds }}</b>
                            <span class="odds-original">{{ item.homeOdds }}</span>
                            <span class="odds-diff" :class="oddsDiff(item.homeOdds, item.changedHomeOdds) > 0 ? 'greater' : 'lower'" v-if="oddsDiff(item.homeOdds, item.changedHomeOdds) != 0">
                                {{ oddsDiff(item.homeOdds, item.changedHomeOdds).toFixed(2) }}%
                            </span>
                        </td>
                        <td class="odds">
                            <b v-if="item.changedDrawOdds">{{ item.changedDrawOdds }}</b>
                            <span class="odds-original" v-if="item.drawOdds">{{ item.drawOdds }}</span>
                            <span class="odds-diff" :class="oddsDiff(item.drawOdds, item.changedDrawOdds) > 0 ? 'greater' : 'lower'" v-if="oddsDiff(item.drawOdds, item.changedDrawOdds) != 0">
                                {{ oddsDiff(item.drawOdds, item.changedDrawOdds).toFixed(2) }}%
                            </span>
                        </td>
                        <td class="odds">
                            <b>{{ item.changedAwayOdds }}</b>
                            <span class="odds-original">{{ item.awayOdds }}</span>
                            <span class="odds-diff" :class="oddsDiff(item.awayOdds, item.changedAwayOdds) > 0 ? 'greater' : 'lower'" v-if="oddsDiff(item.awayOdds, item.changedAwayOdds) != 0">
                                {{ oddsDiff(item.awayOdds, item.changedAwayOdds).toFixed(2) }}%
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table-pagination :data="data" @sorted="sortedData = $event; dataPaginated = true"></table-pagination>
        </div>
    </div>
</template>

<script>
import TablePagination from '@/components/TablePagination.vue'
import LoadStatus from '@/components/LoadStatus.vue'

export default {
    name: 'EventsTable',
    props: ['data'],
    data() {
        return {
            sortedData: [],
            sortByHomeOddsSwitch: -1,
            sortByDrawOddsSwitch: -1,
            sortByAwayOddsSwitch: -1,
            dataPaginated: false
        }
    },
    components: {
        TablePagination,
        LoadStatus
    },
    methods: {
        oddsDiff: function(oddsOrigin, oddsChanged) {
            if(oddsOrigin && oddsChanged) {
                return ( (oddsChanged - oddsOrigin) / oddsChanged * 100 );
            } else {
                return 0;
            }
        },
        sortByHomeOdds: function(cond) {
			let _this = this;

            if(cond == 0) {
                this.data.sort(function(a, b) {
                    return (_this.oddsDiff(a.homeOdds, a.changedHomeOdds)) - (_this.oddsDiff(b.homeOdds, b.changedHomeOdds));
                });
            } else if(cond == 1) {
                this.data.sort(function(a, b) {
                    return (_this.oddsDiff(b.homeOdds, b.changedHomeOdds)) - (_this.oddsDiff(a.homeOdds, a.changedHomeOdds));
                });
            }
        },
        sortByDrawOdds: function(cond) {
            let _this = this;

            if(cond == 0) {
                this.data.sort(function(a, b) {
                    return (_this.oddsDiff(a.drawOdds, a.changedDrawOdds)) - (_this.oddsDiff(b.drawOdds, b.changedDrawOdds));
                });
            } else if(cond == 1) {
                this.data.sort(function(a, b) {
                    return (_this.oddsDiff(b.drawOdds, b.changedDrawOdds)) - (_this.oddsDiff(a.drawOdds, a.changedDrawOdds));
                });
            }
        },
        sortByAwayOdds: function(cond) {
            let _this = this;

            if(cond == 0) {
                this.data.sort(function(a, b) {
                    return (_this.oddsDiff(a.awayOdds, a.changedAwayOdds)) - (_this.oddsDiff(b.awayOdds, b.changedAwayOdds));
                });
            } else if(cond == 1) {
                this.data.sort(function(a, b) {
                    return (_this.oddsDiff(b.awayOdds, b.changedAwayOdds)) - (_this.oddsDiff(a.awayOdds, a.changedAwayOdds));
                });
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@keyframes oddsAnimation {
    0% {
        top: -2px;
    }
    50% {
       top: 0;
    }
    100% {
        top: -2px;
    }
}

.table {
    color: $globalFontColor;
    position: relative;

    td, th {
        padding: 17px 25px;
        text-align: left;
        vertical-align: middle;
        border: 0;
    }
    
    thead {
        background: $globalColor;

        th {
            border: 0;
            padding-top: 20px;
            padding-bottom: 20px;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: $baseLetterSpacing;
            
            &:first-child {
                border-radius: $globalBorderRadius 0 0 0;
                padding: 20px 15px 20px 35px;
            }

            &:last-child {
                border-radius: 0 $globalBorderRadius 0 0;
                padding: 20px 35px 20px 15px;
            }
        }
    }

    tbody {
        font-size: 1.4rem;

        b {
            font-weight: 600;
        }

        td {
            border-bottom: 1px solid rgba($white, 0.08);
            background: rgba($black, 0.2);
            line-height: 1;
            transition: all 0.2s ease-in-out;

            &:first-child {
                padding: 17px 15px 17px 35px;
            }

            &:last-child {
                padding: 17px 35px 17px 15px;
            }

            small {
                font-size: 1.4rem;
                display: block;
                padding-top: 5px;
            }
        }

        tr {
            &:last-child td {
                border-bottom: 0;

                &:first-child {
                    border-radius: 0 0 0 $globalBorderRadius;
                }

                &:last-child {
                    border-radius: 0 0 $globalBorderRadius 0;
                }
            }

            &:hover,
            &:active,
            &:focus {
                td {
                    background: rgba($black, 0.1);
                }
            }
        }

        .marketNumber {
            font-size: 2rem;
            letter-spacing: 3px;
        }
    }
}

table .odds {
    text-align: center;
    font-size: 1.5rem;
    position: relative;

    &-original {
        display: inline-block;

        &:before {
            content: '|';
            padding: 0 4px;
        }
    }

    &-diff {
        display: block;
        padding-top: 5px;
        display: flex;
        align-items: center;
        justify-content: center;

        &.greater,
        &.lower {
            &:after {
                font-family: "tippmixoddsinfo-icons";
                animation: oddsAnimation 0.8s linear infinite;
                position: relative;
            }
        }

        &.greater {
            color: $globalColor;

            &:after {
                content: '\0047';
                vertical-align: middle;
                font-size: 0.7rem;
                transform: rotate(-180deg);
                display: inline-block;
                padding-right: 3px;
            }
        }

        &.lower {
            color: $globalSecondaryColor;

            &:after {
                content: '\0047';
                vertical-align: middle;
                font-size: 0.7rem;
                display: inline-block;
                padding-left: 3px;
            }
        }
    }
}

.clickable {
    cursor: pointer;
    
    .table thead & {
        padding: 17px 10px;
        text-align: center;
        white-space: nowrap;
    }
}

.sorting-icon {
    font-size: 0.9rem;
}

</style>