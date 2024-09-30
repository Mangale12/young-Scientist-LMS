<div class="col-sm-6">
    डाटा <strong>{{getUnicodeNumber($data['rows']->firstItem()) }}</strong> देखि <strong>{{getUnicodeNumber($data['rows']->lastItem()) }} </strong> को <strong> {{getUnicodeNumber($data['rows']->total())}}</strong> प्रविष्टिहरू
    <span> | पृष्ठ लोडहुन लाग्ने समय {{ getUnicodeNumber(round((microtime(true) - LARAVEL_START),2) ) }} सेकेन्ड </span>
</div>