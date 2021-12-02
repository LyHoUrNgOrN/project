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
                </button>
            </li>
            <li>
                <img class="profile" src="" alt="" @click="openProfile">
            </li>

        </ul>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <img class="profile" src="" alt="" @click="changeProfile"> -->
                    <h4 class="name">{{userName}}</h4>
                    <span class="close" @click="close">&times;</span>
                    
                </div>
                <div class="modal-body">
                    <p>Some text in the Modal Body</p>
                    <p>Some other text...</p>
                    <button @click="signOut" >Sign Out <i class="fa fa-sign-out"></i></button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    data(){
        return {
            userName : JSON.parse(localStorage.getItem("user")),
        }
    },

    methods: {
        openProfile(){
            let modal = document.getElementById("myModal");
            modal.style.display = "block";
        },
        close(){
            let modal = document.getElementById("myModal");
            modal.style.display = "none";
        },
        signOut(){
            localStorage.setItem("user"," ");
            this.close();
            localStorage.setItem("login",false);
            this.$router.push('/');
        }
    },
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
    body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 70%;
  top: 0;
  width: 30%; /* 30% width */
  height: 100%; /*Full height*/
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
 
/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  display: flex;
  justify-content: space-between;
  background-color: #5cb85c;
  color: white;
}
.name{
    width:30%;
}

.modal-body {padding: 2px 16px;}

</style>