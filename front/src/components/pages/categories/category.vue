<template>
  <div class="container">
        <!-- <button >Create</button> -->
        <botton-widget class="create_category" @click="displayFormCategory">+ Create</botton-widget>
        <div class="wrap">
            <div class="search">
               <input type="text" class="searchTerm" placeholder="What are you looking for?" v-model="searchName" @keyup="searchCategory">
               <button type="submit" class="searchButton">
                 <i class="fa fa-search"></i>
              </button>
            </div>
         </div>
         <div class="category">
             All CTEGORIES
         </div>
        <div class="category_card">
            <category-cards
                v-for="category of categoryList" :key="category.id"
                :category="category"
                :error-message="errorCategoryMessage"
                @delete="deleteCategory"
                @category-name="updateCategory"
                @category="selectCategory"
                @validate="validateMessageError"
                @remove-error-message="removeMessage"
            ></category-cards>
        </div>

        <dialog-box
            v-if="diplayedDialog"
            :title="dialogTitle"
            @close="closeDialog"
            >
            <hr>
            <label for="description" >Category Name</label>
            <input
                v-model="newCategoryName"
                placeholder="New Category Name"
                @keyup="validateMessageError(newCategoryName)"
            />
            <small class="ok" v-if="errorCategoryMessage === 'ok'"><i class="fa fa-check-circle-o" ></i>{{errorCategoryMessage}}</small>
            <small class="error" v-else >{{ errorCategoryMessage }}</small>

            <template #actions>
                <botton-widget class="create_category_btn" @click="addCategory">Create</botton-widget>
            </template>
        </dialog-box>
    </div>
</template>

<script scoped>
import axios from "../../../api/api.js";

export default {
    data(){
        return {
            categoryList: [],
            errorCategoryMessage : null,
            diplayedDialog: false,
            newCategoryName: "",
            searchName:"",
            dialogTitle: "Create New Category"
        }
    },
    methods: {
        displayAllCategory(){
            if(this.searchName === ''){ 
                axios.get("/category").then(res=>{
                this.categoryList = res.data;
                })
                }
            else {
                axios.get("/category/search/"+this.searchName).then(res=>{
                this.categoryList = res.data;
                });
            }

        },
        deleteCategory(categoryId){
            axios.delete('/category/'+categoryId).then(()=> {
                this.displayAllCategory();
            })

        },
        updateCategory(cat_id, cat_name){
            if(this.errorCategoryMessage === 'ok'){
                let newCategory = {
                    user_id:JSON.parse(localStorage.getItem("user")).id,
                    name: cat_name
                }
                axios.put('/category/'+cat_id, newCategory).then(()=>{
                    this.displayAllCategory();
                })
                .catch(error=>{
                    if (error.response) {
                        this.errorCategoryMessage = error.response.data.errors.name[0];
                    }
                });
                this.errorCategoryMessage = '';

            }

        },
        addCategory(){
            if(this.errorCategoryMessage === 'ok'){
                let newCategory = {
                user_id:JSON.parse(localStorage.getItem("user")).id,
                name: this.newCategoryName
                }
                axios.post('/category', newCategory).then(res=>{
                    this.categoryList= res.data;
                    this.errorCategoryMessage = null;
                    this.displayAllCategory();
                }).catch(error=>{
                    if (error.response) {
                        this.diplayedDialog = true;
                        this.errorCategoryMessage = error.response.data.errors.name[0];
                    }
                });
                this.diplayedDialog = false;
                this.newCategoryName = '';
                this.errorCategoryMessage = '';
            }
        },
        validateMessageError(name){
            if (name !== ''){
                let as = this.categoryList.filter((category) => category.name === name);
                if(as.length === 0){
                    this.errorCategoryMessage = 'ok';

                }else{
                    this.errorCategoryMessage = 'This category already exist';

                }
            }else{
                this.errorCategoryMessage = 'Category name cannot be null';

            }
           
        },
        removeMessage(none){
            this.errorCategoryMessage = none;
        },
        displayFormCategory(){
            this.diplayedDialog = true;
        },
        closeDialog() {
            this.diplayedDialog = false;
            this.errorCategoryMessage = null;
        },
        searchCategory(){
            this.displayAllCategory();
            
        },

    },
    mounted() {
        this.displayAllCategory();  
        localStorage.setItem('path', this.$route.path);

    },
}
</script>

<style scoped>
    body{
        overflow: auto;
        font-family: sans-serif;
    }
    ::-webkit-scrollbar {
        width: 0px;
    }

    .container{
        margin: auto;
        width: 70%;
    }
    
    .search {
        width: 80%;
        position: relative;
        display: flex;
        margin: auto;
        margin-top: 40px;
    }

    .searchTerm {
        width: 100%;
        border: 3px solid rgb(44, 171, 209);
        border-right: none;
        padding: 10px;
        height: 20px;
        border-radius: 5px 0 0 5px;
        outline: none;
        color: black;
        font-weight: bold;
        outline: #00B4CC;

    }

    .searchTerm:focus{
        border: 3px solid #00B4CC;
        background: rgb(255, 255, 255);

    }

    .searchButton {
        width: 50px;
        /* height: 36px; */
        border: 1px solid rgb(44, 171, 209);
        background: rgb(44, 171, 209);
        text-align: center;
        color: #fff;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 20px;
        margin-top: 7px;
    }
    .category_card{
        margin-top: 50px;
    }
    

    .category{
        color: rgb(207, 207, 207);
        font-weight: bold;
        width: 80%;
        border-bottom: 2px solid gray;
        margin: auto;
        margin-top: 40px;
        margin-bottom: -20px;
        font-size: 18px;
        /* float: left; */
        text-align: left;
    }

    .create_category {
        width: 100px;
        align-self: flex-end;
        font-size: 15px;
        font-weight: bold;
        margin-left: 70%;
        margin-top: 60px;
        margin-bottom: -100px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 15px;
    }
    hr{
        margin-top: -20px;

    }
    input{
        display: block;
        width: 95%;
        border: 1px solid #ccc;
        font: inherit;
        padding: 15px;
        border-radius: 5px;
        margin-top: 7px;
    }
    .create_category_btn {
        margin-top: 0;
        width: 100px;
    }

    .ok{
        color: green;
    }
    .error{
        color: red;
    }
</style>