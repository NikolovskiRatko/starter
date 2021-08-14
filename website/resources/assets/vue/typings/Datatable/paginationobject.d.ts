declare interface PaginationObject {
  dataLength?: number | undefined;
  path?: string;
  lastPage?: number;
  currentPage?: number;
  total?: number;
  lastPageUrl?: string;
  nextPageUrl?: string;
  prevPageUrl?: string;
  from?: number;
  to?: number;
}
