<template>
    <div class="load-status module">
        <div class="loader-wrapper">
            <span class="loader"></span>
            <span class="loader"></span>
            <span class="loader"></span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'loader-status'
}
</script>

<style lang="scss" scoped>
@keyframes scale {
    0% { opacity: 0.4 }
    50% { opacity: 1 }
    100% { opacity: 0.4 }
}

.load-status {
    position: absolute;
    width: 100%;
    text-align: center;
    padding: 40px 0;
    background: $globalBackground;
    z-index: 99;
}

.loader {
    width: 8px;
    height: 8px;
    margin: 5px;
    display: inline-block;
    border-radius: 100%;
    animation: scale 2s infinite linear;
    background-color: $white;
    
    &:nth-child(1) {
      animation-delay: 0s;
    }
    &:nth-child(2) {
      animation-delay: 0.3s;
    }
    &:nth-child(3) {
      animation-delay: 0.6s;
    }
}
</style>