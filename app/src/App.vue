<template>
  <div class="page-body">
    <navbar></navbar>
    <div id="tippmixoddsinfo-app">
      <router-view/>
    </div>
    <main-footer></main-footer>
  </div>
  
</template>

<script>
import Navbar from '@/components/Navbar.vue'
import MainFooter from '@/components/MainFooter.vue'

export default {
  components: {
    Navbar,
    MainFooter
  }
}
</script>

<style lang="scss">
@import "./styles/_globals.scss";

.page-body {
	display: flex;
	flex-direction: column;
	height: 100%;
}

@font-face {
    font-family: 'tippmixoddsinfo-icons';
    src: url('./assets/fonts/tippmixoddsinfo-icons.eot');
    src: url('./assets/fonts/tippmixoddsinfo-icons.eot?#iefix') format('embedded-opentype'),
         url('./assets/fonts/tippmixoddsinfo-icons.woff') format('woff'),
         url('./assets/fonts/tippmixoddsinfo-icons.ttf') format('truetype'),
         url('./assets/fonts/tippmixoddsinfo-icons.svg#tippmixoddsinfo-icons') format('svg');
    font-weight: normal;
    font-style: normal;
}
[class*='icon-tippmixoddsinfo']:before{
	display: inline-block;
   font-family: 'tippmixoddsinfo-icons';
   font-style: normal;
   font-weight: normal;
   line-height: 1;
   -webkit-font-smoothing: antialiased;
   -moz-osx-font-smoothing: grayscale
}
.icon-tippmixoddsinfo-calendar:before{content:'\0041';}
.icon-tippmixoddsinfo-double-down:before{content:'\0042';}
.icon-tippmixoddsinfo-filter:before{content:'\0043';}
.icon-tippmixoddsinfo-globe:before{content:'\0044';}
.icon-tippmixoddsinfo-soccer-ball:before{content:'\0045';}
.icon-tippmixoddsinfo-trophy:before{content:'\0046';}
.icon-tippmixoddsinfo-down-arrow:before{content:'\0047';}
.icon-tippmixoddsinfo-down-arrow-light:before{content:'\0048';}
.icon-tippmixoddsinfo-instagram:before{content:'\0049';}
.icon-tippmixoddsinfo-spinner:before{content:'\004a';}
.icon-tippmixoddsinfo-up-arrow:before{
  content:'\0047';
  transform: rotate(180deg);
}
.icon-tippmixoddsinfo-left-arrow-light:before{
  content:'\0048';
  transform: rotate(90deg);
}
.icon-tippmixoddsinfo-right-arrow-light:before{
  content:'\0048';
  transform: rotate(-90deg);
}
.icon-tippmixoddsinfo-double-right:before{
  content:'\0042';
  transform: rotate(-90deg);
}
</style>
