<template>
<section>
    <!-- <menu-bar></menu-bar> -->
    <div class="homeContainer">
        <div class="text">
            <h2>INTERNATIONAL DIGITAL
                BUSINESS EVENT
            </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <router-link id="btn" to="/event"><botton-widget>View More Detail</botton-widget></router-link>
        </div>
    </div>
</section>

</template>

<script>
export default {

}
</script>

<style>
    body{
        background-image: url('https://ak.picdn.net/shutterstock/videos/9134405/thumb/1.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-position: top;
        background-position-x: center;
        background-position-y: top;
        /* background: fixed; */
        /* background: rgb(12, 10, 10); */
    }
    .homeContainer{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80%;
        height: 85vh;
        margin: auto;
    }
    .text{
        text-align: center;
        justify-content: center;
        align-items: center;
        width: 50%;
        color: white;

    }
    .text h2{
        font-size: 38px;
        
    }
    .text button {
        color: white;
        background: rgba(177, 177, 177, 0.623);

    }

</style>