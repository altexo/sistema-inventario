<template>
  <div class="col-md-12">
    <div>

      <!-- <input type="text" placeholder="Search" v-model="query" /> -->
      <div id="custom-search-input">
        <div class="input-group">
          <input
            type="text"
            class="search-query form-control border border-secondary"
            v-model="query"
            placeholder="Buscar Producto"
          />
          <span class="input-group-btn">
            <button  type="button" disabled>
              <span class="fa fa-search"></span>
            </button>
          </span>
        </div>
      </div>
      <ul class="list-group" v-if="results.length > 0 && query">
        <li v-for="result in results.slice(0,10)" :key="result.id" class="list-group-item">
          <div v-text="result.name" @click="showModal(result)"></div>
        </li>
      </ul>
    </div>

    <!-- Modal -->
    <b-modal   ref="add-product-modal" header-class="bg-primary-dark text-white" id="modal-1" hide-footer :title="item.name">
      <p class="text-black">Disponible en inventario: <span>{{item.in_stock}}</span></p>
      <div class="form-group">
        <label for="priceInput">Precio de venta</label>
        <input
          type="number"
          class="form-control"
          id="priceInput"
          v-model="toAdd.price"
        />

      </div>
        <div class="form-group">
        <label for="qtyInput">Cantidad</label>
        <input
          type="number"
          class="form-control"
          id="qtyInput"
          v-model="toAdd.quantity"
        />

      </div>
      <div class="align-items-end">
        <b-button class="" variant="outline-danger"  @click="cancelAdd">Cancelar</b-button>
      <b-button class="" variant="outline-primary"  @click="addProduct({toAdd: toAdd, details: item})">Añadir</b-button>

      </div>
    </b-modal>

  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      query: null,
      item: { name: null, quantity: null, searchable: Object },
      results: [],
       toAdd:{price: null, quantity: null},
    };
  },
  watch: {
    query(after, before) {
      this.searchMembers();
    }
  },
  methods: {
    searchMembers() {
      axios
        .get("sale/products/search", { params: { query: this.query } })
        .then(
          response => (
            (this.results = response.data),
            console.log("Response from search: ", response)
          )
        )
        .catch(error => {});
    },
    showModal(item) {
      this.item = item;
      this.$refs["add-product-modal"].show();
    },
    cancelAdd(){
      // console.log('closed')
      this.toAdd.price = null
      this.toAdd.quantity = null

     this.$refs["add-product-modal"].hide();
    },
    addProduct(item){
      axios.post('sale/temp/sale/store', {item}).then(response => (console.log(response), this.cleanInputs())).catch(err => (console.log(err)))
       this.$emit('addedProduct', item);
       this.$refs["add-product-modal"].hide();
    },
    cleanInputs(){
           this.toAdd.price = null
        this.toAdd.quantity = null
        this.query = null
    }
  }
};
</script>

<style>
</style>