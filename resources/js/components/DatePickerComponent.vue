<template>
  <Datepicker 
    :language="es" 
    :name="name" 
    :format="customFormatter" 
    :bootstrap-styling="true" 
    :value="value" 
    :input-class="inputClass"
    :id="id"
    :clear-button="true"
    :calendar-button="true"
    ></Datepicker>
    
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
      },
    id:{
      type: String,
      default: ''
    },
    inputClass:{
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