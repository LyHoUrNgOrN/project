<template>
  <div id="app">
    <!-- <sign-in @sign-in="userSignIn"></sign-in> -->
    <!-- <sign-up @sign-up="userSignUp"></sign-up> -->
    <!-- <menu-bar></menu-bar> -->
    <router-view @sign-in="userSignIn" @sign-up="userSignUp"></router-view>
  </div>
</template>
<script>
// import axios from 'http.js';
export default {
  data(){
    return{
      userList : [
        {name:"dara",password:"12"},
        {name:"da",password:"124"},
        {name:"da",password:"121"},
        {name:"rada",password:"123"},
      ],
      loginResult:null,
    }
    
  },
  methods: {
      userSignIn(userName,password){
        for (let user of this.userList){
          if(user.name === userName && user.password === password){
            this.loginResult = "Success!"
          }
        }
        if(this.loginResult === null){
          this.loginResult = "Fail!"
        }
        console.log(this.loginResult);
      },
      userSignUp(user){
        this.userList.push(user);
        console.log(this.userList);
      }
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
