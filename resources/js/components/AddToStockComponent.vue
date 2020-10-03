<template>
    <div>
    <div class="form-group form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="add_to_stock" @click="show = !show" :value="show" ref="addToStockCheckbox">
                    <label class="form-check-label" for="exampleCheck1">Registrar ingreso a este producto</label>
                </div>
                 <transition name="slide-fade">
                <div id="addToStock" class="col-md-12 shadow-sm p-3 mb-5 bg-white rounded mt-4 hidden" v-if="show">
                    <label for="inputQty">Cantidad</label>
                    <div class="input-group col-md-6 mb-4">
                       
                        <input type="number" class="form-control" name="quantity" id="inputQty" min="0"  step=".01" placeholder="e.g. 1000">
                        <div class="input-group-append">
                            <span class="input-group-text" id="quantity">KG</span>
                        </div>
                    </div>
                    <label for="inputPrice">Precio de compra</label>
                    <div class="input-group col-md-6 mb-3 ">
                        <input type="number" class="form-control" id="inputPrice" name="price" min="0"  step=".01" placeholder="e.g. 200">
                        <div class="input-group-append">
                          <span class="input-group-text">$</span>
                        </div>
                    </div>
                </div>
                </transition>

                </div>
</template>

<script>
export default {
    data() {
        return {
            show: false
        }
    },
    mounted(){
        
    
    }
//Escribir metodo de volver campos requeridos si show es === true
}
</script>

<style>
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .4s ease;
}
.slide-fade-leave-active {
  transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>