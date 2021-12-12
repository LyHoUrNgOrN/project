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
            <p>{{ event.dateStart }} - {{ event.dateEnd }}</p><br>
            <h2>{{ event.title }}</h2>
        </div>
        <div class="btn">
            <ul>
                <li id="about">About</li>
            </ul>

            <botton class="join">Join</botton>

        </div>
        <div class="main">
            <div class="main_left">
                <h3>Detail</h3>
                <ul>
                    <li><i class="fa fa-user"></i>Event by {{ event.name }}</li>
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
                    <div v-for="member of members" :key="member.id" class="profile" > -->
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

export default {

        data(){
            return {
                event : [],
                members: [],
                day: null,
            }
           
        },
         methods: {

        },
        mounted (){
            this.event = JSON.parse(localStorage.getItem('event_detail'));
            axios.get('/event_member/'+ parseInt(this.event.id)).then(res => {
                this.members = res.data;
                console.log(res.data);
            });
            this.day = parseInt(this.event.dateStart.split(' ')[0].split('-')[2]);
            
            localStorage.setItem('path', this.$route.path);
            console.log(this.event)
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
    /* box-shadow:  rgba(255, 255, 255, 0.651) -80px 100px -80px 0 inset; */
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
    /* box-shadow: rgba(85, 84, 84, 0.329) 0px 2px 8px 0px; */
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
    /* background: rgb(51, 51, 51); */
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
    /* border-bottom: 1px solid gray; */
    width: 100%;
    background: rgb(51, 51, 51);
    /* box-shadow: rgba(104, 103, 103, 0.5) 0px -50px 36px -28px inset; */
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}


.btn .join{
    background: darkcyan;
    padding: 13px;
    /* width: 10%; */
    border-radius: 10px;
    text-align: center;
    color: white;
    border: none;
    float: right;
    margin-right: 10px;
    margin: 10px;
}
#about{
    margin-bottom: -17px;

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
    /* line-height:30px; */
    margin-bottom: 7px;
    
}
.main_left p{
    margin-top: 5px;
    /* line-height:20px;*/
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
    width: 100%;
}
.member p{
    width: 20%;
    /* text-align: center; */
    font-size: 20px;
}
</style>