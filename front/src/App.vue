<template>
  <div id="app">
    <!-- <sign-in @sign-in="userSignIn"></sign-in> -->
    <!-- <sign-up @sign-up="userSignUp"></sign-up> -->
    <menu-bar v-show="isIignIn"></menu-bar>
    <router-view @sign-in="userSignIn" @sign-up="userSignUp"></router-view>
    
  </div>
</template>
<script>
// import axios from 'http.js';
import axios from "axios";
const URL = 'http://127.0.0.1:8000/api'
export default {
  data(){
    return{
      userList : [
      ],
      loginResult:null,
      isIignIn:false,
      activeUser:{},
    }
    
  },
  methods: {
      userSignIn(user){
        // console.log(user);
        this.isIignIn = true;
        this.activeUser = user;
        // localStorage.id = user.id;
      },
      userSignUp(user){
        this.isIignIn = true;
        this.activeUser = user;

        // console.log(user);
        
        // localStorage.id = user.id;
      },

  },
  mounted() {
    //  localStorage.id = 1;
    if (localStorage.getItem("user")){
      this.isIignIn = true;
      this.activeUser = JSON.parse(localStorage.getItem("user"));
    }
    console.log(JSON.parse(localStorage.getItem("user")));
    console.log("signIn");
    axios.get(URL+'/users').then(res=>{
      this.userList = res.data;
      console.log(this.userList);
    });
    
  },
  
  
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  /* margin-top: 60px; */
}
</style>
