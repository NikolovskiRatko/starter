<script lang="ts">
  import { Component, Emit, Vue } from 'vue-property-decorator';

  @Component
  export default class UnsavedChangesModal extends Vue {

    constructor() {
      super();
    }

    @Emit('confirm-unsaved-changes')
    confirmUnsavedChanges(): void {
    }

    @Emit('cancel-unsaved-changes')
    cancelUnsavedChanges(): void {
    }

  }
</script>

<template>
    <div class="sk-modal-overlay">
      <div class="sk-modal-overlay-inner">

        <div class="sk-modal-head">
          <h4>Unsaved changes!</h4>
          <span class="close-btn" @click="cancelUnsavedChanges">
            <i class="fa fa-times"></i>
          </span>
        </div>

        <div class="sk-modal-body">
          <p>You have unsaved changes in this form!
            Are you sure you want to leave this page?</p>
        </div>

        <div class="sk-modal-foot">
          <button
            @click.prevent="confirmUnsavedChanges"
            class="btn btn-success">
            <i class="fa fa-check mr-2"></i>
            Yes
          </button>
          <button
            @click.prevent="cancelUnsavedChanges"
            class="btn btn-danger ml-3">
            <i class="fa fa-times mr-2"></i>
            No
          </button>
        </div>

      </div>
    </div>
</template>
