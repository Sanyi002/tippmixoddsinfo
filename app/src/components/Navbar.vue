<template>
    <div id="navbar">
        <nav class="container">
            <div class="navbar-row d-flex align-items-center">
                <div class="logo">
                    <a href="/"><img src="../assets/logo.svg"></a>
                </div>
                <ul class="navbar-list">
                    <li class="navbar-item active"><a href="">Főoldal</a></li>
                    <li class="navbar-item"><a href="">Kapcsolat</a></li>
                    <li class="navbar-item"><a href="">Súgó</a></li>
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
        }

        a,
        a:visited {
            color: $globalFontColor;
            text-decoration: none;
        }

        a:hover,
        a:active,
        a:focus {
            color: $linkColor;
        }

        &.active {
            &:before {
                opacity: 1;
            }

            a {
                color: $linkColor;
                font-weight: 600;
            }
        }
    }
}
</style>