<template>

    <div class="card">
        <!-- <div class="moreIcon">
            <i class="fa fa-ellipsis-h"></i>
        </div> -->
        <h4 id="category">{{ eventData.name }}</h4>
        <img :src="'http://localhost:8000/storage/pictures/'+ eventData.picture" alt="">
        <h4>{{ eventData.title }}</h4>
        <!-- <h4>{{eventData.description}}</h4> -->
        <p>Date Start: {{ eventData.dateStart }}</p>
        <p>Date End: {{ eventData.dateEnd }}</p>
        <p>Member: {{ eventData.member }} people</p>
        <p>Interested: {{ eventData.interested }} people</p>
        <div class="">
            <slot></slot>
        </div>
    </div>
           
</template>

<script>

export default {
    props: ['eventData'],
    data(){
        return{
            event: this.eventData,
            // categoryName: {name: ''},
        }
    },
    mounted(){
            
    }
}
</script>

<style>
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
        background: rgb(51, 51, 51);
        margin-top: 10px;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
        filter: drop-shadow(0 0 10px rgba(66, 66, 66, 0.7));
        font-family: Arial, Helvetica, sans-serif;
        word-wrap: break-word;
        /* z-index: -11; */

    }
    .card img{
        width: 100%;
        height: 200px;
        border-radius: 4px;
    }
    .card h4{
        margin-top: 0;
        text-align: left;
        color: rgb(218, 216, 216);


    }
    .card p{
        margin-top: -5px;
        text-align: left;
        font-size: 13px;
        color: rgb(223, 223, 223);


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
        background: rgb(80, 78, 78);
    }
    .join-btn{
        width: 28%;
        background: rgb(55, 175, 231);
    }
    #category {
        position: absolute;
        background: rgb(55, 175, 231);
        border-radius: 5px 0 5px 0;
        padding: 2px;
    }
</style>