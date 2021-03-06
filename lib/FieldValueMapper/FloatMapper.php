<?php

/**
 * This file is part of the eZ Platform Solr Search Engine package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace EzSystems\EzPlatformSolrSearchEngine\FieldValueMapper;

use EzSystems\EzPlatformSolrSearchEngine\FieldValueMapper;
use eZ\Publish\SPI\Search\FieldType\FloatField;
use eZ\Publish\SPI\Search\Field;

/**
 * Maps raw document field values to something Solr can index.
 */
class FloatMapper extends FieldValueMapper
{
    /**
     * Check if field can be mapped.
     *
     * @param Field $field
     *
     * @return bool
     */
    public function canMap(Field $field)
    {
        return $field->type instanceof FloatField;
    }

    /**
     * Map field value to a proper Solr representation.
     *
     * @param Field $field
     *
     * @return mixed
     */
    public function map(Field $field)
    {
        return $this->fixupFloat($field->value);
    }

    /**
     * Convert to a proper Solr representation.
     *
     * @param mixed $value
     *
     * @return string
     */
    protected function fixupFloat($value)
    {
        // This will force the '.' as decimal separator and not depend on the locale
        return sprintf('%F', (float)$value);
    }
}
