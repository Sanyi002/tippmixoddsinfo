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
                        <th>Hazai</th>
                        <th>Döntetlen</th>
                        <th>Vendég</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, key) in data" :key="key">
                        <td class="marketNumber">{{ item.marketNumber }}</td>
                        <td>
                            <b>{{ item.eventName }}</b>
                            <br>
                            <small>{{ item.eventDate }}</small>
                        </td>
                        <td>{{ item.sportName }}</td>
                        <td>{{ item.leagueName }}</td>
                        <td class="odds"><b>{{ item.changedHomeOdds }}</b><br><small>{{ item.homeOdds }}</small></td>
                        <td class="odds"><b>{{ item.changedDrawOdds }}</b><br><small>{{ item.drawOdds }}</small></td>
                        <td class="odds"><b>{{ item.changedAwayOdds }}</b><br><small>{{ item.awayOdds }}</small></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EventsTable',
    props: ['data']
}
</script>

<style lang="scss" scoped>
.table {
    color: $globalFontColor;

    td, th {
        padding: 17px 15px;
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

        .odds {
            text-align: center;
            font-size: 1.5rem;
            
            small {
                font-size: 1.2rem;
            }
        }
    }
    
}


</style>