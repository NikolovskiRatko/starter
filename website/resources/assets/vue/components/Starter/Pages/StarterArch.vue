<script lang="ts">
import {Component, Vue} from "vue-property-decorator";

@Component({})

export default class StarterArch extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="starterArch col-md-6">
    <div class="starterArch__header">
      <h2><i class="nes-icon is-large star"></i>Starter Architecture</h2>
    </div>
    <div class="starterArch__box">
      <h4><span style="color: #219cee">#</span> Development Operations (DevOps)</h4>
      <h5><span>Approach:</span> Infrastructure as Code (SweetOps Methodology)</h5>

      <h5><span>Technologies:</span> Geodesic Linux Distro</h5>
      <ul>
        <li>Terraform</li>
        <li>Kubernetes</li>
        <li>Docker</li>
        <li>Helm</li>
      </ul>
      <h5><span>Syntax:</span> Yaml</h5>
      <h5><span>Language:</span> Golang</h5>
    </div>
    <div class="starterArch__box">
      <h4><span style="color: #A4EBF3">#</span> Back End Development</h4>
      <h5><span>Approach:</span>S.O.L.I.D Principles</h5>

      <h5><span>Technologies:</span> Laravel</h5>

      <h5><span>Syntax:</span> Object-Orianted Design (OOD)</h5>
      <h5><span>Language:</span> PHP</h5>
    </div>
    <div class="starterArch__box">
      <h4><span style="color: #219cee">#</span> Front End Development</h4>
      <h5><span>Approach:</span>Component-Based Architecture</h5>

      <h5><span>Technologies:</span> Nuxt / VueJs</h5>

      <h5><span>Syntax:</span> Typescript</h5>
      <h5><span>Language:</span> Javascript</h5>
    </div>
    <div class="starterArch__box">
      <h4><span style="color: #A4EBF3">#</span> Cross Platform</h4>
      <h5><span>Approach:</span>Mobile UI/UX toolkit</h5>

      <h5><span>Technologies:</span> Ionic</h5>

      <h5><span>Syntax:</span> Typescript</h5>
      <h5><span>Language:</span> Javascript</h5>
    </div>

    <div class="starterArch__box__mobile">
      <section>
        <button type="button" class="nes-btn is-primary"
                onclick="document.getElementById('dialog-default').showModal();">
          DevOps
        </button>
        <dialog class="nes-dialog" id="dialog-default">
          <form method="dialog">
            <p class="title">DevOps</p>
            <p>Alert: this is a dialog.</p>
            <menu class="dialog-menu">
              <button class="nes-btn is-primary">Cancel</button>

            </menu>
          </form>
        </dialog>
      </section>
      <section>
        <button type="button" class="nes-btn is-primary"
                onclick="document.getElementById('dialog-default1').showModal();">
          Front End Dev.
        </button>
        <dialog class="nes-dialog" id="dialog-default1">
          <form method="dialog">
            <p class="title">Front End Dev.</p>
            <p>Alert: this is a dialog.</p>
            <menu class="dialog-menu">
              <button class="nes-btn is-primary">Cancel</button>
            </menu>
          </form>
        </dialog>
      </section>
      <section>
        <button type="button" class="nes-btn is-primary"
                onclick="document.getElementById('dialog-default2').showModal();">
          Back End Dev.
        </button>
        <dialog class="nes-dialog" id="dialog-default2">
          <form method="dialog">
            <p class="title">Back End Dev.</p>
            <p>Alert: this is a dialog.</p>
            <menu class="dialog-menu">
              <button class="nes-btn is-primary">Cancel</button>

            </menu>
          </form>
        </dialog>
      </section>
      <section>
        <button type="button" class="nes-btn is-primary"
                onclick="document.getElementById('dialog-default3').showModal();">
          Cross Platform
        </button>
        <dialog class="nes-dialog" id="dialog-default3">
          <form method="dialog">
            <p class="title">Cross Platform</p>
            <p>Alert: this is a dialog.</p>
            <menu class="dialog-menu">
              <button class="nes-btn is-primary">Cancel</button>

            </menu>
          </form>
        </dialog>
      </section>
    </div>
  </div>
</template>
