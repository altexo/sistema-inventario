<template>
    <Datepicker :language="es"></Datepicker>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
export default {
    components: {
        Datepicker
    },
    data () {
            return {
            en: en,
            es: es
            }
        }
}
</script>

<style>

</style>