<template>
    <div class="pt-10">
        <canvas ref="chartCanvas"></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js/auto';
    export default {
        data() {
            return {
                chartjsObject: null,
            }
        },

        mounted() {
            this.chartjsObject = new Chart(this.$refs.chartCanvas, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Earnings Per Month',
                        data: [12, 19, 3, 5, 2, 3, 23, 123, 543, 535, 123],
                        backgroundColor: ['rgba(124, 58, 237)'],
                    }]
                }
            })
        }
    }
</script>