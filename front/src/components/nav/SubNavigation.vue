<template>
  <div class="sidebarCategory">
        <ul>
            <div class="">
                <input type="text" id="searchCategory" placeholder="Type of search..." v-model="searchName" @keyup="searchCategory">
                <i class="fa fa-search searchCategoryIcon" ></i>
            </div>
            <li>
               <div class="categoryCard"><i id="more" class="fa fa-calendar"></i>All Event</div>
            </li>
            <category-card
                v-for="category of categoryList" :key="category.id"
                :category="category"
                @delete="deleteCategory"
                @category-name="updateCategory"
                @category="selectCategory"
            ></category-card>
        </ul>
        <!-- @edit-category="editCategory" -->
        <div class="addCategory">
            <button class="create_btn" @click="displayFormCategory"><i class="fa fa-plus"></i></button>

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
            />
            <small>{{errorCategoryMessage}}</small>
            <template #actions>
                <button class="create_category_btn" @click="addCategory">Create</button>
            </template>
        </dialog-box>
        </div>
        
        
    </div>
</template>
<script>

import CategoryCard from './CategoryCard.vue';

import axios from "axios";
const URL = 'http://127.0.0.1:8000/api'
export default {
    components: {
        CategoryCard, 
    },
    data(){
        return{
            errorCategoryMessage : null,
            // categoryList: [],
            categoryList: [],
            diplayedDialog: false,
            newCategoryName: "",
            searchName:"",
            oldEventCategory: '',
            oldMyEventCategory: ''
        }
    },
    computed: {
        dialogTitle() {
            return 'CREATE A NEW CATEGORY';
        },
    },
    methods: {
        

        deleteCategory(categoryId){
            // this.categoryList = this.categoryList.filter((category) => category.id !== categoryId);
            axios.delete(URL + '/category/'+categoryId).then(()=> {
                this.displayAllCategory();
            })
            this.$router.replace('/event', {silent:true})

        },
        displayFormCategory(){
            this.diplayedDialog = true;
        },
        addCategory(){
            let newCategory = {
                user_id:JSON.parse(localStorage.getItem("user")).id,
                name: this.newCategoryName
            }
            axios.post(URL + '/category', newCategory).then(res=>{
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
        },

        displayAllCategory(){
            if(this.searchName === ''){
                
            axios.get(URL + "/category").then(res=>{
            // console.log("Running...",res.data);
            this.categoryList = res.data;
            })
            }
            else {
                axios.get(URL + "/category/search/"+this.searchName).then(res=>{
                // console.log("Running...",res.data);
                this.categoryList = res.data;
                });
            }

        },
        closeDialog() {
            this.diplayedDialog = false;
            this.errorCategoryMessage = null;
        },
        updateCategory(cat_id, cat_name){
            // for(let category of this.categoryList){
                // if(category.id===cat_id){
                    console.log(cat_name, cat_id);
                    let newCategory = {
                        user_id:JSON.parse(localStorage.getItem("user")).id,
                        name: cat_name
                    }
                    axios.put(URL+'/category/'+cat_id, newCategory).then(()=>{
                        this.displayAllCategory();
                    })
                    .catch(error=>{
                        if (error.response) {
                            // this.diplayedDialog = true;
                            this.errorCategoryMessage = error.response.data.errors.name[0];
                        }
                    });
                    this.errorCategoryMessage = '';
                // }
            // }
        },
        searchCategory(){
            this.displayAllCategory();
            
        },
        selectCategory(category){
            // console.log(this.$route.path.splice(0,5));
            let path = this.$route.path;
            if (path === '/event' || path === '/event/'+ this.oldEventCategory){
                console.log(123);
                this.$router.replace('/event/'+ category.name, {silent:true})
                // this.$route.push('/event');
                this.oldEventCategory = category.name;

            }else if (path === '/myEvent' || path === '/myEvent/'+ this.oldMyEventCategory){
                this.$router.replace('/myEvent/'+ category.name, {silent:true})
                // this.$route.push('/event');
                this.oldMyEventCategory = category.name;
                
            }
            console.log(category);
        }
    },
    mounted() {
        this.displayAllCategory();            
    },
}
</script>
<style>
    .categoryCard{
        padding: 18px;
        font-size: 21px;
    }
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
        width: 0px;
    }
    .sidebarCategory ul{
        margin-left: -14%;
        /* text-align: center; */
        margin-top: 50px;
        padding-bottom: 300px;

    }
    .sidebarCategory ul li{
        list-style: none;
        /* padding: 5px 0 5px 0; */
        width: 100%;
        border-bottom: 1px solid white;
        text-align: left;
        /* padding-left: 22px; */
        color: white;
        display: flex;
        justify-content: space-between;
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
        