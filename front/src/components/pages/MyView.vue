<template>
  <section>
    <base-dialog
      v-if="dialogDisplayed"
      :title="dialogTitle"
      @close="closeDialog"
    >
      <label for="description">Description</label>
      <textarea
        v-model="dialogTextField"
        id="description"
        name="description"
        rows="3"
        ref="descInput"
      ></textarea>

      <template #actions>
        <base-button @click="onConfirm">{{ dialogButtton }}</base-button>
      </template>
    </base-dialog>

    <base-button
      class="right-main-button"
      @click="showCreateRessource"
      type="submit"
      >Create Resource</base-button
    >

    <base-button
      class="right-main-button"
      @click="showEditRessource"
      type="submit"
      >Edit Resource</base-button
    >
  </section>
</template>


<script>
export default {
  data() {
    return {
      dialogMode: 'create',
      dialogDisplayed: false,
      dialogTextField: '',
    };
  },
  computed: {
    dialogTitle() {
      return this.dialogMode === 'edit' ? 'EDIT RESSOURCE' : 'CREATE RESSOURCE';
    },
    dialogButtton() {
      return this.dialogMode === 'edit' ? 'EDIT' : 'CREATE';
    },
  },

  methods: {
    closeDialog() {
      this.dialogDisplayed = false;
    },
    showEditRessource() {
      this.dialogTextField = 'THIS IS EDIT';
      this.dialogMode = 'edit';
      this.dialogDisplayed = true;
    },
    showCreateRessource() {
      this.dialogTextField = 'THIS IS CREATE';
      this.dialogMode = 'create';
      this.dialogDisplayed = true;
    },

    onConfirm() {
      if (this.dialogMode === 'create') {
        console.log(' created ');
      } else if (this.dialogMode === 'edit') {
        console.log(' edited ');
      }

      this.closeDialog();
    },
  },
};
</script>

<style>
.form-control {
  margin: 0.5rem 0;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 0.5rem;
}

input,
textarea {
  display: block;
  width: 100%;
  border: 1px solid #ccc;
  font: inherit;
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


</style>