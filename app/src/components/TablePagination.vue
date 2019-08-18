<template>
    <div id="table-pagination" class="pagination-wrapper">
        <span class="sort-info">
            <b>{{ pageNumber }}</b> / {{ allPage }} Oldal
        </span>
        <ul class="pagination-list">
            <li class="pagination-link pagination-prev" :class="{ 'disabled' : pageNumber <= 1 }" @click="prevPage()"><i class="icon-tippmixoddsinfo-left-arrow-light"></i></li>
            <li class="pagination-link pagination-selector">
                <div class="form-group">
                    <select class="form-control" v-model="pageNumber">
                        <option v-for="(item, key) in allPage" :key="key" :value="item">
                            {{ item }}
                        </option>
                    </select>
                </div>
            </li>
            <li class="pagination-link pagination-next" @click="nextPage()"><i class="icon-tippmixoddsinfo-right-arrow-light"></i></li>
        </ul>
    </div>    
</template>

<script>
export default {
    name: 'table-pagination',
    data() {
        return {
            paginatedData: [],
            pageNumber: 1,
            perPage: 10
        }
    },
    props: ['data'],
    methods: {
        nextPage: function() {
            if((this.pageNumber * this.perPage) < this.data.length) {
                this.pageNumber++;
            }
        },
        prevPage: function() {
            if(this.pageNumber > 1) {
                this.pageNumber--
            }
        }
    },
    computed: {
        sortedData: function()  {
            return this.data.filter((row, index) => {
                let start = (this.pageNumber-1) * this.perPage;
                let end = this.pageNumber * this.perPage;
                if(index >= start && index < end) return true;
            })
        },
        allPage: function() {
            let dataItemNumber = this.data.length;
            return Math.ceil(dataItemNumber/this.perPage);
        }
    },
    watch: {
        sortedData(newValue) {
            this.$emit('sorted', newValue);
        }
    }
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

        &:not(.pagination-selector):not(.disabled) {
            &:hover,
            &:active,
            &:focus {
                background: $globalLightColor;
                color: $globalDarkColor;
            }
        }

        &.disabled {
            opacity: 0.3;
            cursor: auto;
        }
    }

    &-selector {
        border: 0;
        width: $paginationWidth + 30px;

        .form-group {
            margin: 0;
            width: 100%;
            position: relative;

            &:before {
                content: '\0048';
                font-family: 'tippmixoddsinfo-icons';
                position: absolute;
                color: $globalFontColor;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                font-size: 1rem;
                line-height: 1;
                z-index: 0;
            }
        }

        .form-control {
            appearance: none;
            border: 1px solid $globalLightColor;
            border-radius: $globalBorderRadius;
            font-size: 1.6rem;
            background: transparent;
            text-align: center;
            color: $globalFontColor;
            padding: 0 15px;
            width: 100%;
            height: $paginationHeight;
            cursor: pointer;
            font-weight: 600;
            z-index: 1;
            position: relative;
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