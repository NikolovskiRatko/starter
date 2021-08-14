<template>
    <table class="table is-bordered data-table">
        <thead>
        <tr>
            <th v-for="column in columns" :key="column.name"
                v-if="column.sortable"
                :style="'width:'+column.width+';'">
                {{ $t(column.label) }}
            </th>
            <th v-else
            :style="'width:'+column.width+';'">
                {{ $t(column.label) }}
            </th>
        </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script lang="ts">
    export default {
        props: ['columns', 'sort-key', 'sort-orders']
    }
</script>
