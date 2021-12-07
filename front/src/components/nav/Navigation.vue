<template>
  <nav>
        <ul>
            <h2>Event-Me</h2>
        </ul>
        <ul>
            <li><router-link id="menu" to="/home">Home</router-link></li>
            <li><router-link id="menu" to="/event">Event</router-link></li>
            <li><router-link id="menu" to="/myEvent">My Event</router-link></li>
            
             <li class="searchBoxIcon">
                    <input class="searchInput" type="text" name="" placeholder="Search Event">
                    <button class="searchButton" href="#">
                        <i class="fa fa-search"></i>
                    </button>
                </li>
            <li>
                <img class="profile" :src="displayProfile()" alt="" @click="openProfile">
            </li>

        </ul>
                <div id="myModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                       
                        <span class="close" @click="close">&times;</span>
                        </div>
                    <div class="profile">
                        <img :src="displayProfile()" alt="">
                    
                    </div>
                    
                    <div class="modal-body">
                        <p class="name">
                            <i class="fa fa-user-circle-o"></i>
                             {{activeUser.name}}
                        </p>
                        <p class="email">
                            <i class="fa fa-envelope"></i>
                             {{activeUser.email}}
                        </p>
                        <p class="phone">
                            <i class="fa fa-phone-square"></i>
                             +855 969494090
                        </p>
                        <p class="address">
                            <i class="fa fa-map-marker"></i>
                             Phnom Penh
                        </p>
                        <router-link to='/signIn' @click="signOut"><botton-widget>Sign Out</botton-widget></router-link>
     
                    </div>
                </div>
        </div>
    </nav>
</template>

<script>
export default {
    inject:["$activeUser"],
    emits:['sign-out'],
    data(){
        return{
            
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
            this.close();
            localStorage.clear();
            this.$emit("sign-out");
            this.$router.push('/signIn');
        },
        displayProfile(){
            console.log(this.activeUser.profile);
            return "http://127.0.0.1:8000/storage/profiles/" + this.activeUser.profile;
        }
    },
    computed : {
        activeUser (){
            return this.$activeUser();
        }
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
        margin-top: -8px;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid rgb(214, 212, 212);
        color: white;
        position: sticky;
        top: 0;
        background-image: url('https://ak.picdn.net/shutterstock/videos/9134405/thumb/1.jpg');
        background-size: cover;
        /* z-index: 11; */
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
    nav ul li .profile {
        width: 50px;
        height: 50px;
        background: yellow;
        border-radius: 50%;
        border: 1px solid gray;

    }
    
    .modal-body{
        width: 92%;
        
    }
    .modal-body>p{
        border-bottom: 1px solid gray;
    }
    .modal-body>.name,
    .modal-body>.address,
    .modal-body>.email,
    .modal-body>.phone{
        
        width: 100%; 
        padding: 10px; 
        font-size: 16px; 
        text-align: left;
        
    }
    .fa-user-circle-o,
    .fa-envelope,
    .fa-phone-square,
    .fa-map-marker {
        font-size: 20px;
        margin-right: 10px;
    }

    .modal-content img{
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }

    .modal-header,.modal-body{
        border: none;
        
    }
    .modal { 
        display: none; 
        position: fixed; 
        z-index: 1; 
        padding-top: 100px; 
        left: 70%;
        top: 0;
        width: 30%; 
        height: 100%;
        overflow: auto; 
        background-color: rgba(0, 0, 0, 0.883); 
    }
    
    /* / Modal Content / */
    .modal-content {
        position: relative;
        margin: auto;
        padding: 0;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* / Add Animation / */
    @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
    }

    @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
    }

    /* / The Close Button / */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
        margin-top: -70px;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-body {
        padding: 2px 16px;
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