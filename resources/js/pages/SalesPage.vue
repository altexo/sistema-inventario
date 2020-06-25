<template>
  <div class="col-md-12">
    <h2>Venta</h2>
    <div class="col-md-12 shadow-lg p-4 mb-5 rounded bg-white">
      <div class="col-md-9 shadow p-4 mb-1 bg-white rounded">
        <search-bar-component @addedProduct="handleAddProduct"></search-bar-component>
      </div>
      <div class="col-md-9 shadow p-4 mb-5 bg-white rounded border">
        <!-- <h4>Productos</h4> -->
        <sale-grid-component :key="componentKey"></sale-grid-component>
      </div>
      <div class="col-md-9 d-flex justify-content-end">
        <button class="btn btn-success" v-b-modal="'save-sale'">Finalizar Venta</button>
      </div>
    </div>
    <!-- Modal -->
    <b-modal variant="bg-primary text-white" id="save-sale" hide-footer title="Terminar venta">
      <div class="form-check mb-1">
        <input class="form-check-input" v-model="saleDetails.printSale" type="checkbox" value id="printCheckbox" checked />
        <label class="form-check-label" for="printCheckbox">Imprimir</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" v-model="saleDetails.invoiceSale" type="checkbox" value id="invoiceCheckbox" />
        <label class="form-check-label" for="invoiceCheckbox">Facturar</label>
      </div>
      <div class="form-group mt-3">
        <label for="addNotetextarea">Añadir Nota</label>
        <textarea class="form-control" v-model="saleDetails.noteSale" id="addNotetextarea" rows="3"></textarea>
      </div>
      <div class="align-items-end">
        <b-button class variant="outline-danger">Cancelar</b-button>
        <b-button class variant="outline-primary" @click="saveSale">Guardar Venta</b-button>
      </div>
    </b-modal>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      componentKey: 0,
      saleDetails:{
        printSale: true,
        invoiceSale: false,
        noteSale: null
      }
    };
  },
  methods: {
    handleAddProduct(item) {
      this.componentKey += 1;
      // console.log('item from child', item)
    },
    saveSale(){
      axios.post('sale/save', this.saleDetails).then(response => (this.handleAddProduct())).catch(err => (err))
      console.log(this.saleDetails)
    }
  }
};
</script>

<style>
</style>