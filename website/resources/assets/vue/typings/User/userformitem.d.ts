declare interface UserFormItem {
  id?: number;
  username?: string;
  email?: string;
  first_name?: string;
  last_name?: string;
  roles?: any;
  roles_array?: any;
  is_disabled?: number;
  country_id?: number|null;
  uploaded_file: File|null;
  password?: string;
  password_confirmation?: string;
  json_data?: string;
  company: string;
  phone: string;
  source: string;
  contact_email: string;
  shipping_details?: DetailsFormItem;
  billing_details?: DetailsFormItem;
}
