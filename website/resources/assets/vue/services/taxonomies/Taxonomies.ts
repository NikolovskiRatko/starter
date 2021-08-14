import { injectable } from 'inversify';
import { TaxonomiesInterface } from '../taxonomies';
import axios, { AxiosResponse } from 'axios';

@injectable()
export default class Taxonomies implements TaxonomiesInterface {
  constructor() {
  }

  async getHandleTypes(): Promise<AxiosResponse> {
    return await axios.get('/guest/common/get-handle-types');
  }

  async getLaminationTypes(): Promise<AxiosResponse> {
    return await axios.get('/guest/common/get-lamination-types');
  }

  async getPaperTypes(): Promise<AxiosResponse> {
    return await axios.get('/guest/common/get-paper-types');
  }

  async getColorTypes(): Promise<AxiosResponse> {
    return await axios.get('/guest/common/get-color-types');
  }

  async getRatios(): Promise<AxiosResponse> {
    return await axios.get('/guest/common/get-ratios');
  }

  async getCombinations(): Promise<AxiosResponse> {
    return await axios.get('/guest/common/get-combinations');
  }

  async getUser(): Promise<AxiosResponse> {
    return await axios.get('/auth/user');
  }

}
