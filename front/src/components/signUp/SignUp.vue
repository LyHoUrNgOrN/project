<template>
  <div class="form">
        <label for="image"><img class="user" :src="profile" /></label>
        
        <form action="" enctype="multipart/form-data">
            <input type="file" id="image" @change="selectProfile">
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

<script>
import BottonWidget from "./../button_widget/Button.vue";
import axios from "axios";
const URL = 'http://127.0.0.1:8000/api'
export default {
    components: {'botton-widget':BottonWidget},
    emits:["sign-up"],
    data(){
        return{
            value : "Sign Up",
            userName: null,
            email: null,
            password: null,
            confirmPassword: null,
            profile: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9Z9vjM-_Ww_rUHKOYFQ3brhBsKWniGSN7jembYtImHkPzHReyZ4zNBlPF550WjI8a_eE&usqp=CAU",
            messError : {
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
                this.profile = e.target.result;
            }
            reader.readAsDataURL(image);
            this.profile = event.target.files[0].name;
            
        },
        signUp(event){
            event.preventDefault();
            let user = {
                name : this.userName,
                email: this.email,
                password:this.password,
                password_confirmation:this.confirmPassword,
                profile : this.profile,
                role:"user",
            }
            // let user = new FormData();
            // user.append('profie',this.profile);
            // user.append('name',this.userName);
            // user.append('email',this.email);
            // user.append('password',this.password);
            // user.append('password_confirmation',this.confirmPassword);
            // user.append('role','user');

            
            axios.post(URL+'/signup',user).then(res=>{
                // console.log(res.data);
                let user = res.data.user
                localStorage.setItem('user',JSON.stringify(user.name));
                localStorage.setItem('login',true);
                this.$emit("sign-up",user);
                this.$router.push('/home');
            }).catch(error=>{
                if (error.response) {
                    let messError = error.response.data.errors;
                    if(messError.name !== undefined){
                        this.messError.name = messError.name[0];
                    }
                    if(messError.email !== undefined){
                        this.messError.email = messError.email[0];
                    }
                    if(messError.password !== undefined){
                        this.messError.password = messError.password[0];
                    }
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                }
            });
            // this.$emit("sign-up",user);
            this.userName = null;
            this.email = null;
            this.password = null;
            this.confirmPassword = null;
            this.profile = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9Z9vjM-_Ww_rUHKOYFQ3brhBsKWniGSN7jembYtImHkPzHReyZ4zNBlPF550WjI8a_eE&usqp=CAU';
        }
    }
}
</script>

<style>
    body{
        background-image: url('https://thecolonial.org/wp-content/uploads/Event-Blogging-Strategies.jpg');
        background-size: cover;
    }
        .form{
            background-color: rgba(41, 41, 41, 0.308);
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
            border-bottom: 1.5px solid black;
        }
        .robot{
            width: 55%;
            padding: 15px;
            font-size: 20px;
            background: rgba(246, 247, 250, 0.377);
            border-radius: 5px;
            color: white;
        }
        .btn{
            padding: 12px;
            width: 40%;
            font-size: 15px;
            font-weight: bold;
            border: none;
            outline: none;
            border-radius: 10px;
            background: sandybrown;
            margin-top: 15px;
            
        }
        .signIn{
            color: sandybrown;
        }
</style>