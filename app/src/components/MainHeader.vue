<template>
    <header>
        <div class="container">
            <div class="row">
                <div class="content-wrapper">
                    <div class="col-md-12">
                        <h1 class="header-title">Köszöntelek a tippmixodds.info-n!</h1>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="header-description">
                            Az oldalon a népszerű hazai szerencsejátékon, a Tippmixen megfogadható események odds változásait követheted nyomon. 
                            Ha szeretnél többet megtudni az oldal működéséről, esetleg elakadtál nézd meg a <a href="/help">súgót</a>!
                        </div>
                    </div>
                    <div class="header-anchor">
                        <a href="/">
                            <span class="anchor-text">Ugrás az eseményekhez!</span>
														<span class="anchor-icon"><i class="icon-tippmixoddsinfo-double-down"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
  name: 'main-header'
}
</script>

<style lang="scss" scoped>
header {
    padding-top: 140px;
}

.content-wrapper {
    text-align: center;
    width: 100%;
}

.header {
    &-title {
        font-size: 3.8rem;
        letter-spacing: 0.57px;
        margin: 0 0 35px;
    }

    &-description {
        font-size: 1.8rem;
        line-height: 2.7rem;
        letter-spacing: 0.48px;
    }

    &-anchor {
        margin-top: 210px;
        opacity: 0.4;
        transition: $transitionBase;

        &:hover,
        &:active,
        &:focus {
            opacity: 1;
        }

        a {
						text-decoration: none;
						color: $globalFontColor;
        }
    }
}

.anchor{
	&-text {
		color: $globalFontColor;
    text-transform: uppercase;
    font-size: 1.4rem;
    letter-spacing: 0.44px;
	}
	
	&-icon {
		display: block;
		font-size: 3rem;
		padding-top: 15px;
	}
}

</style>
