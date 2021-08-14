export default interface TaxonomiesInterface {
  getHandleTypes(): Array<Taxonomy>;
  getLaminationTypes(): Array<Taxonomy>;
  getPaperTypes(): Array<Taxonomy>;
  getColorTypes(): Array<Taxonomy>;
  getRatios(): Array<any>;
  getCombinations(): Array<any>;
}
