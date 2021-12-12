<template>
    
    <div class="con">
      <div class="form">
        <slot></slot>
      </div>
    </div>
</template>

<script scoped>

</script>

<style scoped>
    .con{
        background-image: url('https://scontent.xx.fbcdn.net/v/t1.15752-9/s350x350/266335939_439003174420670_823171244838047334_n.jpg?_nc_cat=105&ccb=1-5&_nc_sid=aee45a&_nc_eui2=AeGIit7m9Pf5oq8F8Zv_ahU-1vxazjnAywzW_FrOOcDLDJ-htPHqWk2_E1Pmop-5C8tpzL-PTCrYDMxXyoONjjIC&_nc_ohc=0bdk0-H-qdQAX-H8hDY&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AVJvFLMMY_3hLstUrLYimaQG1P8V3OEZkBTq3SjdFJyDmQ&oe=61D9B477');
        background-size: cover;
        padding-top: 5px;
        margin: 0;
        padding-bottom: 72px;
    }
    .form{
        background-color: white;
        border-radius: 40px;
        text-align: center;
        width: 35%;
        margin: auto;
        padding: 10px;
        margin-top: 80px;
    }

    hr{
        width: 60%;
        margin: auto;
        margin-top: 10px;
    }
    #haveAccount{
        color: rgb(49, 49, 49);
    }
    .signIn{
        color: #154360;
    }
</style>