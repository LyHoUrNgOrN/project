<template>
  <dialog-box v-if="display" :title="titleForm" @close="closeDialog(false)" class="create_box">
    <hr>
    <div class="a">
      <form action="">
        <label for="title" id="eventTitle">Event title</label>
        <input type="text" placeholder="Event title" id="title" v-model="title">
        <div class="dateTime">
          <div class="startDate">
            <label for="">Date Start</label><br>
            <input type="datetime-local" placeholder="Date Start" id="date" v-model="dateStart">
          </div>
          <div class="endDate">
            <label for="">Date End</label><br>
            <input type="datetime-local" placeholder="Date Start" id="date" v-model="dateEnd">
          </div>
          
        </div>

        <div id="select">
          <label for="country" >Country</label>
          <select name="country" id="country" v-model="eventCountry">
            <option disabled value="">Please select a country</option>
            <option v-for="(city, eachCountry) of countries" :key="eachCountry" :value="eachCountry" > {{ eachCountry }} </option>
          </select>
        </div>

        <div id="select">
          <label for="city" >City</label>
          <select name="city" id="city" v-model="city">
            <option disabled value="">Please select a country frist</option>
            <option v-for="(city, country) of countries[eventCountry]" :key="country" :value="city">
              {{ city }}
            </option>
          </select>
        </div>
        
        <div id="select">
          <label for="category" >Category</label>
          <select name="category" id="category" v-model="eventCategory">
            <option disabled value="">Please select a category of your event</option>
            <option v-for="(value, id) of categories" :key="id" :value="value.id">
              {{ value.name }}
            </option>
          </select>
        </div>
        <div id="textarea">
          <label for="description" >Description</label>
          <textarea name="" id="description" cols="43" rows="3" placeholder="Description" v-model="description"></textarea>
        </div>
        
      </form>
      <label for="img" id="chooseImage" v-if="isEdit">
        <img class="image" :src="previewImage">      
      </label>
      <input type="file" id="img" accept="image/jpeg, image/png, image/gif" @change="selectImage">
    </div>
    <template #actions>
      <small id="error">{{ message }}</small>
        <botton-widget class="creat_btn" @click="onConfirm">{{ dialogButtton }}</botton-widget>
    </template>
  </dialog-box>
</template>


<script>
import axios from "../../api/api.js";

import moment from "moment";

