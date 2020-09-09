<template>
  <Datepicker :language="es" :name="name" :format="customFormatter" :bootstrap-styling="true" input-class="col-md-11" :value="value"></Datepicker>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { en, es } from "vuejs-datepicker/dist/locale";
import moment from 'moment'
export default {
  components: {
    Datepicker,
  },
  props: {
    name: String,
    value: {
      type: String, 
      default: ''
      }
  },
  methods: {
    customFormatter(date) {
      return moment(date).format("YYYY-MM-DD");
    },
  },
  data() {
    return {
      en: en,
      es: es,
    };
  },
};
</script>

<style>
</style>