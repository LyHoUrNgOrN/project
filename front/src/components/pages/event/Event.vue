<template>
<section>
  <!-- <div class="main"> -->
    <!-- <sub-navigation></sub-navigation> -->
    <div>
            <input type="text" placeholder="search Event" v-model="searchByText" @keyup="findEvent">
            <input type="text" placeholder="search city" v-model="searchByCity" @keyup="findEvent">
            <small>{{messageRemind}}</small>

    </div>
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
// import axios from 'axios';
// const URL = 'http://localhost:8000/api'
import axios from "../../../api/api.js";
import moment from "moment";

export default {
   
    data() {
      return{
        eventList: [
          {id:1,title:'Vue',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Phnom Penh',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:2,title:'JavaScript',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Siem Reap',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:3,title:'PHP',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Battambong',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:4,title:'Laravel',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Banteay Meanchey',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:5,title:'Database',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Keb',description:'I love Cambodia.',picture:'photo.jpg'},

        ],
        searchByText:'',
        searchByCity:'',
        messageRemind:'',

      }
    },
    methods: {
      
      findEvent(){

        this.eventList=[
          {id:1,title:'Vue',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Phnom Penh',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:2,title:'JavaScript',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Siem Reap',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:3,title:'PHP',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Battambong',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:4,title:'Laravel',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Banteay Meanchey',description:'I love Cambodia.',picture:'photo.jpg'},
          {id:5,title:'Database',dateStart:'2021-12-08 12:00:00',dateEnd:'2021-12-08 12:00:00',country:'Cambodia',city:'Keb',description:'I love Cambodia.',picture:'photo.jpg'},

        ];

        if (this.searchByText!=='' && this.searchByCity ===""){
          this.messageRemind = "please enter the city";
        }else if (this.searchByCity !== '' && this.searchByText !==''){
          this.messageRemind = "";
          let event = this.eventList.filter(events => (events.title.toLowerCase().includes(this.searchByText.toLowerCase() ) || events.title.toLowerCase() === this.searchByText.toLowerCase() ) && (events.city.toLowerCase().includes(this.searchByCity.toLowerCase() ) || (events.city.toLowerCase() === this.searchByCity.toLowerCase())));
          this.eventList = event;
          console.log(event);
        }else{
          this.messageRemind = "" 
        }
      },

      dateFormat(date){
        return moment(date).format('YYYY-MM-DD hh:mm:ss');
      },
        
        

      
      // getAllevent(){
      //     const id = JSON.parse(localStorage.getItem("user")).id;
      //     axios.get(URL+ '/event_other/'+ parseInt(id)).then((res) => {
      //       this.eventList = res.data;
      //       console.log(this.eventList);
      //     })
      // }
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