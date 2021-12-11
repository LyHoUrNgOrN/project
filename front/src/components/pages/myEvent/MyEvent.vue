<template>
  <section>
    <!-- <menu-bar></menu-bar> -->
    <div class="main">
      <!-- <sub-navigation></sub-navigation> -->
      <div class="mainRight">
        <event-header>
          <h3>All Event</h3>
          <button class="btn-create" @click="create_event">+ Create</button>
        </event-header>
        <div class="sidebarContainer">
          <event-card
            v-for="event of eventList"
            :key="event.id"
            :event-data="event"
          >
            <div class="btn_edit_cacel">
              <button class="cancel_btn" @click="showCancelEvent(event.id)"> Cancel</button>
              <button class="edit_btn" @click="showEditEvent(event)"><i class="fa fa-pencil-square-o"></i>Edit</button>
            </div>

            
          </event-card>

          <!-- Cancel dialog -->
          <dialog-box
            v-if="dialogDisplay"
            :title="dialogTitleCancel"
            @close="closeDialog"
          >
            <hr />
            <h4>
              <i class="fa fa-exclamation-triangle"></i> Are you sure that you
              want to cancel this Event!!!
            </h4>
            <template #actions>
              <botton-widget @click="removeEvent" class="confirm_btn">Cancel</botton-widget>
            </template>
          </dialog-box>

          <event-form
              v-if="display"
              :title-form="dialogTitle"
              :dialog-buttton='dialogButtton'
              :dialog-mode="dialogMode"
              @close="close"
              @display-event="displayAllEvent"
            >

            </event-form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "../../../api/api.js";
import EventForm from "../myEvent/MyEvent.vue";


export default {
  components:{
    EventForm
  },
  data() {
    return {
      event: [{}],
      dialogMode: "create",
      dialogDisplay: false,
      display: false,
      showEvent: false,
      dialogTitleCancel: "Cancel Your Event",
      eventList: [],
      oneEvent: [{}],
    };
  },

  computed: {
    dialogTitle() {
      return this.dialogMode === "edit" ? "EDIT EVENT" : "CREATE EVENT";
    },
    dialogButtton() {
      return this.dialogMode === "edit" ? "EDIT" : "CREATE";
    },
  },
  methods: {
    close(close){
      this.display = close;
    },
    showEditEvent(event){
      this.display = true;
      this.dialogMode = "edit";
      this.oneEvent = event;
    },
    closeDialog() {
      this.dialogDisplay = false;
      this.display = false;
      this.setNull();
    },
    showCancelEvent(id) {
      this.dialogMode = "cancel";
      this.dialogDisplay = true;
      this.eventId = id;
    },
    onConfirm() {
      this.closeDialog();
    },
    removeEvent() {
      axios.delete("/events/" + this.eventId).then(() => {
        this.displayAllEvent();
      });
      this.dialogDisplay = false;
      this.eventId = null;
    },
    create_event() {
      this.display = true;
      this.dialogMode = "create";
    },
    displayAllEvent() {
      const id = JSON.parse(localStorage.getItem("user")).id;
      axios.get("/event_users/" + parseInt(id)).then((res) => {
        this.eventList = res.data;
      });
    },
  },
  mounted() {
    this.displayAllEvent();
  },
  provide(){
    return {$oneEvent :()=> this.oneEvent};
  },
};
</script>

<style scoped>


.sidebarRight {
  width: 83%;
  background: rgb(22, 22, 22);
}
.sidebarContainer {
  width: 86%;
  margin: auto;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}
.btn-create {
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

.btn_edit_cacel {
  display: flex;
  justify-content: center;
  align-items: flex-end;
  float: right;
}
.cancel_btn,
.edit_btn {
  width: 100px;
  padding: 9px;
  border: none;
  border-radius: 10px;
  font-weight: bold;
  color: white;
}
.detail_btn{
  width: 48%;
}
.cancel_btn {
  margin-right: 5px;
  background: rgb(138, 138, 138);
}
.edit_btn {
  margin-left: 5px;
  background: rgb(58, 151, 204);
}
h4 {
  font-size: 22px;
}
.fa-exclamation-triangle{
  color: red;
  font-size: 30px;
  margin-right: 10px;
}
.fa-pencil-square-o{
  margin-right: 10px;
}

</style>