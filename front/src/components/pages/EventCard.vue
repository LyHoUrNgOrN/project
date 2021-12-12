<template>

    <div class="card">
        <img :src="'http://localhost:8000/storage/pictures/'+eventData.picture" alt="">
        <h4>{{ eventData.title }}</h4>
        <p>Date Start: {{ eventData.dateStart }}</p>
        <p>Date End: {{ eventData.dateEnd }}</p>
        <p>Member: {{ getMember()  }} people</p>
        <p>Country: {{ eventData.country }} people</p>
        <div class="">
            <slot></slot>
        </div>
    </div>
           
</template>

<script>
import axios from "../../api/api.js";

export default {
    props: ['eventData'],

    data(){
        return {
            event: this.eventData,
            memberOfEvent: null,
        }
    },
    methods:{
        getMember(){
            axios.get('/event_member/'+ this.event.id).then(res => {
            this.memberOfEvent = res.data.length;
            // console.log(this.memberOfEvent);

            })
            return this.memberOfEvent;
        }
    },
    mounted(){
        
    }
}
</script>

<style scoped>
    .moreIcon{
        width: 5%;
        padding: 8px;
        border-radius: 50%;
        background: rgba(41, 40, 40, 0.671);
        font-size: 16px;
        position: absolute;
        top: 20px;
        left: 85%;
        color: white;
    }
    .moreIcon:hover {
        background: rgba(112, 114, 112, 0.726);
    }

    .card{
        width: 30%;
        background: #154360;
        margin-top: 10px;
        border-radius: 0 0 10px 10px;
        border: 1px solid #154360;
        /* padding: 10px; */
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.7); */
        /* filter: drop-shadow(0 0 10px rgba(66, 66, 66, 0.7)); */
        /* font-family: Arial, Helvetica, sans-serif; */
        word-wrap: break-word;

    }

    .card img{
        width: 100%;
        height: 200px;
        /* border-radius: 4px; */
    }
    .card h4{
        margin-top: 0;
        text-align: left;
        color: rgb(218, 216, 216);
        margin-left: 15px;

    }
    .card p{
        margin-top: -5px;
        text-align: left;
        font-size: 13px;
        color: rgb(223, 223, 223);
        margin-left: 15px;
    }

</style>