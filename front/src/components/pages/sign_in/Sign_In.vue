<template>
    <div class="form">
        <form action="#">
            <h1>Sign In Here</h1>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" id="name" v-model="userName" placeholder="Username ">
            </div>
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" id="password" v-model="password" placeholder="Password">
            </div>
            <small>{{messageError}}</small>
            <br>
            <a id="forogt-password" href="#">Forgot password</a>
            <br>
            <router-link  to='/' @click="signIn"><botton-widget >Sign In</botton-widget></router-link>
            <div class="or">
                <div id="ruler"></div>
                <p>Or</p>
                <div id="ruler"></div>
            </div>
            <p>Don't have account yet: <router-link class="signUp" to="/signUp">Sign Up</router-link></p>

        </form>
    </div>
</template>

<script>
import axios from "../../../api/api.js";

export default {
    emits:["sign-in"],
    data(){
        return {

            userName:null,
            password:null,
            userList : [],
            loginResult: false,
            messageError:null,
        }
    },
    methods: {
        signIn(event){
            event.preventDefault();
            let user = {
                name:this.userName,
                password:this.password,
            }
            axios.post('/signin',user).then(res=>{
                let user = res.data.user;
                this.$emit("sign-in",user);
                this.$router.push('/myEvent');
            }).catch(error=>{
                if (error.response) {
                    this.messageError = error.response.data.message;
                    console.log(error.response.data.message);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                }
            });
            this.userName = null;
            this.password = null;
        }
    },   
}
</script>

<style scoped>
/* body{
        background-image: url('https://thecolonial.org/wp-content/uploads/Event-Blogging-Strategies.jpg');
        background-size: cover;
    } */
.form{
            background-color: rgba(17, 17, 17, 0.308);
            border-radius: 20px;
            text-align: center;
            width: 40%;
            margin: auto;
            padding: 10px;
            margin-top: 100px;
        }
form{
            width: 50%;
            margin: auto;
            
        }
        #name,
        #password{
            width: 90%;
            padding: 15px;
            margin-bottom: 10px;
            border: none;
            outline: none;
            background: none;
            color: white;
            border-bottom: 1.5px solid black;
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
        form p{
            color: white;
        }
        .textbox{
            display: flex;
        }
        form h1{
            color: white;
        }
        .textbox i{
            margin-top: 15px;
            font-size: 20px;
            color: white;
        }


        .or{
            display: flex;
            justify-content: space-between;
        }
        .or p{
            border: 1px solid white;
            padding: 3px;
            padding-left: 6px;
            padding-right: 6px;
            border-radius: 50%;
        }
        .or #ruler{
            height: 1px;
            width: 44%;
            margin-top: 30px;
            background: rgb(255, 255, 255);
        }
        form p a{
            color: sandybrown;
        }
        #forogt-password{
            color: white;
            margin-left: -50%;
        }
        .signUp{
            color: sandybrown;
        }
        small{
            color:red;
            margin:2px;
        }
</style>