<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Autopilot
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Autopilot\V1\Assistant;

use Twilio\Options;
use Twilio\Values;

abstract class StyleSheetOptions
{

    /**
     * @param array $styleSheet The JSON string that describes the style sheet object.
     * @return UpdateStyleSheetOptions Options builder
     */
    public static function update(
        
        array $styleSheet = Values::ARRAY_NONE

    ): UpdateStyleSheetOptions
    {
        return new UpdateStyleSheetOptions(
            $styleSheet
        );
    }

}


class UpdateStyleSheetOptions extends Options
    {
    /**
     * @param array $styleSheet The JSON string that describes the style sheet object.
     */
    public function __construct(
        
        array $styleSheet = Values::ARRAY_NONE

    ) {
        $this->options['styleSheet'] = $styleSheet;
    }

    /**
     * The JSON string that describes the style sheet object.
     *
     * @param array $styleSheet The JSON string that describes the style sheet object.
     * @return $this Fluent Builder
     */
    public function setStyleSheet(array $styleSheet): self
    {
        $this->options['styleSheet'] = $styleSheet;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Autopilot.V1.UpdateStyleSheetOptions ' . $options . ']';
    }
}

