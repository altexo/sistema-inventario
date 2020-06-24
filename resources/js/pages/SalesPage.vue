<template>
  <div class="col-md-12">
    <h2>Venta</h2>
    <div class="col-md-12 shadow-lg p-4 mb-5 rounded bg-white">
      <div class="col-md-9 shadow p-4 mb-1 bg-white rounded">
        <search-bar-component @addedProduct="handleAddProduct"></search-bar-component>
      </div>
      <div class="col-md-9 shadow p-4 mb-5 bg-white rounded border">
        <!-- <h4>Productos</h4> -->
        <sale-grid-component ></sale-grid-component>
      </div>
      <div class="col-md-9 d-flex justify-content-end">
        <button class="btn btn-success">Finalizar Venta</button>
      </div>
      


     
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {}
  },
  methods: {
    handleAddProduct(item){
      // console.log('item from child', item)
    }
  }
};
</script>

<style>
</style>