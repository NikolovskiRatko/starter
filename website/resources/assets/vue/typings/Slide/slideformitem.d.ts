declare interface SlideFormItem {
  id?: number;
  title?: string;
  subtitle?: string;
  description?: string;
  image?: string;
  learn_more_text?: string;
  learn_more_link_custom?: boolean;
  learn_more_link?: string;
  learn_more_color?: string;
  get_started_text?: string;
  get_started_link_custom?: boolean;
  get_started_link?: string;
  get_started_color?: string;
  uploaded_file: File|null;
}
