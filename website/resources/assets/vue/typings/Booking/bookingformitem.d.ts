declare interface BookingFormItem {
  user_id: number|null;
  time: any;
  duration: number;
  date: any|null;
  date_ready: boolean;
  services: Array<any>;
  services_ready: boolean;
  sections_visible: object;
  comments: string;
  status: number;
}

declare interface BookingFormServiceItem {
  name: string;
  duration: number;
  price: number;
  has_child: boolean;
  appointment_child_service: object;
}

declare interface BookingFromChildServiceItem {
  name: string;
  duration: number;
  price: number;
}
