<template>
  <nav>
        <ul>
            <!-- <img src="sspllogocir-Sani-Software-Private-Limited.png" alt=""> -->
            <h2>Event-Me</h2>
        </ul>
        <ul>
            <li><router-link id="menu" to="/home">Home</router-link></li>
            <li><router-link id="menu" to="/event">Event</router-link></li>
            <li><router-link id="menu" to="/myEvent">My Event</router-link></li>
            <li class="search">
                <input id="input" type="text" placeholder="Search...">
                <button class="search-btn">
                    <i class="fa fa-search"></i>
                </button>
            </li>
            <li>
                <img class="profile" src="" alt="">
            </li>

        </ul>
        
    </nav>
</template>


<script>

export default {
  components: {
    
  }
}
</script>



<style scoped>
    #menu{
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    #menu:hover {
        color: rgb(15, 135, 233);
        padding-bottom: 5px;
    }
    nav{
        margin-top: -35px;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid rgb(214, 212, 212);
        color: white;
    }
    
    nav ul {
        display: flex;
        width: 50%;
        /* justify-content: space-between; */
        align-items: end;
    }
    nav ul h2{
        margin-bottom: -10px;
        font-size: 36px;
        font-weight: bold;
    }
    nav ul li {
        list-style: none;
        text-transform: uppercase;
        margin-top: 20px;
        padding-right: 4%;
        display: flex;
    }
    nav ul .search #input{
        padding: 8px;
        width: 190%;
        /* margin-bottom: -10px; */
        border-radius: 8px 0 0 8px;
        border: 1px solid gray;
        background: rgba(184, 184, 185, 0.534);
        outline: none;
        color: white;
    } 
    nav ul .search{
        width: 40%;
    }
    nav ul .search .search-btn{
        width: 70px;
        border-left: none;
        border: 1px solid gray;
        border-radius: 0 8px 8px 0;
        background: rgb(15, 135, 233);
        color: white;
        
        
    }
    nav ul li .profile {
        width: 50px;
        height: 50px;
        background: yellow;
        border-radius: 50%;
        border: 1px solid gray;

    }
</style>