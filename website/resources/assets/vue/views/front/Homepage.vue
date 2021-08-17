<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import {State} from "vuex-class";
import BasePage from "@/views/front/BasePage.vue";

declare const baseMetaUrl;
// import Slider from "@/components/Slider/Slider.vue";

//Starter Components
import PagePart from "@/components/Starter/Pages/PagePart.vue";
import BuildPart from "@/components/Starter/Pages/BuildPart.vue";

@Component({
  components: {
    PagePart,
    BuildPart
  }
})
export default class Homepage extends BasePage {
  resetFormActive: boolean = false;

  constructor() {
    super();
  }

  async mounted() {
  }

  const sampleCollection = [
    {
      title: 'texts',
      showCode: false,
      code: `<span class="nes-text is-primary">Primary</span>
<span class="nes-text is-success">Success</span>
<span class="nes-text is-warning">Warning</span>
<span class="nes-text is-error">Error</span>
<span class="nes-text is-disabled">Disabled</span>`,
    },
    {
      title: 'buttons',
      showCode: false,
      code: `<a class="nes-btn" href="#">Normal</a>

<button type="button" class="nes-btn is-primary">Primary</button>
<button type="button" class="nes-btn is-success">Success</button>
<button type="button" class="nes-btn is-warning">Warning</button>
<button type="button" class="nes-btn is-error">Error</button>
<button type="button" class="nes-btn is-disabled">Disabled</button>

<label class="nes-btn">
  <span>Select your file</span>
  <input type="file">
</label>`,
    },
    {
      title: 'radios',
      showCode: false,
      code: `<label>
  <input type="radio" class="nes-radio" name="answer" checked />
  <span>Yes</span>
</label>

<label>
  <input type="radio" class="nes-radio" name="answer" />
  <span>No</span>
</label>

<div style="background-color:#212529; padding: 1rem 0;">
  <label>
    <input type="radio" class="nes-radio is-dark" name="answer-dark" checked />
    <span>Yes</span>
  </label>

  <label>
    <input type="radio" class="nes-radio is-dark" name="answer-dark" />
    <span>No</span>
  </label>
</div>`,
    },
    {
      title: 'checkboxes',
      showCode: false,
      code: `<label>
  <input type="checkbox" class="nes-checkbox" checked />
  <span>Enable</span>
</label>

<div style="background-color:#212529; padding: 1rem 0;">
  <label>
    <input type="checkbox" class="nes-checkbox is-dark" checked />
    <span>Dark</span>
  </label>
</div>`,
    },
    {
      title: 'inputs',
      showCode: false,
      code: `<div class="nes-field">
  <label for="name_field">Your name</label>
  <input type="text" id="name_field" class="nes-input">
</div>

<div class="nes-field is-inline">
  <label for="inline_field">.input.is-success</label>
  <input type="text" id="inline_field" class="nes-input is-success" placeholder="NES.css">
</div>

<div class="nes-field is-inline">
  <label for="warning_field">.input.is-warning</label>
  <input type="text" id="warning_field" class="nes-input is-warning" placeholder="8bit.css">
</div>

<div class="nes-field is-inline">
  <label for="error_field">.input.is-error</label>
  <input type="text" id="error_field" class="nes-input is-error" placeholder="awesome.css">
</div>

<div style="background-color:#212529; padding: 1rem;" class="nes-field is-inline">
  <label for="dark_field" style="color:#fff;">.input.is-dark</label>
  <input type="text" id="dark_field" class="nes-input is-dark" placeholder="dark.css">
</div>`,
    },
    {
      title: 'textarea',
      showCode: false,
      code: `<label for="textarea_field">Textarea</label>
<textarea id="textarea_field" class="nes-textarea"></textarea>`,
    },
    {
      title: 'selects',
      showCode: false,
      code: `<label for="default_select">Default select</label>
<div class="nes-select">
  <select required id="default_select">
    <option value="" disabled selected hidden>Select...</option>
    <option value="0">To be</option>
    <option value="1">Not to be</option>
  </select>
</div>

<label for="success_select">nes-select.is-success</label>
<div class="nes-select is-success">
  <select required id="success_select">
    <option value="" disabled selected hidden>Select...</option>
    <option value="0">To be</option>
    <option value="1">Not to be</option>
  </select>
</div>

<label for="warning_select">nes-select.is-warning</label>
<div class="nes-select is-warning">
  <select required id="warning_select">
    <option value="" disabled selected hidden>Select...</option>
    <option value="0">To be</option>
    <option value="1">Not to be</option>
  </select>
</div>

<label for="error_select">nes-select.is-error</label>
<div class="nes-select is-error">
  <select required id="error_select">
    <option value="" disabled selected hidden>Select...</option>
    <option value="0">To be</option>
    <option value="1">Not to be</option>
  </select>
</div>

<div style="background-color:#212529; padding: 1rem 1.2rem 1rem 1rem;width:calc(100% + 8px)">
  <label for="dark_select" style="color:#fff">nes-select.is-dark</label>
  <div class="nes-select is-dark">
    <select required id="dark_select">
      <option value="" disabled selected hidden>Select...</option>
      <option value="0">To be</option>
      <option value="1">Not to be</option>
    </select>
  </div>
</div>`,
    },
    {
      title: 'containers',
      showCode: false,
      code: `<div class="nes-container with-title is-centered">
  <p class="title">Container.is-centered</p>
  <p>Good morning. Thou hast had a good night's sleep, I hope.</p>
</div>

<div class="nes-container is-dark with-title">
  <p class="title">Container.is-dark</p>
  <p>Good morning. Thou hast had a good night's sleep, I hope.</p>
</div>

<div class="nes-container is-rounded">
  <p>Good morning. Thou hast had a good night's sleep, I hope.</p>
</div>

<div class="nes-container is-rounded is-dark">
  <p>Good morning. Thou hast had a good night's sleep, I hope.</p>
</div>`,
    },
    {
      title: 'dialogs',
      note:
        'NES.css does not include any JavaScript. If you want to use dialog element other than Chrome, you need polyfill.',
      showCode: false,
      code: `<!-- Dialog -->
        <section>
        <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-default').showModal();">
        Open dialog
        </button>
        <dialog class="nes-dialog" id="dialog-default">
        <form method="dialog">
        <p class="title">Dialog</p>
        <p>Alert: this is a dialog.</p>
        <menu class="dialog-menu">
        <button class="nes-btn">Cancel</button>
        <button class="nes-btn is-primary">Confirm</button>
        </menu>
        </form>
        </dialog>
        </section>

        <!-- Dark dialog -->
        <section>
        <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-dark').showModal();">
        Open dark dialog
        </button>
        <dialog class="nes-dialog is-dark" id="dialog-dark">
        <form method="dialog">
        <p class="title">Dark dialog</p>
        <p>Alert: this is a dialog.</p>
        <menu class="dialog-menu">
        <button class="nes-btn">Cancel</button>
        <button class="nes-btn is-primary">Confirm</button>
        </menu>
        </form>
        </dialog>
        </section>

        <!-- Rounded dialog -->
        <section>
        <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-rounded').showModal();">
        Open rounded dialog
        </button>
        <dialog class="nes-dialog is-rounded" id="dialog-rounded">
        <form method="dialog">
        <p class="title">Rounded dialog</p>
        <p>Alert: this is a dialog.</p>
        <menu class="dialog-menu">
        <button class="nes-btn">Cancel</button>
        <button class="nes-btn is-primary">Confirm</button>
        </menu>
        </form>
        </dialog>
        </section>

        <!-- Dark and Rounded dialog -->
        <section>
        <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-dark-rounded').showModal();">
        Open dark and rounded dialog
        </button>
        <dialog class="nes-dialog is-dark is-rounded" id="dialog-dark-rounded">
        <form method="dialog">
        <p class="title">Dark and Rounded dialog</p>
        <p>Alert: this is a dialog.</p>
        <menu class="dialog-menu">
        <button class="nes-btn">Cancel</button>
        <button class="nes-btn is-primary">Confirm</button>
        </menu>
        </form>
        </dialog>
        </section>`,
        },
        {
        title: 'lists',
        showCode: false,
        code: `<div class="lists">
  <ul class="nes-list is-disc">
    <li>Good morning.</li>
    <li>Thou hast had a good night's sleep, I hope.</li>
    <li>Thou hast had a good afternoon</li>
    <li>Good night.</li>
  </ul>
</div>

<div class="lists">
  <ul class="nes-list is-circle">
    <li>Good morning.</li>
    <li>Thou hast had a good night's sleep, I hope.</li>
    <li>Thou hast had a good afternoon</li>
    <li>Good night.</li>
  </ul>
</div>

<section class="nes-container is-dark">
  <div class="lists">
    <ul class="nes-list is-disc is-dark">
      <li>Good morning.</li>
      <li>Thou hast had a good night's sleep, I hope.</li>
      <li>Thou hast had a good afternoon</li>
      <li>Good night.</li>
    </ul>
  </div>

  <div class="lists">
    <ul class="nes-list is-circle is-dark">
      <li>Good morning.</li>
      <li>Thou hast had a good night's sleep, I hope.</li>
      <li>Thou hast had a good afternoon</li>
      <li>Good night.</li>
    </ul>
  </div>
</section>`,
},
{
  title: 'tables',
    showCode: false,
  code: `<div class="nes-table-responsive">
  <table class="nes-table is-bordered is-centered">
    <thead>
      <tr>
        <th>Table.is-bordered</th>
        <th>Table.is-centered</th>
        <th>Table.is-centered</th>
        <th>Table.is-centered</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Thou hast had a good morning</td>
        <td>Thou hast had a good afternoon</td>
        <td>Thou hast had a good evening</td>
        <td>Thou hast had a good night</td>
      </tr>
      <tr>
        <td>Thou hast had a good morning</td>
        <td>Thou hast had a good afternoon</td>
        <td>Thou hast had a good evening</td>
        <td>Thou hast had a good night</td>
      </tr>
    </tbody>
  </table>
</div>

<div class="nes-table-responsive">
  <table class="nes-table is-bordered is-dark">
    <thead>
      <tr>
        <th>Table.is-dark</th>
        <th>Table.is-bordered</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Thou hast had a good morning</td>
        <td>Thou hast had a good afternon</td>
      </tr>
      <tr>
        <td>Thou hast had a good morning</td>
        <td>Thou hast had a good afternoon</td>
      </tr>
    </tbody>
  </table>
</div>`,
},
{
  title: 'progress',
    showCode: false,
  code: `<progress class="nes-progress" value="90" max="100"></progress>
<progress class="nes-progress is-primary" value="80" max="100"></progress>
<progress class="nes-progress is-success" value="50" max="100"></progress>
<progress class="nes-progress is-warning" value="30" max="100"></progress>
<progress class="nes-progress is-error" value="10" max="100"></progress>
<progress class="nes-progress is-pattern" value="50" max="100"></progress>`,
},
{
  title: 'avatars',
    description: 'It is recommended to use the class "is-pixelated".',
  showCode: false,
  code: `<img class="nes-avatar is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">

<img class="nes-avatar is-small is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">
<img class="nes-avatar is-medium is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">
<img class="nes-avatar is-large is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">


<img class="nes-avatar is-rounded is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">

<img class="nes-avatar is-rounded is-small is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">
<img class="nes-avatar is-rounded is-medium is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">
<img class="nes-avatar is-rounded is-large is-pixelated" alt="Gravatar image example" src="https://www.gravatar.com/avatar?s=15">`,
},
{
  title: 'balloons',
    showCode: false,
  code: `<section class="nes-container">
  <section class="message-list">
    <section class="message -left">
      <i class="nes-bcrikko"></i>
      <!-- Balloon -->
  <div class="nes-balloon from-left">
  <p>Hello NES.css</p>
  </div>
  </section>

  <section class="message -right">
  <!-- Balloon -->
  <div class="nes-balloon from-right">
  <p>Good morning. Thou hast had a good night's sleep, I hope.</p>
  </div>
  <i class="nes-bcrikko"></i>
  </section>
  </section>
  </section>

  <!-- Balloon 'is-dark'  -->
  <section class="nes-container is-dark">
  <section class="message-list">
  <section class="message -left">
  <i class="nes-bcrikko"></i>
  <!-- Balloon -->
  <div class="nes-balloon from-left is-dark">
  <p>Hello NES.css</p>
  </div>
  </section>

  <section class="message -right">
  <!-- Balloon -->
  <div class="nes-balloon from-right is-dark">
  <p>Good morning. Thou hast had a good night's sleep, I hope.</p>
  </div>
  <i class="nes-bcrikko"></i>
  </section>
  </section>
  </section>
  </section>`,
  },
{
  title: 'cursor',
    showCode: false,
  code: `<p class="nes-balloon from-left nes-pointer">
  This is not a clickable element, but it's an area of the pointer.
</p>`,
},
{
  title: 'badges',
    showCode: false,
  code: `<a href="#" class="nes-badge">
  <span class="is-dark">NES.css</span>
</a>

<a href="#" class="nes-badge">
  <span class="is-primary">is</span>
</a>

<a href="#" class="nes-badge">
  <span class="is-success">a</span>
</a>

<a href="#" class="nes-badge">
  <span class="is-warning">great</span>
</a>

<a href="#" class="nes-badge">
  <span class="is-error">framework!</span>
</a>

<a href="#" class="nes-badge is-split">
  <span class="is-dark">npm</span>
  <span class="is-primary">1.1.0</span>
</a>

<a href="#" class="nes-badge is-split">
  <span class="is-dark">test</span>
  <span class="is-success">100%</span>
</a>

<a href="#" class="nes-badge is-icon">
  <span class="is-warning"><i class="nes-icon star is-small"></i></span>
  <span class="is-primary">Icons</span>
</a>

<a href="#" class="nes-badge is-icon">
  <span class="is-dark">hi</span>
  <span class="is-warning">Text</span>
</a>`,
},
{
  title: 'reaction-icons',
    showCode: false,
  description:
  'If you want to change icon size, please use "is-small", "is-medium" and "is-large".',
    code: `<section class="icon-list">
  <!-- heart -->
  <i class="nes-icon is-large heart"></i>
  <i class="nes-icon is-large is-half heart"></i>
  <i class="nes-icon is-large is-transparent heart"></i>
  <i class="nes-icon is-large heart is-empty"></i>

  <!-- star -->
  <i class="nes-icon is-large star"></i>
  <i class="nes-icon is-large star is-half"></i>
  <i class="nes-icon is-large star is-transparent"></i>
  <i class="nes-icon is-large star is-empty"></i>

  <!-- like -->
  <i class="nes-icon is-large like"></i>
  <i class="nes-icon is-large like is-empty"></i>
  </section>`,
  },
{
  title: 'sns-icons',
    showCode: false,
  description:
  'If you want to change icon size, please use "is-small", "is-medium" and "is-large".',
    code: `<section class="icon-list">
  <!-- twitter -->
  <i class="nes-icon twitter is-large"></i>

  <!-- facebook -->
  <i class="nes-icon facebook is-large"></i>

  <!-- instagram -->
  <i class="nes-icon instagram is-large"></i>

  <!-- github -->
  <i class="nes-icon github is-large"></i>

  <!-- google -->
  <i class="nes-icon google is-large"></i>

  <!-- gmail -->
  <i class="nes-icon gmail is-large"></i>

  <!-- medium -->
  <i class="nes-icon medium is-large"></i>

  <!-- linkedin -->
  <i class="nes-icon linkedin is-large"></i>

  <!-- twitch -->
  <i class="nes-icon twitch is-large"></i>

  <!-- youtube -->
  <i class="nes-icon youtube is-large"></i>

  <!-- reddit -->
  <i class="nes-icon reddit is-large"></i>

  <!-- whatsapp -->
  <i class="nes-icon whatsapp is-large"></i>
  </section>`,
  },
{
  title: 'other-icons',
    showCode: false,
  description:
  'If you want to change icon size, please use "is-small", "is-medium" and "is-large".',
    code: `<section class="icon-list">
  <!-- close -->
  <i class="nes-icon close is-large"></i>

  <!-- trophy -->
  <i class="nes-icon trophy is-large"></i>

  <!-- coin -->
  <i class="nes-icon coin is-large"></i>
  </section>`,
  },
{
  title: 'pixel-arts',
    showCode: false,
  code: `<section class="icon-list">
  <!-- controllers -->
  <i class="nes-logo"></i>
  <i class="nes-jp-logo"></i>
  <i class="snes-logo"></i>
  <i class="snes-jp-logo"></i>

  <!-- octocat -->
  <i class="nes-octocat animate"></i>

  <!-- phone -->
  <i class="nes-smartphone"></i>
  <i class="nes-phone"></i>
  </section>`,
  },
{
  title: 'Nintendo-characters',
    showCode: false,
  note:
  'Nintendo owns the copyright of these characters. Please comply with the Nintendo guidelines and laws of the applicable jurisdiction.',
    code: `<section class="icon-list">
  <!-- Copyright Nintendo -->
  <i class="nes-mario"></i>
  <i class="nes-ash"></i>
  <i class="nes-pokeball"></i>
  <i class="nes-bulbasaur"></i>
  <i class="nes-charmander"></i>
  <i class="nes-squirtle"></i>
  <i class="nes-kirby"></i>
  </section>`,
  },
];

const coreteam = [
  {
    name: 'B.C.Rikko',
    feat: 'Creator of NES.css',
    github: 'BcRikko',
    twitter: 'bc_rikko',
  },
  {
    name: 'Igor Guastalla',
    feat: 'Development support',
    github: 'guastallaigor',
    twitter: 'guastallaigor',
  },
];

const emeriti = [
  {
    name: 'Trezy',
    feat: 'Setup DevOps',
    github: 'trezy',
    twitter: 'TrezyCodes',
  },
  {
    name: 'Abdullah Samman',
    feat: 'Setup test suite',
    github: 'evexoio',
  },
];

// curl -s 'https://api.github.com/repos/nostalgic-css/NES.css/contributors?per_page=100' | jq '.[].login'
const contributors = [
  '4k1k0',
  'sombreroEnPuntas',
  'Divoolej',
  'soph-iest',
  'montezume',
  'sazzadsazib',
  'HiKaylum',
  'jdvivar',
  'ohlookitsderpy',
  'IngwiePhoenix',
  'kyu-suke',
  'jjspace',
  'Baldomo',
  'DanSnow',
  'ernestomancebo',
  'Ilyeo',
  'Kartones',
  'rrj-dev',
  'vicainelli',
  'stewartrule',
  'kenshinji',
  'youngkaneda',
  'Takumi0901',
  'loo41',
  'alexd99',
  'alexgleason',
  'agarzola',
  'AlphaWong',
  'brendansparrow',
  'Ermakoy',
  'fleeting',
  'JamesIves',
  'jsoref',
  'KOREAN139',
  'KalobTaulien',
  'LukBukkit',
  'otaviopace',
  'Pedro-Souza',
  'iamrameffort',
  'scottaohara',
  'd0p1s4m4',
  'lucasjs',
  'musavvirahmed',
  'sinofp',
  'thisisabhinay',
  'tnantoka',
];

new Vue({
  el: '#nescss',
  data() {
    return {
      collection: sampleCollection,
      coreteam,
      emeriti,
      contributors,
      animateOctocat: false,
      copiedBalloon: {
        display: 'none',
        top: 0,
        left: 0,
      },
      scrollPos: 0,
    };
  },
  filters: {
    capitalize(val) {
      if (!val) return '';
      val = val.toString();
      return val.charAt(0).toUpperCase() + val.slice(1);
    },
  },
  mounted() {
    document.addEventListener('scroll', () => {
      this.scrollPos = document.documentElement.scrollTop || document.body.scrollTop;
    });
    hljs.initHighlightingOnLoad();
    [].forEach.call(document.querySelectorAll('dialog'), (a) => {
      dialogPolyfill.registerDialog(a);
    });
    this.replaceImages();
  },
  methods: {
    copy(event, id) {
      this.showCopiedBalloon(event.pageY, event.pageX);

      const fake = document.createElement('textarea');
      fake.value = this.collection.find(a => a.title === id).code;
      fake.setAttribute('readonly', '');
      Object.assign(fake.style, {
        position: 'absolute',
        left: '-9999px',
      });
      this.$el.appendChild(fake);
      fake.select();
      document.execCommand('copy');
      this.$el.removeChild(fake);
    },
    startAnimate() {
      this.animateOctocat = true;
    },
    stopAnimate() {
      this.animateOctocat = false;
    },
    showCopiedBalloon(top, left) {
      this.copiedBalloon = {
        display: 'block',
        top: `${top - 100}px`,
        left: `${left - 180}px`,
      };
      setTimeout(() => {
        this.copiedBalloon.display = 'none';
      }, 1000);
    },
    replaceImages() {
      Array.from(document.querySelectorAll('img.lazy')).forEach((img) => {
        img.onload = () => img.classList.remove('lazy');
        img.src = img.dataset.src;
      });
    },
  },
});
}
</script>

