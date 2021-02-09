<template>
<div>
    <div class='content'>
    </div>
    <vc-date-picker
        mode='range'
        popover-visibility='visible'
        :formats='formats'
        v-model='date'
        @drag='drag = $event'>
        <div
        class='field is-expanded'
        slot-scope='{ inputValue, updateValue }'>
        <label class='label'>
            Enter Date
        </label>
        <div class="control has-icons-left has-icons-right is-expanded">
            <input
            type='text'
            placeholder='D MMM YY - D MMM YY'
            :class='["input", { "is-drag": !!drag }]'
            :value="inputValue"
            @change='updateValue($event.target.value)' />
            <span class="icon is-small is-left">
            <i class="fas fa-calendar"></i>
            </span>
            <span class='day-span'>
            {{ daySpan }}
            </span>
        </div>
        </div>
    </vc-date-picker>
</div>
</template>

<script>
const msInDay = 1000*60*60*24;
export default {
data() {
return {
    drag: null,
    date: null,
    formats: {
    input: 'D MMM YY',
    },
};
},
computed: {
daySpan() {
    const span = this.getDaySpan(this.drag || this.date);
    return (span && `${span} days`) || '';
},
},
methods: {
getDaySpan(range) {
    if (!range) return 0;
    return (range.end - range.start)/msInDay + 1;
},
},
};
</script>

<style>
.input {
min-width: 300px;
}
.is-drag {
color: #999999 !important;
}
.day-span {
position: absolute;
right: 10px;
top: 6px;
color: #999999;
}
</style>
