<template>
<section>
  <!-- <menu-bar></menu-bar> -->
  <div class="main">
    <sub-navigation></sub-navigation>
    <!-- <event-card></event-card> -->
  </div>
</section>

</template>

<script>
import SubNavigation from './../SubNavigation.vue'
// import EventCard from './../EventCard.vue'

export default {
    components:{
        SubNavigation,
        // EventCard
    },
    
    data() {
      return{
        
      }
    }
}
</script>

<style scoped>
  .main{
      display: flex;
      justify-content: space-between;
      
  }
</style>