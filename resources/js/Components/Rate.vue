<template>
    <div class="flex">
        <icon name="star"
            class="w-7 h-7 cursor-pointer"
            :class="[rateValue >= i ? 'text-yellow-300 fill-current' : 'text-gray-600']"
            v-for="i in 5"
            :key="i"
            @mouseenter="rateValue=i"
            @mouseleave="rateValue=modelValue"
            @click="rate"/>
    </div>
</template>

<script>
    export default {
        props: {
            modelValue: Number
        },

        data() {
            return {
                rateValue: this.modelValue
            };
        },

        methods: {
            rate() {
                this.$emit('update:modelValue', this.rateValue)
                this.$emit('change', this.rateValue)
            }
        }
    }
</script>