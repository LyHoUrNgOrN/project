<template>
    <li>
        <router-link :to="'/event/'+ category.name"><i id="more" class="fa fa-calendar-o"></i>{{ category.name }}</router-link>
        <i class="fa fa-ellipsis-v" id="more" :title="more" @click="showMore"></i>
        <div class="icon" v-if="isShow">
            <p><i class="fa fa-pencil-square-o" id="edit" @click="editeCategory"></i>Edit</p>
            <p><i class="fa fa-trash-o" id="delete" @click="deleteCategory"></i> Delete</p>
        </div>
    </li>
</template>

<script>
export default {
    props: ['category'],
    emits: ['delete'],
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

        },
        deleteCategory(){
            this.$emit('delete', this.category.id);
        }
    }

}
</script>

<style scoped>
    #more {
        margin-right: 20px;
    }
    .icon {
        background: rgba(15, 15, 15, 0.493);
        width: 40%;
        height: 60px;
        padding: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 50%;
        margin-top: 100px;
        border-radius: 10px;
        position: absolute;
    }
    .icon p{
        text-align: center;
    }
</style>