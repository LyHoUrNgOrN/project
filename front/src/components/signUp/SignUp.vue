<template>
  <div class="form">
        <label for="image"><img class="user" :src="profile" /></label>
        
        <form action=""  enctype="multipart/form-data">
            <input type="file" id="image" @change="selectProfile">
            <input type="text" placeholder="User Name" v-model="userName">
            <input type="email" placeholder="Email" v-model="email">
            <input type="password" placeholder="Password" v-model="password">
            <input type="password" placeholder="Confirm Password" v-model="confirmPassword">
            <br>
            <botton-widget
                :valueButton="value"
                @click="signUp"
            ></botton-widget>
            <p>Have account: <router-link class="signIn" to="/signIn" >Sign In</router-link></p>
        </form>

        
  </div>
</template>

<script>
import BottonWidget from "./../button_widget/Button.vue";
export default {
    components: {BottonWidget},
    emits:["sign-up"],
    data(){
        return{
            value : "Sign Up",
            userName: "",
            email: "",
            password: "",
            confirmPassword: "",
            profile: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9Z9vjM-_Ww_rUHKOYFQ3brhBsKWniGSN7jembYtImHkPzHReyZ4zNBlPF550WjI8a_eE&usqp=CAU"
        }
    },
    methods: {
        selectProfile(event){
            const image = event.target.files[0].name;
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onloadend = e =>{
                this.profile = e.target.result;
            }
            console.log(this.profile);
        },
        signUp(event){
            event.preventDefault();
            let user = {
                name : this.userName,
                email: this.email,
                password:this.password,
                profile : this.profile,
            }
            this.$emit("sign-up",user);
            this.name = "";
            this.email = "";
            this.password = "";
            this.profile = "";
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
        input[type="text"],
        input[type="email"],
        input[type="password"]{
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