<template>
    <div id="structure-view">
        <ActionInfo class="mb-2"
                    :title="`Table Structure for \`${$root.table.table}\``"
                    description="Check your table structure and setup"></ActionInfo>
        <div class="column-overview">
            <div class="columns-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th class="table-th">
                            <p @click.prevent>
                                {{ trans('table_empty.col_key') }}
                            </p>
                        </th>
                        <th class="table-th">
                            <p @click.prevent>
                                {{ trans('table_empty.col_field') }}
                            </p>
                        </th>
                        <th class="table-th">
                            <p @click.prevent>
                                {{ trans('table_empty.col_def') }}
                            </p>
                        </th>
                        <th class="table-th">
                            <p @click.prevent>
                                {{ trans('table_empty.col_type') }}
                            </p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-row" v-for="struct in structure">
                        <td class="ellipsis table-td" :class="struct.Key ? '' : 'italic'">
                            {{ struct.Key ? struct.Key : trans('table_empty.not_set') }}
                        </td>
                        <td class="ellipsis table-td" :class="struct.Field ? '' : 'italic'">
                            {{ struct.Field ? struct.Field : trans('table_empty.not_set') }}
                        </td>
                        <td class="ellipsis table-td" :class="struct.Default ? '' : 'italic'">
                            {{ struct.Default ? struct.Default : trans('table_empty.not_set') }}
                        </td>
                        <td class="ellipsis table-td" :class="struct.Type  ? '' : 'italic'">
                            {{ struct.Type ? struct.Type : trans('table_empty.not_set') }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import ActionInfo from './ActionInfo';

export default {
    name      : 'ViewStructure',
    components: { ActionInfo },
    props     : ['structure'],
};
</script>

<style scoped lang="scss">
#structure-view {
  h1 {
    @apply mt-4;
    @apply mb-2;
    color: var(--header-text-color);
    @apply w-full;
    @apply text-center;
  }

  .column-overview {
    @apply w-full;
    @apply flex;
    @apply flex-col;
    @apply justify-center;

    h2 {
      @apply text-black;
      @apply font-bold;
      @apply bg-gray-400;
      @apply py-2;
      @apply text-center;
      @apply mb-2;
    }

    .columns-wrapper {
      @apply flex;
      @apply flex-col;
      transform: rotateX(180deg);

      table {
        @apply w-full;
        @apply rounded;
        @apply bg-gray-200;

        thead {
          @apply border-b;
          border-color: var(--border-color);
          @apply rounded;
          @apply bg-tableColumn;

          .table-th {
            @apply border;
            border-color: var(--border-color);
            @apply p-1;
            @apply whitespace-nowrap;
            @apply text-sm;
            @apply mx-10;
            @apply text-center;

            p {
              @apply text-xs;
              @apply font-light;
              @apply text-secondary;
              @apply -mt-1;
            }
          }
        }

        .table-td {
          @apply px-4;
          @apply text-sm;
          @apply text-center;
          @apply text-secondary;
        }
      }
    }

    .buttons-wrapper {
      @apply flex;
      @apply justify-center;

      button {
        @apply bg-indigo-500;
        @apply w-40;
        @apply mt-20;
        @apply text-white;
        @apply font-semibold;
        @apply py-1;
        @apply px-3;
        @apply rounded;
        @apply shadow;

        &:hover {
          @apply bg-indigo-400;
        }

        &:active {
          @apply bg-indigo-300;
        }
      }
    }
  }
}
</style>
