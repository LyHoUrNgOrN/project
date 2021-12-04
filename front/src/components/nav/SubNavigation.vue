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
                @category-name="getCategoryName"
            ></category-card>
        </ul>
        <div class="addCategory">
        </div>
    </div>
</template>
<script>
import CategoryCard from './CategoryCard.vue';
// import 'bootstrap/dist/css/bootstrap.min.css'
export default {
    components: {CategoryCard},
    data(){
        return{
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
            ]
        }
    },
    methods: {
        deleteCategory(categoryId){
            this.categoryList = this.categoryList.filter((category) => category.id !== categoryId);
        },
        getCategoryName(categoryId, categoryName){
            let categories = [];
            for (let category of this.categoryList){
                if (category.id === categoryId){
                    let categoryUpdate = {
                        id: categoryId,
                        name: categoryName
                    }

                    categories.push(categoryUpdate);
                }else{
                    categories.push(category);
                }
            }
            this.categoryList = categories;
        }
    }
}
</script>
<style>
    .sidebarCategory{
        position: fixed;
        width: 22%;
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
        margin-left: -16%;
        /* text-align: center; */
        margin-top: 50px;

    }
    .sidebarCategory ul li{
        list-style: none;
        /* padding: 5px 0 5px 0; */
        width: 91%;
        border-bottom: 1px solid white;
        text-align: left;
        padding-left: 30px;
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
    /* ul li:hover a{ */
        /* padding-left: 50px; */
        
    /* } */
    
    #searchCategory {
        background: none;
        border: 2px solid gray;
        padding: 8px;
        outline: none;
        color: white;
        left: 3%;
        top: 6%;
        border-radius: 15px;
        position: absolute;
        width: 87%;
        font-size: 16px;
        
    }
    .searchCategoryIcon{
        position: absolute;
        left: 85%;
        top: 8vh;
        color: rgb(255, 255, 255);
    }
</style>
        