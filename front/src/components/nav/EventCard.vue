<template>

    <div class="mainRight">
        <div class="cardHead">
            <h3>All Event</h3>
            <!-- <button class="btn-create">+ Create</button> -->
        </div>
        <div class="sidebarContainer">
            <div class="card">
                <img src="https://media.smallbiztrends.com/2014/11/Business-eventEDIT.jpg" alt="">
                <h3>Lorem ipsum dolor sit amet consectetur ad</h3>
                <p>November 12, 2021</p>
                <p>Member: 120 people</p>
                <p>Interested: 120 people</p>
                <div class="">
                    <button class="interested-btn">Interested</button>
                    <button class="join-btn">Join</button>
                </div>
            </div>
            <div class="card">
                <img src="https://media.smallbiztrends.com/2014/11/Business-eventEDIT.jpg" alt="">
                <h3>Lorem ipsum dolor sit amet consectetur ad</h3>
                <p>November 12, 2021</p>
                <p>Member: 120 people</p>
                <p>Interested: 120 people</p>
                <div class="">
                    <button class="interested-btn">Interested</button>
                    <button class="join-btn">Join</button>
                </div>
            </div>
            <div class="card">
                <img src="https://media.smallbiztrends.com/2014/11/Business-eventEDIT.jpg" alt="">
                <h3>Lorem ipsum dolor sit amet consectetur ad</h3>
                <p>November 12, 2021</p>
                <p>Member: 120 people</p>
                <p>Interested: 120 people</p>
                <div class="">
                    <button class="interested-btn">Interested</button>
                    <button class="join-btn">Join</button>
                </div>
            </div>
            <div class="card">
                <img src="https://media.smallbiztrends.com/2014/11/Business-eventEDIT.jpg" alt="">
                <h3>Lorem ipsum dolor sit amet consectetur ad</h3>
                <p>November 12, 2021</p>
                <p>Member: 120 people</p>
                <p>Interested: 120 people</p>
                <div class="">
                    <button class="interested-btn">Interested</button>
                    <button class="join-btn">Join</button>
                </div>
            </div>
            <div class="card">
                <img src="https://media.smallbiztrends.com/2014/11/Business-eventEDIT.jpg" alt="">
                <h3>Lorem ipsum dolor sit amet consectetur ad</h3>
                <p>November 12, 2021</p>
                <p>Member: 120 people</p>
                <p>Interested: 120 people</p>
                <div class="">
                    <button class="interested-btn">Interested</button>
                    <button class="join-btn">Join</button>
                </div>
            </div>
            <div class="card">
                <img src="https://media.smallbiztrends.com/2014/11/Business-eventEDIT.jpg" alt="">
                <h3>Lorem ipsum dolor sit amet consectetur ad</h3>
                <p>November 12, 2021</p>
                <p>Member: 120 people</p>
                <p>Interested: 120 people</p>
                <div class="">
                    <button class="interested-btn">Interested</button>
                    <button class="join-btn">Join</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
    .mainRight{
        margin-left: 21%;
        /* border: 1px solid gray; */
        /* margin-top: 200px; */
    }
    .cardHead{
        margin-bottom: 90px;
        margin-left: 50px;
        border-bottom: 2px solid gray;
        width: 93%;
        /* margin: auto; */
        display: flex;
        justify-content: space-between;
        align-items: end;
        position: sticky;
        top: 105px;
        height: 100px;
        background: rgb(43, 42, 42);
    }
    .cardHead h3{
        color: white;
        margin-left: 10;
        
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
        /* display: flex; */
        /* justify-content: space-between; */
    }
    .sidebarContainer{
        width: 90%;
        margin: auto;
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        z-index: -111;
    }
    .card{
        width: 30%;
        /* height: 60vh; */
        background: rgb(92, 95, 94);
        color: white;
        border-radius: 10px;
        padding: 10px;
        margin-top: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
        filter: drop-shadow(0 0 10px rgba(66, 66, 66, 0.7));
        font-family: Arial, Helvetica, sans-serif;
        z-index: -111;

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
        background: rgb(179, 176, 176);
    }
    .join-btn{
        width: 28%;
        background: rgb(55, 175, 231);
    }
</style>