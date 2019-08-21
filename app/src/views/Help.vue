<template>
    <div id="help-page">
        <navbar></navbar>
        <div class="container page-wrapper">
            <h1 class="page-title">
                Súgó
            </h1>
            <div class="page-content">
                <div class="help-block">
                    <h3>Hogyan működik az oldal?</h3>
                    <p>Az oldal félóránként megvizsgálja a tippmixen megfogadható események oddsait. Ha azok eltérnek a kiírás időpontjában (tehát mikor megjelent a tippmix.hu megfogadható eseményei között) megadott oddsoktól, akkor rögzíti ezeket a módosulásokat.
    FONTOS! Az oldal csak azokat az eseményeket vizsgálja, amelyek nem élők és a megfogadható kimenetelek száma maximum 3. </p>
                </div>
                <div class="help-block">
                    <h3>Odds módosulások</h3>
                    <p>A táblázatban a vastagon szedett odds mutatja az eseményhez tartozó legfrissebb szorzót. Emelett található az esemény eredeti (kiírás időpontjában) rögzített oddsa. A két szám közötti különbséget százalékos formában jelzi a táblázat. </p>
                </div>
                <div class="help-block">
                    <h3>Rendezés</h3>
                    <p>Van lehetőség az események odds eltérései alapján rendezni az adatokat. Ehhez a szorzóknál lévő oszlopnévre kell kattintani (hazai/döntetlen/vendég). </p>
                </div>
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
.help-block {
    margin-bottom: 45px;
    display: block;
}
</style>