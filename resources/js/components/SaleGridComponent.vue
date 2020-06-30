<template>
  <div class="col-md-12 sale-table">
    <table class="table table-bordered table-hover">
      <thead>
        <tr class="bg-dark text-white shadow">
          <th scope="col">Producto</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in products" :key="product.id">
          <td>{{product.product.name}}</td>
          <td>{{product.sale_price}}</td>
          <td>{{product.quantity}}</td>
          <td>{{product.sale_price * product.quantity | currency('$', 2, {decimalSeparator: '.'})}}</td>
          <td><button @click="removeFromSale(product.id, index)" class="btn btn-danger btn-sm">Borrar</button></td>
        </tr>
      </tbody>
    </table>
    <div class="col-md-12 shadow p-2  row d-flex justify-content-end">
       <h4 class="mt-1 mr-3 text-right ">Total:  </h4>
       <h4 class="mt-1 mr-3 text-right ">{{total | currency('$', 2, {decimalSeparator: '.'})}}</h4>
    </div>
   
  </div>
</template>

<script>
import axios from 'axios'
import Vue2Filters from 'vue2-filters'
export default {
  data(){
    return {
      products: [],
      total: 0
    }
  },
  mounted(){
  
    this.getTempSale()
    
  },
   methods:{
     removeFromSale(id, index){
       //Faltan validaciones y handle error
       axios.get('temo/sale/delete/'+id).then(response => (
        //  this.$delete(this.products, index)
        this.getTempSale()))
         .catch(err => (console.log('Error deleting', err)))
     },
     getTempSale(){
       axios.get('temp/sale/get').then(response => (console.log(response.data), this.products = response.data.in_sale, this.total = response.data.total)).catch(err => (console.log(err)))
     }
   }
};
</script>

<style>
</style>