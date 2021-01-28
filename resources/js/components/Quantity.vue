<template>
    <div class="quantity-toggle">
        <button @click.prevent="decrement()">&mdash;</button>
        <input type="text" :value="quantity" readonly>
        <button @click.prevent="increment()">&#xff0b;</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                quantity: 1,
            }
        },

        mounted() {
            this.$emit('input', this.quantity)
        },

        methods: {
            increment() {
                this.quantity++
                this.$emit('input', this.quantity)
            },
            decrement() {
                if (this.quantity === 1) {
                    // alert('Negative quantity not allowed')
                } else {
                    this.quantity--
                    this.$emit('input', this.quantity)
                }
            }
        }
    }
</script>

<style lang="scss">
    $border: 2px solid #ddd;

    .quantity-toggle {
        display: flex;

        input {
            border: 0;
            border-top: $border;
            border-bottom: $border;
            width: 2.0rem;
            text-align: center;
            padding: 0 .2rem;
            outline: none;
        }

        button {
            border: $border;
            padding: .1rem;
            background: white;
            color: black;
            font-size: 1rem;
            cursor: pointer;
            outline: none;
        }
    }
</style>
