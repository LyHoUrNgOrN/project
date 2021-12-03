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
            <!-- <li class="search"> -->
                <!-- <input id="input" type="text" placeholder="Search...">
                <button class="search-btn">
                    <i class="fa fa-search"></i>
                </button> -->
               
            <!-- </li> -->
             <li class="searchBoxIcon">
                    <input class="searchInput" type="text" name="" placeholder="Search">
                    <button class="searchButton" href="#">
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
        /* margin-top: -30px; */
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid rgb(214, 212, 212);
        color: white;
        position: sticky;
        top: 0;
        background: rgb(43, 42, 42);
    }
    
    nav ul {
        display: flex;
        width: 50%;
        justify-content: space-around;
        align-items: end;
    }
    nav ul h2{
        margin-bottom: -10px;
        font-size: 36px;
        font-weight: bold;
        margin-left: -65%;
    }
    nav ul li {
        list-style: none;
        text-transform: uppercase;
        margin-top: 20px;
        padding-right: 4%;
        display: flex;
        
    }
    
    /* nav ul .search{
        width: 40%;
    } */
    
    nav ul li .profile {
        width: 50px;
        height: 50px;
        background: yellow;
        border-radius: 50%;
        border: 1px solid gray;

    }




    .searchBoxIcon {
        height: 40px;
        border-radius: 40px;
        border: 1px solid #2f3640;
        padding-right: 0;

    }
    .searchBoxIcon:hover{
        border: 1px solid steelblue;

    }
    .searchBoxIcon:hover > .searchInput {
        width: 200px;
        padding: 0 6px;
    }


    .searchButton {
        color: white;
        float: right;
        width: 50px;
        border-radius: 40%;
        background: #2f3640;
        transition: 0.4s;
        border: none;

    }

    .searchInput {
        border:none;
        background: none;
        outline:none;
        float:left;
        padding: 0;
        color: white;
        font-size: 16px;
        transition: 0.4s;
        width: 0px;
        border-radius: 30px;

    }
</style>