<template>
  <!--<div>-->
    <!--<div class="page-header">-->
      <!--<h1 class="page-header__main-title" style="font-size: 0.625rem">-->
        <!--<a href="/">-->
          <!--<img src="https://fontmeme.com/permalink/210614/d357fad6a11a3d710c3a0fc60c47e9f8.png" alt="STARTER" border="0">-->
        <!--</a>-->
      <!--</h1>-->
    <!--</div>-->
    <!--<page-part></page-part>-->
    <!--<build-part></build-part>-->
  <!--</div>-->
  <div id="nescss">
    <header :class="{ sticky: scrollPos > 50 }">
      <div class="container">
        <div class="nav-brand">
          <a href="https://nostalgic-css.github.io/NES.css/">
            <h1><i class="snes-jp-logo brand-logo"></i>NES.css</h1>
          </a>
          <p>NES-style CSS Framework.</p>
        </div>

        <div class="social-buttons">
          <p>Share on SNS</p>
          <div class="share">
            <a href="https://twitter.com/share?text=NES.css%EF%BD%9CNES-style%20CSS%20Framework%20%40bc_rikko&url=https://nostalgic-css.github.io/NES.css/" target="_blank"><i class="nes-icon twitter"></i></a>
            <a href="https://www.facebook.com/sharer.php?u=https://nostalgic-css.github.io/NES.css/&t=NES.css%EF%BD%9CNES-style%20CSS%20Framework" target="_blank"><i class="nes-icon facebook"></i></a>
            <a href="https://www.linkedin.com/shareArticle?url=https%3A//nostalgic-css.github.io/NES.css/&title=NES.css%EF%BD%9CNES-style%20CSS%20Framework" target="_blank"><i class="nes-icon linkedin"></i></a>
            <a href="https://github.com/nostalgic-css/NES.css" target="_blank"><i class="nes-icon github"></i></a>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
      <main class="main-content">
        <a class="github-link" :class="{ active:  scrollPos < 200 }" href="https://github.com/nostalgic-css/NES.css" target="_blank" rel="noopener" @mouseover="startAnimate" @mouseout="stopAnimate">
          <p class="nes-balloon from-right">Fork me<br />on GitHub</p>
          <i class="nes-octocat" :class="animateOctocat ? 'animate' : ''"></i>
        </a>

        <!-- About -->
        <section class="topic">
          <h2 id="about"><a href="#about">#</a>About</h2>
          <p>NES.css is NES-style (8bit-like) CSS Framework.</p>
        </section>


        <!-- Installation -->
        <section class="topic">
          <h2 id="installation"><a href="#installation">#</a>Installation</h2>
          <p>NES.css is available via either npm or Yarn, or a CDN.</p>
          <p>Please read <a href="https://github.com/nostalgic-css/NES.css" target="_blank" rel="noopener">README.md</a>.</p>
        </section>

        <!-- Usage -->
        <section class="topic">
          <h2 id="usage"><a href="#usage">#</a>Usage</h2>
          <p>NES.css only provides components. You will need to define your own layout.</p>

          <section class="showcase" v-for="sample in collection" :key="sample">
            <section class="nes-container with-title">
              <h3 class="title">{{ sample.title | capitalize }}</h3>
              <div
                      :id="sample.title"
                      class="item"
                      v-html="sample.code">
              </div>
              <p v-if="sample.description" class="description nes-text">{{ sample.description }}</p>
              <p v-if="sample.note" class="note nes-text is-error">{{ sample.note }}</p>
              <button type="button" class="nes-btn is-primary showcode" @click="sample.showCode = !sample.showCode">&lt;&gt;</button>
            </section>
            <section class="samplecode" v-show="sample.showCode">
              <button type="button" class="nes-btn copycode" @click="copy($event, sample.title)">copy</button>
              <pre><code class="html">{{ sample.code }}</code></pre>
            </section>
          </section>
        </section>

        <!-- Members -->
        <section class="topic">
          <h2 id="members"><a href="#members">#</a>Members</h2>
          <section class="coreteam">
            <h3 class="topic-title"><i class="nes-icon star"></i>Core Team Members</h3>
            <p>Here is core team members developing NES.css.</p>

            <div class="coreteam-members">
              <template v-for="member in coreteam">
                <section class="nes-container is-dark member-card">
                  <div class="avatar">
                    <img class="lazy" :data-src="'https://github.com/' + member.github + '.png?size=80'" :alt="'Core Member ' + member.name">
                  </div>
                  <div class="profile">
                    <h4 class="name">{{ member.name }}</h4>
                    <p>{{ member.feat }}</p>
                    <div>
                      <a :href="'https://github.com/' + member.github" target="_blank" rel="noopener" aria-label="github"><i class="nes-icon github"></i></a>
                      <a v-if="member.twitter" :href="'https://twitter.com/' + member.twitter" target="_blank" rel="noopener" aria-label="twitter"><i class="nes-icon twitter"></i></a>
                    </div>
                  </div>
                </section>
              </template>
            </div>
          </section>
          <section class="coreteam-emeriti" v-if="emeriti.length > 0">
            <h3 class="topic-title"><i class="nes-icon trophy"></i>Core Team Emeriti</h3>
            <p>Here we honor some no-longer-active core team members.</p>

            <div class="coreteam-members">
              <template v-for="member in emeriti">
                <section class="nes-container is-dark member-card">
                  <div class="avatar">
                    <img class="lazy" :data-src="'https://github.com/' + member.github + '.png?size=80'" :alt="'Emeriti ' + member.name">
                  </div>
                  <div class="profile">
                    <h4 class="name">{{ member.name }}</h4>
                    <p>{{ member.feat }}</p>
                    <div>
                      <a :href="'https://github.com/' + member.github" target="_blank" rel="noopener" aria-label="github"><i class="nes-icon github"></i></a>
                      <a v-if="member.twitter" :href="'https://twitter.com/' + member.twitter" target="_blank" rel="noopener" aria-label="twitter"><i class="nes-icon twitter"></i></a>
                    </div>
                  </div>
                </section>
              </template>
            </div>
          </section>
          <section class="contributors">
            <h3 class="topic-title"><i class="nes-icon heart"></i>Contributors</h3>
            <template v-for="user in contributors">
              <a class="contributor" :href="'https://github.com/' + user" target="_black">
                <img class="nes-avatar is-large is-rounded lazy" :data-src="'https://github.com/' + user + '.png?size=64'" :alt="'Contributor ' + user">
                <p>{{ user }}</p>
              </a>
            </template>
          </section>
        </section>

        <!-- Articles -->
        <section class="topic">
          <h2 id="articles"><a href="#articles">#</a>Articles</h2>
          <article class="article-link">
            <h3 class="title">
              <a href="https://medium.com/@bc_rikko/why-i-created-and-released-nes-css-ee8966bacd09" target="_blank" rel="noopener"><i class="nes-icon medium"></i><span>Why I created and released NES.css</span></a>
            </h3>
          </article>
          <article class="article-link">
            <h3 class="title">
              <a href="https://github.blog/2019-01-20-release-radar-december-2018/#nes-css-1-0" target="_blank" rel="noopener"><i class="nes-icon github"></i><span>Release Radar·December 2018|The GitHub Blog</span></a>
            </h3>
          </article>
        </section>

      </main>

      <footer>
        <p>
          <span>&copy;2018</span>
          <a href="https://kuroeveryday.blogspot.com/" target="_blank" rel="noopener">Black Everyday Company</a>
          <span>-</span>
          <a href="https://twitter.com/bc_rikko" target="_blank" rel="noopener">@bc_rikko</a>
        </p>
      </footer>

      <!-- Copied balloon -->
      <div class="nes-balloon from-right copied-balloon" :style="copiedBalloon">
        <p>copied!!</p>
      </div>

      <!-- FAB Button -->
      <button type="button" class="nes-btn is-error scroll-btn" :class="{ active: scrollPos > 500 }" @click="window.scrollTo({ top:0, behavior: 'smooth' })"><span>&lt;</span></button>
    </div>
  </div>
