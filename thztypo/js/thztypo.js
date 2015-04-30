/**
 * @package      ThzTypo
 * @copyright    Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author       Themezly.com
 * @version      1.0.0
 * @license      MIT License, https://github.com/Themezly/ThzTypo/blob/master/LICENSE
 * @website      http://www.themezly.com
 */
;
(function($, window, document, undefined) {

   "use strict";

   var pluginName = "ThzTypo",
      defaults = {
         fontselector: "#thz-font-selector",
         fontfamily: "#thz-font-family",
         fontvariant: "#thz-font-variant",
         fontsubset: "#thz-font-subset",
         fontinput: ".thz-font-input",
         fontbox: ".thz-fontbox",
         fontpreview: ".thz-typography-preview",
         fontSize: ".thz-font-size",
         lineHeight: ".thz-font-lineheight",
         letterSpacing: ".thz-letter-spacing",
         fontColor: ".thz-font-color"
      };

   function Plugin(element, options) {
      this.element = element;

      this.settings = $.extend({}, defaults, options);
      this._defaults = defaults;
      this._name = pluginName;
      this.init();
   }

   $.extend(Plugin.prototype, {
      init: function() {

         var self = this;

         this.previewCss = '';

         self.ThzFontChange();
         self.ThzFontChangeFamily();
         self.ThzFontClose();
         self.ThzMetricsChange();

      },

      ThzPreviewAppend: function() {

         var self = this;

		
		if(!$(self.element).find(self.settings.fontinput).length){
			return;
		}
		
		$(self.element).append($(self.settings.fontselector).css('display', 'block'));
         var $current = $(self.element).find(self.settings.fontinput).val().split('|');
         var font_family = $current[0];
         var font_variant = $current[1];
         $(self.element).find(self.settings.fontfamily).val(font_family).trigger('change');
         $(self.element).find(self.settings.fontvariant).val(font_variant).trigger('change');

         if ($current[2] !== undefined) {
            var font_subset = $current[2];
            $(self.element).find(self.settings.fontsubset).val(font_subset).trigger('change');
         }

      },

      ThzMetricsChange: function() {

         var self = this;
         $(self.element).find('input,select').on('change keyup blur click', function(e) {
            self.ThzPreviewAppend();
         });

      },

      ThzChange: function() {

         var self = this;
         $(self.element).find(self.settings.fontselector).trigger('change');
      },

      ThzFontChange: function() {
         var self = this;
         $(self.element).on('change', self.settings.fontselector, function(e) {

            var fontFamily = $(self.settings.fontfamily).val();
            var fontWeight = $(self.settings.fontvariant).val();
            var fontSubset = $(self.settings.fontsubset).val();
            var fontStyle = 'normal';
            var fontSize = $(self.element).find(self.settings.fontSize).val();
            var lineHeight = $(self.element).find(self.settings.lineHeight).val();
            var letterSpacing = $(self.element).find(self.settings.letterSpacing).val();

            if (self.ThzIsNumber(letterSpacing)) {
               letterSpacing = letterSpacing + "px"
            }

            var fontColor = $(self.element).find(self.settings.fontColor).val();
            var font_type = $(self.settings.fontfamily).find(':selected').attr('data-type');

            var font_family_input = fontFamily + '|';
            var font_variant_input = fontWeight;
            var font_subset_input = '';

            if (fontSubset) {
               font_subset_input = '|' + fontSubset;
            }

            var fontbox_value = font_family_input + font_variant_input + font_subset_input
            $(this).parent().find(self.settings.fontinput).val(fontbox_value);

            if (fontWeight.indexOf('italic') > -1) {

               fontWeight = fontWeight.replace('italic', '');
               fontStyle = 'italic';
            }

            if (fontWeight === 'regular') {
               fontWeight = 400;
            }

            if (font_type === 'google') {
               var google_font_link = 'http://fonts.googleapis.com/css?family=' + fontFamily + ':' + fontWeight + '&subset=' + fontSubset;
               $('.thz_google_font').remove();
               $('link:last').after('<link href="' + google_font_link + '" rel="stylesheet" class="thz_google_font" type="text/css">');
               fontFamily = fontFamily + ',sans-serif';
            }

            self.previewCss = {
               'font-family': fontFamily,
               'font-size': fontSize + "px",
               'font-style': fontStyle,
               'font-weight': fontWeight,
               'line-height': lineHeight + "em",
               'letter-spacing': letterSpacing,
               'color': fontColor
            };

            self.ThzPreviewCss();
            e.stopImmediatePropagation();
         });
      },

      ThzFontClose: function() {
         var self = this;
         $(document).on('click', function(event) {
            event.stopImmediatePropagation();
            if ($(event.target).parents(self.settings.fontbox).length == 0) {
               $(self.settings.fontselector).css('display', 'none');
            }
         });

      },

      ThzFontChangeFamily: function() {

         var self = this;

         $(self.element).on('change', self.settings.fontfamily, function(e) {

            $(self.settings.fontsubset).parent().css('display', 'none');
            var $font_subsets = $(this).find(':selected').attr('data-subsets');
            var $font_variants = $(this).find(':selected').attr('data-variants');

            if ($font_subsets) {
               self.ThzBuildSelectList($font_subsets, self.settings.fontsubset);
               $(self.settings.fontsubset).parent().css('display', 'block');
            } else {

               $(self.settings.fontsubset).html('');
            }

            if ($font_variants !== '') {
               self.ThzBuildSelectList($font_variants, self.settings.fontvariant);
            }

         });

      },

      ThzBuildSelectList: function($collection, $container) {

         var self = this;
         var $options_array = $collection.split(',');
         var $container_html = '';

         $.each($options_array, function(index, value) {

            $container_html += '<option value="' + value + '">' + self.ThzCapitalize(value) + '</option>';

         });

         return $($container).html($container_html);

      },

      ThzCapitalize: function(string) {
         var self = this;
         return string.charAt(0).toUpperCase() + string.slice(1);

      },

      ThzPreviewCss: function() {

         var self = this;

         $(self.settings.fontpreview).css(self.previewCss);
         self.ThzPreviewContrast(self.settings.fontpreview);

      },

      ThzIsNumber: function(n) {
         return !isNaN(parseFloat(n)) && isFinite(n);
      },

      ThzPreviewContrast: function(container) {

         var self = this;

         var bg = $(container).css('color');
         //use first opaque parent bg if element is transparent
         if (bg == 'transparent' || bg == 'rgba(0, 0, 0, 0)') {
            $(container).parents().each(function() {
               bg = $(container).css('color')
               if (bg != 'transparent' && bg != 'rgba(0, 0, 0, 0)') return false;
            });
            //exit if all parents are transparent
            if (bg == 'transparent' || bg == 'rgba(0, 0, 0, 0)') return false;
         }
         //get r,g,b and decide
         var rgb = bg.replace(/^(rgb|rgba)\(/, '').replace(/\)$/, '').replace(/\s/g, '').split(',');
         var yiq = ((rgb[0] * 299) + (rgb[1] * 587) + (rgb[2] * 114)) / 1000;
         if (yiq >= 150) {

            $(container).css('background-color', '#000000');

         } else {

            $(container).css('background-color', '#ffffff');
         }

      }

   });

   $.fn[pluginName] = function(options) {
      return this.each(function() {
         if (!$.data(this, 'plugin_' + pluginName)) {
            $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
         } else if (Plugin.prototype[options]) {
            $.data(this, 'plugin_' + pluginName)[options]();
         }
      });
   }

})(jQuery, window, document);