<script lang="ts">
    import { Component, Watch, Prop, Vue } from 'vue-property-decorator';
    import TableColumn from '@/components/Datatables/_partials/TableColumn.vue'

    @Component({
      components: {
        TableColumn
      },
    })
    export default class TableRow extends Vue {
        @Prop() value;
        @Prop() columns;
        @Prop() slide;

        isHovering: boolean = false;

        constructor() {
            super();
        }
    }
</script>

<template>
  <tr
    @mouseover="isHovering = true"
    @mouseout="isHovering = false"
    class="kt-datatable__row"
    :class="{'kt-datatable__row--hover': isHovering}"> <!--kt-datatable__row&#45;&#45;even-->

    <table-column :width="columns[0].width">
      {{slide.id}}
    </table-column>

    <table-column :width="columns[1].width">
      {{slide.title}}
    </table-column>

    <table-column :width="columns[2].width">
      {{slide.subtitle}}
    </table-column>

    <table-column :width="columns[3].width">
      {{slide.description}}
    </table-column>

    <table-column :width="columns[4].width">
      {{slide.type}}
    </table-column>

    <table-column :width="columns[5].width">
      <router-link v-if="$auth.user().permissions_array.includes('user_write')"
                   :to="{ name: 'edit.slide', params: { slideId: slide.id }}"
                   exact="">
        <i aria-hidden="true"
           class="fa fa-pencil-square-o"></i> 
        {{ $t('buttons.edit') }}
      </router-link>
    </table-column>

    <table-column :width="columns[6].width">
      <i v-if="$auth.user().permissions_array.includes('user_write')"
         @click="deleteRow(slide.id)"
         variant="link"
         aria-hidden="true"
         class="las la-trash-alt"></i>
    </table-column>

  </tr>
</template>
