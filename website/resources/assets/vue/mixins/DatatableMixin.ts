import { Vue, Component, Prop } from 'vue-property-decorator';
import { namespace } from 'vuex-class';
import dialog from '@/utils/dialog';

const { State } = namespace('Root');

@Component
export class DatatableMixin extends Vue {
  @Prop() columns;
  @State('homePath') homePath;

  endpoint: string = 'no_endpoint';
  datatable_data: Object[] = [];
  loading: boolean;
  tableData: TableData;
  pagination: PaginationObject;
  sortOrders: Object;
  sortKey: string;
  success: any = 0;
  length: number = 10;

  constructor() {
    super();
    this.loading = true;
    this.tableData = {
      draw: 1,
      length: 10,
      search: '',
      column: 0,
      dir: 'desc',
      error: false,
      errorMessage: '',
      noRecords: false,
    };
    this.pagination = {
      lastPage: 0,
      currentPage: 0,
      total: 0,
      lastPageUrl: '',
      nextPageUrl: '',
      prevPageUrl: '',
      dataLength: 10,
      from: 0,
      to: 0
    };
    this.sortOrders = {};
    this.sortKey = 'id';
  }

  getIndex(array: any[], key: string, value: string): number {
    return array.findIndex(i => i[key] == value);
  }

  // This is from UsersDatatable and was not used only defined
  get actualUser() {
    return this.$auth.user();
  }

  setDatatableError(message='') {
    this.tableData.error = true;
    this.tableData.errorMessage = message;
  }

  async getData(url: string = ''): Promise<void> {
    this.loading = true;

    let response;

    this.tableData.draw++;
    if (url === '') {
      url = this.endpoint+'/draw';
    }
    try {
      response = await this.axios.post(url, this.tableData);
    } catch (error) {
      if (error.response) {
        this.setDatatableError(error.response.data.message);
      }
    }

    this.loading = false;

    const { status, data } = response;
    switch (status) {
      case 200: {
        if (data.errors) {
          this.setDatatableError();
          return;
        }
        if (this.tableData.draw == data.draw) {
          this.datatable_data = data.data.data;

          this.configPagination(data.data);

          if (data.data.data.length > 0) {
            this.tableData.noRecords = false;
          } else {
            this.tableData.noRecords = true;
          }
        }
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

  configPagination(data): void {
    this.pagination.lastPage = data.last_page;
    this.pagination.currentPage = data.current_page;
    this.pagination.total = data.total;
    this.pagination.lastPageUrl = data.last_page_url;
    this.pagination.nextPageUrl = data.next_page_url;
    this.pagination.prevPageUrl = data.prev_page_url;
    this.pagination.path = data.path+'?page=';
    this.pagination.from = data.from;
    this.pagination.to = data.to;
    this.pagination.dataLength = Number(data.per_page);
  }

  async sortBy(key: string): Promise<void>  {
    this.sortKey = key;
    this.sortOrders[key] = this.sortOrders[key] * -1;
    this.tableData.column = this.getIndex(this.columns, 'name', key);
    this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
    this.getData();
  }

  async changeLength(length: number): Promise<void>  {
    this.tableData.length = length;
    this.getData();
  }

  async deleteRow(index: number): Promise<void> {
    if (!await dialog('general.confirm.delete', true)) {
      return;
    }
    this.axios.get(this.endpoint + '/' + index + '/delete')
      .then((response) => {
        dialog('strings.front.deleted_successfully', false);
        this.getData();
      })
      .catch((error) => {
        dialog(error.response.data.message, false);
      });
  }

  triggerSort(key,name) {

    if (this.sortKey != name) {
      this.tableData.dir = 'desc'
    } else if (this.tableData.dir === 'asc') {
      this.tableData.dir = 'desc'
    } else {
      this.tableData.dir = 'asc'
    }

    this.tableData.column = key;
    this.sortKey = name;
    this.getData();
  }

  // This is unused left just in case it is needed again
  // async changePage(page: number): Promise<void>  {
  //   let url = this.endpoint;
  //   url = url+'/draw';
  //   url = url+'?page='+ String(page);
  //   this.getData(url);
  // }

}
