<template>
  <div class="col-md-12 sale-table">
    <table class="table table-borderless table-hover">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Total</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{product.product.name}}</td>
          <td>{{product.sale_price}}</td>
          <td>{{product.quantity}}</td>
          <td>{{product.sale_price * product.quantity}}</td>
          <td><button class="btn btn-primary btn-sm">Delete</button></td>
        </tr>
      </tbody>
    </table>
    <div class="col-md-12 shadow p-2  row d-flex justify-content-end">
       <h4 class="mt-1 mr-3 text-right ">Total:  </h4>
       <h4 class="mt-1 mr-3 text-right "> {{total}}</h4>
    </div>
   
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data(){
    return {
      products: [],
      total: 0
    }
  },
  mounted(){
    axios.get('temp/sale/get').then(response => (console.log(response.data), this.products = response.data.in_sale, this.total = response.data.total)).catch(err => (console.log(err)))
    
  }
};
</script>

<style>
</style>