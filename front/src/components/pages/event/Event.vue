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

export default {
   
    data() {
      return{
        eventList: []
      }
    },

    methods: {
      dateFormat(date){
        return moment(date).format('YYYY-MM-DD hh:mm:ss');
      },
    },

    mounted(){
      this.$router.push("/Event");
      this.$router.replace(this.$route.path, {silent:true})
      const id = JSON.parse(localStorage.getItem("user")).id;
      axios.get('/event_other/'+ parseInt(id)).then((res) => {
        let allData = res.data;
        let currentDate = new Date();
        let date = currentDate.getFullYear()+'-'+currentDate.getDate()+'-'+(currentDate.getMonth()+1)+' '+currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();
        for(let eachObj of allData){
          if(this.dateFormat(eachObj.dateEnd) >= this.dateFormat(date)){
            this.eventList.push(eachObj)
          }
        }
      });
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
        background: rgb(55, 175, 231);
        margin-left: 5px;
        float: right;
    }
</style>