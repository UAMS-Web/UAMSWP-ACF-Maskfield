(function($){

    if (typeof acf.add_action === 'undefined') {
        return
      }

    /**
     * Ready Append
     *
     * These are 2 events which are fired during the page load.
     * ready = on page load similar to $(document).ready()
     * append = on new DOM elements appended via repeater field
     *
     * @param	 element jQuery element which contains the ACF fields
     * @return void
     */

    acf.add_action('ready append', function (element) {
        acf
          .get_fields(
            {
              type: 'maskfield',
            },
            element
          )
          .each(function () {
            initialize_field( $(this) );
          });
    });

    /**
     *  initialize_field
     *
     *  This function will initialize the $field.
     *
     *  @date	30/11/17
     *  @since	5.6.5
     *
     *  @param	n/a
     *  @return	n/a
     */
    function initialize_field($field) {
        // get input field
        // console.log($field);
        var $maskInput = $field.find('input.item-mask');
        setMask($maskInput);
    }

    /**
     * Set Mask 
     * @param {type} $field
     * @returns {undefined}
     */
    function setMask($field) {
        $field.inputmask('remove');
        $field.inputmask($field.attr('regexp'));
    }
    
})(jQuery);