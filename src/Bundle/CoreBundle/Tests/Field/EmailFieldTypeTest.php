<?php

namespace UniteCMS\CoreBundle\Tests\Field;

use UniteCMS\CoreBundle\Field\FieldableFieldSettings;

class EmailFieldTypeTest extends FieldTypeTestCase
{
    public function testEmailTypeFieldTypeWithEmptySettings()
    {
        // Email Type Field with empty settings should be valid.
        $ctField = $this->createContentTypeField('email');
        $this->assertCount(0, static::$container->get('validator')->validate($ctField));
    }

    public function testEmailTypeFieldTypeWithInvalidSettings()
    {
        // Email Type Field with invalid settings should not be valid.
        $ctField = $this->createContentTypeField('email');
        $ctField->setSettings(new FieldableFieldSettings(['foo' => 'baa']));

        $errors = static::$container->get('validator')->validate($ctField);
        $this->assertCount(1, $errors);
        $this->assertEquals('additional_data', $errors->get(0)->getMessageTemplate());
    }
}
