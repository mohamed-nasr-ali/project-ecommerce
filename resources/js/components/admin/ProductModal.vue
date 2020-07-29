<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container">
        <div class="modal-header">
          <slot name="header" >
              <h1>Product</h1>
          </slot>
        </div>

        <div class="modal-body">
          <slot name="body">
              <div class="form-group row">
                  <label for="staticName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                      <input type="text" v-model="data.name" class="form-control" id="staticName" placeholder="Product Name">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputUnits" class="col-sm-2 col-form-label">Units</label>
                  <div class="col-sm-10">
                      <input type="text" v-model="data.units" class="form-control" id="inputUnits" placeholder="Units">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                  <div class="col-sm-10">
                      <input type="text" v-model="data.price" class="form-control" id="inputPrice" placeholder="Price">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                      <textarea class="form-control" id="inputDescription" v-model="data.description" placeholder="description"></textarea>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="file" class="col-sm-2 col-form-label">Product Image</label>
                  <div class="col-sm-10">
                      <input type="file" id="file" @change="attachFile">
                      <img class="image-preview" width="100" height="100" :src="'/'+data.image" v-show="data.image != null">
                  </div>
              </div>
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button class="modal-default-button" @click="uploadFile">
              Finish
            </button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    props : ['product'],
    data(){
      return {
        attachment : null
      }
    },
    computed : {
      data : function(){
        if(this.product != null){
          return this.product
        }
        else {
          return {
            name : "",
            units : "",
            price : "",
            description : "",
            image : false
          }
        }
      }
    },
    methods : {
      attachFile(event){
        this.attachment = event.target.files[0];
          if (event.target.files[0]) {
              $('.image-preview').css('display', 'block');
              var reader = new FileReader();
              reader.onload = function (e) {

                  $('.image-preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(event.target.files[0]);
          }
      },
      uploadFile(event){
        if(this.attachment !== null){
          var formData = new FormData();
          formData.append("image", this.attachment)
          axios.post("/api/upload-file", formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
          .then(response => {
            this.product.image = response.data
              this.$emit('close', this.product)
              this.attachment=null
              document.getElementById('file').value = "";
          })
        }
        else {
            this.$emit('close', this.product)
            this.attachment=null
            document.getElementById('file').value = "";
        }
      }
    }
  }
</script>
<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 60%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
