<template>
<section>
    <header>
      <li class="header">All Explore Event</li>
        <div class="search_event">
          <input type="text" placeholder="Search event" id="seachBytitle" v-model="searchByText" @keyup="findEvent">
          <select id="selectCity" v-model="searchByCity" @change="findEvent">
            <option v-for="(city,index) of cityList" :key="index" :value="city" >
          {{ city }}
          </option>
          </select>
        </div>    
    </header>
    <div class="mainRight">
      <div class="sidebarContainer">
          <event-card
            v-for="event of eventList" :key="event.id"
            :event-data="event"
          >                
              <button class="quit-btn"  v-if="isJoin(event.id)" @click="quitJoin(event.id)">Quit</button>
              <button class="join-btn"  v-else @click="joinEvent(event.id)">Join</button>
          </event-card>
          
      </div>
    </div>
</section>

</template>

<script>
import axios from "../../../api/api.js";
import moment from "moment";
import EventHeader from '../../UI/Header.vue'

export default {
    inject:["$activeUser"],
    components: [
      EventHeader, 
    ],
    data() {
      return{
        searchByText: '',
        searchByCity: 'Phnom Penh',
        eventList: [],
        id: JSON.parse(localStorage.getItem("user")).id,
        cityList : [],
        listAllOfEvent: [],
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
        axios.post("/event_joins", user_create).then(() => {
          this.getEventJoinByUser();
          this.findEvent();
          this.isJoin(eventId);
        });
      },

      quitJoin(eventId){
        axios.get("/event_quit_id/"+eventId+"/"+this.activeUser.id).then((response)=>{
          let idToQuit = response.data[0].id;
          axios.delete("event_quit/"+idToQuit).then(()=>{
            this.findEvent();
            this.getEventJoinByUser();
            this.isJoin(eventId);
          });
        });
      },

      getEventJoinByUser(){
        axios.get("/event_user_has_joins/"+this.activeUser.id).then((response)=>{
          this.eventHasJoined = response.data;
        });
        this.findEvent();
      },

      findEvent(){
        if (this.searchByText !== '' || this.searchByCity !== ''){
          this.eventList = this.listAllOfEvent.filter(events => ((events.title.toLowerCase().includes(this.searchByText.toLowerCase())) 
          ||(events.description.toLowerCase().includes(this.searchByText.toLowerCase())) 
          ||(events.name.toLowerCase().includes(this.searchByText.toLowerCase()))) 
          && (events.city === this.searchByCity));
          
        }else{
          this.eventList = this.listAllOfEvent;
        }
        
      },
      getEvent(){
        axios.get('/event_other/'+ parseInt(this.activeUser.id)).then((res) => {
          let allData = res.data;
          let currentDate = new Date();
          let date = currentDate.getFullYear()+'-'+currentDate.getDay()+'-'+(currentDate.getMonth()+1)+' '+currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();
          let events = [];
          for(let eachObj of allData){
            if(this.dateFormat(eachObj.dateEnd) >= this.dateFormat(date)){
              events.push(eachObj);
            }
          }
          this.eventList = events;
          this.listAllOfEvent = events;   
          this.findEvent();

        });
      },
      
    },
    mounted(){
      this.$router.push("/Event");
      this.$router.replace(this.$route.path, {silent:true})
      this.getEvent();
      axios.get('/countries').then((res) => {
        let all = res.data;
        for(let countries in all){
          for(let city of all[countries]){
            this.cityList.push(city);
          }
        }
      })

      this.getEventJoinByUser();
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

    ::-webkit-scrollbar {
        width: 0px;
    }
     header{
      padding: 20px;
      background: #154360;
      color: white;
      position: sticky;
      top: 142px;
      z-index: 2;
      display: flex;
      justify-content: flex-start;
    }
    .header{
      list-style: none;
      display: flex;
      justify-self: flex-start;
      align-items: flex-start;
      margin-left: 20px;
      font-size: 20px;
      width: 50%;

    }
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
        background: #F1C40F;
        font-size: 15px;
        margin-bottom: 10px;

        
    }
    .quit-btn{
        padding: 9px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        color: white;
        width: 28%;
        cursor: pointer;
        background: rgba(103, 107, 110, 0.719);

    }
    .search_event{
      display: flex;
      width: 60%;
      justify-content: space-between;
      float: right;
    }
    #seachBytitle{
      width: 85%;

    }
    #seachBytitle,
    #selectCity{
      padding: 10px;
      border: 2px solid rgb(255, 255, 255);
      outline: none;
      font-size: 18px;
      background: #2a546e3a;
      color: white;
    }
    #selectCity{
      width: 30%;
      border-left: none;
    }
</style>