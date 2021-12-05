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
        /* background: yellowgreen; */
        /* background-image: url('https://images.creativemarket.com/0.1.0/ps/6332878/1820/1023/m1/fpnw/wm1/varp4qjyuyfo3acz6c6mwlpxatbxzmgvxgpn8sbvowmljs7fqm8j5wpmri5cvzlk-.jpg?1556873804&s=25eeda5e6a3619051e8561b7bb17a640');
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