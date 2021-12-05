<template>
  <div class="sidebarCategory">
        <ul>
            <div class="">
                <input type="text" id="searchCategory" placeholder="Type of search...">
                <i class="fa fa-search searchCategoryIcon"></i>
            </div>
            <li>
                <router-link to="/event/allEvent"><i id="more" class="fa fa-calendar"></i>All Event</router-link>
            </li>
            <category-card
                v-for="category of categoryList" :key="category.id"
                :category="category"
                @delete="deleteCategory"
                @category-name="updateCategory"
                
                
            ></category-card>
        </ul>
        <!-- @edit-category="editCategory" -->
        <div class="addCategory">
            <button class="create_btn" @click="displayFormCategory"><i class="fa fa-plus"></i></button>

            <dialog-box
            v-if="dialogDisplayed"
            :title="dialogTitle"
            @close="closeDialog"
            >
            <hr>
            <label for="description" >Category Name</label>
            <input
                v-model="newCategoryName"
                placeholder="New Category Name"
            />
            <template #actions>
                <button class="create_category_btn" @click="addCategory">Create</button>
            </template>
        </dialog-box>
        </div>
        <!-- <category-form 
        v-if="showForm"
        @cancle-create-category="cancelAddCategory"
        @create-category="addCategory"
        @update-category="updateCategory"
        :error="errorCategoryMessage"
        :isCreate="isCreate"
        :title ="title"
        :categoryId="cat_id"
        ></category-form> -->
        
        
    </div>
</template>
<script>

import CategoryCard from './CategoryCard.vue';
// import CategoryForm from './CategoryForm.vue';
// import 'bootstrap/dist/css/bootstrap.min.css'
import axios from "axios";
const URL = 'http://127.0.0.1:8000/api'
export default {
    components: {
        CategoryCard, 
        // CategoryForm
    },
    data(){
        return{
            
            showForm: false,
            isCreate:false,
            errorCategoryMessage : null,
            title:null,
            cat_id:null,
            // categoryList: [],
            categoryList: [
                {id: 1, name: "Music"},
                {id: 2, name: "Business"},
                {id: 3, name: "Sport"},
                {id: 4, name: "Wedding"},  
                {id: 5, name: "Wedding"}, 
                {id: 6, name: "Wedding"},
                {id: 7, name: "Wedding"},  
                {id: 8, name: "Wedding"} , 
                {id: 9, name: "Wedding"}  ,
            ],
            dialogDisplayed: false,
            newCategoryName: ""
        }
    },
    computed: {
        dialogTitle() {
            return 'CREATE A NEW CATEGORY';
        },
    },
    methods: {
        deleteCategory(categoryId){
            this.categoryList = this.categoryList.filter((category) => category.id !== categoryId);
        },
        displayFormCategory(){
            // this.showForm = true;
            // this.isCreate= true;
            this.dialogDisplayed = true;
        },
        cancelAddCategory(){
            this.errorCategoryMessage = null;
            this.title = null;
            this.showForm = false;
        },
        addCategory(){
            console.log(this.newCategoryName);
            // let newCategory = {
            //     name: this.newCategoryName
            // }
            // axios.post(URL + '/category', newCategory).then(res=>{
            //     this.categoryList= res.data;
            //     this.showForm = false;
            //     this.errorCategoryMessage = null;
            //     this.displayAllCategory();
            // }).catch(error=>{
            //     if (error.response) {
            //         this.errorCategoryMessage = error.response.data.errors.name[0];
            //     }
            // });
            this.dialogDisplayed = !this.dialogDisplayed;
        },

        displayAllCategory(){
            axios.get(URL + "/category").then(res=>{
            console.log("Running...",res.data);
            this.categoryList = res.data;
            })

        },
        closeDialog() {
            this.dialogDisplayed = false;
        },
        updateCategory(cat_id, cat_name){
            for(let category of this.categoryList){
                if(category.id===cat_id){
                    axios.put(URL+'/category/'+cat_id, {name:cat_name}).then(res=>{
                        this.categoryList=res.data;
                        this.displayAllCategory();
                        this.showForm = false;
                        this.title = null;
                    })
                    .catch(error=>{
                        if (error.response) {
                            this.errorCategoryMessage = error.response.data.errors.name[0];
                        }
                    });
                }
            }
        }
    },
    mounted() {
        this.displayAllCategory();
    },
}
</script>
<style>
    .sidebarCategory{
        position: fixed;
        width: 21%;
        margin-left: -0.5%;
        height: 100vh;
        background: rgb(51, 51, 51);
        padding-top: 40px;
        overflow: auto;
        
    }
    ::-webkit-scrollbar {
        width: 10px;
    }
    .sidebarCategory ul{
        margin-left: -14%;
        /* text-align: center; */
        margin-top: 50px;

    }
    .sidebarCategory ul li{
        list-style: none;
        /* padding: 5px 0 5px 0; */
        width: 91%;
        border-bottom: 1px solid white;
        text-align: left;
        padding-left: 22px;
        color: white;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .sidebarCategory ul li:hover{
        background: rgba(73, 172, 211, 0.582);

    }
    .sidebarCategory ul li a{
        height: 100%;
        width: 100%;
        line-height: 45px;
        padding: 10px;
        font-size: 20px;
        color: white;
        text-decoration: none;
        text-align: left;
        
    } 
    .sidebarCategory ul li i{
        margin-right: 10px;
    }
    
    #searchCategory {
        background: none;
        border: 2px solid gray;
        padding: 8px;
        outline: none;
        color: white;
        left: 5%;
        top: 6%;
        border-radius: 15px;
        position: absolute;
        width: 87%;
        font-size: 16px;
        
    }
    .searchCategoryIcon{
        position: absolute;
        left: 88%;
        top: 9vh;
        color: rgb(255, 255, 255);
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
    .fa-exclamation-triangle{
        color: red;
        margin-right: 10px;
    }
    input:focus{
        background-color: #f0e6fd;
        outline: none;
        border-color: #3d008d;
    }
    .create_btn,
    .create_category_btn{
        border: none;
        font-weight: bold;
    }
    .create_btn{
        background: rgba(255, 255, 255, 0.774);
        padding: 12px;
        width: 4%;
        top: 88vh;
        left: 16%;
        border-radius: 50%;
        font-size: 26px;
        position: fixed;
        color: rgb(42, 40, 40);
    }
    .create_category_btn{
        padding: 10px;
        background: rgb(44, 171, 209);
        border-radius: 15px;
        width: 18%;
        font-size: 16px;

    }
</style>
        