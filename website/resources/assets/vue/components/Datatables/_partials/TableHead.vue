<script lang="ts">
  import {Component, Watch, Prop, Vue, Emit} from 'vue-property-decorator';

    @Component
    export default class TableHeadColumn extends Vue {
        @Prop() columns;
        @Prop() sortKey;
        @Prop() tableData;

        constructor() {
            super();
        }

        @Emit('trigger-sort')
        triggerSort(key,name): void {}
    }
</script>

<template>
  <thead class="kt-datatable__head">
    <tr class="kt-datatable__row">
      <th v-for="column in columns" :key="column.name"
          v-if="column.sortable && !tableData.noRecords"
          :title="$t(column.label)"
          class="kt-datatable__cell"
          :class="({
            'kt-datatable__cell--sort' : column.sortable,
          })"
          :style="'width:'+column.width+';'">
          <span @click="triggerSort(column.id,column.name)">
            {{ $t(column.label) }}
            <i v-show="column.sortable && column.name === sortKey && tableData.dir === 'asc'"
               class="fa fa-arrow-down"></i>
            <i v-show="column.sortable && column.name === sortKey && tableData.dir === 'desc'"
               class="fa fa-arrow-up"></i>
          </span>
      </th>
      <th v-else
          class="kt-datatable__cell"
          :style="'width:'+column.width+';'"
          :title="$t(column.label)">
        <span>
          {{ $t(column.label) }}
        </span>
      </th>
    </tr>
  </thead>
</template>
