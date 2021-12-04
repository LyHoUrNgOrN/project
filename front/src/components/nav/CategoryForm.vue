<template>

  <div class="bootstrap-modal-no-jquery" >
    <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom-0">
            <h5 class="modal-title" v-if="isCreate">Create New Category</h5>
            <h5 class="modal-title" v-else>Update Category Here</h5>
          </div>
          <div class="modal-body">
            <div class="form_input">
              <input v-show ="updatecrategory === null" v-model="categoryName" type="text" placeholder="category name">
              <input v-show ="updatecrategory !== null" v-model="updatecrategory" type="text" placeholder="category name">
              <small>{{error}}</small>
            </div>
          </div>
          <div class="modal-footer border-top-0 buttonCreate">
            <button type="button" class="btn-cancel" @click="cancelCreateCategory">DISCARD</button>
            <button type="button" class="btn-create" @click="createCategory" v-if="isCreate">CREATE</button>
            <button type="button" class="btn-update" v-else @click="updateCategory">UPDATE</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import 'bootstrap/dist/css/bootstrap.min.css'
  export default {
    emits:['create-category','cancle-create-category','update-category'],
    props:["error","isCreate","title","categoryId"],
    data(){
      return {categoryName:null,
              updatecrategory:this.title
      };
    },
    methods: {
      createCategory() {
        this.$emit('create-category',this.categoryName);
   
      },
      cancelCreateCategory() {
        this.$emit('cancle-create-category');
      },
      updateCategory(){
        this.$emit('update-category',this.updatecrategory, this.categoryId)

      }
      
    }
  }
</script>

<style scoped>
  /* Override default value of 'none' */

  .modal {
    display: block;
  }
  .form_input{
    margin-top: -10px;
  }
  .buttonCreate{
    margin-top: -10px;
  }
  .modal-content{
    background: rgb(243, 244, 247);
    border-radius: 15px;
    border: none;
    box-shadow: 0 6px 12px 0 rgba(50, 81, 90, 0.2), 0 6px 20px 0 rgba(50, 81, 90, 0.452);
    
  }
  .modal-header{
    align-items: center;
    justify-content: center;
    display: flex;
  }
  input[type=text]{
    padding-bottom: 10px;
    outline: none;
    border: none;
    background-color: #eee;
    background: rgba(179, 180, 182, 0.014);
    color: rgb(0, 0, 0);
    border-bottom: 1px solid rgb(255, 0, 13);
    width: 100%;
  }
  .btn-cancel, .btn-create, .btn-update{
    outline: none;
    border: none;
    color: white;
    padding: 5px;
    border-radius: 5px;
    font-size:12px;
    margin-bottom: 10px;
  }
  .btn-cancel{
    background:rgba(255, 0, 0, 0.658);
  }
  .btn-create{
    background:rgba(0, 0, 255, 0.705);
  }
  .btn-update{
    background: rgba(0, 128, 0, 0.692);
  }
  small{
    float: left;
  }
  ::placeholder {
  color: rgba(126, 123, 123, 0.699);
  
  
}
</style>