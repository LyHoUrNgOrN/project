<template>
        <li>
            <h3> {{ category.name }}</h3>
            <div class="btn_category">
                <i class="fa fa-pencil" @click="showEditCategory"></i>
                <i class="fa fa-trash" @click="showDeleteCategory"></i>
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
                    v-model="categoryNameEdit"
                    @keyup="validateError"
                />
                <small v-if="errorMessage === 'ok'" class="validateTrue"><i class="fa fa-check-circle-o" ></i>{{ errorMessage }}</small>
                <small v-else>{{ errorMessage }}</small>
                
                <h4 v-if="dialogMode !== 'edit'"> <i class="fa fa-exclamation-triangle"></i> Are you sure that you want to delete this category!</h4>

                <template #actions>
                    <button @click="onConfirm">{{ dialogButtton }}</button>
                </template>
            </dialog-box>
        </li>

    
            
</template>

<script>
export default {
    props: ['category', 'errorMessage'],
    emits: ['delete', 'category-name', 'category', 'validate', 'removeErrorMessage'],
    data(){
        return{
            more: "show Edit & Delete",
            dialogMode: 'delete',
            dialogDisplayed: false,
            categoryNameEdit: '',
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
        validateError(){
            console.log(this.categoryNameEdit);
            this.$emit('validate', this.categoryNameEdit);

        },
        showMore(){
            this.isShow = !this.isShow;
        },
        closeDialog() {
            this.dialogDisplayed = false;
            this.isShow = false;
            this.$emit('removeErrorMessage', null);

        },
        showEditCategory() {
            this.categoryNameEdit = this.category.name;
            this.dialogMode = 'edit';
            this.dialogDisplayed = true;
        },
        showDeleteCategory() {
            this.dialogMode = 'delete';
            this.dialogDisplayed = true;
        },

        onConfirm() {
            if (this.dialogMode === 'delete') {
                this.$emit('delete', this.category.id);
            } else if (this.dialogMode === 'edit') {
                console.log(' edited ');
                this.$emit('category-name', this.category.id, this.categoryNameEdit);
            }

            this.closeDialog();
        },
        selectCategory(){
            this.$emit('category', this.category);
        },
        
    }
    
}

</script>

<style scoped>
    li {
        list-style: none;
        display: flex;
        justify-content: space-between;
        background: rgb(128, 129, 129);
        padding: 15px;
        /* padding-right: 20px; */
        border-radius: 10px;
        width: 77%;
        margin: auto;
        margin-bottom: 10px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        color: white;
    }
    .btn_category {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 22px;
        width: 7%;
        /* margin-right: 20px; */

    }
    .fa-trash{
        color: rgb(187, 33, 33);
    }
    .fa-pencil{
        color: rgb(3, 117, 146);
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
    input:focus{
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
    .validateTrue{
        color: green;
    }
    .validateTrue i{
        margin-right: 10px;
    }
</style>