<template>
  <div class="sidebar">
    
        <ul>
            <li><a href="#">All Event</a></li>
            <li><a href="#">Music</a></li>
            <li><a href="#">Business</a></li>
            <li><a href="#">Wedding</a></li>

        </ul>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
    .sidebar{
        position: fixed;
        left: 0px;
        width: 18%;
        height: 100%;
        background: rgb(92, 95, 94);
        padding-top: 40px;
        
    }
    .sidebar ul{
        margin-left: -16%;
    }
    .sidebar ul li{
        list-style: none;
        padding: 10px 0 10px 0;
        width: 100%;
        text-align: center;
        border-bottom: 1px solid white;
    }
    .sidebar ul a{
        /* display: block; */
        height: 100%;
        width: 100%;
        line-height: 45px;
        /* padding: 15px; */
        font-size: 20px;
        color: white;
        text-decoration: none;
        /* padding-left: 20px; */
        /* text-align: center; */
        
    }
    
    ul li:hover a{
        padding-left: 50px;
        
    }
</style>