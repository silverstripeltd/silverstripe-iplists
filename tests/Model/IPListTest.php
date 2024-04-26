<?php

namespace Madmatt\IPLists\Tests\Model;

use Madmatt\IPLists\Model\IPList;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\LiteralField;

class IPListTest extends SapphireTest
{
    protected $usesDatabase = true;

    public function testGetCMSFieldsIPHelpMessage(): void
    {
        $list = new IPList([
            'Title' => 'Title',
            'ProtectedRoutes' => 'routes'
        ]);
        $fields = $list->getCMSFields();

        // IPHelpMessage should only appear if the list hasn't been saved yet, and should be replaced by the GridField
        $this->assertInstanceOf(LiteralField::class, $fields->fieldByName('IPHelpMessage'));
        $this->assertFalse($fields->hasField('IPs'));

        $list->write();
        $fields = $list->getCMSFields();
        $this->assertFalse($fields->hasField('IPHelpMessage'));
        $this->assertInstanceOf(GridField::class, $fields->dataFieldByName('IPs'));
    }
}
