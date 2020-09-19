<template>
  <div class="col-md-12">
    <h2>Venta</h2>
    <div class="col-md-12 shadow-lg p-4 mb-5 rounded bg-white">
      <div class="col-md-12 shadow p-4 mb-1 bg-white rounded">
        <search-bar-component @addedProduct="handleAddProduct"></search-bar-component>
      </div>
      <div class="col-md-12 shadow p-4 mb-5 bg-white rounded border">
        <!-- <h4>Productos</h4> -->
        <sale-grid-component :key="componentKey"></sale-grid-component>
      </div>
      <div class="col-md-12 d-flex justify-content-end">
        <button class="btn btn-success" v-b-modal="'save-sale'">Finalizar Venta</button>
      </div>
    </div>
    <!-- Modal -->
    <b-modal ref="save-sale-modal"  id="save-sale" hide-footer title="Terminar venta" header-class="bg-primary-dark text-white">
      <div class="form-check mb-1">
        <input class="form-check-input" v-model="saleDetails.printSale" type="checkbox" value id="printCheckbox" checked />
        <label class="form-check-label" for="printCheckbox">Imprimir</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" v-model="saleDetails.invoiceSale" type="checkbox" value id="invoiceCheckbox" />
        <label class="form-check-label" for="invoiceCheckbox">Facturar</label>
      </div>
       <div class="form-group mt-3">
           <input type="text" class="form-control" id="clientName" v-model="saleDetails.clientName" aria-describedby="clientNameHelp" placeholder="">
        <label for="clientName">Nombre del Cliente</label>
      </div>
      <div class="form-group mt-3">
        <label for="addNotetextarea">Añadir Nota</label>
        <textarea class="form-control" v-model="saleDetails.noteSale" id="addNotetextarea" rows="3"></textarea>
      </div>
     
      <div class="align-items-end">
        <b-button class variant="outline-danger" @click="cancelSale">Cancelar</b-button>
        <b-button class variant="outline-primary" @click="saveSale">Guardar Venta</b-button>
      </div>
    </b-modal>
    <!-- Modal response -->
    <b-modal ref="modal-response" :header-class="headerColor"  >
      <p>{{responseMsg}}</p>
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
        noteSale: null,
        clientName: null
      },
      responseMsg: "",
      headerColor: "bg-sucess text-white"
    };
  },
  methods: {
    handleAddProduct(item) {
      this.componentKey += 1;
      // console.log('item from child', item)
      this.$refs["save-sale-modal"].hide();
    },
    cancelSale(){
      this.$refs["save-sale-modal"].hide();
      window.open("print/invoice", "_blank");  
    },
    saveSale(){
      axios.post('save', this.saleDetails).then(response => (console.log(response), this.HandleResponse(response.data) ,this.handleAddProduct())).catch(err => (console.log('Error', err) ))
      

       this.$refs["save-sale-modal"].hide();
       
    },

    HandleResponse(response){
      if(response.success === true){
        this.responseMsg = "La venta  se guardó exitosamente."
        this.headerColor = "bg-success text-white"
       
      }else{
        this.responseMsg = "La venta no pudo guardarse correctamente."
        this.headerColor = "bg-danger text-white"
        //Show error modal
      }
      this.$refs["modal-response"].show();
      this.printInvoice()
    },
    printInvoice(){
      window.open("print/invoice", "_blank");  
    }
  }
};
</script>

<style>
</style>