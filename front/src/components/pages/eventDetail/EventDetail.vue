<template>
    <div class="container">
        <div class="image">
            <div class="date">
                <div class="dateHead"></div>
                <h1>{{ day }}</h1>
            </div>
            <img :src="'http://localhost:8000/storage/pictures/' + event.picture" alt="">
        </div>
        
        <div class="content">
            <p>{{ changeDateToFullDate(event.dateStart) }} - {{ changeDateToFullDate(event.dateEnd) }}</p><br>
            <h2>{{ event.title }}</h2>
        </div>
        <div class="btn">
            <ul>
                <li id="about">About</li>
            </ul>

            <div class="userJoin" v-if="!user_owner">
                <button class="quit-btn"  v-if="isJoin(event.id)" @click="quitJoin(event.id)">Quit</button>
                <button class="join-btn"  v-else @click="joinEvent(event.id)">Join</button>
            </div>
        </div>
        <div class="main">
            <div class="main_left">
                <h3>Detail</h3>
                <ul>
                    <li><i class="fa fa-user"></i>Event by {{ event.userName }}</li>
                    <li><i class="fa fa-globe"></i>Location: {{ event.city }} in {{ event.country }}</li>
                    <li><i class="fa fa-file-text-o"></i>Description</li>
                    <p>{{ event.description }}</p>
                </ul>
                
            </div>
            <div class="main_right">
                <div  class="numberUser">
                    <div class="member">
                        <p> {{ members.length }} Member</p>
                    </div>
                    <div>
                    </div>
                    
                </div>
                <div>
                    <h3>All member</h3>
                    <div v-for="member of members" :key="member.id" class="profile" >
                        <img :src="'http://localhost:8000/storage/profiles/' + member.profile" alt="">
                        <p>{{ member.name }}</p>
                    </div>                   
                </div>
               
            </div>
            
        </div>
       
    </div>
</template>

<script>
import axios from "../../../api/api.js";
import moment from "moment";

export default {

        data(){
            return {
                event : [],
                members: [],
                day: null,
                eventHasJoined: [],
                id: JSON.parse(localStorage.getItem('user')).id,
                user_owner: true,
            }
           
        },
         methods: {
            changeDateToFullDate(date){

                return moment(date).format('ddd MMM Do YYYY, h:mm:ss a');
             },
            isJoin(eventId){
                for (let joinEvent of this.eventHasJoined){
                    if(joinEvent.id == eventId){
                        return true;
                    }
                }
                return false;
            },
            joinEvent(eventId){
                let user_create = {
                    user_id: this.id,
                    event_id: eventId,
                    role: "member",
                };
                axios.post("/event_joins", user_create).then(() => {
                    this.getOtherEvents();
                    this.getEventMember();
                });

            },
            quitJoin(eventId){
                axios.get("/event_quit_id/"+eventId+"/"+this.id).then((response)=>{
                    let idToQuit = response.data[0].id;
                    axios.delete("event_quit/"+idToQuit).then(()=>{
                        this.getOtherEvents();
                        this.getEventMember();
                    });
                });
            
            },
            getOtherEvents(){
                axios.get("/event_user_has_joins/"+this.id).then((response)=>{
                    this.eventHasJoined = response.data;
                    this.isJoin(this.event.id);
                });
            },
            getEventMember(){
                axios.get('/event_member/'+ parseInt(this.event.id)).then(res => {
                    this.members = res.data;
                });
            }
        },
        mounted (){
            this.event = JSON.parse(localStorage.getItem('event_detail'));
            this.getEventMember();
            this.day = parseInt(this.event.dateStart.split(' ')[0].split('-')[2]);
            
            if (localStorage.getItem('path') === '/event'){
                this.user_owner = false;
            }else{
                this.user_owner = true;
            }
            localStorage.setItem('path', this.$route.path);
            this.getOtherEvents();
            
        },
        
}
</script>

<style scoped>

/* Detail */
    .container{
        width: 75%;
        margin: auto;
        margin-top: 40px;
        background: rgb(29, 28, 28);
        border-radius: 10px;
        padding-bottom: 20px;
    }
    .image{
        width: 100%;
        display: flex;
        justify-content: space-between;
    }
    .date{
        width: 9%;
        height: 95px;
        background: rgb(36, 35, 35);
        margin: auto;
        margin-top: 300px;
        border-radius: 10px 10px 10px 10px;
        box-shadow: rgba(148, 147, 147, 0.329) 0px 10px 50px;
    }
    .dateHead{
        width: 100%;
        height: 26px;
        border-radius: 10px 10px 0 0;
        background: #f64545;
    }
    .date h1{
        display: block;
        font-size: 44px;
        margin-top: 10px;
        text-align: center;
        color: white;
    }
    .container img{
        width: 85%;
        height: 400px;
        border-radius: 0 10px 0 0;

    }
    .content{
        padding-bottom: 20px;
        padding-top: -100px;
    }
    .content p{
        color: red;
        padding-left: 20px;
        width: 100%;
        text-align: left;
    }
    .content h2{
        color: white;
        margin-top: -10px;
        padding-left: 20px;
        margin-bottom: 20px;
        float: left;

    }
    .btn{
        float:right;
        text-align: right;
        border-top: 1px solid rgba(128, 128, 128, 0.836);
        width: 100%;
        background: rgb(51, 51, 51);
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    #about{
        margin-bottom: 7px;

    }
    .main{
        margin-top: 80px;
        width: 100%;
        display: flex;
        justify-content: space-around;
    }
    .main_left,.main_right{
        background: rgb(51, 51, 51);
        width: 45%;
        border-radius: 10px;
        padding: 10px;
    }

    .main_left h3{
        color: white;
        margin: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid gray;
    }
    .main_left ul{
        margin-left: -20px;
        color: rgb(209, 209, 209);
    } 
    .main_left li{
        text-align: left;
        font-weight: bold;
        margin-bottom: 7px;
        
    }
    .main_left p{
        margin-top: 5px;
        text-align: left;

    }
    .fa-user,
    .fa-globe,
    .fa-file-text-o{
        margin-right: 10px;
    }
    .main_right p{
        color: white;
        float: left;
    }
    .numberUser{
        display: flex;
        justify-content: space-around;
        border-bottom: 1px solid gray;
        line-height:20px;
    }
    .main_right h3{
        margin-left: 30px;
        margin-bottom: 10px;
        color: white;

    }
    .main_right img{
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-left: 30px;
        margin-right: 10px;
        margin-top: 10px;

    }

    .profile{
        display: flex;

    }
    .btn > ul{
        margin-bottom: 0px;
    }
    ul li {
        list-style: none;
        color: rgb(243, 242, 241);
        text-transform: capitalize;
        font-weight: bold;
        font-size: 18px;
        margin-top: 10px;
    }
    .member{
        display: flex;
        justify-content: space-around;
        width: 80%;
        text-align: center;
        margin: auto;
    }
    .member p{
        width: 20%;
        font-size: 20px;
    }

    .join-btn,
    .quit-btn{
        padding: 9px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        color: white;
        width: 15%;
        font-size: 15px;
        margin-top: 10px;
        margin-right: 20px;
        
    }
    .join-btn{
        background: #F1C40F;
    }
    .quit-btn{
        background: rgba(103, 107, 110, 0.719);

    }
    .userJoin{
        width: 45%;
        margin-bottom: 10px;
    }
</style>