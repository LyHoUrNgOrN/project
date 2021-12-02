<template>
  <div class="sidebar">
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
                // {id: 5, name: "Wedding"},
                // {id: 6, name: "Wedding"},
                // {id: 7, name: "Wedding"},
                // {id: 8, name: "Wedding"},
                
                
            ]
        }
    },
    methods: {
        deleteCategory(categoryId){
            this.categoryList = this.categoryList.filter((category) => category.id !== categoryId);
        }
    }
}
</script>

<style >
    .sidebar{
        position: fixed;
        width: 22%;
        margin-left: -10px;
        margin-top: 41px;
        height: 78.5vh;
        background: rgb(92, 95, 94);
        padding-top: 40px;
        overflow: auto;
        
    }
    .sidebar ul{
        margin-left: -16%;
        text-align: center;
        margin-top: 50px;

    }
    .sidebar ul li{
        list-style: none;
        /* padding: 5px 0 5px 0; */
        width: 91%;
        /* text-align: center; */
        border-bottom: 1px solid white;
        text-align: left;
        padding-left: 30px;
        color: white;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .sidebar ul li:hover{
        background: rgba(73, 172, 211, 0.582);

    }
    .sidebar ul li a{
        /* display: block; */
        height: 100%;
        width: 100%;
        line-height: 45px;
        padding: 10px;
        font-size: 20px;
        color: white;
        text-decoration: none;
        /* color: lightcoral; */
        /* padding-left: 20px; */
        text-align: left;
        
    } 
    .sidebar ul li i{
        margin-right: 10px;
    }
    /* ul li:hover a{ */
        /* padding-left: 50px; */
        
    /* } */
    
    #searchCategory {
        background: none;
        border: 2px solid gray;
        padding: 10px;
        outline: none;
        color: white;
        left: 3%;
        top: 6%;
        border-radius: 15px;
        position: absolute;
        width: 86%;
        font-size: 16px;
        
    }
    .searchCategoryIcon{
        position: absolute;
        left: 85%;
        top: 7vh;
        color: rgb(255, 255, 255);
    }
</style>
        