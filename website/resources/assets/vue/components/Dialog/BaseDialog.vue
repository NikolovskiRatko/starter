<script lang="ts">
import { DialogComponent } from 'vue-modal-dialogs';
import { Component, Prop } from 'vue-property-decorator';

@Component
export default class BaseDialog extends DialogComponent<boolean> {
  @Prop() isConfirm;
  @Prop() message;

  cancel(): void {
    this.$close(false);
  }

  ok(): void {
    this.$close(true);
  }
}
</script>

<template>
  <div class="message-wrapper">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">{{ $t(message) }}</div>
        <div class="modal-footer">
          <button @click="ok" variant="primary">{{ $t('buttons.ok') }}</button>
          <button v-if="isConfirm" @click="cancel" variant="secondary">{{ $t('buttons.cancel') }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.message-wrapper {
  background-color: rgba(0, 0, 0, 0.5);
  height: 100%;
  left: 0;
  padding-top: 20px;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 2001;
}
</style>
