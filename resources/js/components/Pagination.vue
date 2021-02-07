<template>
    <!-- Pagination -->
    <nav id="stickyblock-end" class="text-center" aria-label="Page Navigation">
        <ul class="list-inline">
            <li class="list-inline-item float-left g-hidden-xs-down">
                <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                    aria-label="Previous" :class="isFirst" @click="prev">
                    <span aria-hidden="true">
                        <i class="fa fa-angle-left g-mr-5"></i> Previous
                    </span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="list-inline-item" v-for="(page, index) in meta.last_page" :key="index">
                <a class="u-pagination-v1__item u-pagination-v1-4 g-rounded-50 g-pa-7-14" @click="switchPage(page)" :class="meta.current_page === page ? 'u-pagination-v1-4--active' : ''"><span>{{ page }}</span></a>
            </li>
            <li class="list-inline-item float-right g-hidden-xs-down">
                <a class="u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16"
                    aria-label="Next" :class="isLast" @click="next">
                    <span aria-hidden="true">
                        Next <i class="fa fa-angle-right g-ml-5"></i>
                    </span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- End Pagination -->
</template>

<script>
export default {
    props: {
        meta: {
            type: Object,
            required: true
        },
        links: {
            type: Object,
            default: null
        }
    },

    computed: {
        isFirst () {
            return this.meta.current_page === 1 ? 'disabled' : '';
        },

        isLast () {
            return this.meta.current_page === this.meta.last_page ? 'disabled' : '';
        }
    },

    methods: {
        switchPage (currentPage = this.meta.current_page) {
            this.$router.push({
                name: this.$route.name,
                query: {
                    page: currentPage,
                    q: this.$route.query.q,
                },
            });
        },

        prev () {
            if (! this.isFirst) {
                this.meta.current_page--;
            }
            this.switchPage();
        },

        next () {
            if (! this.isLast) {
                this.meta.current_page++;
            }
            this.switchPage();
        },
    }
}
</script>

<style lang="scss" scoped>
    .u-pagination-v1__item {
        &:hover {
            span {
                color: rgb(114,192,44);
            }
        }

        &.disabled {
            pointer-events: none;
        }

        &.u-pagination-v1-4--active {
            span {
                color: white;
            }
        }
    }
</style>
