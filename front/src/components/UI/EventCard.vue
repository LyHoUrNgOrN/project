<template>

    <div class="card">
        <div class="moreIcon">
            <i class="fa fa-ellipsis-h"></i>
        </div>
        <img src="https://www.industrialempathy.com/img/remote/ZiClJf-1920w.jpg" alt="">
        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, similique.</h3>
        <p>Date Start: 12 november, 2021</p>
        <p>Date End: 12 november, 2021</p>
        <p>Member: 123 people</p>
        <p>Interested: 502 people</p>
        <div class="">
            <slot></slot>
        </div>
    </div>
           
</template>

<script>
export default {
    props: ['eventDatas'],
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
    }
    .moreIcon:hover {
        background: rgba(112, 114, 112, 0.726);
    }

    .card{
        width: 30%;
        background: rgb(51, 51, 51);
        margin-top: 10px;
        color: white;
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
        filter: drop-shadow(0 0 10px rgba(66, 66, 66, 0.7));
        font-family: Arial, Helvetica, sans-serif;
    }
    .card img{
        width: 100%;
        height: 200px;
        border-radius: 4px;
    }
    .card h3{
        margin-top: 0;
        text-align: left;
    }
    .card p{
        margin-top: -12px;
        text-align: left;

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
</style>