export default {
  inject: ['$oneEvent'],
  props:['dialogMode', 'dialogButtton', 'titleForm'],
  emits: ['displayEvent', 'close'],
  data() {
    return {
      dialog_mode: this.dialogMode,
      display: true,
      eventList: this.event,
      showDialogeEvent: false,
      dialogTextField: '',
      image: "",
      eventCountry: null,
      eventCategory: null,
      city: null,
      title: null,
      dateStart: null,
      dateEnd: null,
      description: null,
      previewImage: "https://kendramakslife.engrave.site/img/default.jpg",
      message: "",
      eventId: null,
      categories: [],
      countries: [],
      event: this.oneEvent,
      isEdit: true,
    };
  },
  computed: {
      oneEvent(){
        return this.$oneEvent();
      }
  },
  methods: {
    closeDialog(isTrue) {
      this.$emit('close', isTrue);
    },
    dateFormat(date) {
      return moment(date).format("YYYY-MM-DD hh:mm:ss");
    },
    selectImage(e) {
      const image = e.target.files[0];
      let reader = new FileReader();
      reader.onloadend = (e) => {
        this.previewImage = e.target.result;
      };
      reader.readAsDataURL(image);
      this.image = e.target.files[0];
    },
    create_new_event(){
      let newEvent = new FormData();
            newEvent.append("title", this.title);
            newEvent.append("dateStart", this.dateFormat(this.dateStart));
            newEvent.append("dateEnd", this.dateFormat(this.dateEnd));
            newEvent.append("country", this.eventCountry);
            newEvent.append("city", this.city);
            newEvent.append("category_id", this.eventCategory);
            newEvent.append("description", this.description);
            newEvent.append("picture", this.image);

            axios.post("/events", newEvent)
                .then((res) => {
                  let user_create = {
                    user_id: JSON.parse(localStorage.getItem("user")).id,
                    event_id: res.data.data.id,
                    role: "creator",
                  };
                  axios.post("/event_joins", user_create).then(() => {
                    this.closeDialog(false);
                  });

                }).catch((error) => {
                  this.closeDialog(true);
                  this.message = error.response.data.message;

                });
    },
    update_event(){
      let editEvent = {
        "title": this.title,
        "dateStart": this.dateFormat(this.dateStart),
        "dateEnd": this.dateFormat(this.dateEnd),
        "country": this.eventCountry,
        "city": this.city,
        "category_id": this.eventCategory,
        "description": this.description,
        "picture": this.oneEvent.picture,
      }
      axios
          .put("/events/" + parseInt(this.eventId), editEvent)
          .then(() => {
            this.closeDialog(false);
            this.eventId = null;

          })
          .catch((error) => {
            this.closeDialog(true);
            this.message = error.response.data.message;
      });
    },

    onConfirm(){
      if (this.title !== null && this.dateStart !== null && this.dateEnd !== null && this.eventCountry !== null && this.city !== null && this.eventCategory !== null && this.description !== null){
          if (this.dialog_mode === 'create'){
            if ( this.image !== ''){
              this.create_new_event();
            }

        }else if (this.dialog_mode === "edit"){
          this.update_event();
          
        }
        this.message = "";
      }else{
        this.message = "You should complete all information";
      }
    }
      
  },
  mounted() {
    axios.get('/countries').then(res=>{
      this.countries = res.data;
    });
    axios.get('/category').then(res=>{
      this.categories = res.data;
    })
      if (this.dialog_mode === 'edit'){
        this.previewImage =  "http://localhost:8000/storage/pictures/" + this.oneEvent.picture;
        this.title = this.oneEvent.title;
        let startDate = this.oneEvent.dateStart.split(" ");
        let startEnd = this.oneEvent.dateEnd.split(" ");
        this.dateStart = startDate[0] + "T" + startDate[1];
        this.dateEnd = startEnd[0] + "T" + startEnd[1];
        this.eventCountry = this.oneEvent.country;
        this.city = this.oneEvent.city;
        this.eventCategory = this.oneEvent.category_id;
        this.eventId = this.oneEvent.id;
        this.description = this.oneEvent.description;
        this.isEdit = false;
      }
  },
};
</script>

<style scoped>

  #country,
  #city,
  #category{
    width: 111%;
    padding: 10px;
    border: 1px solid #15436057;
    background: #2a546e3a;
  }
  #title{
    padding: 10px;
    width: 100%;
  }

  .dateTime,
  #eventTitle,
  #select,
  #description{
    margin-top: 10px;
    outline: none;

  }
  #description{
    font-size: 14px;
    border: 1px solid #15436057;
    background: #2a546e3a;
    margin-bottom: -50px;
  }
  #title{
    width: 105%;
    border: 1px solid #15436057;
    background: #2a546e3a;

  }
  
  #date{
    width: 110%;
    outline: none;
    height: 40px;
    border: 1px solid #15436057;
    background: #2a546e3a;

  }
  .dateTime{
    display: flex;
    justify-content: space-between;
  }
  .startDate,
  .endDate{
    width: 48%;
  }
  .endDate{
    margin-left: 30px;
  }
  form{
    width: 55%;
    margin-left: -5px;
  }
  .image{
    width: 100%;
    height: 50vh;
    border: 1px solid #15436057;
    border-radius: 20px;
    margin: auto;
  }
  .a{
    display: flex;
    justify-content: space-between;
  }

  #img{
    display: none;
  }
  #chooseImage{
    margin-left: 10%;
    width: 40%;

  }
  #error {
    color: red;
    position: absolute;
    bottom: 70px;
    right: 25px;
  }

  .creat_btn{
    margin-top: -80px;
    margin-bottom: 0px;
  }
</style>