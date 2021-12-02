<template>
<section>
    <!-- <menu-bar></menu-bar> -->
    <div class="homeContainer">
        <div class="text">
            <h2>INTERNATIONAL DIGITAL
                BUSINESS EVENT
            </h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <button><router-link id="btn" to="/event">View More Detail</router-link></button>
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
        
        background: rgb(43, 42, 42);
    }
    .homeContainer{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80%;
        height: 85vh;
        /* background: yellowgreen; */
        /* background-image: url('https://s3.amazonaws.com/images.productionhub.com/posts/53453fb457_a1otazmjc1.jpg');
        background-size: cover; */
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
        padding: 15px;
        border: none;
        border-radius: 15px;
        background: rgba(175, 175, 175, 0.65);
        color: white;
        font-weight: bold;
    }
    #btn {
        color: white;
        text-decoration: none;
    }
</style>