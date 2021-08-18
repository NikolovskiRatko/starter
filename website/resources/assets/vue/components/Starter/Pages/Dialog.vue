<script lang="ts">
import {Component, Vue} from "vue-property-decorator";

@Component({})

export default class Dialog extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="dialog__box">
    <section>
      <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-rounded').showModal();">
        Development Operations
      </button>
      <dialog class="nes-dialog is-rounded" id="dialog-rounded">
        <form method="dialog">
          <h4 class="title"> Development Operations</h4>
          <p>Approach: Infrastructure as Code ( SweetOps Methodology )</p>
          <p>Technologies: Geodesic Linux Distro</p>
          <p>Syntax: Yaml</p>
          <p>Language: Golang</p>
          <menu class="dialog-menu">
            <button class="nes-btn is-primary">Exit</button>
          </menu>
        </form>
      </dialog>
    </section>

    <section>
      <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-rounded1').showModal();">
        Front End Development
      </button>
      <dialog class="nes-dialog is-rounded" id="dialog-rounded1">
        <form method="dialog">
          <p class="title">Front End Development</p>
          <p>Alert: this is a dialog.</p>
          <menu class="dialog-menu">
            <button class="nes-btn is-primary">Exit</button>
          </menu>
        </form>
      </dialog>
    </section>

    <section>
      <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-rounded2').showModal();">
        Back End Development
      </button>
      <dialog class="nes-dialog is-rounded" id="dialog-rounded2">
        <form method="dialog">
          <p class="title">Back End Development</p>
          <p>Alert: this is a dialog.</p>
          <menu class="dialog-menu">
            <button class="nes-btn is-primary">Exit</button>
          </menu>
        </form>
      </dialog>
    </section>
    <section>
      <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-rounded3').showModal();">
        Class Platform
      </button>
      <dialog class="nes-dialog is-rounded" id="dialog-rounded3">
        <form method="dialog">
          <p class="title">Class Platform</p>
          <p>Alert: this is a dialog.</p>
          <menu class="dialog-menu">
            <button class="nes-btn is-primary">Exit</button>
          </menu>
        </form>
      </dialog>
    </section>

  </div>
</template>
