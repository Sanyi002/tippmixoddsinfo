<template>
    <div id="table-pagination" class="pagination-wrapper">
        <span class="sort-info">
            <b>10</b> / 20 Oldal
        </span>
        <ul class="pagination-list">
            <li class="pagination-link active">1</li>
            <li class="pagination-link">2</li>
            <li class="pagination-link">3</li>
            <li class="pagination-link">4</li>
            <li class="pagination-link pagination-next"><i class="icon-tippmixoddsinfo-right-arrow-light"></i></li>
        </ul>
    </div>    
</template>

<script>
export default {
    name: 'table-pagination'
}
</script>

<style lang="scss" scoped>
.sort-info {
    font-size: 1.5rem;
    height: 100%;
    line-height: 1;
    margin: auto 0;
    display: inline-block;
}
.pagination {
    &-wrapper {
        margin: 30px 0;
        display: flex;
    }

    &-list {
        margin: 0 0 0 auto;
        padding: 0;
        list-style-type: none;
        display: flex;
        align-items: center;
    }

    &-link {
        width: $paginationWidth;
        height: $paginationHeight;
        border-radius: $globalBorderRadius;
        border: 1px solid $globalLightColor;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 15px 0 0;
        font-weight: 600;
        transition: $transitionBase;
        cursor: pointer;

        &:last-child {
            margin: 0;
        }

        &:hover,
        &:active,
        &:focus,
        &.active {
            background: $globalLightColor;
            color: $globalDarkColor;
        }
    }

    &-prev,
    &-next {
        font-size: 1.2rem;

        i {
            display: flex;
        }
    }
}
</style>