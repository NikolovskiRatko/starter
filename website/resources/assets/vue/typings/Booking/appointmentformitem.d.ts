declare interface AppointmentFormItem {
  id?: number|null;
  start?: Date|string;
  end?: Date|string;
  date?: Date|string;
  duration?: number;
  user_id?: number|null;
  time?: any;
  services: Array<any>;
  status: number;
}
