import { Vue, Component, Prop } from 'vue-property-decorator';
import { namespace } from 'vuex-class';
import dialog from '@/utils/dialog';
import Form from '../../../../node_modules/form-backend-validation';
import { Container, Draggable } from "vue-smooth-dnd";

const { State } = namespace('Root');

@Component({
  components: {
    Container,
    Draggable
  }
})
export class DragableDatatableMixin extends Vue {
  @Prop() columns;
  @State('homePath') homePath;

  endpoint: string = 'no_endpoint';
  datatable_data: Object[] = [];
  loading: boolean;
  form: Form;
  tableData: TableData;

  constructor() {
    super();
    this.loading = true;
    this.form = new Form();
    this.tableData = {
      error: false,
      errorMessage: '',
      noRecords: false,
    };
  }

  getIndex(array: any[], key: string, value: string): number {
    return array.findIndex(i => i[key] == value);
  }

  async getData(url: string = ''): Promise<void> {
    let response;
    if (url === '') {
      url = this.endpoint+'/getall';
    }
    try {
      response = await this.axios.get(url);
    } catch (e) {
      this.setDatatableError();
    }

    this.loading = false;
    const { status, data } = response;
    switch (status) {
      case 200: {
        if (data.errors) {
          this.setDatatableError();
          return;
        }
        this.datatable_data = data;

        if (data.length > 0) {
          this.tableData.noRecords = false;
        } else {
          this.tableData.noRecords = true;
        }

        return data;
        break;
      }
      case 401: {
        this.$router.push(this.homePath);
        return;
      }
      default: {
        this.setDatatableError();
        return;
      }
    }
  }

  async deleteRow(index: number): Promise<void> {
    if (!await dialog('general.confirm.delete', true)) {
      return;
    }
    this.axios.get(this.endpoint + '/delete/' + index)
      .then((response) => {
        dialog('strings.front.deleted_successfully', false);
        this.getData();
      })
      .catch((error) => {
        dialog(error.response.data.message, false);
      });
  }

  async restoreRow(index: number): Promise<void> {
    if (!await dialog('general.confirm.restore', true)) {
      return;
    }
    this.axios.get(this.endpoint + '/restore/' + index)
      .then(response => {
        dialog('general.restored_successfully', false);
        this.getData();
      })
      .catch(error => {
        dialog(error.response.data.message, false);
      });
  }

  applyDrag(arr, dragResult) {
    const { removedIndex, addedIndex, payload } = dragResult;
    if (removedIndex === null && addedIndex === null) return arr;

    const result = [...arr];
    let itemToAdd = payload;

    if (removedIndex !== null) {
      itemToAdd = result.splice(removedIndex, 1)[0]
    }

    if (addedIndex !== null) {
      result.splice(addedIndex, 0, itemToAdd)
    }

    return result
  };

  async addNew(): Promise<any> {
    this.loading = true;
    return this.form.post(this.endpoint + '/new')
      .then((response) => {
        this.getData();
        return response.data;
      })
      .catch((error) => {
        this.loading = false;
        return error.response.data;
      });
  }

  async editItem(id: number): Promise<any> {
    this.loading = true;
    return this.form.post(this.endpoint + '/edit/' + id)
      .then((response) => {
        this.getData();
      })
      .catch((error) => {
        this.loading = false;
        return error.response.data;
      });
  }

  onDrop(dropResult) {
    this.loading = true;
    this.datatable_data = this.applyDrag(this.datatable_data, dropResult);
    this.orderDatatable(this.datatable_data);
  }

  async orderDatatable(new_state_datatable): Promise<void> {
    this.axios.post(this.endpoint + '/order', new_state_datatable)
      .then((response) => {
        this.getData();
      })
      .catch((error) => {
        dialog(error.response.data.message, false);
      });
  }

  setDatatableError(message='') {
    this.tableData.error = true;
    this.tableData.errorMessage = message;
  }
}
