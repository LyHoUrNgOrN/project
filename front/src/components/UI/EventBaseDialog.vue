<template>
  <teleport to="body">
    <div @click="$emit('close')" id="background"></div>
    <dialog open>
      <header>
        <slot name="header">
          <h2>{{ title }}</h2>
        </slot>
      </header>
      <section class="content">
        <div class="left">
          <input
            type="text"
            placeholder="Event name..."
            id="eventTitle"
            v-model="name"
          />
          
          <div class="placeInput">
            <label for="dateIt" class="labelDate">Start date</label>
            <input type="datetime-local" id="startDate" v-model="startDate" />
          </div>
          
          <div class="placeInput">
            <label for="dateIt" class="labelDate">End date</label>
            <input type="datetime-local" id="endDate" v-model="endDate" />
          </div>
          <select name="country" id="country" v-model="eventCountry">
            <option disabled value="">Please select a country</option>
            <option
              v-for="(city, eachCountry) in countries"
              :key="eachCountry"
              :value="eachCountry"
            >
              {{ eachCountry }}
            </option>
          </select>
          <select name="city" id="city" v-model="eventCity">
            <option disabled value="">
              Please select a country frist
            </option>
            <option
              v-for="(city, country) in countries[eventCountry]"
              :key="country"
              :value="city"
            >
              {{ city }}
            </option>
          </select>
          <!-- this is category -->
          <select name="category" id="category" v-model="eventCategory">
            <option disabled value="">Please select a category of your event</option>
            <option
              v-for="(value, id) of category"
              :key="id"
            >
              {{ value.name }}
            </option>
          </select>
          <!-- this is end category -->
          <textarea
            name="description"
            id="textare"
            v-model="description"
            placeholder="Description"
            rows="4"
          ></textarea>
          <menu>
            <slot name="actions">
              <base-button @click="ok" class="clickOk">Create</base-button>
            </slot>
          </menu>
        </div>
        <div class="right">
          <h4>Click to add picture for event</h4>
          <input
            type="file"
            id="imgForNewthing"
            name="imge"
            @change="getImage"
            accept="image/jpeg, image/png, image/gif"
            hidden
          />
          <label for="imgForNewthing" class="imgArea"><img :src="previewProfile" class="imgout"></label>
        </div>
      </section>
    </dialog>
  </teleport>
</template>

<script>
// import country from "../json/countries.json";
// import moment from 'moment';
import axios from 'axios';
import moment from 'moment';
const URL = "http://127.0.0.1:8000/api/";
export default {
  props: {
    title: {
      type: String,
      required: false,
    },
  },
  emits: ["close"],
  data() {
    return {
      countries: "",
      eventCategory : "",
      eventCountry: "",
      eventCity: "",
      name: "",
      startDate: "",
      picture: "",
      endDate: "",
      description: "",
      previewProfile : "",
      category : [],
      allData: [],
    };
  },
  methods: {
    ok() {
      for(let i of this.category){
        if(i.name === this.eventCategory){
          this.eventCategory = i
        }
      }
      let forAdd = new FormData();
        forAdd.append('title',this.name), 
        forAdd.append('dateStart',this.dateFormat(this.startDate)), 
        forAdd.append('dateEnd',this.dateFormat(this.endDate)), 
        forAdd.append('country',this.eventCountry), 
        forAdd.append('city',this.eventCity), 
        forAdd.append('category_id',this.eventCategory.id), 
        forAdd.append('description',this.description), 
        forAdd.append('picture',this.picture), 
      axios.post(URL+'events',forAdd).then(()=>{});
    },
    dateFormat(date){
      return moment(date).format('YYYY-MM-DD hh:mm:ss');
    },
    getImage(event){
      let image = event.target.files[0];
      let reader = new FileReader();
      reader.onloadend = e =>{
          this.previewProfile = e.target.result;
      }
      reader.readAsDataURL(image);
      this.picture = image;
    },
  },
  mounted() {
    axios.get(URL+'countries').then(res=>{
      this.countries = res.data;
    });
    axios.get(URL+'category').then(res=>{
      this.category = res.data;
    })
  },
};
</script>

<style scoped>
#background {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.75);
  z-index: 100;
}
.labelDate{
  widows: 40%;
}
dialog {
  position: fixed;
  top: 5vh;
  left: 20%;
  width: 60%;
  z-index: 100;
  border-radius: 12px;
  border: none;
  color: white;
  background: rgba(204, 203, 203, 0.815);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  padding: 0;
  margin: 0;
  overflow: hidden;
  z-index: 11;
}

header {
  background-color: var(--main-color);
  color: rgb(255, 247, 247);
  width: 100%;
  padding: 1rem;
}
label{
  font-size: 15px;
}
header h2 {
  margin: 0;
}

section {
  padding: 1rem;
}

menu {
  padding: 1rem;
  display: flex;
  justify-content: flex-end;
  margin: 0;
}

/* This is what I change */
.content {
  display: grid;
  grid-template-columns: 1fr 0.8fr;
}
input[type="file"] {
  display: none;
}
.left > * {
  width: 90%;
  padding: 5px;
  margin: 5px;
}
.imgArea {
  border: 1px solid black;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 80%;
}
.imgout{
  width: 100%;
  height: 100%;
  background-size: cover;
}
input[type="text"] {
  margin-top: 10px;
}
.date {
  margin: 0;
  width: 100%;
}
.date label {
  text-align: center;
}
input[type="date"] {
  width: 55%;
  padding: 5px;
}
.placeInput {
  display: flex;
  width: 92%;
}
.appt {
  width: 30%;
  margin-left: 5px;
}
.clickOk {
  width: 30%;
  margin: auto;
  border-radius: 20px;
}
input[type="time"]{
  font-size: 14px;
}
#category,
#country,
#city{
  width: 93%;
}
input,
textarea,
select{
  background: rgba(150, 149, 149, 0.226);
  color: white;
  border: none;
}
option{
  background: rgba(0, 0, 0, 0.75);
}
</style>