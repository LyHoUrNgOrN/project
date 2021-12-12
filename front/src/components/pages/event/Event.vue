<template>
<section>
  <!-- <div class="main"> -->
    <!-- <sub-navigation></sub-navigation> -->
    <!-- <header>
    <li class="header">All Event</li>

    </header> -->
    <event-header
    :title="event_title"
    ></event-header>
    <div class="mainRight">
        <div class="sidebarContainer">
            <event-card
              v-for="event of eventList" :key="event.id"
              :event-data="event"
            >
                <button class="join-btn">Join</button>
            </event-card>
           
        </div>
    </div>
  <!-- </div> -->
</section>

</template>

<script>
import axios from "../../../api/api.js";
import moment from "moment";
import EventHeader from '../../UI/Header.vue'
// import Header from '../../UI/Header.vue';

export default {
   components: { EventHeader },
    data() {
      return{
        eventList: [],
        id: JSON.parse(localStorage.getItem("user")).id,
        event_title: 'All Event'
      }
    },

    methods: {
      dateFormat(date){
        return moment(date).format('YYYY-MM-DD hh:mm:ss');
      },
      getEventOtherUser(){
        axios.get('/event_other/'+ parseInt(this.id)).then((res) => {
          let allData = res.data;
          let currentDate = new Date();
          let date = currentDate.getFullYear()+'-'+currentDate.getDate()+'-'+(currentDate.getMonth()+1)+' '+currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();
          let events = [];
          for(let eachObj of allData){
            if(this.dateFormat(eachObj.dateEnd) >= this.dateFormat(date)){
              events.push(eachObj);
            console.log(123);

            }
          }
          this.eventList = res.data;
          console.log(this.eventList);
        });
        axios.get('/event_user_has_joins/'+ parseInt(this.id)).then((res)=> {
            this.userJoinEvent = res.data;
        });
      }
    },

    mounted(){
      this.$router.push("/Event");
      this.$router.replace(this.$route.path, {silent:true})
      this.getEventOtherUser();
    }
}
</script>

<style scoped>
    ::-webkit-scrollbar {
        width: 0px;
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
        /* float: right; */
        background: #F1C40F;
        font-size: 15px;
        margin-bottom: 10px;

    }


</style>