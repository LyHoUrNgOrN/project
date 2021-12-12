<template>
  <div class="form">
        <label for="image" id="labelForProfile"><img class="user" :src="previewProfile"/></label>
        <form action="" enctype="multipart/form-data">
            <input type="file" id="image" accept="image/jpeg, image/png, image/gif, image/jpg" @change="selectProfile" >
            <small>{{messError.profile}}</small>
            <input type="text" id="name" placeholder="User Name" v-model="userName">
            <small>{{messError.name}}</small>
            <input type="email" id="email" placeholder="Email" v-model="email">
            <small>{{messError.email}}</small>
            <input type="password" id="password" placeholder="Password" v-model="password">
            <input type="password" id="confirmPasswprd" placeholder="Confirm Password" v-model="confirmPassword">
            <small>{{messError.password}}</small>
            <br>
            <router-link to='/signUp' @click="signUp"><botton-widget>Sign Up</botton-widget></router-link>
            <p>Have account: <router-link class="signIn" to="/signIn" >Sign In</router-link></p>
        </form>

        
  </div>
</template>

<script scoped>
import axios from "../../../api/api.js";

export default {
    emits:["sign-up"],
    data(){
        return{
            userName: "",
            email: null,
            password: null,
            confirmPassword: null,
            previewProfile: "https://www.psi.org.kh/wp-content/uploads/2019/01/profile-icon-300x300.png",
            profile : null,
            messError : {
                profile:null,
                name:null,
                email: null,
                password:null,
            }
        }
    },
    methods: {
        selectProfile(event){
            const image = event.target.files[0];
            let reader = new FileReader();
            reader.onloadend = e =>{
                this.previewProfile = e.target.result;
            }
            reader.readAsDataURL(image);
            this.profile = image;
            
        },
        signUp(){

            let user = new FormData();
            user.append('name',this.userName);
            user.append('email',this.email);
            user.append('password',this.password);
            user.append('password_confirmation',this.confirmPassword);
            user.append('profile',this.profile);

            axios.post('/signup',user).then(()=>{
                this.$router.push('/signIn');
            }).catch(error=>{
                if (error.response) {
                    let messError = error.response.data.errors;
                    console.log(messError);
                    if(messError.name !== undefined){
                        this.messError.name = messError.name[0];
                    }
                    if(messError.email !== undefined){
                        this.messError.email = messError.email[0];
                    }
                    if(messError.password !== undefined){
                        this.messError.password = messError.password[0];
                    }
                    if(messError.profile !== undefined){
                        this.messError.profile = 'Please choose a correct profile!';
                    }
                }
            });
            this.userName = null;
            this.email = null;
            this.password = null;
            this.confirmPassword = null;
            this.previewProfile = 'https://www.psi.org.kh/wp-content/uploads/2019/01/profile-icon-300x300.png';
            this.profile = null;
        }
    }
}
</script>

<style>
    body{
        background-image: url('https://ak.picdn.net/shutterstock/videos/9134405/thumb/1.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-position: top;
        background-position-x: center;
        background-position-y: top;
    }
        .form{
            background-color: rgba(88, 88, 88, 0.308);
            border-radius: 20px;
            text-align: center;
            width: 40%;
            margin: auto;
            padding: 10px;
            margin-top: 40px;
        }
        .user{
            background-size: cover;
            width: 30%;
            height: 25vh;
            border-radius: 50%;
            margin: auto;
            margin-top: 10px;
        }
        #image{
            display: none;
        }
        form{
            width: 50%;
            margin: auto;
        }
        form p{
            color: white;
        }
        #name,
        #email,
        #password,
        #confirmPasswprd{
            width: 90%;
            padding: 15px;
            margin-bottom: 10px;
            border: none;
            outline: none;
            background: none;
            color: rgb(255, 255, 255);
            border-bottom: 1.5px solid rgb(236, 236, 236);
        }
        .robot{
            width: 55%;
            padding: 15px;
            font-size: 20px;
            background: rgba(246, 247, 250, 0.377);
            border-radius: 5px;
            color: white;
        }

        .signIn{
            color: rgb(44, 171, 209);
        }
</style>