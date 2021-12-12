<template>
  <div class="container">
        <header>
            <li class="header">All Categories</li>
        </header>
        <!-- <botton-widget class="create_category" @click="displayFormCategory">+ Create</botton-widget> -->
        <!-- <div class="wrap"> -->
            <div class="forSearch">
                <div class="search">
                    <button type="submit" class="searchButton" @click="searchCategory">
                        <i class="fa fa-search"></i>
                    </button>
                    <input type="text" class="searchTerm" placeholder="What are you looking for?" v-model="searchName" @keyup="searchCategory">
               
                </div>
                <botton-widget class="create_category" @click="displayFormCategory">+ Create</botton-widget>

            </div>
         <!-- </div> -->
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
// import EventHeader from '../../UI/Header.vue'

export default {
    data(){
        return {
            categoryList: [],
            errorCategoryMessage : null,
            diplayedDialog: false,
            newCategoryName: "",
            searchName:"",
            dialogTitle: "Create New Category",
            event_title: "All categories",
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
    },
}
</script>

<style scoped>

    header{
      /* list-style: none; */
      padding: 20px;
      background: #154360;
      color: white;
      position: sticky;
      top: 143px;
      z-index: 2;
    }
    .header{
      list-style: none;
      display: flex;
      justify-self: start;
      align-items: flex-start;
      margin-left: 20px;
      font-size: 20px;

    }
    body{
        overflow: auto;
        font-family: sans-serif;
    }
    ::-webkit-scrollbar {
        width: 0px;
    }

    .container{
        margin: auto;
        width: 100%;
    }

    .search {
        width: 80%;
        /* position: relative; */
        display: flex;
        margin: auto;
        margin-top: 40px;
        margin-left: -0.1%;
    }
    .forSearch{
        width: 80%;
        display: flex;
        justify-content: space-between;
        margin: auto;
    }
    .searchTerm {
        width: 50%;
        border: 3px solid #154360;
        border-left: none;
        padding: 10px;
        height: 20px;
        border-radius: 0 5px 5px 0;
        outline: none;
        color: black;
        font-weight: bold;

    }

    .searchButton {
        width: 50px;
        /* height: 36px; */
        border: 1px solid #154360;
        background: #154360;
        text-align: center;
        color: #fff;
        border-radius: 5px 0 0 5px;
        cursor: pointer;
        font-size: 20px;
        margin-top: 7px;
    }
    .category_card{
        margin-top: 50px;
    }
    

    /* .category{
        color: rgb(207, 207, 207);
        font-weight: bold;
        width: 80%;
        border-bottom: 2px solid gray;
        margin: auto;
        margin-top: 40px;
        margin-bottom: -20px;
        font-size: 18px;
        /* float: left; */
        /* text-align: left;
    } */

    /* .create_category {
        width: 100px;
        align-self: flex-end;
        font-size: 15px;
        font-weight: bold;
        margin-left: 60%;
        margin-top: 60px;
        margin-bottom: -100px;
    } */
    .create_category{
        margin-top: 50px;
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