<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator:taxonomy {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Boilerplate Code for the back-end implementation of a draggable ordering datatable CRUD for a taxonomy type entity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->controller($name);
        $this->bll($name);
        $this->bllInterface($name);
        // TODO same functionality from service provider needs to be copied to HomeController and vue router
        $this->serviceProvider($name);
        $this->homeController($name);
        $this->vueRoutes($name);
        $this->taxonomiesDAL($name);

        // TODO: uncomment when done using for current project
//        $this->model($name);
//        $this->schema($name);
        $this->newRequest($name);
        $this->editRequest($name);
        $this->controller($name);

        $this->view($name);
        $this->datatable($name);
        $this->typing($name);

        File::append(base_path('routes/Common/api.php'),
"
Route::group([
    'middleware' => ['api','jwt.renew'],
    'prefix' => 'common',
], function () {
    Route::get('".strtolower(str_plural($name))."/getall', 'Controllers\\".$name."Controller@get".str_plural($name)."Admin');
    Route::post('".strtolower(str_plural($name))."/order', 'Controllers\\".$name."Controller@order".str_plural($name)."');
    Route::post('".strtolower(str_plural($name))."/new', 'Controllers\\".$name."Controller@new".$name."');
    Route::get('".strtolower(str_plural($name))."/delete/{id}', 'Controllers\\".$name."Controller@delete".$name."');
    Route::get('".strtolower(str_plural($name))."/restore/{id}', 'Controllers\\".$name."Controller@restore".$name."');
    Route::post('".strtolower(str_plural($name))."/edit/{id}', 'Controllers\\".$name."Controller@edit".$name."');
});"
        );
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/Taxonomy/$type.stub"));
    }

    protected function controller($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                str_plural($name),
                strtolower(str_plural($name)),
                strtolower($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("Applications/Common/Controllers/{$name}Controller.php"), $template);
    }

    protected function bll($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                str_plural($name),
                strtolower($name)
            ],
            $this->getStub('BLL')
        );

        file_put_contents(app_path("Applications/Common/BLL/{$name}BLL.php"), $template);
    }

    protected function bllInterface($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}'
            ],
            [
                $name,
                str_plural($name)
            ],
            $this->getStub('BLLInterface')
        );

        file_put_contents(app_path("Applications/Common/BLL/{$name}BLLInterface.php"), $template);
    }

    protected function serviceProvider($name)
    {
        $file = "app/Applications/Common/Providers/CommonServiceProvider.php";
        $oldContents = File::get($file);
        $file_parts = preg_split('/\/\*INSERT NEW IMPORTS HERE\*\//', $oldContents);
        $result = implode("use App\\Applications\\Common\\BLL\\".$name."BLL;\nuse App\\Applications\\Common\\BLL\\".$name."BLLInterface;\n/*INSERT NEW IMPORTS HERE*/", $file_parts);

        $file_parts = preg_split('/\/\*INSERT NEW BINDINGS HERE\*\//', $result);
        $result = implode("\$this->app->bind(".$name."BLLInterface::class, ".$name."BLL::class);\n\t\t/*INSERT NEW BINDINGS HERE*/", $file_parts);
        File::replace(base_path($file),$result);
    }

    protected function homeController($name)
    {
        $file = "app/Http/Controllers/HomeController.php";
        $oldContents = File::get($file);
        $file_parts = preg_split('/\/\*INSERT NEW CONFIGURATOR OPTIONS HERE\*\//', $oldContents);
        $result = implode("[
                        'label' => 'products.".str_plural(strtolower($name))."',
                        'name' => 'item_".str_plural(strtolower($name))."',
                        'link' => '".str_plural(strtolower($name))."',
                        'permission' => 'user_view',
                    ],
                    /*INSERT NEW CONFIGURATOR OPTIONS HERE*/", $file_parts);
        File::replace(base_path($file),$result);
    }

    protected function vueRoutes($name)
    {
        $file = "resources/assets/vue/router/admin.ts";
        $oldContents = File::get($file);

        $file_parts = preg_split('/\/\*INSERT NEW IMPORTS HERE\*\//', $oldContents);
        $result = implode("const ".$name." = () =>  import(/* webpackChunkName: \"".str_plural($name)."CRUD\" */ '../views/admin/Taxonomies/".$name.".vue');\n/*INSERT NEW IMPORTS HERE*/", $file_parts);

        $file_parts = preg_split('/\/\*INSERT NEW CONFIGURATOR OPTIONS HERE\*\//', $result);
        $result = implode("{
        path: '".str_plural(strtolower($name))."',
        name: '".str_plural(strtolower($name))."',
        component: ".$name.",
        meta: {
          title: Vue.i18n.translate('products.".str_plural(strtolower($name))."', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/'
          }
        }
      },
      /*INSERT NEW CONFIGURATOR OPTIONS HERE*/", $file_parts);
        File::replace(base_path($file),$result);
    }

    protected function taxonomiesDAL($name)
    {
        $file = "app/Applications/Common/DAL/TaxonomiesDAL.php";
        $oldContents = File::get($file);

        $file_parts = preg_split('/\/\*INSERT NEW IMPORTS HERE\*\//', $oldContents);
        $result = implode("use App\Applications\Common\Model\\".$name.";\n/*INSERT NEW IMPORTS HERE*/", $file_parts);

        $file_parts = preg_split('/\/\*INJECT DEPENDENCY HERE\*\//', $result);
        $result = implode(",\n\t\t".$name." $".strtolower($name)."/*INJECT DEPENDENCY HERE*/", $file_parts);

        $file_parts = preg_split('/\/\*SET DEPENDENCY HERE\*\//', $result);
        $result = implode("\$this->".strtolower($name)." = $".strtolower($name).";\n\t\t/*SET DEPENDENCY HERE*/", $file_parts);

        $file_parts = preg_split('/\/\*INSERT NEW CONFIGURATOR OPTIONS HERE\*\//', $result);
        $result = implode("
    public function getAll".str_plural($name)."(){
        return \$this->".strtolower($name)."->withTrashed()->orderBy('order')->get();
    }

    /*INSERT NEW CONFIGURATOR OPTIONS HERE*/", $file_parts);
        File::replace(base_path($file),$result);
    }

    protected function newRequest($name)
    {
        $template = str_replace(
            [
                '{{modelName}}'
            ],
            [
                $name
            ],
            $this->getStub('NewRequest')
        );

        file_put_contents(app_path("Applications/Common/Requests/New{$name}Request.php"), $template);
    }

    protected function editRequest($name)
    {
        $template = str_replace(
            [
                '{{modelName}}'
            ],
            [
                $name
            ],
            $this->getStub('EditRequest')
        );

        file_put_contents(app_path("Applications/Common/Requests/Edit{$name}Request.php"), $template);
    }

    protected function model($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}'
            ],
            [
                $name,
                strtolower(str_plural($name)),
            ],
            $this->getStub('Model')
        );

        file_put_contents(app_path("Applications/Common/Model/{$name}.php"), $template);
    }

    protected function schema($name)
    {
        $template = str_replace(
            [
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}'
            ],
            [
                str_plural($name),
                strtolower(str_plural($name)),
            ],
            $this->getStub('Schema')
        );

        file_put_contents(base_path("database/migrations/".date('Y_m_d_His')."_create_".strtolower(str_plural($name))."_table.php"), $template);
    }

    protected function view($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}'
            ],
            [
                $name,
                str_plural($name),
                strtolower(str_plural($name))
            ],
            $this->getStub('View')
        );

        file_put_contents(base_path("resources/assets/vue/views/admin/Taxonomies/".$name.".vue"), $template);
    }

    protected function datatable($name)
    {
        $template = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                str_plural($name),
                strtolower(str_plural($name)),
                strtolower($name)
            ],
            $this->getStub('Datatable')
        );

        file_put_contents(base_path("resources/assets/vue/features/Admin/TaxonomiesCrud/_components/".str_plural($name)."Datatable.vue"), $template);
    }

    protected function typing($name)
    {
        $template = str_replace(
            [
                '{{modelName}}'
            ],
            [
                $name
            ],
            $this->getStub('Typing')
        );

        file_put_contents(base_path("resources/assets/vue/typings/Taxonomies/".strtolower($name)."tablerow.d.ts"), $template);
    }
}
