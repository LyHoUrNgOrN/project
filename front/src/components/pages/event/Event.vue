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
                <!-- <button class="interested-btn">Detail</button> -->
                
                <button class="quit-btn"  v-if="isJoin(event.id)" @click="quitJoin(event.id)">Quit</button>
                <button class="join-btn"  v-else @click="joinEvent(event.id)">Join</button>
                <!-- <button class="join-btn">Join</button> -->
            </event-card>
           
        </div>
    </div>
  <!-- </div> -->
</section>

</template>

<script>
// import axios from 'axios';
// const URL = 'http://localhost:8000/api'
import axios from "../../../api/api.js";
import moment from "moment";

export default {
    inject:["$activeUser"],
    data() {
      return{
        eventList: [],
        eventHasJoined:[],
      }
    },
    methods: {
      
      dateFormat(date){
        return moment(date).format('YYYY-MM-DD hh:mm:ss');
      },
      isJoin(eventId){
          for (let joinEvent of this.eventHasJoined){
            if(joinEvent.id == eventId){
              return true;
            }
          }
          return false;
      },
      joinEvent(eventId){
        let user_create = {
            user_id: this.activeUser.id,
            event_id: eventId,
            role: "member",
        };
        axios.post("/event_joins", user_create).then((res) => {
          console.log(res.data.message);
          this.getOtherEvents();
        });
      },
      quitJoin(eventId){
        axios.get("/event_quit_id/"+eventId+"/"+this.activeUser.id).then((response)=>{
          let idToQuit = response.data[0].id;
          axios.delete("event_quit/"+idToQuit).then(response=>{
            console.log(response.data.message);
            this.getOtherEvents();
          });
        });
      },
      getOtherEvents(){
        axios.get("/event_user_has_joins/"+this.activeUser.id).then((response)=>{
          this.eventHasJoined = response.data;
        });
        axios.get('/event_other/'+ parseInt(this.activeUser.id)).then((res) => {
          let allData = res.data;
          let currentDate = new Date();
          let date = currentDate.getFullYear()+'-'+currentDate.getDate()+'-'+(currentDate.getMonth()+1)+' '+currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();
          let events = [];
          for(let eachObj of allData){
            if(this.dateFormat(eachObj.dateEnd) >= this.dateFormat(date)){
              events.push(eachObj);
            }
          }
          this.eventList = events;
        });
      }
    },
    mounted(){
      this.$router.push("/Event");
      this.$router.replace(this.$route.path, {silent:true});
      this.getOtherEvents();
      axios.get("/event_user_has_joins/"+this.activeUser.id).then((response)=>{
        this.eventHasJoined = response.data;
      });
      localStorage.setItem('path', this.$route.path);

    },
    computed : {
      activeUser(){
        return this.$activeUser();
      }
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

    .join-btn{
        padding: 9px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        color: white;
        width: 28%;
        margin-left: 5px;
        float: right;
        cursor: pointer;
        background: rgba(107, 180, 236, 0.719);

        
    }
    .quit-btn{
        padding: 9px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        color: white;
        width: 28%;
        margin-left: 5px;
        float: right;
        cursor: pointer;
        background: rgba(103, 107, 110, 0.719);

    }
</style>