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
        @Prop() user;

        isHovering: boolean = false;
        order_statuses: Array<any>;

        constructor() {
            super();
            this.order_statuses = [
              {'id': 0, 'name': 'Approved'},
              {'id': 1, 'name': 'Declined'},
              {'id': 2, 'name': 'Shipped'},
              {'id': 3, 'name': 'Delivered'}
            ];
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
      {{user.first_name}}
    </table-column>

    <table-column :width="columns[1].width">
      {{user.last_name}}
    </table-column>

    <table-column :width="columns[2].width">
      {{user.email}}
    </table-column>

    <table-column :width="columns[3].width">
      {{user.roles}}
    </table-column>

    <table-column :width="columns[4].width">

      <template v-if="user.is_disabled">{{ $t('users.status.disabled') }}</template>
      <template v-else>{{ $t('users.status.enabled') }}</template>

    </table-column>


    <table-column :width="columns[5].width">
      <router-link v-if="$auth.user().permissions_array.includes('user_write')"
                   :to="{ name: 'edit.user', params: { userId: user.id }}"
                   exact="">
        <i aria-hidden="true"
           class="fa fa-pencil-square-o"></i> 
        {{ $t('buttons.edit') }}
      </router-link>
    </table-column>

    <table-column :width="columns[6].width">
      <i v-if="$auth.user().permissions_array.includes('user_write')"
         @click="deleteUser(user, user.id)"
         variant="link"
         aria-hidden="true"
         class="fa fa-trash-o"></i>
    </table-column>

  </tr>
</template>
