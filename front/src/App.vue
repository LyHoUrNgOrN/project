
<template>
  <section>
    <menu-bar v-if="activeUser" @sign-out="userSignOut" @new-data="userSignIn"></menu-bar>
    <router-view @sign-in="userSignIn"></router-view>
 </section>
</template>

<script>

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
        console.log(user);
        this.activeUser = user;
        localStorage.setItem('user',JSON.stringify(user));
        localStorage.setItem('path', '/myEvent');
      },
      userSignOut(){
        this.activeUser = null;
      }
  },
  mounted() {
    if ((window.localStorage.getItem("user") !== null) && this.$route.path == "/signIn" || this.$route.path == "/") {
      let pathed = localStorage.getItem('path');
      this.$router.push(pathed); // redirect to myEvent, for example
      this.activeUser = JSON.parse(localStorage.getItem("user"));

    }
    let user = JSON.parse(localStorage.getItem("user"));
    if(user !== null){
        this.activeUser = JSON.parse(localStorage.getItem("user"));
        const pathed = localStorage.getItem('path');
        this.$router.push(pathed);
    }
    else{
       this.activeUser = user;
       this.$router.push('/signIn');
      localStorage.setItem('path', '/');

    }
    window.onpopstate = event => {
      if ((window.localStorage.getItem("user") !== null) && this.$route.path == "/signIn" || this.$route.path == "/") {
          this.$router.push("/myEvent"); // redirect to myEvent, for example
      }
      console.log(event);
    };
    
  },

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
