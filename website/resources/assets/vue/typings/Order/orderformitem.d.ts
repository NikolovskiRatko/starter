declare interface OrderFormItem {
  status?: string;
  offer_id?: string;
  shipping_detail_id?: number|null;
  billing_detail_id?: number|null;
  shipping_details?: DetailsFormItem;
  billing_details?: DetailsFormItem;
  offer?: OfferFormItem;
}
