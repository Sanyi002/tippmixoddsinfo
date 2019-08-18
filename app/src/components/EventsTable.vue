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
                    <tr>
                        <td class="marketNumber">26089</td>
                        <td>Alavés - Levante<br><small>08.18. 19:00</small></td>
                        <td>Labdarúgás</td>
                        <td>Spanyol bajnokság</td>
                        <td>2,15<br><small>2,00</small></td>
                        <td>3,15<br><small>3,00</small></td>
                        <td>3,20<br><small>3,30</small></td>
                    </tr>
                    <tr>
                        <td class="marketNumber">26089</td>
                        <td>Alavés - Levante<br><small>08.18. 19:00</small></td>
                        <td>Labdarúgás</td>
                        <td>Spanyol bajnokság</td>
                        <td>2,15<br><small>2,00</small></td>
                        <td>3,15<br><small>3,00</small></td>
                        <td>3,20<br><small>3,30</small></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EventsTable'
}
</script>

<style lang="scss" scoped>
.table {
    color: $globalFontColor;

    td, th {
        padding: 17px 15px;
        text-align: center;
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
        font-size: 1.6rem;

        td {
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid rgba($white, 0.08);
            background: rgba($black, 0.2);

            &:first-child {
                padding: 17px 15px 17px 35px;
            }

            &:last-child {
                padding: 17px 35px 17px 15px;
            }

            small {
                font-size: 1.4rem;
            }
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .marketNumber {
            font-size: 2rem;
            letter-spacing: 3px;
        }
    }
    
}


</style>