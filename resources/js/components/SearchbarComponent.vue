<template>
  <div class="col-md-12">
    <div>
      <!-- <input type="text" placeholder="Search" v-model="query" /> -->
      <div id="custom-search-input">
        <div class="input-group">
          <input type="text" class="search-query form-control border border-secondary" v-model="query" placeholder="Buscar Producto" />
          <span class="input-group-btn">
            <button type="button" disabled>
              <span class="fa fa-search"></span>
            </button>
          </span>
        </div>
      </div>
      <ul class="list-group"  v-if="results.length > 0 && query">
        <li v-for="result in results.slice(0,10)" :key="result.id" class="list-group-item">
            <div v-text="result.title"></div>
        </li>
      </ul>
      <!-- <ul v-if="results.length > 0 && query">
        <li v-for="result in results.slice(0,10)" :key="result.id">
          <a :href="result.url">
            <div v-text="result.title"></div>
          </a>
        </li>
      </ul> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      query: null,
      results: [],
      
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
        .get("products/search", { params: { query: this.query } })
        .then(response => (this.results = response.data, console.log('Response from search: ',response)))
        .catch(error => {});
    }
  }
};
</script>

<style>
</style>