</template>

<style scoped>

  @charset "utf-8";
  @import url(https://fonts.googleapis.com/css?family=Press+Start+2P);

  body {
    padding: 0 2rem;
    margin: 0 2rem;
  }

  #nescss > .container {
    max-width: 980px;
    margin: 0 auto;
    margin-top: 150px;
  }

  /* Header */
  header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9;
    border-bottom: 4px solid #D3D3D3;
    background-color: white;
  }

  header > .container {
    display: flex;
    align-items: baseline;
    max-width: 980px;
    margin: 0 auto;
    padding-top: 1rem;
    transition: all 0.2s ease;
  }

  header > .container > .nav-brand {
    margin-right: auto;
  }
  header > .container > .social-button {
    margin-left: auto;
  }

  .nav-brand .brand-logo {
    margin-right: 1rem;
  }
  .nav-brand > a {
    color: #212529;
    text-decoration: none;
  }

  .social-buttons p {
    margin-bottom: 0;
  }

  /* Header-sticky */
  header.sticky > .container {
    font-size: 0.8rem;
    padding: 0;
    align-items: center;
  }
  header.sticky .nav-brand h1 {
    margin: 0;
  }
  header.sticky .nav-brand p {
    display: none;
    margin-bottom: 0;
    font-size: 0.6rem;
  }

  /* Main */
  .main-content {
    margin-bottom: 4rem;
  }

  /* Footer */
  footer {
    text-align: center;
    margin-bottom: 2rem;
  }
  footer a {
    color: #333;
    text-decoration: none;
  }

  h2 > a {
    margin-right: 1rem;
  }

  .topic {
    margin-bottom: 3rem;
  }

  /* github link */
  .github-link {
    position: fixed;
    top: 100px;
    right: -240px;
    z-index: 999;
    display: flex;
    height: 100px;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  .github-link.active {
    right: 10px;
  }
  .github-link:hover {
    text-decoration: none;
  }
  .github-link > p.nes-balloon {
    align-self: flex-start;
    padding: 0.2rem 0.5rem;
    font-size: 0.8rem;
    color: #333;
  }
  .github-link > i.nes-octocat {
    align-self: flex-end;
  }

  /* Showcase */
  section.showcase {
    margin-top: 2.5rem;
  }
  section.showcase > section.nes-container {
    padding-bottom: 2.5rem;
  }
  section.showcase > section.nes-container,
  section.showcase > section.samplecode {
    position: relative;
  }
  .nes-btn.showcode {
    position: absolute;
    font-size: 12px;
    bottom: 0px;
    right: -4px;
  }
  .nes-btn.copycode {
    position: absolute;
    font-size: 12px;
    top: 0;
    right: 0px;
  }

  section.showcase > section.samplecode > pre code {
    font-size: 13px;
    line-height: 1.5;
    padding: 1.5rem;
  }

  .item {
    margin-bottom: -1rem;
  }
  .item > * {
    margin-bottom: 1.5rem !important;
  }

  /* Containers */
  .item.containers > .nes-container {
    display: inline-block;
    max-width: 400px;
  }

  /* Balloons sample */
  section.message-list {
    display: flex;
    flex-direction: column;
  }
  .message-list > .message {
    display: flex;
    margin-top: 2rem;
  }
  .message-list > .message > .nes-balloon {
    max-width: 550px;
  }
  .message-list > .message i {
    align-self: flex-end;
  }
  .message-list > .message.-left {
    align-self: flex-start;
  }
  .message-list > .message.-right {
    align-self: flex-end;
  }
  .message-list > .message.-left i {
    margin-right: 2rem;
  }
  .message-list > .message.-right i {
    margin-left: 2rem;
  }

  .icon-list > .blur-filter {
    filter: blur(10px);
  }

  /* Copied balloon */
  .nes-balloon.copied-balloon {
    position: absolute;
    display: none;
    padding: 1rem;
    box-shadow: 0 5px 20px 5px rgba(0,0,0,.6);
    z-index: 1;
  }

  /* Topic */
  h3.topic-title {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
  }

  h3.topic-title > i {
    margin-right: 1.5rem;
  }

  /* coreteam */
  .coreteam-members {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  .nes-container.member-card {
    display: flex;
    padding: 1rem 1.5rem;
    width: 470px;
    margin-bottom: 2rem;
  }

  .member-card .avatar > img {
    display: block;
    width: 80px;
    height: 80px;
    border-radius: 50%;
  }
  .member-card > .profile {
    margin-left: 1.5rem;
  }
  .member-card > .profile > .name {
    font-size: 20px;
  }

  /* Contributors */
  .contributor {
    display: inline-block;
    margin: 1rem;
    text-align: center;
    width: 160px;
  }
  .contributor > p {
    margin: .5rem;
    font-size: 12px;
  }
  .contributor img.nes-avatar {
    transition: all .4s;
    display: inline-block;
  }
  .contributor:hover {
    text-decoration: none;
    opacity: 0.7;
  }

  /* Articles */
  .article-link > .title a {
    color: #333;
  }
  .article-link > .title span {
    margin-left: 1rem;
  }

  /* Scroll back to top */
  .scroll-btn {
    position: fixed;
    bottom: -60px;
    right: 2rem;
    box-shadow: 0 5px 20px rgba(0,0,0,.6);
    transition: all 0.3s ease;
  }
  .scroll-btn.active {
    bottom: 25px;
  }
  .scroll-btn > span {
    display: block;
    transform: rotateZ(90deg);
  }

  img.lazy {
    background-color: #D3D3D3;
  }

  @media screen and (max-width: calc(980px - 4rem)) {
    header > .container {
      margin: 0 4rem;
    }
  }

  @media screen and (max-width: 768px) {
    body {
      margin: 2rem 0.5rem;
      padding: 0;
    }

    header > .container {
      margin: 0 0.5rem;
    }

    .github-link {
      display: none;
    }

    .message-list > .message > .nes-balloon {
      max-width: 60%;
    }
  }

  @media screen and (max-width: 580px) {
    #nescss > .container {
      margin-top: 190px;
    }
  }
</style>
