<template>
    <div class="form">
        <form action="#">
            <h1>Login Here</h1>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" v-model="userName" placeholder="Username ">
            </div>
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" v-model="password" placeholder="Password">
            </div>
            <a id="forogt-password" href="#">Forgot password</a>
            <br>
            <botton-widget :valueButton="value" @click="signIn"></botton-widget>

            <div class="or">
                <div id="ruler"></div>
                <p>Or</p>
                <div id="ruler"></div>
            </div>
            <p>Don't have account yet: <router-link class="signUp" to="/signUp" >Sign Up</router-link></p>

        </form>
    </div>
</template>

<script>
export default {
    emits:["sign-in"],
    data(){
        return {
            value : "Sign In",
            userName:null,
            password:null,
        }
    },
    methods: {
        signIn(event){
            event.preventDefault();
            this.$emit("sign-in",this.userName,this.password);
            this.userName = null;
            this.password = null;
        }
    },   
}
</script>

<style>
body{
        background-image: url('https://thecolonial.org/wp-content/uploads/Event-Blogging-Strategies.jpg');
        background-size: cover;
    }
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
        input[type="text"],
        input[type="password"]{
            width: 90%;
            padding: 15px;
            margin-bottom: 10px;
            border: none;
            outline: none;
            background: none;
            color: rgb(0, 0, 0);
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
</style>