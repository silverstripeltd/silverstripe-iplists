<?php

namespace Madmatt\IPLists\Admin;

use Madmatt\IPLists\Model\IP;
use Madmatt\IPLists\Model\IPList;
use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Forms\LiteralField;

class IPListAdmin extends ModelAdmin
{
    private static string $menu_title = 'IP Lists';

    private static string $url_segment = 'ip-lists';

    private static string $menu_icon_class = 'font-icon-lock';

    private static array $managed_models = [
        IPList::class,
        IP::class
    ];

    /**
     * @inheritDoc
     */
    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        if ($this->modelClass === IP::class) {
            $msg = '<div class="alert alert-warning"><strong>Caution:</strong> Removing IPs from this list will remove'
                . ' them from all IP lists and the database.</div>';
            $form->Fields()->insertBefore($this->sanitiseClassName(IP::class), LiteralField::create('IPHelper', $msg));
        }

        return $form;
    }
}
