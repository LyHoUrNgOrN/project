<template>
  <nav>
        <ul>
            <img id="logo" src="https://scontent.xx.fbcdn.net/v/t1.15752-9/p168x128/264169873_606371380695158_665677976128419885_n.png?_nc_cat=111&ccb=1-5&_nc_sid=aee45a&_nc_eui2=AeF7J8eYkRPaNmQen0YO5VgbZ-i4psbY8Gln6LimxtjwacRER8rbBd-AuK-BGgT8qfCxmajadsoanVRR9VRIVuPE&_nc_ohc=mbqYKtLq310AX8On0i1&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AVJvsoWYKvLJzTTl5du0MuE6rzbee1TxgP0VceOAQQSiMg&oe=61DAEED8" alt="">
        </ul>
        <ul>
            <router-link id="menu" to="/event">Event</router-link>
            <router-link id="menu" to="/myEvent">My Event</router-link>
            <router-link id="menu" to="/category">Category</router-link>
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
                    <p class="editData" @click="editData"><i class="fa fa-sliders"></i> Update your personal data</p>
                    <router-link to='/signIn' @click="signOut"><botton-widget>Sign Out</botton-widget></router-link>
                    <dialog-box
                        v-if="diplayedDialog"
                        :title="dialogTitle"
                        @close="closeDialog"
                        >
                        <hr>
                        <div class="box">
                            <label for="username">Your Name</label><br>
                            <input type="text" v-model="newName" placeholder="New Name" id="username"/>
                        </div>
                        <div class="box">
                            <label for="yourEmail">Your Email</label><br>
                            <input type="text" v-model="newEmail" placeholder="New Email" id="yourEmail"/>  
                        </div>
                        <!-- <small class="ok" v-if="errorCategoryMessage === 'ok'"><i class="fa fa-check-circle-o" ></i>{{errorCategoryMessage}}</small> -->
                        <small class="errorMessage" >{{ errorMessage }}</small>

                        <template #actions>
                            <botton-widget class="update_btn" @click="updateData">Update</botton-widget>
                        </template>
                    </dialog-box>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from "../../api/api.js";

export default {
    inject:["$activeUser"],
    emits:['sign-out', 'newData'],
    data(){
        return{
            diplayedDialog: false,
            dialogTitle: "Update your Data",
            newName: '',
            newEmail: '',
            profile: '',
            errorMessage: '',

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
            return "http://127.0.0.1:8000/storage/profiles/" + this.activeUser.profile;
        },
        closeDialog(){
            this.diplayedDialog = false;
            this.errorMessage = "";
        },
        editData(){
            this.diplayedDialog = true;
            this.newName = this.activeUser.name;
            this.newEmail = this.activeUser.email;
            this.imageProfile = 'http://127.0.0.1:8000/storage/profiles/' + this.activeUser.profile;
        },
        updateData(){
            console.log(this.activeUser.id);
            if(this.newName !== '' && this.newEmail !== ''){
                const newData = {
                    name: this.newName,
                    email: this.newEmail,
                    profile: this.activeUser.profile
                }
                axios.put('/users/'+ parseInt(this.activeUser.id), newData).then(()=> {
                    // console.log(newData);
                    newData['id'] = this.activeUser.id;
                    localStorage.setItem('user', JSON.stringify(newData));
                    this.$emit('newData', newData);
                    this.activeUser = newData;

                })
                this.closeDialog();
            }else{
                this.errorMessage = "Your data cannot be null";
            }
        },
    },

    computed : {
        activeUser (){
            return this.$activeUser();
        }
    }
}
</script>
<style scoped>
    #logo{
        width: 120px;
        margin-bottom: -35px;
        margin-left: -70%;
    }
    #menu{
        color: #154360;
        text-decoration: none;
        font-weight: bold;
    }
    
    nav{
        margin-top: -8px;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid rgb(214, 212, 212);
        background: white;
        position: sticky;
        top: 0;
        z-index: 11;
        

    }
    
    nav ul {
        display: flex;
        width: 50%;
        justify-content: space-around;
        align-items: flex-end;
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
    .router-link-active{
        background: #15436057;
        padding: 15px;
        border-radius: 10px;
    }

    nav ul li .profile {
        width: 50px;
        height: 50px;
        background: rgb(43, 43, 42);
        border-radius: 50%;
        /* border: 1px solid gray; */

    }

    .modal-body{
        width: 92%;
        
    }
    .modal-body>p{
        border-bottom: 1px solid gray;
    }
    .editData{
        cursor: pointer;
        /* color: cornflowerblue; */
    }
    .modal-body>.name,
    .modal-body>.address,
    .modal-body>.email,
    .modal-body>.country,
    .modal-body>.editData{
        
        width: 100%; 
        padding: 10px; 
        font-size: 16px; 
        text-align: left;
        
    }
    .fa-user-circle-o,
    .fa-envelope,
    .fa-globe,
    .fa-map-marker,
    .fa-sliders {
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
        /* box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); */
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s;
        color: white;
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
    .editProfile{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 145px;
        left: 35px;
        font-size: 22px;
        color: rgba(116, 113, 113, 0.911);
    }
    .newProfile{
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: auto;
        margin-left: 40%;
    }
    #profile{
        display: none;
    }
    .box{
        
        margin-top: 20px;
        margin-left: 20%;
    }
    #username,
    #yourEmail{
        padding: 15px;
        outline: none;
        margin: auto;
        width: 70%;
        outline: none;
        border: 1px solid #154360;
        background: #2a546e3a;
        color: #154360;
        font-size: 16px;

    }
    .errorMessage {
        color: red;
        margin-left: 12%;
        margin-top: 15px;
    }

</style>