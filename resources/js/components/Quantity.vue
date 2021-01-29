<template>
    <div class="quantity-toggle">
        <button @click.prevent="decrement()" :disabled="decrementDisabled">&mdash;</button>
        <input type="text" v-model.number="currentValue" readonly :min="min" :max="max">
        <button @click.prevent="increment()" :disabled="incrementDisabled">&#xff0b;</button>
    </div>
</template>

<script>
    export default {
        props: {
            disabled: Boolean,
            max: {
                type: Number,
                default: Infinity
            },
            min: {
                type: Number,
                default: -Infinity
            },
            value: {
                required: true
            },
        },

        data() {
            return {
                currentValue: this.value,
                decrementDisabled: false,
                incrementDisabled: false,
            }
        },

        watch: {
            value(val) {
                this.currentValue = val
            }
        },

        mounted() {
            this.$emit('input', 1)
        },

        methods: {
            increment() {
                if (this.disabled || this.incrementDisabled) {
                    return
                }

                let newVal = this.currentValue + 1
                this.decrementDisabled = false

                this._updateValue(newVal)
            },
            decrement() {
                if (this.disabled || this.decrementDisabled) {
                    return
                }

                let newVal = this.currentValue + -1
                this.incrementDisabled = false

                this._updateValue(newVal)
            },
            _updateValue(newVal) {
                const oldVal = this.currentValue

                if (oldVal === newVal || typeof this.value !== 'number') {
                    return
                }
                if (newVal <= this.min) {
                    newVal = this.min
                    this.decrementDisabled = true
                }
                if (newVal >= this.max) {
                    newVal = this.max
                    this.incrementDisabled = true
                }
                this.currentValue = newVal
                this.$emit('input', this.currentValue)
            }
        }
    }
</script>

<style lang="scss" scoped>
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
