<template>
<section>
  <!-- <div class="main"> -->
    <!-- <sub-navigation></sub-navigation> -->
  
    <div class="mainRight">
        <event-header>
            <h3>All Event</h3>
        </event-header>
        <div class="sidebarContainer">
            <event-card
              v-for="event of eventList" :key="event.id"
              :event-data="event"
            >
                <button class="interested-btn">Interested</button>
                <button class="join-btn">Join</button>
            </event-card>
           
        </div>
    </div>
  <!-- </div> -->
</section>

</template>

<script>
import axios from 'axios';
const URL = 'http://localhost:8000/api'

export default {
   
    data() {
      return{
        eventList: []
      }
    },
    mounted(){
      this.$router.push("/Event");
      this.$router.replace(this.$route.path, {silent:true})
      const id = JSON.parse(localStorage.getItem("user")).id;
      axios.get(URL+ '/event_other/'+ parseInt(id)).then((res) => {
        this.eventList = res.data;
        console.log(this.eventList);
      })


    }
}
</script>

<style scoped>

    
    .sidebarRight{
        width: 90%;
        background: rgb(22, 22, 22);
        
    }
    .sidebarContainer{
        width: 90%;
        margin: auto;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .interested-btn,
    .join-btn{
        padding: 9px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        color: white;
    }
    .interested-btn{
        width: 65%;
        background: rgb(179, 176, 176);
        margin-right: 5px;
    }
    .join-btn{
        width: 28%;
        background: rgb(55, 175, 231);
        margin-left: 5px;
    }
</style>