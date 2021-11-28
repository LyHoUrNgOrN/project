<template>
  <div class="main">
    <sub-navigation></sub-navigation>
    <my-event-card></my-event-card>
  </div>
</template>

<script>
import SubNavigation from './../SubNavigation.vue'
import MyEventCard from './MyEventCard.vue'

export default {
    components:{
        SubNavigation,
        MyEventCard
    }
}
</script>

<style scoped>
  .main{
      display: flex;
      justify-content: space-between;
      
  }
</style>