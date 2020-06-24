
<template>
  <b-modal ref="add-product-modal" id="modal-1" title="BootstrapVue">
    <p class="my-4">Hello from modal!</p>
  </b-modal>
</template>

    <script>
export default {
  props: {
    product: {
      required: false,
    },

  },
  mounted(){
      console.log(this.product)
  },
  methods: {
    close() {
      this.$emit("input", !this.value);
    }
  }
};
</script>


    <style lang="css" scoped>
.modal {
  background-color: rgba(0, 0, 0, 0.7);
}
</style>
