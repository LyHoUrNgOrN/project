<template>
    <li>
        <router-link :to="'/event/'+ category.name"><i id="more" class="fa fa-calendar-o"></i>{{ category.name }}</router-link>
        <i class="fa fa-ellipsis-v" id="more" :title="more" @click="showMore"></i>
        <div class="icon" v-if="isShow">
            <p><i class="fa fa-pencil-square-o" id="edit" @click="editeCategory"></i>Edit</p>
            <p @click="deleteCategory"><i class="fa fa-trash-o" id="delete" ></i> Delete</p>
        </div>
    </li>
</template>

<script>
export default {
    props: ['category'],
    emits: ['delete','edit-category'],
    data(){
        return{
            more: "show more",
            isShow: false,
        }
    },
    methods: {
        showMore(){
            // alert('hi');
            this.isShow = !this.isShow;
        },
        editeCategory(){
            this.$emit('edit-category',this.category.name,this.category.id);
           
        },
        deleteCategory(){
            this.$emit('delete', this.category.id);
        }
    }

}
</script>

<style scoped>
    li:hover{
        background: rgba(73, 172, 211, 0.582);
    }
    #more {
        margin-right: 20px;
    }
    .icon {
        background: rgba(15, 15, 15, 0.493);
        width: 30%;
        height: 60px;
        padding: 5px;
        /* display: flex;
        justify-content: space-between;
        align-items: center; */
        margin-left: 50%;
        margin-top: 100px;
        border-radius: 10px;
        position: absolute;
    }
    .icon p{
        text-align: center;
        cursor: pointer;
        display: flex;
        justify-content: center;
        margin-top: 0;
        padding: 5px;
        /* border: 1px solid gray; */
    }
    p:nth-child(2){
        margin-top: -17px;
    }
    .icon p:hover{
        background: seagreen;
    }
</style>