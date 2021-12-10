<template>
  <section>
    <menu-bar v-if="activeUser" @sign-out="userSignOut"></menu-bar>
    <router-view @sign-in="userSignIn"></router-view>
 </section>
</template>

<script>
// import axios from 'http.js';
// import axios from "axios";
// const URL = 'http://127.0.0.1:8000/api'
export default {
  data(){
    return{
      activeUser:null,
    }
  },
  watch : {
    activeUser(){
      return this.activeUser !== null;
    }
  },
  methods: {
      userSignIn(user){
        this.activeUser = user;
        localStorage.setItem('user',JSON.stringify(user));
      },
      userSignOut(){
        this.activeUser = null;
      }
  },
  mounted() {
    // if ((window.localStorage.getItem("user") !== null) && this.$route.path == "/signIn" || this.$route.path == "/") {
    //   this.$router.push("/home"); // redirect to home, for example
    // }
    let user = JSON.parse(localStorage.getItem("user"));
    if(user !== null){
        this.activeUser = JSON.parse(localStorage.getItem("user"));
        this.$router.push("/home");
    }
    else{
       this.activeUser = user;
       this.$router.push('/signIn');
    }
    window.onpopstate = event => {
      if ((window.localStorage.getItem("user") !== null) && this.$route.path == "/signIn" || this.$route.path == "/") {
          this.$router.push("/home"); // redirect to home, for example
      }
      console.log(event);
    };
    if (
        (window.localStorage.getItem("user") !== null &&
        this.$route.path == "/signIn") || this.$route.path == "/"
      ) {
        this.$router.push("/home"); // redirect to home, for example
      }
    
  },
  // computed: {
  //   currentRouteName() {
  //       console.log(this.$router.path);
  //       if(this.$router.path === '/' || this.$router === '/signIn'){
  //         localStorage.clear();

  //       }
  //       return this.$route.path;
  //   }
  // },
   provide(){
    return {$activeUser :()=> this.activeUser};
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  /* / margin-top: 60px; / */
}
</style>
