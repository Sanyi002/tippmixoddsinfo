<template>
    <footer>
        <div class="container">
            <div class="footer-wrapper">
                <div class="copyright">
                    <a href="/">tippmixodds.info</a>
                    <span class="year">2019</span>
                </div>
                <div class="personal-logo">
                    <a target="_blank" href="http://sandorszabo.site/">
                        <img src="../assets/sandorszaboLogo.svg" >
                    </a>
                </div>
                <div class="socials">
                    <a href="/">
                    <i class="icon-tippmixoddsinfo-instagram"></i>
                    Kövesd az oldalt Instagramon is!
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'main-footer'
}
</script>

<style lang="scss" scoped>
footer {
    background: rgba($black, 0.2);
    display: inline-block;
    width: 100%;
    height: $footerHeight;
    margin-top: auto;
}

.footer {
    &-wrapper {
        font-size: 1.2rem;
        display: flex;
        justify-content: space-between;
        padding: 15px 0;

        a,
        a:visited {
            color: $globalFontColor;
            opacity: 0.5;
        }

        a:hover,
        a:focus,
        a:active {
            opacity: 1;
        }
    }
}

.socials {
    i {
        font-size: 2rem;
        vertical-align: middle;
        padding-right: 10px;
    }

    a {
        text-decoration: none;
    }   
}

.copyright {
    display: flex;
    align-items: center;

    span {
        opacity: 0.5;
        
        &:before {
            content: '|';
            display: inline-block;
            padding: 0 5px;
        }
    }
}
</style>