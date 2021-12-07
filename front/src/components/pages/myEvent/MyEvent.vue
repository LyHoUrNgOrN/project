<template>
<section>
  <!-- <menu-bar></menu-bar> -->
  <div class="main">
    <sub-navigation></sub-navigation>
    <div class="mainRight">
        <event-header>
            <h3>All Event</h3>
            <button class="btn-create">+ Create</button>
        </event-header>
        <div class="sidebarContainer">
            <event-card
              v-for="event of eventList" :key="event.id"
              :event-data="event"
            >
                <button class="cancel_btn"  @click="showCancelEvent" :title="dialogMode">Cancel</button>
                <button class="edit_btn"  @click="showEditEvent">Edit</button>

                
            </event-card>
            <dialog-box
                  v-if="dialogDisplay"
                  :title="dialogTitle"
                  @close="closeDialog"
                  >
                  <hr>
                  <label for="description" v-if="dialogMode === 'edit' ">Category Name</label>
                  <input
                      v-if="dialogMode === 'edit'"

                  />
                  <h4 v-if="dialogMode !== 'edit'"> <i class="fa fa-exclamation-triangle"></i> Are you sure that you want to cancel this Event!!!</h4>

                  <template #actions>
                      <button @click="onConfirm" class="confirm_btn">{{ dialogButtton }}</button>
                  </template>
              </dialog-box>
        </div>
    </div>
  </div>
</section>

</template>

<script>

export default {    
    data() {
      return{
        dialogMode: 'cancel',
        dialogDisplay: false,
        eventList: [
          {id: 1, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://guesthubs.com/wp-content/uploads/2021/03/pexels-photo-1051076.jpeg'},
          {id: 2, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://greatescapepublishing.com/wp-content/uploads/2018/07/stock-photos.jpg'},
          {id: 3, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://149442090.v2.pressablecdn.com/wp-content/uploads/2018/01/Hand-picked-stock-photos-for-your-marketing-materials-v2.jpg'},
          {id: 4, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80'},
          {id: 5, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://images.pexels.com/photos/1264210/pexels-photo-1264210.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'},
          {id: 6, title: "ABCDEFGHIJKLMOPQRSTUVWXZY", dateStart: 'November 12, 2021', dateEnd:'November 12, 2021', member: 123, interested: 300, image: 'https://images4.alphacoders.com/264/264676.jpg'},
        ]
      }
    },
    computed: {
       
        dialogTitle() {
        return this.dialogMode === 'edit' ? 'EDIT EVENT' : 'CANCEL EVENT';
        },
        dialogButtton() {
        return this.dialogMode === 'edit' ? 'EDIT' : 'CANCEL';
        },
    },
    methods:{
       closeDialog() {
        this.dialogDisplay = false;
       
        },
      showCancelEvent(){
        this.dialogMode = 'cancel';
        this.dialogDisplay = true;
      },
      showEditEvent(){
        console.log('Cancel');
        this.dialogMode = 'edit';
        this.dialogDisplay = true;
      },
      onConfirm(){
        this.closeDialog();
      }
    },
    mounted(){

            console.log(this.$route.path);

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
    
    .sidebarRight{
        width: 83%;
        background: rgb(22, 22, 22);
        
    }
    .sidebarContainer{
        width: 90%;
        margin: auto;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
  .btn-create{
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
    .cancel_btn,
    .edit_btn{
      width: 48%;
      padding: 9px;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      color: white;

    }
    .cancel_btn{
      margin-right: 5px;
      background: rgb(138, 138, 138);
    }
    .edit_btn{
      margin-left: 5px;
      background: rgb(58, 151, 204);
    }
    h4{
        font-size: 22px;

    }
    .confirm_btn{
      border: none;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 15px;
      width: 18%;
      color: aliceblue;
      background: rgb(211, 41, 41);
    }
    
</style>