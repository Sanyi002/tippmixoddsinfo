<template>
    <div id="navbar">
        <nav class="container">
            <div class="navbar-row d-flex align-items-center">
                <div class="logo">
                    <a href="/"><img src="../assets/logo.svg"></a>
                </div>
                <ul class="navbar-list">
                    <router-link class="navbar-item" tag="li" active-class="active" to="/" exact>Főoldal</router-link>
                    <router-link class="navbar-item" tag="li" active-class="active" to="/contact">Kapcsolat</router-link>
                    <router-link class="navbar-item" tag="li" active-class="active" to="/help">Súgó</router-link>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'navbar'
}
</script>

<style scoped lang="scss">
nav {
    display: flex;
    align-items: center;
}

.logo {
    margin-right: auto;
}

.navbar {
    &-row {
        width: calc(100% + 30px);
    }

    &-list {
        list-style-type: none;
        margin: 0 -25px 0 auto;
        padding: 0;
    }

    &-item {
        display: inline-block;
        padding: 0 25px;
        letter-spacing: 0.48px;
        line-height: $navbarHeight;
        position: relative;
        cursor: pointer;
        transition: $transitionBase;

        &:before {
            content: '';
            background: $globalColor;
            position: absolute;
            border-radius: $globalBorderRadius;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 50px);
            height: 5px;
            opacity: 0;
            transition: $transitionBase;
        }

        &:hover,
        &:active,
        &:focus {
            color: $linkColor;
        }

        &.active {
            color: $linkColor;
            font-weight: 600;

            &:before {
                opacity: 1;
            }
        }
    }
}
</style>