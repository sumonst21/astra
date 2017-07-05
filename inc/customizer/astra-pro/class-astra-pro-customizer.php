<?php
    /**
     * Astra Pro customizer section.
     *
     * @since  1.0.0
     * @access public
     */
    class Astra_Pro_Customizer extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'astra-pro';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function json() {
            $json = parent::json();
            $json['pro_url']  = esc_url( $this->pro_url );
            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand control-section-default">
                <h3>
                    <# if ( data.title && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" target="_blank">{{ data.title }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }