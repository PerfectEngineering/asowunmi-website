<?php
// Quick hack around fonts for the section title
// shortcode aso_section_title

function asoSectionTitle($attrs) {
    $a = shortcode_atts( array(
        'top' => '',
        'middle' => '',
        'bottom' => ''
    ), $attrs );

    $html = '<div class="section-title-container alus-section-title default aso-font no-bottom-margin">
            <span class="before-title">'. $a['top'] .'</span>
            <div class="section-title-main">
                <span class="font-900 " style="font-size:24px ">'. $a['middle'] . '</span>
            </div>
            <span class="sub-title-des"> ' . $a['bottom'] . '</span>
        </div>';

    return $html;
}