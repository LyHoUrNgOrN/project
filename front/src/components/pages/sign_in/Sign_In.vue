<template>
   <div class="con">
        <div class="form">
        <form action="#">
            <h1>Sign In Here</h1>
            <div class="textbox">
                <label :for="nameId" :id="idIcon"><i class="fa fa-user" aria-hidden="true"></i></label>
                <input type="text" :id="nameId" v-model="userName" placeholder="Username ">
            </div>
            <div class="textbox">
                <label :for="passwordId" :id="passwordIcon"><i class="fa fa-lock" aria-hidden="true"></i></label>
                <input :type="type" :id="passwordId" v-model="password" placeholder="Password">
            </div>
            <small>{{messageError}}</small>
            <br>
            <div class="showPassword">
                <input type="checkbox" id="showPass" name="showPass" @change="showOrHidePass">
                <label for="showPass">{{btnText}}</label> 
            </div>
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
   </div>
</template>

<script scoped>
import axios from "../../../api/api.js";

export default {
    emits:["sign-in"],
    data(){
        return {
            userName:'',
            password:'',
            userList : [],
            loginResult: false,
            messageError:null,
            type: 'password',
            btnText: 'Show Password',
            idIcon: 'userName_icon',
            nameId:'name',
            passwordId: 'password',
            passwordIcon: 'password_icon',
        }
    },
    methods: {
        signIn(event){
            
            if (this.userName !== '' && this.password !== ''){
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
                this.userName = '';
                this.password = null;
            }else{
                if(this.name === '' ){
                    this.idIcon = 'nameMissing';
                    this.nameId = 'nameError';
                }
                if(this.password === '' ){
                    this.passwordIcon = 'passwordMissing';
                    this.passwordId = 'passwordError';
                }
                
                console.log(123);
            }
        },
        showOrHidePass(){
            if(this.type === 'password') {
                this.type = 'text'
                this.btnText = 'Hide Password'
            } else {
                this.type = 'password'
                this.btnText = 'Show Password'
            }
        },
    },   
}
</script>

<style scoped>

    .con{
        background-image: url('https://coreybradshaw.files.wordpress.com/2019/04/network-transformation-optimizednfv-16x9.jpg.rendition.intel_.web_.480.270.jpg');
        background-size: cover;
        padding-top: 5px;
        margin: 0;
        padding-bottom: 110px;
    }
    .form{
        background-color: white;
        border-radius: 40px;
        text-align: center;
        width: 35%;
        margin: auto;
        padding: 10px;
        margin-top: 80px;
    }
    form{
        /* width: 50%; */
        margin: auto;
        
    }
    #name,
    #password{
        width: 50%;
        padding: 15px;
        border: 1px solid #154360;
        background: #2a546e3a;
        font-size: 18px;
        margin-top: 10px;
        outline: none;
    }
    #nameError,
    #passwordError{
         width: 50%;
        padding: 15px;
        border: 1px solid red;
        background: #2a546e3a;
        font-size: 18px;
        margin-top: 10px;
        outline: none;
    }
    
    .textbox{
        /* width: 80%; */
        display: flex;
    }
    #userName_icon,
    #password_icon{
        width: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #154360;
        color: #154360;
        background: white;
        border-right: none;
        font-size: 24px;
        border: 1px 0 1px 1px solid #154360;
        margin-left: 16%;
        margin-top: 10px;

    }
    #nameMissing,
    #passwordMissing{
        width: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: white;
        border-right: none;
        font-size: 24px;
        color: red;
        border: 1px solid red;
        margin-left: 16%;
        margin-top: 10px;
    }

    hr{
        width: 60%;
        margin: auto;
        margin-top: 10px;
    }
    #haveAccount{
        color: rgb(49, 49, 49);
    }
    .signUp{
        color: #154360;
    }

    .or{
        width: 50%;
        margin: auto;
        display: flex;
        /* justify-content: space-between; */

    }
    .or p{
        border: 1px solid #154360;
        padding: 3px;
        padding-left: 6px;
        padding-right: 6px;
        border-radius: 50%;
    }
    .or #ruler{
        height: 1px;
        width: 50%;
        margin-top: 30px;
        background: #154360;
    }

    small{
        color:red;
        margin:2px;
    }

    .showPassword{
        color: #154360;
        margin-left: -40%;
        font-size: 16px;
    }
</style>