<template>
    <li>
        <router-link :to="'/event/'+ category.name"><i id="more" class="fa fa-calendar-o"></i>{{ category.name }}</router-link>
        <i class="fa fa-ellipsis-v" id="more" :title="more" @click="showMore"></i>
        <div class="icon" v-if="isShow" >
            <p @click="showEditCategory"><i class="fa fa-pencil-square-o"  ></i> Edit</p>
            <p @click="showDeleteCategory"><i class="fa fa-trash-o" ></i> Delete</p>
        </div>

        <dialog-box
            v-if="dialogDisplayed"
            :title="dialogTitle"
            @close="closeDialog"
            >
            <hr>
            <label for="description" v-if="dialogMode === 'edit' ">Category Name</label>
            <input
                v-if="dialogMode === 'edit'"
                v-model="dialogTextField"

            />
            <h4 v-if="dialogMode !== 'edit'"> <i class="fa fa-exclamation-triangle"></i> Are you sure that you want to delete this category!</h4>

            <template #actions>
                <button @click="onConfirm">{{ dialogButtton }}</button>
            </template>
        </dialog-box>
    </li>
</template>

<script>
import DialogBox from './DialogBox.vue'
export default {
    props: ['category'],
    emits: ['delete', 'category-name'],
    components: {
        DialogBox
    },
    data(){
        return{
            more: "show more",
            isShow: false,
            dialogMode: 'create',
            dialogDisplayed: false,
            dialogTextField: '',
        }
    },
    computed: {
        dialogTitle() {
        return this.dialogMode === 'edit' ? 'EDIT CATEGORY' : 'DELETE CATEGORY';
        },
        dialogButtton() {
        return this.dialogMode === 'edit' ? 'EDIT' : 'DELETE';
        },
    },
    methods: {
        showMore(){
            // alert('hi');
            this.isShow = !this.isShow;
        },
        closeDialog() {
        this.dialogDisplayed = false;
        },
        showEditCategory() {
        this.dialogTextField = this.category.name;
        this.dialogMode = 'edit';
        this.dialogDisplayed = true;
        },
        showDeleteCategory() {
        this.dialogMode = 'create';
        this.dialogDisplayed = true;
        },

        onConfirm() {
            console.log(this.dialogTextField);
        if (this.dialogMode === 'create') {
            this.$emit('delete', this.category.id);
        } else if (this.dialogMode === 'edit') {
            console.log(' edited ');
            this.$emit('category-name', this.category.id, this.dialogTextField);
        }

        this.closeDialog();
        },
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

        margin-left: 50%;
        margin-top: 100px;
        border-radius: 10px;
        position: absolute;
        text-align: center;
        padding: 10px;
    }
     p{
        text-align: center;
        cursor: pointer;
        display: flex;
        justify-content: center;
        margin-top: 10px;
        
    }
    
   /* ............................................... */
    .form-control {
        margin: 0.5rem 0;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 15px;
    }
    hr{
        margin-top: -20px;

    }
    input{
        display: block;
        width: 95%;
        border: 1px solid #ccc;
        font: inherit;
        padding: 15px;
        border-radius: 5px;
        margin-top: 7px;
    }
    .fa-exclamation-triangle{
        color: red;
        margin-right: 10px;
    }
    input:focus,
    textarea:focus {
        background-color: #f0e6fd;
        outline: none;
        border-color: #3d008d;
    }

    h3 {
        margin: 0.5rem 0;
        font-size: 1rem;
    }
    h4{
        font-size: 22px;

    }
    button{
        border: none;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 15px;
        width: 18%;
        background: rgb(44, 171, 209);
    }


</style>