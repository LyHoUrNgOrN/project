<template>
<section>
  <div class="main">
    <div class="mainRight">
        <event-header>
            <h3>All Event</h3>
            <button class="btn-create" @click="create_event">+ Create</button>
        </event-header>
        <div class="sidebarContainer">
            <event-card
              v-for="event of eventList" :key="event.id"
              :event-data="event"
            >
                <button class="cancel_btn"  @click="showCancelEvent(event.id)" :title="dialogMode">Cancel</button>
                <button class="edit_btn"  @click="showEditEvent">Edit</button>
            </event-card>
            <dialog-box
                  v-if="dialogDisplay"
                  :title="dialogTitleCancel"
                  @close="closeDialog"
                  >
                  <hr>
                  <h4> <i class="fa fa-exclamation-triangle"></i> Are you sure that you want to cancel this Event!!!</h4>
                  <template #actions>
                      <button @click="removeEvent" class="confirm_btn">Cacel</button>
                  </template>
            </dialog-box>
            <base-dialog
              v-if="showDialogeEvent"
              :title="dialogTitle"
              @close="closeDialog">
              <template #actions>
                <base-button @click="onConfirm">{{ dialogButtton }}</base-button>
              </template>
            </base-dialog>
        </div>
    </div>
  </div>
</section>

</template>

<script>
import axios from 'axios';
const URL = 'http://127.0.0.1:8000/api'

export default {    
    data() {
      return{
        dialogMode: 'create',
        dialogDisplay: false,
        showDialogeEvent: false,
        showEvent: false,
        eventId: null,
        dialogTitleCancel: "Cancel Your Event",
        eventList: []
      }
    },
    computed: {
       
        dialogTitle() {
        return this.dialogMode === 'edit' ? 'EDIT EVENT' : 'CREATE EVENT';
        },
        dialogButtton() {
        return this.dialogMode === 'edit' ? 'EDIT' : 'CREATE';
        },
    },
    methods:{
       closeDialog() {
        this.dialogDisplay = false;
       
        },
      showCancelEvent(id){
        this.dialogMode = 'cancel';
        this.dialogDisplay = true;
        this.eventId = id;
      },
      showEditEvent(){
        console.log('Cancel');
        this.dialogMode = 'edit';
        this.dialogDisplay = true;
      },
      onConfirm(){
        this.closeDialog();
      },
      removeEvent(){
        axios.delete(URL+ '/events/' + this.eventId).then(()=> {
          this.displayAllCategory();
        })
        this.dialogDisplay = false;
        this.eventId = null;
      },
      create_event(){
        this.showDialogeEvent = true;
        this.dialogMode = 'create';
      },



      displayAllCategory(){
        const id = JSON.parse(localStorage.getItem("user")).id;
        axios.get(URL+ '/event_users/'+ parseInt(id)).then((res) => {
          this.eventList = res.data;
          console.log(this.eventList);
        })
      }

    },
    mounted(){
      this.displayAllCategory();

    }
}
</script>

<style scoped>
    
    .sidebarRight{
        width: 83%;
        background: rgb(22, 22, 22);
        
    }
    .sidebarContainer{
        width: 86%;
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
    .fa-exclamation-triangle{
        color: red;
        margin-right: 10px;
    }
</style>