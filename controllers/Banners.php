<?php namespace SamPoyigi\FrontEnd\Controllers;

use AdminMenu;

class Banners extends \Admin\Classes\AdminController
{
    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController',
    ];

    public $listConfig = [
        'list' => [
            'model'        => 'SamPoyigi\FrontEnd\Models\Banners',
            'title'        => 'lang:admin::banners.text_title',
            'emptyMessage' => 'lang:admin::banners.text_empty',
            'defaultSort'  => ['order_id', 'DESC'],
            'configFile'   => 'banners',
        ],
    ];

    public $formConfig = [
        'name'       => 'lang:admin::banners.text_form_name',
        'model'      => 'SamPoyigi\FrontEnd\Models\Banners',
        'create'     => [
            'title'         => 'lang:admin::lang.form.create_title',
            'redirect'      => 'banners/edit/{banner_id}',
            'redirectClose' => 'banners',
        ],
        'edit'       => [
            'title'         => 'lang:admin::lang.form.edit_title',
            'redirect'      => 'banners/edit/{banner_id}',
            'redirectClose' => 'banners',
        ],
        'preview'    => [
            'title'    => 'lang:admin::lang.form.preview_title',
            'redirect' => 'banners',
        ],
        'delete'     => [
            'redirect' => 'banners',
        ],
        'configFile' => 'banners',
    ];

    protected $requiredPermissions = 'Admin.Banners';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('banners', 'marketing');
    }

    public function formValidate($model, $form)
    {
        $namedRules = [
            ['name', 'lang:admin::banners.label_name', 'required|min:2|max:255'],
            ['type', 'lang:admin::banners.label_type', 'required|alpha|max:8'],
            ['click_url', 'lang:admin::banners.label_click_url', 'required|min:2|max:255'],
            ['custom_code', 'lang:admin::banners.label_custom_code', 'required_if:type,custom'],
            ['alt_text', 'lang:admin::banners.label_alt_text', 'required_if:type,image|min:2|max:255'],
            ['image_code', 'lang:admin::banners.label_image', 'required_if:type,image'],
            ['language_id', 'lang:admin::banners.label_language', 'required|integer'],
            ['status', 'lang:admin::lang.label_status', 'required|integer'],
        ];

        return $this->validatePasses(post($form->arrayName), $namedRules);
    }
}
