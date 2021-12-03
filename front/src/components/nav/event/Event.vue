<template>
<section>
  <!-- <menu-bar></menu-bar> -->
  <div class="main">
    <sub-navigation></sub-navigation>
  
    <div class="mainRight">
        <div class="cardHead">
            <h3>All Event</h3>
            <!-- <button class="btn-create">+ Create</button> -->
        </div>
        <div class="sidebarContainer">
            <event-card
              v-for="event of eventList" :key="event.id"
              :event-datas="event"
            ></event-card>
           
        </div>
    </div>
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
        eventList: [
          {id: 1, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://guesthubs.com/wp-content/uploads/2021/03/pexels-photo-1051076.jpeg'},
          {id: 1, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://greatescapepublishing.com/wp-content/uploads/2018/07/stock-photos.jpg'},
          {id: 1, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://149442090.v2.pressablecdn.com/wp-content/uploads/2018/01/Hand-picked-stock-photos-for-your-marketing-materials-v2.jpg'},
          {id: 1, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80'},
          {id: 1, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://images.pexels.com/photos/1264210/pexels-photo-1264210.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'},
          {id: 1, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://images4.alphacoders.com/264/264676.jpg'},
        ]
      }
    }
}
</script>

<style scoped>
  .main{
      display: flex;
      justify-content: space-between;
      
  }
  .mainRight{
        margin-left: 19%;
    }
    .cardHead{
        margin-top: 60px;
        margin-bottom: 20px;
        margin-left: 55px;
        border-bottom: 2px solid gray;
        width: 90%;
        /* / margin: auto; / */
        display: flex;
        justify-content: space-between;
        align-items: end;
        position: sticky;

    }
    .cardHead h3{
        color: white;
    }
    .cardHead .btn-create{
        padding: 12px;
        width: 13%;
        border: none;
        border-radius: 15px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        background: rgb(55, 175, 231);
        margin-bottom: 20px;
    }
    .sidebarRight{
        width: 83%;
        background: rgb(22, 22, 22);
        /* / display: flex; / */
        /* / justify-content: space-between; / */
    }
    .sidebarContainer{
        width: 90%;
        margin: auto;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
</style>