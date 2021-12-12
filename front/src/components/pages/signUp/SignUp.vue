<template>
    
    <div class="con">
      <div class="form">
        
        <label for="image" id="labelForProfile"><img class="user" :src="previewProfile"/></label>
        <form action="" enctype="multipart/form-data">
            <input type="file" id="image" accept="image/jpeg, image/png, image/gif, image/jpg" @change="selectProfile" >
            <small>{{messError.profile}}</small>
            <div class="name">
                <label for="name" class="userName_icon"><i class="fa fa-user-circle" aria-hidden="true"></i></label>
                <input type="text" id="name" placeholder="User Name" v-model="userName">
                <small>{{messError.name}}</small>
            </div>

            <div class="email">
                <label for="email" class="emial_icon"><i class="fa fa-envelope-open"></i></label>
                <input type="email" id="email" placeholder="Email" v-model="email">
                <small>{{messError.email}}</small>
            </div>
            
            <div class="password">
                <label for="password" class="password_icon"><i class="fa fa-lock" ></i></label>
                <input type="password" id="password" placeholder="Password" v-model="password">
            </div>
            <div class="confirmPassword">
                <label for="confirmPasswprd" class="confirm_password"><i class="fa fa-lock" ></i></label>
                <input type="password" id="confirmPasswprd" placeholder="Confirm Password" v-model="confirmPassword">
                <small>{{messError.password}}</small>
            </div>
            
            <router-link to='/signUp' @click="signUp"><botton-widget>Sign Up</botton-widget></router-link>
            <hr>
            <p id="haveAccount">Have account: <router-link class="signIn" to="/signIn" >Sign In</router-link></p>
        </form>        
      </div>
    </div>
</template>

<script scoped>
import axios from "../../../api/api.js";

export default {
    emits:["sign-up"],
    data(){
        return{
            userName: "",
            email: null,
            password: null,
            confirmPassword: null,
            previewProfile: "https://www.prajwaldesai.com/wp-content/uploads/2021/02/Find-Users-Last-Logon-Time-using-4-Easy-Methods.jpg",
            profile : null,
            messError : {
                profile:null,
                name:null,
                email: null,
                password:null,
            }
        }
    },
    methods: {
        selectProfile(event){
            const image = event.target.files[0];
            let reader = new FileReader();
            reader.onloadend = e =>{
                this.previewProfile = e.target.result;
            }
            reader.readAsDataURL(image);
            this.profile = image;
            
        },
        signUp(){

            let user = new FormData();
            user.append('name',this.userName);
            user.append('email',this.email);
            user.append('password',this.password);
            user.append('password_confirmation',this.confirmPassword);
            user.append('profile',this.profile);

            axios.post('/signup',user).then(()=>{
                this.$router.push('/signIn');
            }).catch(error=>{
                if (error.response) {
                    let messError = error.response.data.errors;
                    console.log(messError);
                    if(messError.name !== undefined){
                        this.messError.name = messError.name[0];
                    }
                    if(messError.email !== undefined){
                        this.messError.email = messError.email[0];
                    }
                    if(messError.password !== undefined){
                        this.messError.password = messError.password[0];
                    }
                    if(messError.profile !== undefined){
                        this.messError.profile = 'Please choose a correct profile!';
                    }
                }
            });
            this.userName = null;
            this.email = null;
            this.password = null;
            this.confirmPassword = null;
            this.previewProfile = 'https://www.psi.org.kh/wp-content/uploads/2019/01/profile-icon-300x300.png';
            this.profile = null;
        }
    }
}
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
    .user{
        background-size: cover;
        width: 22%;
        height: 15vh;
        border-radius: 50%;
        margin: auto;
        border-bottom: 8px solid #154360;
        border-top: 8px solid #ffffff;
        border-left: 8px solid #154360;
        border-right: 8px solid #ffffff;
        margin-top: -60px;
        /* margin-top: 10px; */
    }
    #image{
        display: none;
    }
    form{
        /* width: 50%; */
        margin: auto;
    }
    form p{
        color: white;
    }
    #name,
    #email,
    #password,
    #confirmPasswprd{
        width: 50%;
        padding: 15px;
        border: 1px solid #154360;
        background: #2a546e3a;
        font-size: 18px;
        margin-top: 10px;
        outline: none;
    
    }

    .name,
    .email,
    .password,
    .confirmPassword {
        /* width: 80%; */
        display: flex;
    }
    .userName_icon,
    .emial_icon,
    .password_icon,
    .confirm_password {
        width: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #154360;
        color: #154360;
        background: white;
        border-right: none;
        font-size: 24px;
        border: 1px 0 1px 1px solid #154360;
        margin-left: 16%;
        margin-top: 10px;

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
    small{
            color:red;
            margin:2px;
        }
</style>