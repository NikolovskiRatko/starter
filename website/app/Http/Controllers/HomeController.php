<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('app');
    }


    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        return view('app_admin');
    }

    /**
     * Run an artisan command from url (used for debugging)
     *
     * @return void
     */
    public function runCommand($command)
    {
        Artisan::call($command);
    }

    /**
     * Get initial data for Vue.js application
     */
    public function vue()
    {
        $homeItems = [
            [
                'label' => 'strings.dashboard',
                'name' => 'item_dashboard',
                'link' => 'dashboard',
                'permission' => 'user_view', // Change to dashboard_view
            ],
            [
                'label' => 'general.configurator',
                'name' => 'item_configurator',
                'link' => 'configurator',
                'expanded' => false,
                'permission' => 'user_view',
                'subcategories' => [
                    [
                        'label' => 'products.combinations',
                        'name' => 'item_combinations',
                        'link' => 'combinations',
                        'permission' => 'user_view',
                    ],
//                    [
//                        'label' => 'products.ratios',
//                        'name' => 'item_ratios',
//                        'link' => 'ratios',
//                        'permission' => 'user_view',
//                    ],
                    [
                        'label' => 'products.parameters',
                        'name' => 'item_parameters',
                        'link' => 'parameters',
                        'permission' => 'user_view',
                    ],
                    [
                        'label' => 'products.formats',
                        'name' => 'item_formats',
                        'link' => 'formats',
                        'permission' => 'user_view',
                    ],
                    // TODO remove Controller BLL and vue components for this
//                    [
//                        'label' => 'products.cliches',
//                        'name' => 'item_cliches',
//                        'link' => 'cliches',
//                        'permission' => 'user_view',
//                    ],
                    [
                        'label' => 'products.colors',
                        'name' => 'item_colors',
                        'link' => 'colors',
                        'permission' => 'user_view',
                    ],
                    [
                        'label' => 'products.handles',
                        'name' => 'item_handles',
                        'link' => 'handles',
                        'permission' => 'user_view',
                    ],
                    [
                        'label' => 'products.laminations',
                        'name' => 'item_laminations',
                        'link' => 'laminations',
                        'permission' => 'user_view',
                    ],
                    [
                        'label' => 'products.papers',
                        'name' => 'item_papers',
                        'link' => 'papers',
                        'permission' => 'user_view',
                    ],
                    [
                        'label' => 'products.packageweights',
                        'name' => 'item_packageweights',
                        'link' => 'packageweights',
                        'permission' => 'user_view',
                    ],
                    /*INSERT NEW CONFIGURATOR OPTIONS HERE*/
                ]
            ],
            [
                'label' => 'strings.users.main',
                'name' => 'item_users',
                'link' => 'users',
                'expanded' => false,
                'permission' => 'user_view',
                'subcategories' => [
                    [
                        'label' => 'strings.users.admin',
                        'name' => 'item_users',
                        'link' => 'users',
                        'permission' => 'user_view',
                    ],
                    [
                        'label' => 'strings.users.public',
                        'name' => 'item_users_public',
                        'link' => 'users.public',
                        'permission' => 'user_view',
                    ],
                ]
            ],[
                'label' => 'strings.products.main',
                'name' => 'item_products',
                'link' => 'products',
                'permission' => 'user_view',
            ],[
                'label' => 'Appointments',
                'name' => 'item_appointments',
                'link' => 'appointments',
                'permission' => 'user_view',
            ],[
                'label' => 'strings.orders.main',
                'name' => 'item_orders',
                'link' => 'orders',
                'permission' => 'user_view',
            ],[
                'label' => 'strings.admin_menu.shipping',
                'name' => 'item_shipping',
                'link' => 'edit.shipping',
                'permission' => 'user_view',
            ],[
                'label' => 'strings.homepage.main',
                'name' => 'item_homepage',
                'link' => 'sliders',
                'expanded' => false,
                'permission' => 'user_view',
                'subcategories' => [
                    [
                        'label' => 'strings.homepage.homepage_slider',
                        'name' => 'item_homepage_slider',
                        'link' => 'sliders',
                        'permission' => 'user_view',
                    ],
                ]
            ],
        ];

        $data = [
            'homeItems' => $homeItems,
        ];

        return $data;
    }
}
