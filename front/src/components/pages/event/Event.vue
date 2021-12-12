<template>
<section>  
    <div class="mainRight">
        <event-header>
            <h3>All Event</h3>
            <div class="search_event">
              <input type="text" placeholder="Search event" id="seachBytitle" v-model="searchByText" @keyup="findEvent">
              <select id="selectCity" v-model="searchByCity" @change="findEvent">
                <option v-for="(city,index) of cityList"
              :key="index"
              :value="city"
              @select="findEvent"
              >
              {{ city }}
              </option>
              </select>
            </div>    
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
</section>

</template>

<script>
import axios from 'axios';
const URL = 'http://localhost:8000/api'

export default {
   
    data() {
      return{
        searchByText: '',
        searchByCity: 'Phnom Penh',
        eventList: [],
        cityList : [],
        listAllOfEvent: [],
        
      }
    },
    methods:{
      findEvent(){
        if (this.searchByText !== ''){
          console.log(this.searchByText);
          console.log(this.searchByCity)
          this.eventList = this.listAllOfEvent.filter(events => ((events.title.toLowerCase().includes(this.searchByText.toLowerCase())) ||(events.description.toLowerCase().includes(this.searchByText.toLowerCase())) ||(events.name.toLowerCase().includes(this.searchByText.toLowerCase()))) && (events.city === this.searchByCity)
           );

          // this.eventList = event;
          console.log(event);
        }else{
          this.getEvent();
        }
        
      },
      getEvent(){
        const id = JSON.parse(localStorage.getItem("user")).id;
        axios.get(URL+ '/event_other/'+ parseInt(id)).then((res) => {
          this.eventList = res.data;
          this.listAllOfEvent = res.data;
          console.log(this.eventList);
        })
      },
      
    },
    mounted(){
      this.$router.push("/Event");
      this.$router.replace(this.$route.path, {silent:true})
      this.getEvent();
      axios.get(URL+'/countries').then((res) => {
        // let country = [];
        let all = res.data;
        for(let countries in all){
          for(let city of all[countries]){
            this.cityList.push(city);
            // console.log(city)
          }
          // console.log(all.countries);
        }
        // console.log(all);
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
    .search_event{
      display: flex;
      width: 60%;
      justify-content: space-between;
    }
    #seachBytitle{
      padding: 10px;
      border: 1px solid gray;
      outline: none;
      width: 85%;
      border-radius: 10px 0 0 10px;
    }
    #selectCity{
      border-radius: 0 10px 10px 0;
    }
    #seachBytitle:focus{
      background: white;
    }
</style>