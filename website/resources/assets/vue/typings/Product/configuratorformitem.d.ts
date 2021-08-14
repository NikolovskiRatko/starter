declare interface ConfiguratorFormItem {
  product?: {
    height?: number|null;
    width?: number|null;
    length?: number|null;
    handle_id?: number;
    handle_color_id?: number|null;
    lamination_id?: number|null;
    paper_id?: number;
    outside_colors?: any;
    inside_colors?: any;
    outside_spot_colors?: string;
    inside_spot_colors?: string;
    bottom?: string;
    printed_bottom?: string;
    front_back?: string;
    spot_uv?: string;
    hot_foil?: boolean;
    embossing?: boolean;
    hot_foil_cliches?: any;
    embossing_cliches?: any;
    hf_cliche: any;
    em_cliche: any;
    quantity: number;
    max_package_weight: number;
    comment: string;
  }
}
